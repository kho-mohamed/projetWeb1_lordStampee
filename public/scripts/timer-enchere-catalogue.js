// 1) Récupère le texte JSON du script et le nettoie
const scripts = document.querySelectorAll("script.enchereindex-json");
scripts.forEach((script) => {
  const raw = script.textContent.trim();
  console.log(raw); // Affiche le JSON de chaque enchère
  // Tu peux ensuite parser chaque raw individuellement
  const enchereData = JSON.parse(raw);
  // ...traitement pour chaque enchère

  if (raw != undefined) {
    // 2) Transforme la chaîne JSON en objet JS:
    const enchereData = JSON.parse(raw);
    console.log(enchereData);
    // 3) on récupère les dates en format date :
    const dateDebut = new Date(enchereData.date_debut);
    const dateFin = new Date(enchereData.date_fin);

    // 4) on récupère la balise d'affichage du compteur:
    const compteur = document.querySelector(
      `#compteur-enchere${enchereData.id}`
    );

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

      return `${jour}j : ${heure}h : ${minute}mn`;
    }

    // 6) Mise à jour du compteur toutes les secondes
    setInterval(() => {
      const now = new Date(); // horloge du navigateur
      let affichage;

      if (now < dateDebut) {
        affichage = "Prochainement";
      } else if (now > dateFin) {
        affichage = "Terminée";
      } else {
        affichage = format(dateFin - now);
      }
      compteur.textContent = affichage;
    }, 1000);
  }
});
