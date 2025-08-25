{{ include('layouts/header.php', {title: 'Liste des mises'})}}


<h1>Listes de vos mises</h1>

{% if message is defined %}
<div class="alert alert-success">{{ message }}</div>
{% endif %}


{% for mise in mises %}
{% set prixMax = 0 %}
{% if mise.montant > prixMax %}
{% set prixMax = mise.montant %}
{% endif %}


{% endfor %}
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Numéro de l'enchère</th>
            <th>Date de mise</th>
            <th>Prix de la mise</th>
            <th>Prix plancher</th>
            <th>Situation</th>
            <th>Afficher la mise</th>
        </tr>
    </thead>
    {# Calcul du montant max avant le tableau #}
    {% set montantMax = 0 %}
    {% for mise in mises %}
    {% if mise.montant|number_format(0, '.', '') > montantMax %}
    {% set montantMax = mise.montant|number_format(0, '.', '') %}
    {% endif %}
    {% endfor %}

    <tbody>
        {% for mise in mises %}
        {% set encherePrixPlancher = 0 %}
        {% for enchere in encheres %}
        {% if enchere.id == mise.enchereId %}
        {% set encherePrixPlancher = enchere.prix_plancher %}
        {% endif %}
        {% endfor %}
        <tr>
            <td>{{ mise.id }}</td>
            <td>{{ mise.enchereId }}</td>
            <td>{{ mise.date_mise }}</td>
            <td>{{ mise.montant }}</td>
            <td>{{ encherePrixPlancher }}</td>

            {% if mise.montant|number_format(0, '.', '') == montantMax %}
            <td class="gagne">Vous Gagnez</td>
            {% else %}
            <td class="perdu">Vous perdez</td>
            {% endif %}

            <td><a href="{{base}}/enchere/show?id={{ mise.enchereId }}">Afficher</a></td>
        </tr>
        {% endfor %}
    </tbody>
</table>
</tbody>
</table>




{{ include('layouts/footer.php')}}