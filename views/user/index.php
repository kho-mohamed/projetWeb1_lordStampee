{{ include('layouts/header.php', {title: 'Mon profil'})}}

<main class="corps">
    <div class="profil">
        <div class="profil__header">
            <div class="profil__avatar">
                {{ user.prenom|slice(0, 1)|upper }}{{ user.nom|slice(0, 1)|upper }}
            </div>
            <h1>Mon Profil</h1>
            <p>Bienvenue, {{ user.prenom }} {{ user.nom }}</p>
        </div>

        <div class="profil__content">
            <div class="profil__info">
                <h2>Informations personnelles</h2>

                <div class="profil__field">
                    <span class="profil__label">Nom :</span>
                    <span class="profil__value">{{ user.nom }}</span>
                </div>

                <div class="profil__field">
                    <span class="profil__label">Prénom :</span>
                    <span class="profil__value">{{ user.prenom }}</span>
                </div>

                <div class="profil__field">
                    <span class="profil__label">Login :</span>
                    <span class="profil__value">{{ user.login }}</span>
                </div>

                <div class="profil__field">
                    <span class="profil__label">Email :</span>
                    <span class="profil__value">{{ user.email }}</span>
                </div>
            </div>

            <div class="profil__stats">
                <h2>Mes options</h2>

                <div class="profil__stat-item">
                    <a class="profil__stat-label" href="{{base}}/timbres/index">Mes timbres <svg width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="Ouvrir le lien">
                            <path d="M14 3h7v7" />
                            <path d="M21 3l-9 9" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h7" />
                        </svg></a>
                    <a class="profil__stat-label" href="{{base}}/timbres/create">Ajouter un timbre <svg width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="Ouvrir le lien">
                            <path d="M14 3h7v7" />
                            <path d="M21 3l-9 9" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h7" />
                        </svg></a>

                </div>

                <div class="profil__stat-item">
                    <a class="profil__stat-label" href="{{base}}/mise/index">Mes Mises <svg width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="Ouvrir le lien">
                            <path d="M14 3h7v7" />
                            <path d="M21 3l-9 9" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h7" />
                        </svg></a>
                </div>

                <div class="profil__stat-item">
                    <a class="profil__stat-label" href="{{base}}/favoris/index">Favoris <svg width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="Ouvrir le lien">
                            <path d="M14 3h7v7" />
                            <path d="M21 3l-9 9" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h7" />
                        </svg></a>
                </div>
            </div>
        </div>

        <div class="profil__actions">
            <a href="{{ base }}/user/edit" class="profil__button">
                Modifier mon profil
            </a>
            <a href="{{ base }}/user/delete" class="profil__button">
                Supprimer mon profil
            </a>
            <a href="{{ base }}/logout" class="profil__button profil__button--secondary">
                Se déconnecter
            </a>
        </div>
    </div>
</main>

{{ include('layouts/footer.php')}}