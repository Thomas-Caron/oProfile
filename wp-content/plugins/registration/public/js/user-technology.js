let userTechnology = {
  init: function() {
    let addTechnologyButton = document.querySelector('.add-technology');

    addTechnologyButton.addEventListener(
      'click',
      userTechnology.addTechnology
    );

    let deleteTechnologyButtonList = document.querySelectorAll('.delete-technology');
    for (
      let index = 0;
      index < deleteTechnologyButtonList.length;
      index++
    ) {
      deleteTechnologyButton = deleteTechnologyButtonList.item(index);

      deleteTechnologyButton.addEventListener(
        'click',
        userTechnology.deleteTechnology
      );
    }
  },

  /**
   * Add technology
   *
   * @param {Event} event Event
   */
  addTechnology: function(event) {
    let technologyTemplate = document.querySelector('#technology-template');

    let technology = technologyTemplate.content.querySelector('.form__group').cloneNode(true);
    technology.classList.add('new');

    setTimeout(
      function() {
        technology.classList.remove('new');
      },
      2000
    );

    let deleteButton = technology.querySelector('.delete-technology');
    deleteButton.addEventListener(
      'click',
      userTechnology.deleteTechnology
    );

    let technologyIdSelect = technology.querySelector('.technology-id');
    let technologyLevelSelect = technology.querySelector('.technology-level');

    let technologyIndex = userTechnology.getNextTechnologyIndex();

    technologyIdSelect.setAttribute(
      'name',
      'technologyList[' + technologyIndex + '][id]'
    );
    technologyLevelSelect.setAttribute(
      'name',
      'technologyList[' + technologyIndex + '][level]'
    );

    let technologyContainer = document.querySelector('.technology-container');

    technologyContainer.insertBefore(technology, event.currentTarget);
  },

  /**
   * Delete technology
   *
   * @param {Event} event Event
   */
  deleteTechnology: function(event) {
    let doDelete = confirm('Êtes-vous sûr(e) de vouloir supprimer la technologie de votre liste ?');
      if (doDelete) {
        event
          .currentTarget
          .closest('.form-user-technology__group')
          .remove();
      }
  },

  getNextTechnologyIndex: function() {
    return document.querySelectorAll('.form-user-technology__group').length;
  },
};

document.addEventListener('DOMContentLoaded', userTechnology.init);
