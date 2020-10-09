let carousel = {
  init: function() {
    let carouselElement = document.querySelector('.carousel');

    if (carouselElement) {
      // Générer un bouton de navigation pour chaque élément présent dans le contenu du carrousel
      // Récupérer tous les enfants directs du contenu du carrousel
      let contentElementList = carouselElement.querySelectorAll('.carousel__content > *');

      // J'ajoute la classe active sur le premier élément de la liste
      contentElementList.item(0).classList.add('active');

      // Pour chacun d'entre eux, je veux lui créer un bouton de navigation qui permet de l'afficher
      for (
        let index = 0;
        index < contentElementList.length;
        index += 1
      ) {
        let contentElement = contentElementList.item(index);

        // Je crée un élément de navigation associé à mon élément
        carousel.addNavigationElement(contentElement);
      }

      // Je mets en place le défilement automatique
      carousel.intervalId = window.setInterval(
        carousel.displayNextContent,
        10000 //ms
      );

      let contentContainerElement = document.querySelector('.carousel__content');

      contentContainerElement.addEventListener(
        'mouseenter',
        function(event) {
          // Je stoppe le traitement
          window.clearInterval(carousel.intervalId);
        }
      );

      contentContainerElement.addEventListener(
        'mouseleave',
        function() {
          carousel.intervalId = window.setInterval(
            carousel.displayNextContent,
            10000 //ms
          );
        }
      );
    }

  },

  /**
   * Add navigation element for content element
   *
   * @param {Element} contentElement DOM Content Element
   */
  addNavigationElement: function(contentElement) {
    // Je crée un élément bouton
    let buttonElement = document.createElement('button');

    buttonElement.addEventListener(
      'click',
      function() {
        // Je récupère la position gauche de l'élément que je veux afficher
        let contentLeftPosition = contentElement.offsetLeft;

        // Je récupère le conteneur des contenus du carousel
        let contentContainerElement = document.querySelector('.carousel__content');

        // Je scroll vers le contenu que je veux afficher
        contentContainerElement.scrollLeft = contentLeftPosition;

        // J'enlève la classe active sur ceux qui le sont déjà
        let activeElementList = document.querySelectorAll('.carousel__content > .active');

        for (
          let index = 0;
          index < activeElementList.length;
          index++
        ) {
          let activeElement = activeElementList.item(index);

          activeElement.classList.remove('active');
        }

        // J'ajoute une classe indiquant que l'élément est affiché
        contentElement.classList.add('active');
      }
    );

    let navigationContainerElement = document.querySelector('.carousel__navigation');
    navigationContainerElement.appendChild(buttonElement);
  },

  displayNextContent: function() {
    // Je récupère le conteneur
    let contentListElement = document.querySelector('.carousel__content');

    // Je récupère l'élément suivant l'élément actif
    let nextContentElement = contentListElement.querySelector(
      '.active + *'
    );

    if (nextContentElement) {

      // Je récupère la position gauche de l'élément suivant dans son parent
      let nextContentLeftPostion = nextContentElement.offsetLeft;

      // Je scrolle dans le parent vers la position de l'élément suivant
      contentListElement.scrollLeft = nextContentLeftPostion;

      // Je supprime la classe active de tous les autres élements
      let activeElementList = document.querySelectorAll('.carousel__content > .active');

      for (
        let index = 0;
        index < activeElementList.length;
        index++
      ) {
        let activeElement = activeElementList.item(index);

        activeElement.classList.remove('active');
      }

      // J'ajoute la classe active sur l'élément vers lequel je viens de scroller
      nextContentElement.classList.add('active');
    } else {
      // Je récupère le premier élément de la liste
      let firstContentElement = contentListElement.querySelector(':first-child');

      let firstContentLeftPosition = firstContentElement.offsetLeft;

      contentListElement.scrollLeft = firstContentLeftPosition;

      // Je supprime la classe active de tous les autres élements
      let activeElementList = document.querySelectorAll('.carousel__content > .active');

      for (
        let index = 0;
        index < activeElementList.length;
        index++
      ) {
        let activeElement = activeElementList.item(index);

        activeElement.classList.remove('active');
      }

      firstContentElement.classList.add('active');
    }
  }
};

export default carousel;
