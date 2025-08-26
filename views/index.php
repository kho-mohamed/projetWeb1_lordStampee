{{ include('layouts/header.php', {title: 'Page d\'accueil'})}}

<main class="corps">
    <div class="carte">
        <article class="carte__contenue-additionnel">
            <h1>Mission de Stampee</h1>

            <small>Prestigieuse maison de vente aux enchères</small>
            <p>
                Bienvenue sur Stampee, la première plateforme d’enchères en ligne
                dédiée exclusivement à la philatélie. Fondée sous l’impulsion du
                distingué Lord Reginald Stampee, Stampee a pour mission de
                rassembler les collectionneurs de timbres du monde entier autour
                d’une expérience à la fois simple, élégante et raffinée. Ici, chaque
                enchère raconte une histoire, chaque timbre porte une mémoire, et
                chaque mise est une promesse d’héritage.
            </p>

            <h3>Les enchères en vedette</h3>

            <p>
                Découvrez nos enchères les plus populaires et les “Coups de cœur du
                Lord”, soigneusement sélectionnés pour leur rareté, leur valeur
                historique ou leur beauté exceptionnelle.
            </p>

            <p>
                Ces timbres uniques sont disponibles pour une durée limitée – à vous
                de jouer et de placer votre mise avant qu’il ne soit trop tard.
            </p>

            <h3>À propos de Lord Reginald Stampee</h3>

            <p>
                Collectionneur passionné depuis les années 1950, Lord Reginald
                Stampee, duc de Worcessteshear, a consacré sa vie à la philatélie.
                Il est reconnu mondialement pour la qualité et l’authenticité de sa
                collection, ainsi que pour ses célèbres enchères organisées chaque
                saison dans les salons prestigieux du Royaume-Uni.
            </p>

            <p>Restez informé des dernières actualités du monde des timbres :</p>
            <ul>
                <li>Prochaines grandes ventes</li>
                <li>Nouveaux timbres ajoutés à la plateforme</li>
                <li>
                    Articles sur l’histoire postale et les techniques de collection
                </li>
            </ul>

            <h3>Naviguez facilement dans l’univers Stampee</h3>

            <p>
                Que vous soyez néophyte ou expert philatéliste, Stampee vous offre
                une navigation fluide et intuitive pour accéder rapidement à :
            </p>

            <ul>
                <li>Toutes les enchères en cours</li>
                <li>Votre profil et vos mises</li>
                <li>Vos enchères favorites</li>
                <li>Le fonctionnement de la plateforme</li>
                <li>Les archives des enchères passées</li>
                <li>Et bien sûr… tout savoir sur le Lord et la philatélie</li>
            </ul>

            <h3>Rejoignez la communauté Stampee</h3>

            <p>
                Devenez membre gratuitement et commencez à suivre, miser et
                découvrir des trésors postaux du monde entier. Inscription rapide –
                Enchères ouvertes à tous !
            </p>

            <p>Stampee, entre tradition et modernité</p>

            <p>
                Pensée pour les collectionneurs d’hier et d’aujourd’hui, Stampee
                marie l’élégance classique à une technologie moderne. Entrez dans
                l’univers du Lord, où chaque timbre vaut bien plus qu’un bout de
                papier… c’est une pièce d’histoire.
            </p>
        </article>
        <article class="carte__selection-produit">
            <h2>Timbres vedettes</h2>
            <div class="galerie">
                {% for timbre in timbres %}
                {% set paysNom = '' %}
                {% set encherePrix = '' %}
                {% set imageLien = '' %}
                {% for image in images %}
                {% if image.timbreId == timbre.id %}
                {% set imageLien = image.lien %}
                {% endif %}
                {% endfor %}
                {% for pay in pays %}
                {% if pay.id == timbre.paysId %}
                {% set paysNom = pay.nom %}
                {% endif %}
                {% endfor %}
                {% for enchere in encheres %}
                {% if enchere.timbreId == timbre.id %}
                {% set encherePrix = enchere.prix_plancher %}
                {% endif %}
                {% endfor %}

                <a class="galerie__carte">
                    <picture class="galerie__carte__image"><img src="{{asset}}/{{ imageLien }}" alt="timbre" />
                    </picture>
                    <div class="galerie__carte__information">
                        <h2 class="galerie__carte__titre">{{ timbre.nom }}</h2>
                        <div class="galerie__carte__info">
                            <div class="galerie__carte__type">
                                <ul>
                                    <li>Pays:</li>
                                    <li>Prix de base :</li>
                                </ul>
                            </div>
                            <div class="galerie__carte__detail">
                                <ul>
                                    <li>{{ paysNom }}</li>
                                    <li>{{ encherePrix }} CAD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
                {% endfor %}

            </div>
        </article>
    </div>
</main>

{{ include('layouts/footer.php')}}