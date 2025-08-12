{{ include('layouts/header.php', {title: 'Error'})}}
<div class="container">
    <h2>Page ERREUR 404</h2>
    <strong class="error">{{ message }}</strong>
</div>
{{ include('layouts/footer.php')}}