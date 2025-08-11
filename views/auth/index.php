{{ include('layouts/header.php', {title: 'page de connection'})}}

<div class="form-container">
    <h1 class="form_header">Page de connection</h1>
    <form action="{{base}}/login" method="POST">
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" value="{{user.login}}">
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" name="motDePasse" id="motDePasse" value="{{user.motDePasse}}">

        {% if errors.message is defined %}
        <span class="error">{{ errors.message }}</span>
        {% endif %}

        {% if errors.login is defined %}
        <span class="error">{{ errors.login }}</span>
        {% endif %}

        {% if errors.motdepass is defined %}
        <span class="error">{{ errors.motDePasse }}</span>
        {% endif %}

        <button type="submit">S'authentifier</button>
    </form>
</div>

{{ include('layouts/footer.php')}}