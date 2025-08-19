//récupuré les variables :

const baliseFavoris = document.querySelector(".carte__action__boutton__suivre");
const favoriEtat = baliseFavoris.dataset.favoris;
const membreId = baliseFavoris.dataset.membre;
const enchereId = baliseFavoris.dataset.enchere;

function ajouterAuxFavoris() {
  fetch("/favoris/insert", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      enchere_id: enchereId,
      membre_id: membreId,
    }),
    // ou pour form-urlencoded : body: 'timbre_id=' + timbreId
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Ajouté aux favoris !");
        baliseFavoris.dataset.favoris = "non";
        baliseFavoris.textContent = "Supprimer de mes favoris";
      } else {
        alert("Erreur lors de l'ajout aux favoris");
      }
    })
    .catch((error) => {
      console.error("Erreur:", error);
      alert("Erreur de connexion");
    });
}
