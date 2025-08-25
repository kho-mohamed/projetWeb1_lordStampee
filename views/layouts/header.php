<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset }}/css/style.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&family=Raleway:wght@300;400;700&display=swap"
        rel="stylesheet" />
    <script type="module" src="{{ asset }}/scripts/main.js"></script>
    <title>{{ title }}</title>
</head>

<body>
    <header class="entete">
        <picture class="entete__logo">
            <img class="entete__logo-image" src="{{ asset }}/images/logo.webp" alt="Logo de Lord Stampee" />
        </picture>
        <div class="entete__navigation">
            <nav class="entete__nav-secondaire">
                <div class="entete__config">
                    <select name="devise" id="devise">
                        <option value="cad">CAD</option>
                        <option value="usd">USD</option>
                    </select>
                </div>
                <div class="entete__config">
                    <select name="langue" id="langue">
                        <option value="fr">Fr</option>
                        <option value="en">En</option>
                    </select>
                </div>
                <div class="entete__config"><a href="#">Nous contacter</a></div>
            </nav>
            <div class="entete__nav-principale">
                <nav class="menu_hamburger">
                    <input type="checkbox" id="menu_hamburger__action" class="menu_hamburger__action" hidden />
                    <label for="menu_hamburger__action" class="menu_hamburger__entete">
                        <span class="menu_hamburger__symbole">☰</span>
                        <span class="menu_hamburger__titre">Enchères</span>
                    </label>
                    <ul class="menu_hamburger__liste menu_hamburger__styleliste">
                        <li class="menu_hamburger__item">
                            <a href="#">Les enchères encours</a>
                        </li>

                        <li class="menu_hamburger__item">
                            <a href="#">Les enchères à venir</a>
                        </li>
                        <li class="menu_hamburger__item">
                            <a href="#">Les enchères archivés</a>
                        </li>
                        <li class="menu_hamburger__conteneur-sous-liste">
                            <a class="menu_hamburger__titre-sous-liste" href="#">Les enchères historiques</a>
                            <ul class="menu_hamburger__sous-liste menu_hamburger__styleliste">
                                <li class="menu_hamburger__sous-liste__item">
                                    <a href="#">Les enchères historiques du Lord Stampee</a>
                                </li>
                                <li class="menu_hamburger__sous-liste__item">
                                    <a href="#">Les enchères historiques mondial</a>
                                </li>
                                <li class="menu_hamburger__sous-liste__item">
                                    <a href="#">Les meilleures timbres de l'histoire</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class=" entete__logo entete__logo2"></div>

                <div class="entete__recherche">
                    <input type="search" placeholder="Quel timbre cherchez-vous ?" />
                    <button type="submit">
                        <img src="{{ asset }}/images/rechercher.webp" alt="Icône de recherche" />
                    </button>
                </div>
                {% if session.user_id is not defined %}
                <div class="entete__connexion">
                    <a href="{{ base }}/login"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            role="img" aria-labelledby="title-login">
                            <title id="title-login">Se connecter</title>
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg></a>
                </div>
                <div class="entete__connexion">
                    <a href="{{ base }}/user/create"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            role="img" aria-labelledby="title-user-plus">
                            <title id="title-user-plus">S'enregistrer</title>
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4.4 3.6-8 8-8" />
                            <line x1="20" y1="8" x2="20" y2="14" />
                            <line x1="17" y1="11" x2="23" y2="11" />
                        </svg></a>
                </div>
                {% endif %}
                {% if session.user_id is defined %}
                <div class="entete__connexion">
                    <a href="{{ base }}/user/index"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            role="img" aria-labelledby="title-user-circle">
                            <title id="title-user-circle">Compte</title>
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="10" r="3" />
                            <path d="M6 20c0-3.3 2.7-6 6-6s6 2.7 6 6" />
                        </svg></a>
                </div>
                {% endif %}

                <picture class="entete__notifications">
                    <img src="{{ asset }}/images/bouton-notifications.webp" alt="Notifications" />
                </picture>
            </div>
        </div>
    </header>

    <main class="corps">