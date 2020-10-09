// J'importe mon objet provenant du fichier indiqué
import '../scss/main.scss';
import mainMenu from './mainMenu.js';
import carousel from './carousel.js';
import skill from './skill.js';
import header from './header.js';

// Lorsque le DOM est chargé, j'exécute la méthode init de mainMenu
document.addEventListener(
  'DOMContentLoaded',
  mainMenu.init
);

document.addEventListener(
  'DOMContentLoaded',
  carousel.init
);

document.addEventListener(
  'DOMContentLoaded',
  skill.init
);

document.addEventListener(
  'DOMContentLoaded',
  header.init
);
