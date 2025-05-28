
// On page load, set dark mode if saved in localStorage
document.addEventListener('DOMContentLoaded', function () {
    const isDark = localStorage.getItem('darkmode') === 'true';
    document.body.classList.toggle('dark', isDark);
    document.getElementById('switch-mode').checked = isDark;
});

// Listen for toggle changes
document.getElementById('switch-mode').addEventListener('change', function () {
    const isDark = this.checked;
    document.body.classList.toggle('dark', isDark);
    localStorage.setItem('darkmode', isDark);
});
