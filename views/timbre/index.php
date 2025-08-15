{{ include('layouts/header.php', {title: 'Liste des timbres'})}}


<h1>Listes de vos timbres</h1>

{% if message is defined %}
<div class="alert alert-success">{{ message }}</div>
{% endif %}
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Date d'émission</th>
            <th>Certifié</th>
            <th>Tirage</th>
            <th>Dimension</th>
            <th>Couleur</th>
            <th>Pays</th>
            <th>Condition</th>
            <th>Voir Enchère</th>
        </tr>
    </thead>
    <tbody>
        {% for timbre in timbres %}
        {% set couleurInput= '' %}
        {% set paysInput = '' %}
        {% set conditionInput = '' %}
        {% for couleur in couleurs %}
        {% if couleur.id == timbre.couleurId %}
        {% set couleurInput = couleur.nom %}
        {% endif %}
        {% endfor %}
        {% for pay in pays %}
        {% if pay.id == timbre.paysId %}
        {% set paysInput = pay.nom %}
        {% endif %}
        {% endfor %}
        {% for condition in conditions %}
        {% if condition.id == timbre.conditionId %}
        {% set conditionInput = condition.nom %}
        {% endif %}
        {% endfor %}
        <tr>
            <td>{{ timbre.id }}</td>
            <td>{{ timbre.nom }}</td>
            <td>{{ timbre.date_creation }}</td>
            <td>{{ timbre.certifie ? 'Oui' : 'Non' }}</td>
            <td>{{ timbre.tirage }}</td>
            <td>{{ timbre.dimension }}</td>
            <td>{{ couleurInput }}</td>
            <td>{{ paysInput }}</td>
            <td>{{ conditionInput }}</td>
            <td><a href="{{base}}/encheres/show?id={{timbre.id}}">Détail de l'enchère</a></td>
        </tr>
        {% endfor %}
    </tbody>
</table>




{{ include('layouts/footer.php')}}