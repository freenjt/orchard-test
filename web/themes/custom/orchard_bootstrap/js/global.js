/**
 * @file
 * Global utilities.
 *
 */
(function (Drupal) {

  'use strict';

  Drupal.behaviors.orchard_bootstrap = {
    attach: function (context, settings) {
      let bannerNavItem = document.querySelectorAll('.menu--banner-navigation .dropdown-item');
      bannerNavItem.forEach((item) => {
        item.addEventListener('click', (event) => {
          event.preventDefault();
          const imageUrl = event.target.getAttribute('data-banner');
          document.getElementById('banner').style.backgroundImage = `url('${imageUrl}')`;
        });
      });
    },
  };

})(Drupal);
