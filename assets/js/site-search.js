/**
 * Site search panel — toggle, animation, focus, Escape.
 */
(function () {
  'use strict';

  var panel = document.querySelector('[data-site-search-panel]');
  var toggle = document.querySelector('[data-site-search-toggle]');
  var input = document.querySelector('[data-site-search-input]');
  var closeButtons = document.querySelectorAll('[data-site-search-close]');

  if (!panel || !toggle) return;

  var isOpen = false;
  var exitTimer = null;
  var EXIT_MS = 280;
  var ENTER_MS = 380;

  function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  }

  function clearExitTimer() {
    if (exitTimer) {
      window.clearTimeout(exitTimer);
      exitTimer = null;
    }
  }

  function setOpen(nextOpen) {
    clearExitTimer();
    isOpen = nextOpen;

    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    toggle.classList.toggle('fusion-site-nav__search-btn--active', isOpen);
    toggle.setAttribute(
      'aria-label',
      isOpen ? 'Close search' : 'Open search'
    );

    if (isOpen) {
      panel.hidden = false;
      panel.classList.remove('fusion-search-exit');
      panel.classList.add('fusion-search-enter');

      if (prefersReducedMotion()) {
        panel.classList.remove('fusion-search-enter');
      } else {
        window.setTimeout(function () {
          panel.classList.remove('fusion-search-enter');
        }, ENTER_MS);
      }

      if (input) {
        window.setTimeout(function () {
          input.focus();
        }, prefersReducedMotion() ? 0 : 60);
      }

      document.dispatchEvent(new CustomEvent('ccg:search-open'));
      return;
    }

    panel.classList.remove('fusion-search-enter');
    panel.classList.add('fusion-search-exit');

    if (prefersReducedMotion()) {
      panel.hidden = true;
      panel.classList.remove('fusion-search-exit');
      return;
    }

    exitTimer = window.setTimeout(function () {
      panel.hidden = true;
      panel.classList.remove('fusion-search-exit');
      exitTimer = null;
    }, EXIT_MS);
  }

  toggle.addEventListener('click', function () {
    setOpen(!isOpen);
  });

  closeButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      setOpen(false);
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && isOpen) {
      setOpen(false);
    }
  });

  document.addEventListener('ccg:mega-nav-open', function () {
    if (isOpen) setOpen(false);
  });

  window.ccgSiteSearch = {
    close: function () {
      setOpen(false);
    },
    isOpen: function () {
      return isOpen;
    },
  };
})();
