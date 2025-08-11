{{ include('layouts/header.php', {title: 'Mon profil'})}}

<h1>Mon profil</h1>

<div class="profil">
    <div class="profil__info">
        <h2>Informations personnelles</h2>
        <p>Nom : {{ user.name }}</p>
        <p>Email : {{ user.email }}</p>
    </div>
    <div class="profil__actions">
        <a href="{{ base }}/user/edit" class="button">Modifier mon profil</a>
    </div>
</div>

{{ include('layouts/footer.php')}}