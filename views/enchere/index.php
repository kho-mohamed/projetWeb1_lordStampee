{{ include('layouts/header.php', {title: 'Liste des enchères'})}}

<main class="corps">
      <h1 class="sr-only">Catalogue de timbres aux enchères</h1>
      <section class="filtre">
        <div class="filtre__entete">
          <picture class="filtre__icone"
            ><img src="assets/images/filtre.webp" alt="filtre"
          /></picture>
          <h2 class="filtre__titre">Filtres</h2>
        </div>
        <div class="filtre__corps">
          <div class="filtre__boutton">
            <span>Par types de timbres</span
            ><picture
              ><img src="assets/images/dropdown.webp" alt="dropdown"
            /></picture>
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
            <span>Par origine géographique</span
            ><picture
              ><img src="assets/images/dropdown.webp" alt="dropdown"
            /></picture>
          </div>
          <div class="filtre__boutton">
            <span>Par période d'émission</span
            ><picture
              ><img src="assets/images/dropdown.webp" alt="dropdown"
            /></picture>
          </div>
          <div class="filtre__boutton">
            <span>Par état du timbre</span
            ><picture
              ><img src="assets/images/dropdown.webp" alt="dropdown"
            /></picture>
          </div>
          <div class="filtre__boutton">
            <span>Par thématique</span
            ><picture
              ><img src="assets/images/dropdown.webp" alt="dropdown"
            /></picture>
          </div>
          <div class="filtre__boutton">
            <span>Par statut d'enchère</span
            ><picture
              ><img src="assets/images/dropdown.webp" alt="dropdown"
            /></picture>
          </div>
          <div class="filtre__boutton">
            <span>Par tranches de Prix</span
            ><picture
              ><img src="assets/images/dropdown.webp" alt="dropdown"
            /></picture>
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
        <a class="carte-catalogue">
          <picture class="carte-catalogue__image"
            ><img src="./assets/categorie/aerien.webp" alt="timbre"
          /></picture>
          <h2 class="carte-catalogue__titre">Timbres canada 1965</h2>
          <div class="carte-catalogue__info">
            <div class="carte-catalogue__type">
              <ul>
                <li>Pays:</li>
                <li>Prix Plancher :</li>
              </ul>
            </div>
            <div class="carte-catalogue__detail">
              <ul>
                <li>Canada</li>
                <li>250 CAD</li>
              </ul>
            </div>
          </div>
          <div class="Carte-catalogue__action">
            <div class="carte-catalogue__rebourt">
              <picture
                ><img src="assets/images/sablier.webp" alt="sablier" /></picture
              ><span>2j : 5h : 30mn</span>
            </div>
            <div class="carte-catalogue__achat">
              <span>Voir l'enchère</span
              ><picture
                ><img src="assets/images/encheres.webp" alt="enchere"
              /></picture>
            </div>
          </div>
        </a>
        <a class="carte-catalogue">
          <picture class="carte-catalogue__image"
            ><img src="./assets/categorie/etat.webp" alt="timbre"
          /></picture>
          <h2 class="carte-catalogue__titre">Timbres Japan 1964</h2>
          <div class="carte-catalogue__info">
            <div class="carte-catalogue__type">
              <ul>
                <li>Pays:</li>
                <li>Prix Plancher :</li>
              </ul>
            </div>
            <div class="carte-catalogue__detail">
              <ul>
                <li>Japan</li>
                <li>300 CAD</li>
              </ul>
            </div>
          </div>
          <div class="Carte-catalogue__action">
            <div class="carte-catalogue__rebourt">
              <picture
                ><img src="assets/images/sablier.webp" alt="sablier" /></picture
              ><span>1j : 3h : 30mn</span>
            </div>
            <div class="carte-catalogue__achat">
              <span>Voir l'enchère</span
              ><picture
                ><img src="assets/images/encheres.webp" alt="enchere"
              /></picture>
            </div>
          </div>
        </a>
        <a class="carte-catalogue">
          <picture class="carte-catalogue__image"
            ><img src="./assets/categorie/pays.webp" alt="timbre"
          /></picture>
          <h2 class="carte-catalogue__titre">Timbres Simon Veil</h2>
          <div class="carte-catalogue__info">
            <div class="carte-catalogue__type">
              <ul>
                <li>Pays:</li>
                <li>Prix Plancher :</li>
              </ul>
            </div>
            <div class="carte-catalogue__detail">
              <ul>
                <li>France</li>
                <li>50 CAD</li>
              </ul>
            </div>
          </div>
          <div class="Carte-catalogue__action">
            <div class="carte-catalogue__rebourt">
              <picture
                ><img src="assets/images/sablier.webp" alt="sablier" /></picture
              ><span>3j : 5h : 30mn</span>
            </div>
            <div class="carte-catalogue__achat">
              <span>Voir l'enchère</span
              ><picture
                ><img src="assets/images/encheres.webp" alt="enchere"
              /></picture>
            </div>
          </div>
        </a>
        <a class="carte-catalogue">
          <picture class="carte-catalogue__image"
            ><img src="./assets/categorie/us.webp" alt="timbre"
          /></picture>
          <h2 class="carte-catalogue__titre">Timbres US</h2>
          <div class="carte-catalogue__info">
            <div class="carte-catalogue__type">
              <ul>
                <li>Pays:</li>
                <li>Prix Plancher :</li>
              </ul>
            </div>
            <div class="carte-catalogue__detail">
              <ul>
                <li>États-unie</li>
                <li>500 CAD</li>
              </ul>
            </div>
          </div>
          <div class="Carte-catalogue__action">
            <div class="carte-catalogue__rebourt">
              <picture
                ><img src="assets/images/sablier.webp" alt="sablier" /></picture
              ><span>1j : 1h : 30mn</span>
            </div>
            <div class="carte-catalogue__achat">
              <span>Voir l'enchère</span
              ><picture
                ><img src="assets/images/encheres.webp" alt="enchere"
              /></picture>
            </div>
          </div>
        </a>
        <a class="carte-catalogue">
          <picture class="carte-catalogue__image"
            ><img src="./assets/categorie/vieu.webp" alt="timbre"
          /></picture>
          <h2 class="carte-catalogue__titre">Timbre "Us Mail"</h2>
          <div class="carte-catalogue__info">
            <div class="carte-catalogue__type">
              <ul>
                <li>Pays:</li>
                <li>Prix Plancher :</li>
              </ul>
            </div>
            <div class="carte-catalogue__detail">
              <ul>
                <li>États-unie</li>
                <li>400 CAD</li>
              </ul>
            </div>
          </div>
          <div class="Carte-catalogue__action">
            <div class="carte-catalogue__rebourt">
              <picture
                ><img src="assets/images/sablier.webp" alt="sablier" /></picture
              ><span>2j : 5h : 30mn</span>
            </div>
            <div class="carte-catalogue__achat">
              <span>Voir l'enchère</span
              ><picture
                ><img src="assets/images/encheres.webp" alt="enchere"
              /></picture>
            </div>
          </div>
        </a>
        <a class="carte-catalogue">
          <picture class="carte-catalogue__image"
            ><img src="./assets/categorie/avion.webp" alt="timbre"
          /></picture>
          <h2 class="carte-catalogue__titre">Timbres US aviation</h2>
          <div class="carte-catalogue__info">
            <div class="carte-catalogue__type">
              <ul>
                <li>Pays:</li>
                <li>Prix Plancher :</li>
              </ul>
            </div>
            <div class="carte-catalogue__detail">
              <ul>
                <li>États-unie</li>
                <li>3000 CAD</li>
              </ul>
            </div>
          </div>
          <div class="Carte-catalogue__action">
            <div class="carte-catalogue__rebourt">
              <picture
                ><img src="assets/images/sablier.webp" alt="sablier" /></picture
              ><span>0j : 5h : 30mn</span>
            </div>
            <div class="carte-catalogue__achat">
              <span>Voir l'enchère</span
              ><picture
                ><img src="assets/images/encheres.webp" alt="enchere"
              /></picture>
            </div>
          </div>
        </a>
      </section>
    </main>

{{ include('layouts/footer.php')}}