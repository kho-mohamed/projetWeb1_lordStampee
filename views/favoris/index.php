{{ include('layouts/header.php', {title: 'Listes de vos favoris'})}}

<main class="corps">
    <h1 class="sr-only">Catalogue des enchères favoris.</h1>
    <section class="catalogue">
        {% for enchere in encheres %}
        {% set timbreObjet = null %}
        {% set paysInput = '' %}
        {% set imageLien = '' %}
        {% for timbre in timbres %}
         {% if timbre.id == enchere.timbreId %}
                {% set timbreObjet = timbre %}
                {% set imageLien = images[timbre.id] ?? '' %}
         {% for pay in pays %}
            {% if pay.id == timbreObjet.paysId %}
            {% set paysInput = pay.nom %}
            {% endif %}
        {% endfor %}
        {% endif %}
        {% endfor %}

        <script class="enchereindex-json" id="liste-enchere-json{{ enchere.id }}" type="application/json">
    {{ {
        id: enchere.id,
        date_debut: enchere.date_debut|date('c'),
        date_fin: enchere.date_fin|date('c'),
        timbreId: timbreObjet ? timbreObjet.id : null,
        timbreDate: timbreObjet ? timbreObjet.date_creation : null,
        nom: timbreObjet ? timbreObjet.nom : null,
        prix_plancher: enchere.prix_plancher,
        pays: timbreObjet ? timbreObjet.paysId : null,
        paysNom: paysInput,
        imagePrincipale: imageLien
    }|json_encode|raw }}
    </script>

        <a class="carte-catalogue" href="{{base}}/enchere/show?id={{ enchere.id }}">
            <picture class="carte-catalogue__image"><img src="{{ asset }}/{{ imageLien }}" alt="timbre" />
            </picture>
            <h2 class="carte-catalogue__titre">{{timbreObjet.nom}}</h2>
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
                        class="compteur-enchere" id="compteur-enchere{{ enchere.id }}">2j : 5h : 30mn</span>
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