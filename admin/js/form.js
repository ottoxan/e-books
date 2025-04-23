function closeForm() {
    document.querySelector('.form-popup-bg').classList.remove('is-visible');
}

function openForm() {
    const formPopupBg = document.querySelector('.form-popup-bg');
    if (formPopupBg) {
        formPopupBg.classList.add('is-visible');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Attach the close functionality to the close button
    const btnCloseForm = document.getElementById('btnCloseForm');
    if (btnCloseForm) {
        btnCloseForm.addEventListener('click', function (event) {
            event.preventDefault();
            closeForm();
        });
    }

    const form = document.getElementById('createForm');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(form);

            fetch('create-academic.php', {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.text())
                .then((data) => {
                    console.log(data); // Log the server response for debugging
                    // Optionally, display a success message or close the form
                    closeForm();
                    alert('Academic stage created successfully!');
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('An error occurred while creating the academic stage.');
                });
        });
    }
});