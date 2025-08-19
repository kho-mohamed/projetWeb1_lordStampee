// 1) Récupère le texte JSON du script et le nettoie
const raw = document.querySelector("#enchere-json")?.textContent?.trim();

// 2) Transforme la chaîne JSON en objet JS:
const enchereData = JSON.parse(raw);

// 3) on récupère les dates en format date :

const dateDebut = new Date(enchereData.date_debut);
const dateFin = new Date(enchereData.date_fin);

// 4) on récupère la balise d'affichage du compteur:
const compteur = document.querySelector(".compteur-enchere");

// 5) Formateur lisible pour un delta en millisecondes:

function format(ms) {
  if (ms <= 0) {
    return "Enchère terminée";
  }
  const secondes = Math.floor(ms / 1000);
  const jour = Math.floor(secondes / 86400);
  const heure = Math.floor((secondes % 86400) / 3600);
  const minute = Math.floor((secondes % 3600) / 60);
  const seconde = Math.floor(secondes % 60);

  return `${jour}j : ${heure}h : ${minute}mn : ${seconde}s`;
}

// 6) Mise à jour du compteur toutes les secondes
setInterval(() => {
  const now = new Date(); // horloge du navigateur
  let affichage;

  if (now < dateDebut) {
    affichage = "L'enchère commence dans " + format(dateDebut - now);
  } else if (now > dateFin) {
    affichage = "L'enchère est terminée";
  } else {
    affichage = "L'enchère se termine dans " + format(dateFin - now);
  }
  compteur.textContent = affichage;
}, 1000);
