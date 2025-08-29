{{ include('layouts/header.php', {title: 'enregistrement timbre'})}}


<div class="form-container">
    <h1 class="form_header">Modification d'un timbre</h1>
    <form action="{{base}}/timbres/update" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input class="form_input" type="text" name="id" id="id" value="{{timbre.id}}" hidden>
        <input class="form_input" type="text" name="nom" id="nom" value="{{timbre.nom}}">

        {% if errors.nom is defined %}
        <span class="error">{{ errors.nom }}</span>
        {% endif %}
        <label for="dimension">Dimension :</label>
        <input class="form_input" type="text" name="dimension" id="dimension" value="{{timbre.dimension}}"
            placeholder="exemple : 3x5">

        {% if errors.dimension is defined %}
        <span class="error">{{ errors.dimension }}</span>
        {% endif %}

        <label for="date_creation">Année de création :</label>
        <input class="form_input" type="number" name="date_creation" id="date_creation" value="{{timbre.date_creation}}"
            minlength="4" maxlength="4">
        {% if errors.date_creation is defined %}
        <span class="error">{{ errors.date_creation }}</span>
        {% endif %}

        <label for="certifie">Certifié :</label>
        <select name="certifie" id="certifie" class="form_input">
            <option value="">faite un choix</option>
            <option value="1" {% if timbre.certifie==1 %}selected{% endif %}>Oui</option>
            <option value="0" {% if timbre.certifie==0 %}selected{% endif %}>Non</option>
        </select>
        {% if errors.certifie is defined %}
        <span class="error">{{ errors.certifie }}</span>
        {% endif %}

        <label for="tirage">Tirage :</label>
        <input class="form_input" type="number" name="tirage" id="tirage" value="{{timbre.tirage}}">
        {% if errors.tirage is defined %}
        <span class="error">{{ errors.tirage }}</span>
        {% endif %}

        <input id="membreId" name="membreId" type="hidden" value="{{membreId}}" />

        <label for="couleursId">Couleur :</label>
        <select name="couleursId" id="couleursId" class="form_input">
            <option value="">faite un choix</option>
            {% for couleur in couleurs %}
            <option value="{{ couleur.id }}" {% if timbre.couleursId==couleur.id %}selected{% endif %}>{{ couleur.nom }}
            </option>
            {% endfor %}
        </select>
        {% if errors.couleursId is defined %}
        <span class="error">{{ errors.couleursId }}</span>
        {% endif %}

        <label for="paysId">Pays :</label>
        <select name="paysId" id="paysId" class="form_input">
            <option value="">faite un choix</option>
            {% for pay in pays %}
            <option value="{{ pay.id }}" {% if timbre.paysId==pay.id %}selected{% endif %}>{{ pay.nom }}</option>
            {% endfor %}
        </select>
        {% if errors.paysId is defined %}
        <span class="error">{{ errors.paysId }}</span>
        {% endif %}

        <label for="conditionId">Condition :</label>
        <select name="conditionId" id="conditionId" class="form_input">
            <option value="">faite un choix</option>
            {% for etat in condition %}
            <option value="{{ etat.id }}" {% if timbre.conditionId==etat.id %}selected{% endif %}>{{ etat.nom }}
            </option>
            {% endfor %}
        </select>
        {% if errors.conditionId is defined %}
        <span class="error">{{ errors.conditionId }}</span>
        {% endif %}

        <label for="image1">Image principale (.webp) :</label>
        {% if timbre.images is defined %}
        {% for img in timbre.images %}
        {% if img.principale == 1 %}
        <img src="{{ asset }}/{{ img.lien }}" alt="Image principale" style="max-width:120px;max-height:120px;" />
        {% endif %}
        {% endfor %}
        {% endif %}
        <input type="file" name="image1" id="image1" accept=".webp">

        <label for="image2">Image secondaire 2 (.webp) :</label>
        {% if timbre.images is defined %}
        {% for img in timbre.images %}
        {% if img.principale == 0 %}
        <img src="{{ asset }}/{{ img.lien }}" alt="Image secondaire" style="max-width:120px;max-height:120px;" />
        {% endif %}
        {% endfor %}
        {% endif %}
        <input type="file" name="image2" id="image2" accept=".webp">

        <label for="image3">Image secondaire 3 (.webp) :</label>
        <input type="file" name="image3" id="image3" accept=".webp">

        <label for="image4">Image secondaire 4 (.webp) :</label>
        <input type="file" name="image4" id="image4" accept=".webp">

        <button type="submit">Enregistrer</button>
    </form>
</div>

{{ include('layouts/footer.php')}}