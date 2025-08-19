{{ include('layouts/header.php', {title: 'Liste des enchères'})}}
<script id="enchere-json" type="application/json">
  {{ {
      id: enchere.id,
      date_debut: enchere.date_debut|date('c'),
      date_fin: enchere.date_fin|date('c')
  }|json_encode|raw }}
</script>
<main class="corps">
    <div class="carte">
        <article class="carte__produit-principal">
            <h1 class="sr-only" data-enchere="{{ enchere.id }}" data-membre="{{ timbre.membreId }}">Fiche de l'enchère
            </h1>
            <div class="carte__carrousel">
                {% for image in images %}
                <picture class="carte__carrousel__miniature"><img src="{{asset}}/{{ image.lien }}" alt="{{timbre.nom}}"
                        data-principale="{{ image.principale }}" />
                </picture>
                {% endfor %}

            </div>
            <picture class="carte__image-principal">
                <img src="" alt="" />
            </picture>


            <section class="carte__description carte__element-flex">
                <div class="carte__description__titre">
                    <h2>
                        {{ timbre.nom }}
                    </h2>
                    <picture class="carte__description__notification">
                        <img src="{{asset}}/images/bouton-notifications.webp" alt="Notifications" />
                    </picture>
                </div>
                <div class="carte__action carte__element-flex">
                    <div class="carte__action__prix">
                        <span class="carte__action__prix_text">Prix Plancher :</span>
                        <span class="carte__action__prix__chiffre">{{ enchere.prix_plancher }} CAD</span>
                    </div>
                    <div class="carte__action__boutton">
                        <a class="carte__action__boutton__style carte__action__boutton__offre" href="#">Faire une
                            mise</a>
                        <a class="carte__action__boutton__style carte__action__boutton__suivre" data-favoris="oui"
                            href="#">Ajouter à mes
                            favoris</a>
                    </div>
                </div>
                <div class="carte__compteur carte__element-flex compteur-enchere">

                </div>
                <section class="carte__description__details">
                    <h2>Détails du timbre</h2>
                    <ul>
                        <li><strong>Condition :</strong> {{ condition}}</li>
                        <li><strong>Date :</strong> {{ timbre.date_creation }}</li>
                        <li><strong>Dimension :</strong> {{ timbre.dimension }}</li>
                        <li><strong>Couleur :</strong> {{ couleur }}</li>
                        <li><strong>Tirage :</strong> {{ timbre.tirage }}</li>
                        <li><strong>Pays :</strong> {{ pays }}</li>
                        <li><strong>Certifié :</strong> {{ timbre.certifie ? 'oui' : 'non' }}</li>
                    </ul>
                </section>
            </section>
        </article>

        <article class="carte__selection-produit">
            <h2>Timbres smilaires</h2>
            <div class="galerie">
                <a class="galerie__carte">
                    <picture class="galerie__carte__image"><img src="assets/image_produit/timbre2.webp" alt="timbre" />
                    </picture>
                    <div class="galerie__carte__information">
                        <h2 class="galerie__carte__titre">Timbres US POSTAGE</h2>
                        <div class="galerie__carte__info">
                            <div class="galerie__carte__type">
                                <ul>
                                    <li>Pays:</li>
                                    <li>Prix de base :</li>
                                </ul>
                            </div>
                            <div class="galerie__carte__detail">
                                <ul>
                                    <li>États-Unis</li>
                                    <li>250 CAD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="galerie__carte">
                    <picture class="galerie__carte__image"><img src="assets/image_produit/timbre4.webp" alt="timbre" />
                    </picture>
                    <div class="galerie__carte__information">
                        <h2 class="galerie__carte__titre">Timbres Japan 1964</h2>
                        <div class="galerie__carte__info">
                            <div class="galerie__carte__type">
                                <ul>
                                    <li>Pays:</li>
                                    <li>Prix de base :</li>
                                </ul>
                            </div>
                            <div class="galerie__carte__detail">
                                <ul>
                                    <li>Japan</li>
                                    <li>300 CAD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="galerie__carte">
                    <picture class="carte-catalogue__image"><img src="assets/image_produit/timbre7.webp" alt="timbre" />
                    </picture>
                    <div class="galerie__carte__information">
                        <h2 class="galerie__carte__titre">Timbres Simon Veil</h2>
                        <div class="galerie__carte__info">
                            <div class="galerie__carte__type">
                                <ul>
                                    <li>Pays:</li>
                                    <li>Prix de base :</li>
                                </ul>
                            </div>
                            <div class="cgalerie__carte__detail">
                                <ul>
                                    <li>France</li>
                                    <li>50 CAD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="galerie__carte">
                    <picture class="carte-catalogue__image"><img src="assets/image_produit/timbre5.webp" alt="timbre" />
                    </picture>
                    <div class="galerie__carte__information">
                        <h2 class="galerie__carte__titre">Timbres Grande Bretagne</h2>
                        <div class="galerie__carte__info">
                            <div class="galerie__carte__type">
                                <ul>
                                    <li>Pays:</li>
                                    <li>Prix de base :</li>
                                </ul>
                            </div>
                            <div class="cgalerie__carte__detail">
                                <ul>
                                    <li>Angleterre</li>
                                    <li>260 CAD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="galerie__carte">
                    <picture class="carte-catalogue__image"><img src="assets/image_produit/timbre6.webp" alt="timbre" />
                    </picture>
                    <div class="galerie__carte__information">
                        <h2 class="galerie__carte__titre">Timbres 1916</h2>
                        <div class="galerie__carte__info">
                            <div class="galerie__carte__type">
                                <ul>
                                    <li>Pays:</li>
                                    <li>Prix de base :</li>
                                </ul>
                            </div>
                            <div class="cgalerie__carte__detail">
                                <ul>
                                    <li>allemagne</li>
                                    <li>85 CAD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </article>
    </div>
</main>

{{ include('layouts/footer.php')}}