<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://source.unsplash.com/1600x900/?nature,water');
            /* Gambar background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .box {
            background-color: rgba(255, 255, 255, 0.85);
            /* Warna latar belakang kotak, semi-transparan */
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="box border border-2 rounded p-5 shadow text-center">
            <h1>Home</h1>
            <p>Hello, this is the index page.</p>
            <a type="button" class="btn btn-primary" href="admin/login.php">Login</a>
        </div>
    </div>
</body>

</html>