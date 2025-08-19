{{ include('layouts/header.php', {title: 'Liste des enchères'})}}

<main class="corps">
    <h1 class="sr-only">Catalogue de timbres aux enchères</h1>
    <section class="filtre">
        <div class="filtre__entete">
            <picture class="filtre__icone"><img src="{{asset}}/images/filtre.webp" alt="filtre" /></picture>
            <h2 class="filtre__titre">Filtres</h2>
        </div>
        <div class="filtre__corps">
            <div class="filtre__boutton">
                <span>Par types de timbres</span>
                <picture><img src="{{ asset }}/images/dropdown.webp" alt="dropdown" /></picture>
                <ul class="filtre__sous-menu">
                    <li class="filtre_sous-menu-item">Timbres-poste</li>
                    <li class="filtre_sous-menu-item">Timbres commémoratifs</li>
                    <li class="filtre_sous-menu-item">Timbres courants</li>
                    <li class="filtre_sous-menu-item">Timbres de poste aérienne</li>
                    <li class="filtre_sous-menu-item">Timbres fiscaux</li>
                    <li class="filtre_sous-menu-item">Timbres de service</li>
                    <li class="filtre_sous-menu-item">Préoblitérés</li>
                    <li class="filtre_sous-menu-item">
                        Carnets / Blocs / Feuilles complètes
                    </li>
                </ul>
            </div>
            <div class="filtre__boutton">
                <span>Par origine géographique</span>
                <picture><img src="{{ asset }}/images/dropdown.webp" alt="dropdown" /></picture>
            </div>
            <div class="filtre__boutton">
                <span>Par période d'émission</span>
                <picture><img src="{{ asset }}/images/dropdown.webp" alt="dropdown" /></picture>
            </div>
            <div class="filtre__boutton">
                <span>Par état du timbre</span>
                <picture><img src="{{ asset }}/images/dropdown.webp" alt="dropdown" /></picture>
            </div>
            <div class="filtre__boutton">
                <span>Par thématique</span>
                <picture><img src="{{ asset }}/images/dropdown.webp" alt="dropdown" /></picture>
            </div>
            <div class="filtre__boutton">
                <span>Par statut d'enchère</span>
                <picture><img src="{{ asset }}/images/dropdown.webp" alt="dropdown" /></picture>
            </div>
            <div class="filtre__boutton">
                <span>Par tranches de Prix</span>
                <picture><img src="{{ asset }}/images/dropdown.webp" alt="dropdown" /></picture>
                <ul class="filtre__sous-menu">
                    <li class="filtre_sous-menu-item">0 - 100CAD</li>
                    <li class="filtre_sous-menu-item">101 - 500CAD</li>
                    <li></li>
                    <li class="filtre_sous-menu-item">501 -1000CAD</li>
                    <li class="filtre_sous-menu-item">plus que 1000CAD</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="catalogue">
        {% for enchere in encheres %}
        {% set timbreObjet= '' %}
        {% set couleurInput= '' %}
        {% set paysInput = '' %}
        {% set conditionInput = '' %}
        {% set imageInput = '' %}
        {% set imageInput2 = '' %}
        {% for timbre in timbres %}
        {%if timbre.id == enchere.timbreId %}
        {% set timbreObjet = timbre %}
        {% for couleur in couleurs %}
        {% if couleur.id == timbreObjet.couleurId %}
        {% set couleurInput = couleur.nom %}
        {% endif %}
        {% endfor %}
        {% for pay in pays %}
        {% if pay.id == timbreObjet.paysId %}
        {% set paysInput = pay.nom %}
        {% endif %}
        {% endfor %}
        {% for condition in conditions %}
        {% if condition.id == timbreObjet.conditionId %}
        {% set conditionInput = condition.nom %}
        {% endif %}
        {% endfor %}
        {% for image in images %}
        {% if image.timbreId == timbreObjet.id and image.principale == 1 %}
        {% set imageInput = image %}
        {% endif %}
        {% if image.timbreId == timbreObjet.id and image.principale != 1 %}
        {% set imageInput2 = image %}
        {% endif %}
        {% endfor %}
        {% endif %}
        {% endfor %}

        <script class="enchere-json" id="enchere-json{{ enchere.id }}" type="application/json">
    {{ {
        id: enchere.id,
        date_debut: enchere.date_debut|date('c'),
        date_fin: enchere.date_fin|date('c')
    }|json_encode|raw }}
    </script>

        <a class="carte-catalogue" href="{{base}}/enchere/show?id={{ enchere.id }}">
            <picture class="carte-catalogue__image"><img src="{{ asset }}/{{ imageInput.lien }}" alt="timbre" />
            </picture>
            <h2 class="carte-catalogue__titre">{{timbre.nom}}</h2>
            <div class="carte-catalogue__info">
                <div class="carte-catalogue__type">
                    <ul>
                        <li>Pays:</li>
                        <li>Prix Plancher :</li>
                    </ul>
                </div>
                <div class="carte-catalogue__detail">
                    <ul>
                        <li>{{paysInput}}</li>
                        <li>{{enchere.prix_plancher}} CAD</li>
                    </ul>
                </div>
            </div>
            <div class="carte-catalogue__action">
                <div class="carte-catalogue__rebourt">
                    <picture><img src="{{asset}}/images/sablier.webp" alt="sablier" /></picture><span
                        class="compteur-enchere">2j : 5h : 30mn</span>
                </div>
                <div class="carte-catalogue__achat">
                    <span>Voir l'enchère</span>
                    <picture><img src="{{asset}}/images/encheres.webp" alt="enchere" /></picture>
                </div>
            </div>
        </a>

        {% endfor %}
    </section>
</main>

{{ include('layouts/footer.php')}}