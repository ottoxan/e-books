<?php
session_start();
$mysqli = require "config/database.php";

// Make sure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id']; // get current logged-in user's ID
$email = '';
$name = '';
$password = '';
$confirm_password = '';
$error_message = '';
$success_message = '';

// Fetch current user info
$stmt = $mysqli->prepare("SELECT name, email FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $name = $row['name'];
    $email = $row['email'];
} else {
    $error_message = "User not found.";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    do {
        if (empty($email)) {
            $error_message = "Email is required";
            break;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format";
            break;
        }

        // If user entered a new password, check confirmation
        if (!empty($password)) {
            if ($password !== $confirm_password) {
                $error_message = "Password and confirmation do not match";
                break;
            }

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("UPDATE user SET email = ?, password_hash = ? WHERE id = ?");
            $stmt->bind_param("ssi", $email, $password_hash, $id);
        } else {
            // Update only email if password left blank
            $stmt = $mysqli->prepare("UPDATE user SET email = ? WHERE id = ?");
            $stmt->bind_param("si", $email, $id);
        }

        if (!$stmt->execute()) {
            $error_message = "Error: " . $stmt->error;
            break;
        }

        $success_message = "Profile updated successfully";
    } while (false);
}
?>

<?php include 'partials/header.php'; ?>

<?php if (!empty($success_message)) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $success_message; ?>
    </div>
<?php } ?>

<div class="form-popup-bg is-visible">
    <div class="form-container">
        <?php if (!empty($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <form method="POST">
            <h1>Edit Profile</h1>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="<?php echo htmlspecialchars($email); ?>"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="password">New Password (leave blank to keep current)</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password">
            </div>

            <div class="form-group mb-3">
                <label for="confirm_password">Confirm New Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="confirm_password"
                    name="confirm_password">
            </div>

            <div class="row mb-3">
                <div class="offset-sm-4 col-sm-4 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>