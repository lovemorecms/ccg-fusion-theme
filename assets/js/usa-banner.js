/**
 * CMS.gov Design System USA banner — expand/collapse guidance panel.
 */
(function () {
  'use strict';

  var banners = document.querySelectorAll('[data-ccg-usa-banner]');
  if (!banners.length) return;

  banners.forEach(function (banner) {
    var header = banner.querySelector('[data-usa-banner-header]');
    var toggle = banner.querySelector('[data-usa-banner-toggle]');
    var guidance = banner.querySelector('[data-usa-banner-guidance]');
    var mobileAction = banner.querySelector('[data-usa-banner-mobile-action]');
    var closeContainer = banner.querySelector('[data-usa-banner-close-container]');
    var chevrons = banner.querySelectorAll('[data-usa-banner-chevron]');

    if (!toggle || !guidance) return;

    function setChevronRotated(rotated) {
      chevrons.forEach(function (chevron) {
        chevron.classList.toggle('ccg-mega-chevron--open', rotated);
      });
    }

    function setOpen(isOpen) {
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      guidance.hidden = !isOpen;

      if (header) {
        header.classList.toggle('ds-c-usa-banner__header--expanded', isOpen);
      }

      if (mobileAction) {
        mobileAction.classList.toggle('ds-u-display--flex', !isOpen);
      }

      if (closeContainer) {
        closeContainer.hidden = !isOpen;
      }

      setChevronRotated(isOpen);
    }

    toggle.addEventListener('click', function () {
      var isOpen = toggle.getAttribute('aria-expanded') === 'true';
      setOpen(!isOpen);
    });
  });
})();
