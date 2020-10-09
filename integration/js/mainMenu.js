let mainMenu = {
  /**
   * Main menu DOM Element
   *
   * @type {Element|null}
   */
  element: null,

  /**
   * Initialize mainMenu module
   */
  init: function() {
    // console.log('init');
    mainMenu.element = document.querySelector('.main-menu');

    if (mainMenu.element) {
      mainMenu.addActionsEventListeners();
    }
  },

  /**
   * Add actions event listeners
   */
  addActionsEventListeners: function() {
    let openMenuElement = document.querySelector('.open-main-menu');

    if (openMenuElement) {
      openMenuElement.addEventListener(
        'click',
        mainMenu.open
      );
    }


    let closeMenuElement = document.querySelector('.close-main-menu');

    if (closeMenuElement) {
      closeMenuElement.addEventListener(
        'click',
        mainMenu.close
      );
    }
  },

  /**
   * Open main menu
   */
  open: function() {
    mainMenu.element.classList.add('visible');
  },

  /**
   * Close main menu
   */
  close: function() {
    mainMenu.element.classList.remove('visible');
  }
};

// J'exporte le contenu de ma variable
export default mainMenu;
