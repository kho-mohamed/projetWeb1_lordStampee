</main>
<footer class="piedpage">
    <picture class="piedpage__logo">
        <img src="{{ asset }}/images/logo.webp" alt="Logo de Lord Stampee" />
    </picture>
    <nav class="piedpage__nav-principale">
        <a href="{{ base }}/index" class="piedpage__lien1">Notre histoire</a>
        <a href="{{ base }}/enchere/index" class="piedpage__lien1">Enchères</a>
        {% if session.user_id is defined %}
        <a href="{{ base }}/favoris/index" class="piedpage__lien1">Favoris</a>
        {% endif %}
        <a href="{{ base }}/user/index" class="piedpage__lien1">Profil</a>
    </nav>
    <nav class="piedpage__nav-secondaire">
        <a href="#" class="piedpage__lien2">À propos de nous</a>
        <a href="#" class="piedpage__lien2">Mentions légales</a>
        <a href="#" class="piedpage__lien2">Confidentialité</a>
        <a href="#" class="piedpage__lien2">Signaler un problème</a>
    </nav>
    <small>&copy; 2025 Projet patrimoine philatélique — Tous droits
        réservés</small>
</footer>
</body>

</html>