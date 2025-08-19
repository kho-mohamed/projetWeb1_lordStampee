// liste des variables :
const baliseLogo = document.querySelector(".entete__logo");
const imageLogo = document.querySelector(".entete__logo-image");
const baliseLogoScreen = document.querySelector(".entete__logo2");

// fonction de déplacement du logo :

const deplacerLogo = async () => {
  baliseLogoScreen.appendChild(imageLogo);
};

const revenirLogo = async () => {
  baliseLogo.appendChild(imageLogo);
};

// balise de mediaquery cible :
const mediaQueryMobile = window.matchMedia("(max-width: 785px)");
// écouteur d'évenement :

mediaQueryMobile.addEventListener("change", async (event) => {
  if (event.matches) {
    await deplacerLogo();
  } else {
    await revenirLogo();
  }
});
