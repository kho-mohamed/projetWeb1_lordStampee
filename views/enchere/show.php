{{ include('layouts/header.php', {title: 'Fiche d\'enchère'})}}
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
                    {% if favoris %}

                    <form action="{{base}}/favoris/delete" method="POST" class="carte__description__notification">
                        <input type="hidden" name="enchere_id" value="{{ enchere.id }}">
                        <input type="hidden" name="membre_id" value="{{ timbre.membreId }}">
                        <button type="submit" class="favoris">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="#b13f3f" stroke="#b13f3f" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" role="img" aria-label="Retirer des favoris">
                                <title>Retirer des favoris</title>
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z" />
                            </svg>
                        </button>
                    </form>
                    {% else %}
                    <form action="{{base}}/favoris/insert" method="POST" class="carte__description__notification">
                        <input type="hidden" name="enchere_id" value="{{ enchere.id }}">
                        <input type="hidden" name="membre_id" value="{{ timbre.membreId }}">
                        <button type="submit" class="favoris">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#b13f3f" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" role="img" aria-label="Ajouter aux favoris">
                                <title>Ajouter aux favoris</title>
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z" />
                            </svg>
                        </button>
                    </form>
                    {% endif %}
                </div>
                <form action="{{base}}/mise/insert" class="carte__action carte__element-flex" method="POST">
                    <div class="carte__action__prix">
                        <span class="carte__action__prix_text">Prix Plancher :</span>
                        <span class="carte__action__prix__chiffre">{{ enchere.prix_plancher }} CAD</span>
                    </div>
                    <input type="hidden" name="enchereId" value="{{ enchere.id }}">
                    <input type="hidden" name="membreId" value="{{ timbre.membreId }}">
                    <input type="hidden" name="date_mise" value="{{ " now"|date("Y-m-d") }}">
                    <!-- <div class="carte__action__boutton">
                        <a class="carte__action__boutton__style carte__action__boutton__suivre" data-favoris="oui"
                            href="#">Ajouter à mes
                            favoris</a>
                        <a class="carte__action__boutton__style carte__action__boutton__offre" href="#">Faire une
                            mise</a>
                    </div> -->

                    <div class="carte__action__boutton">
                        <input type="number" name="montant" step="0.01" min="{{enchere.prix_plancher}}"
                            class="carte__action__boutton__style carte__action__boutton__suivre" />
                        {% if errors.montant is defined %}
                        <span class="error">{{ errors.montant }}</span>
                        {% endif %}
                        <button type="submit" class="carte__action__boutton__style carte__action__boutton__offre">
                            Faire une mise
                        </button>
                    </div>
                </form>
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


    </div>
</main>

{{ include('layouts/footer.php')}}