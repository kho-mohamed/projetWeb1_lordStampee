// récupérer les variables:
const balisePhotoPrincipale = document.querySelector(".carte__image-principal");
const photos = document.querySelectorAll(".carte__carrousel__miniature img");
const photoP = document.querySelector("[data-principale='1']");

function init() {
  if (balisePhotoPrincipale != undefined) {
    // on affecte une photo par default au produit :
    photoPrincipale(photoP);
    if (photos.length > 1) {
      photos.forEach((photo) => {
        photo.addEventListener("click", changementPhoto);
      });
    }
  }
}
if (photos.length > 0) {
  photos.forEach((photo) => {
    photo.addEventListener("click", photoPrincipale);
  });
}

function photoPrincipale(photoSource) {
  // on récupéré la source de l'image :
  const src = photoSource.src;

  // on remplace la source de l'image de la balise principale:
  const img = document.createElement("img");
  img.src = src;
  balisePhotoPrincipale.innerHTML = "";
  balisePhotoPrincipale.appendChild(img);
}

function changementPhoto(event) {
  // on récupére l'élément cliqué:
  const photo = event.currentTarget;

  // on change la photo principale:
  photoPrincipale(photo);
}

init();
