// 1) Récupère tous les scripts JSON
const scripts = document.querySelectorAll("script.enchereindex-json");
const enchereDataArray = [];
scripts.forEach((script) => {
  const raw = script.textContent.trim();
  if (raw) {
    enchereDataArray.push(JSON.parse(raw));
  }
});

// on récupére les filtres disponibles:
const filtreCouleurs = document.querySelectorAll("[data-couleur]");
const filtrePays = document.querySelectorAll("[data-pays]");
const filtreConditions = document.querySelectorAll("[data-condition]");
const filtreDate = document.querySelectorAll("[data-date]");

function init() {
  // Logique d'initialisation ici
  filtreDeCouleurs();
  filtreDePays();
  filtreDeCondition();
  filtreDeDate();
  console.log(filtreDeDate());
}
function filtreDeCouleurs() {
  filtreCouleurs.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const couleurId = event.currentTarget.dataset.couleur;
      console.log("Couleur sélectionnée :", couleurId);
      // Filtrer les enchères en fonction de la couleur sélectionnée
      const enchereFiltree = enchereDataArray.filter(
        (enchere) => enchere.couleur == couleurId
      );
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour cette couleur.");
      }
      console.log("Enchères filtrées :", enchereFiltree);
      enchereFiltree.forEach((enchere) => {
        afficheEncheres(enchere);
      });
    });
  });
}

function filtreDePays() {
  filtrePays.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const paysId = event.currentTarget.dataset.pays;
      console.log("Pays sélectionné :", paysId);
      // Filtrer les enchères en fonction du pays sélectionné
      const enchereFiltree = enchereDataArray.filter(
        (enchere) => enchere.pays == paysId
      );
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour ce pays.");
      }
      console.log("Enchères filtrées :", enchereFiltree);
      enchereFiltree.forEach((enchere) => {
        afficheEncheres(enchere);
      });
    });
  });
}

function filtreDeDate() {
  filtreDate.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const dateId = event.currentTarget.dataset.date;
      console.log("Date sélectionnée :", dateId);
      // Filtrer les enchères en fonction de la date sélectionnée
      let enchereFiltree;
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
      console.log("Enchères filtrées :", enchereFiltree);
      enchereFiltree.forEach((enchere) => {
        afficheEncheres(enchere);
      });
    });
  });
}

function filtreDeCondition() {
  filtreConditions.forEach((filtre) => {
    filtre.addEventListener("click", async (event) => {
      const conditionId = event.currentTarget.dataset.condition;
      console.log("Condition sélectionnée :", conditionId);
      // Filtrer les enchères en fonction de la condition sélectionnée
      const enchereFiltree = enchereDataArray.filter(
        (enchere) => enchere.condition == conditionId
      );
      if (enchereFiltree.length === 0) {
        alert("Aucune enchère trouvée pour cette état.");
      }
      console.log("Enchères filtrées :", enchereFiltree);
      enchereFiltree.forEach((enchere) => {
        afficheEncheres(enchere);
      });
    });
  });
}

function afficheEncheres(enchere) {
  const conteneurEncheres = document.querySelector(".catalogue");
  const aChild = conteneurEncheres.querySelectorAll("a.carte-catalogue");
  aChild.forEach((a) => {
    a.remove(); // supprimer tout les balises a du catalogue
  });

  conteneurEncheres.insertAdjacentHTML("beforeend", gabaritHtml(enchere)); // les remplacer par les nouvelles balises
}

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

init();
