{{ include('layouts/header.php', {title: 'Résultat recherche'})}}

<main class="corps">
    <h1 class="sr-only">Résultat de la recherche</h1>
    <section class="catalogue">
        {% for timbre in timbres %}
        {% set enchereId = null %}
        {% set encherePrix = null %}
        {% set paysInput = '' %}
        {% for enchere in encheres %}
        {% if enchere.timbreId == timbre.id %}
        {% set enchereId = enchere.id %}
        {% set encherePrix = enchere.prix_plancher %}
        {% endif %}
        {% endfor %}

        <a class="carte-catalogue"
            href="{% if enchereId %}{{base}}/enchere/show?id={{ enchereId }}{% else %}#{% endif %}">
            <h2 class="carte-catalogue__titre">{{timbre.nom}}</h2>
            <div class="carte-catalogue__info">
                <div class="carte-catalogue__type">
                    <ul>
                        <li>Prix Plancher :</li>
                    </ul>
                </div>
                <div class="carte-catalogue__detail">
                    <ul>
                        <li>{% if enchereId %}{{encherePrix}} CAD{% else %} - {% endif %}</li>
                    </ul>
                </div>
            </div>
            <div class="carte-catalogue__action">
                {% if enchereId %}
                <div class="carte-catalogue__achat">
                    <span>Voir l'enchère</span>
                    <picture><img src="{{asset}}/images/encheres.webp" alt="enchere" /></picture>
                </div>
                {% else %}
                <div class="carte-catalogue__achat">
                    <span>Aucune enchère</span>
                </div>
                {% endif %}
            </div>
        </a>

        {% endfor %}
    </section>
</main>

{{ include('layouts/footer.php')}}