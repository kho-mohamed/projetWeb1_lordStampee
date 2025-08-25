// Récupère tous les scripts JSON contenant les données des enchères
const scripts = document.querySelectorAll("script.enchereindex-json");
const enchereDataArray = [];
// Pour chaque script, on extrait et parse le JSON
scripts.forEach((script) => {
  const raw = script.textContent.trim();
  if (raw) {
    enchereDataArray.push(JSON.parse(raw));
  }
});

// Sélectionne tous les éléments de filtre disponibles sur la page
const filtreCouleurs = document.querySelectorAll("[data-couleur]"); // Filtres par couleur
const filtrePays = document.querySelectorAll("[data-pays]"); // Filtres par pays
const filtreConditions = document.querySelectorAll("[data-condition]"); // Filtres par condition
const filtreDate = document.querySelectorAll("[data-date]"); // Filtres par date
const filtrePrix = document.querySelectorAll("[data-prix]"); // Filtres par tranche de prix

// Fonction d'initialisation des filtres
function init() {
  // Active chaque filtre
  filtreDeCouleurs();
  filtreDePays();
  filtreDeCondition();
  filtreDeDate();
  filtreDePrix();
}

// Filtre les enchères selon la couleur sélectionnée
function filtreDeCouleurs() {
  filtreCouleurs.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const couleurId = event.currentTarget.dataset.couleur;
      // Filtre les enchères dont la couleur correspond
      const enchereFiltree = enchereDataArray.filter(
        (enchere) => enchere.couleur == couleurId
      );
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour cette couleur.");
      }
      // Affiche les enchères filtrées
      afficheEncheres(enchereFiltree);
    });
  });
}

// Filtre les enchères selon le pays sélectionné
function filtreDePays() {
  filtrePays.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const paysId = event.currentTarget.dataset.pays;
      // Filtre les enchères dont le pays correspond
      const enchereFiltree = enchereDataArray.filter(
        (enchere) => enchere.pays == paysId
      );
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour ce pays.");
      }
      // Affiche les enchères filtrées
      afficheEncheres(enchereFiltree);
    });
  });
}

// Filtre les enchères selon la période d'émission sélectionnée
function filtreDeDate() {
  filtreDate.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const dateId = event.currentTarget.dataset.date;
      let enchereFiltree;
      // Filtrage selon la tranche d'année
      if (dateId == 1) {
        enchereFiltree = enchereDataArray.filter(
          (enchere) => Number(enchere.timbreDate) < 1900
        );
      } else if (dateId == 2) {
        enchereFiltree = enchereDataArray.filter(
          (enchere) =>
            Number(enchere.timbreDate) >= 1900 &&
            Number(enchere.timbreDate) < 1950
        );
      } else if (dateId == 3) {
        enchereFiltree = enchereDataArray.filter(
          (enchere) =>
            Number(enchere.timbreDate) >= 1950 &&
            Number(enchere.timbreDate) < 2000
        );
      } else if (dateId == 4) {
        enchereFiltree = enchereDataArray.filter(
          (enchere) => Number(enchere.timbreDate) >= 2001
        );
      }
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour cette date.");
      }
      // Affiche les enchères filtrées
      afficheEncheres(enchereFiltree);
    });
  });
}

// Filtre les enchères selon la tranche de prix sélectionnée
function filtreDePrix() {
  filtrePrix.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const prixId = event.currentTarget.dataset.prix;
      let enchereFiltree;
      // Filtrage selon la tranche de prix
      if (prixId == 1) {
        enchereFiltree = enchereDataArray.filter(
          (enchere) => enchere.prix_plancher < 500
        );
      } else if (prixId == 2) {
        enchereFiltree = enchereDataArray.filter(
          (enchere) =>
            enchere.prix_plancher >= 501 && enchere.prix_plancher < 1000
        );
      } else if (prixId == 3) {
        enchereFiltree = enchereDataArray.filter(
          (enchere) => enchere.prix_plancher >= 1001
        );
      }
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour ce prix.");
      }
      // Affiche les enchères filtrées
      afficheEncheres(enchereFiltree);
    });
  });
}

// Filtre les enchères selon la condition sélectionnée
function filtreDeCondition() {
  filtreConditions.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const conditionId = event.currentTarget.dataset.condition;
      // Filtre les enchères dont la condition correspond
      const enchereFiltree = enchereDataArray.filter(
        (enchere) => enchere.condition == conditionId
      );
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour cette état.");
      }
      // Affiche les enchères filtrées
      afficheEncheres(enchereFiltree);
    });
  });
}

// Affiche les enchères dans le catalogue en supprimant les anciennes
function afficheEncheres(enchereFiltree) {
  const conteneurEncheres = document.querySelector(".catalogue");
  const aChild = conteneurEncheres.querySelectorAll("a.carte-catalogue");
  aChild.forEach((a) => {
    a.remove(); // supprimer tout les balises a du catalogue
  });
  enchereFiltree.forEach((enchere) => {
    conteneurEncheres.insertAdjacentHTML("beforeend", gabaritHtml(enchere)); // les remplacer par les nouvelles balises
  });
}

// Génère le HTML pour une enchère
function gabaritHtml(enchere) {
  // Mettre à jour l'affichage des enchères ici
  const gabarit = `<a class="carte-catalogue" href="/enchere/show?id=${enchere.id}">
            <picture class="carte-catalogue__image"><img src="../../public/${enchere.imagePrincipale}" alt="timbre">
            </picture>
            <h2 class="carte-catalogue__titre">${enchere.nom}</h2>
            <div class="carte-catalogue__info">
                <div class="carte-catalogue__type">
                    <ul>
                        <li>Pays:</li>
                        <li>Prix Plancher :</li>
                    </ul>
                </div>
                <div class="carte-catalogue__detail">
                    <ul>
                        <li>${enchere.nom}</li>
                        <li>${enchere.prix_plancher} CAD</li>
                    </ul>
                </div>
            </div>
            <div class="carte-catalogue__action">
                <div class="carte-catalogue__rebourt">
                    <picture><img src="/public/images/sablier.webp" alt="sablier"></picture><span class="compteur-enchere">2j : 5h : 30mn</span>
                </div>
                <div class="carte-catalogue__achat">
                    <span>Voir l'enchère</span>
                    <picture><img src="/public/images/encheres.webp" alt="enchere"></picture>
                </div>
            </div>
        </a>`;
  return gabarit;
}

// Lance l'initialisation des filtres au chargement du script
init();
