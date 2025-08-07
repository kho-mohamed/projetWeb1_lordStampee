<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset }}/css/style.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&family=Raleway:wght@300;400;700&display=swap"
        rel="stylesheet" />
    <title>{{ title }}</title>
</head>

<body>
    <header class="entete">
        <picture class="entete__logo">
            <img src="{{ asset }}/images/logo.webp" alt="Logo de Lord Stampee" />
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

                <div class="entete__recherche">
                    <input type="search" placeholder="Quel timbre cherchez-vous ?" />
                    <button type="submit">
                        <img src="{{ asset }}/images/rechercher.webp" alt="Icône de recherche" />
                    </button>
                </div>

                <div class="entete__connexion">
                    <a href="#">Se connecter</a>
                </div>

                <picture class="entete__notifications">
                    <img src="{{ asset }}/images/bouton-notifications.webp" alt="Notifications" />
                </picture>
            </div>
        </div>
    </header>

    <main class="corps">