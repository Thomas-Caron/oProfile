let skill = {
  init: function() {
    // Je récupère tous les boutons de compétences
    let buttonElementList = document.querySelectorAll('.skill .button');

    // Sur chacun d'entre eux
    for (
      let index = 0;
      index < buttonElementList.length;
      index = index + 1
    ) {
      let buttonElement = buttonElementList.item(index);

      // J'ajoute d'événement sur le click qui gère l'affichage de la description
      buttonElement.addEventListener(
        'click',
        skill.displayDescription
      );
    }
  },

  displayDescription: function(event) {
    // J'annule le comportement par défaut du lien
    event.preventDefault();

    // Je récupère la cible de l'événement
    let buttonElement = event.currentTarget;

    // Je récupère la description de la compétence
    let descriptionElement = buttonElement
      .parentNode // .closest('.skill')
      .querySelector('.skill__description');

    // J'ajoute ou je retire la classe visible sur la description
    descriptionElement.classList.toggle('visible');

    // Si ma description est visible
    if (descriptionElement.classList.contains('visible')) {
      // Je modifie le texte du bouton en 'Cacher'
      buttonElement.textContent = 'Cacher';
    } else {
      // Je modifie le texte du bouton en 'Voir les détails'
      buttonElement.textContent = 'Voir les détails';
    }
  }
};

export default skill;
