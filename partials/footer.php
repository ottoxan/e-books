<!-- Footer -->
<footer>
    <ul>
        <li><a href="#about"><?= __('About') ?></a></li>
        <li><a href="#contact"><?= __('Contact') ?></a></li>
    </ul>
    <p class="copyright">&copy; All Rights Reserved</p>
</footer>

</div> <!-- Tutup wrapper -->
<script>
    // Set language on dropdown from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const lang = localStorage.getItem('lang') || 'en';
        document.getElementById('languageSelect').value = lang;
        setLangParam(lang, false);
    });

    function changeLanguage(lang) {
        localStorage.setItem('lang', lang);
        setLangParam(lang, true);
    }

    // Update the URL parameter for language and optionally reload
    function setLangParam(lang, reload = false) {
        const url = new URL(window.location);
        url.searchParams.set('lang', lang);
        if (reload) {
            window.location = url.toString();
        } else {
            window.history.replaceState({}, '', url);
        }
    }
</script>
<script>
    function redirectToSearch() {
        var query = document.getElementById('searchInput').value;
        if (query.trim() !== "") {
            window.location.href = 'http://localhost/bookSearch.php?q=' + encodeURIComponent(query);
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>