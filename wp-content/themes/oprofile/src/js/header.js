let header = {
  init: function() {
    window.addEventListener(
      'scroll',
      header.changePosition
    );
  },

  /**
   * Change header position
   */
  changePosition: function() {
    let bodyElement = document.querySelector('body');

    // Je stocke l'élément à surveiller pour changer la position du header
    let switchElement = null;

    if (bodyElement.classList.contains('home')) {

      // L'élément à surveiller pour la page d'accueil est la bannière
      switchElement = document.querySelector('.banner');

    } else if (bodyElement.classList.contains('developer')) {

      // Sur la page profil (dévelopeur) c'est le composant developer-full
      switchElement = document.querySelector('.developer-full');

    }

    // Si j'ai élément à surveiller
    if (switchElement !== null) {
      let headerElement = document.querySelector('.header');

      // La position basse d'un élément c'est la somme entre sa position haute et sa taille
      let headerSwitchPosition = switchElement.offsetTop + switchElement.offsetHeight;

      // Si je dépasse la banner de scroll dans la fenêtre...
      if (window.scrollY >= headerSwitchPosition) {
        // ... je passe le header en fixed
        if (! headerElement.classList.contains('header--fixed')) {
          headerElement.classList.add('header--fixed');
        }
      } else {
        // ... je laisse le header à sa place par défaut
        if (headerElement.classList.contains('header--fixed')) {
          headerElement.classList.remove('header--fixed');
        }
      }
    }
  }
};

export default header;
