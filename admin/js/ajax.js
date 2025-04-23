// function loadContent(method, url, targetId = "content-main") { 
//     const target = document.getElementById(targetId);

//     const xhttp = new XMLHttpRequest();
//     xhttp.open(method === '' ? "GET" : method, url, true);
//     xhttp.onload = function () {

//         if (xhttp.status === 200) {
//             target.innerHTML = xhttp.responseText;
//         } else {
//             target.innerHTML = "<p>Failed to load content.</p>";
//             console.error("Failed to load content: " + xhttp.status);
//         }
//     };
//     xhttp.onerror = function () {
//         target.innerHTML = "<p>An error occurred while loading the content.</p>";
//         console.error("An error occurred while loading the content.");
//     };
//     xhttp.send();


// }

function executePHP(url) {
    fetch(url)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }
            return response.text();
        })
        .then((data) => {
            console.log("PHP executed successfully:");
            // Optionally, update a specific part of the page with the response
            document.getElementById("content-main").innerHTML = data;
        })
        .catch((error) => {
            console.error("Error executing PHP:", error);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(form);

            fetch('create-academic.php', {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(data.message); // Show success message
                        closeForm(); // Close the form popup
                        // Optionally, reload or update the table dynamically
                    } else {
                        alert(data.message); // Show error message
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('An error occurred while creating the academic stage.');
                });
        });
    }
});