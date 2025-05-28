

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>