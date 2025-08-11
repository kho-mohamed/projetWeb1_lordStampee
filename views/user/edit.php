{{ include('layouts/header.php', {title: 'modification membre'})}}


<div class="form-container">
    <h1 class="form_header">Modification des informations</h1>
    <form action="{{base}}/user/update?id={{user.id}}" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="{{user.nom}}">

        {% if errors.nom is defined %}
        <span class="error">{{ errors.nom }}</span>
        {% endif %}
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="{{user.prenom}}">

        {% if errors.prenom is defined %}
        <span class="error">{{ errors.prenom }}</span>
        {% endif %}

        <label for="login">Login :</label>
        <input type="text" name="login" id="login" value="{{user.login}}" readonly>
        {% if errors.login is defined %}
        <span class="error">{{ errors.login }}</span>
        {% endif %}

        <label for="motDePasse">Mot de passe :</label>
        <input type="password" name="motDePasse" id="motDePasse" value="">
        {% if errors.motDePasse is defined %}
        <span class="error">{{ errors.motDePasse }}</span>
        {% endif %}

        <label for="email">Courriel :</label>
        <input type="email" name="email" id="email" value="{{user.email}}">
        {% if errors.email is defined %}
        <span class="error">{{ errors.email }}</span>
        {% endif %}

        <button type="submit">Enregistrer</button>
    </form>
</div>

{{ include('layouts/footer.php')}}