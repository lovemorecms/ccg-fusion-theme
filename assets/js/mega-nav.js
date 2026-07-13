/**
 * CCG Fusion mega menu — desktop panels, overlay, mobile drawer.
 */
(function () {
  'use strict';

  var root = document.getElementById('ccg-mega-nav');
  if (!root) return;

  var overlay = root.querySelector('[data-mega-overlay]');
  var triggers = root.querySelectorAll('[data-menu-trigger]');
  var megas = root.querySelectorAll('.fusion-nav-v2__mega');
  var categoryTabs = root.querySelectorAll('.fusion-nav-v2__category');
  var panelPanes = root.querySelectorAll('.ccg-mega-nav__panel-pane');
  var mobileToggle = root.querySelector('[data-mobile-toggle]');
  var mobileDrawer = document.getElementById('fusion-nav-v2-mobile-drawer');
  var iconMenu = root.querySelector('.ccg-icon-menu');
  var iconClose = root.querySelector('.ccg-icon-close');

  var activeMenu = '';
  var mobileOpen = false;
  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function replayAnimation(el) {
    if (!el || reducedMotion) return;
    el.style.animation = 'none';
    void el.offsetHeight;
    el.style.animation = '';
  }

  function setBodyScroll(lock) {
    document.documentElement.classList.toggle('ccg-mega-nav-open', lock);
  }

  function closeMenu() {
    activeMenu = '';
    root.dataset.activeMenu = '';
    root.classList.remove(
      'fusion-nav-v2--mega-open',
      'fusion-nav-v2--mega-open-about',
      'fusion-nav-v2--mega-open-explore',
      'fusion-nav-v2--mega-open-learn',
      'fusion-nav-v2--mega-open-get-started'
    );
    triggers.forEach(function (btn) {
      btn.classList.remove('fusion-mega-trigger--active');
      btn.setAttribute('aria-expanded', 'false');
    });
    megas.forEach(function (mega) {
      mega.hidden = true;
    });
    if (overlay) overlay.hidden = true;
    if (!mobileOpen) setBodyScroll(false);
  }

  function openMenu(menuId) {
    if (activeMenu === menuId) {
      closeMenu();
      return;
    }
    if (window.ccgSiteSearch && window.ccgSiteSearch.isOpen()) {
      window.ccgSiteSearch.close();
    }
    closeMenu();
    activeMenu = menuId;
    root.dataset.activeMenu = menuId;
    root.classList.add('fusion-nav-v2--mega-open', 'fusion-nav-v2--mega-open-' + menuId);
    triggers.forEach(function (btn) {
      var on = btn.getAttribute('data-menu-trigger') === menuId;
      btn.classList.toggle('fusion-mega-trigger--active', on);
      btn.setAttribute('aria-expanded', on ? 'true' : 'false');
    });
    megas.forEach(function (mega) {
      mega.hidden = mega.id !== 'fusion-nav-v2-mega-' + menuId;
    });
    var activeMega = root.querySelector('#fusion-nav-v2-mega-' + menuId);
    if (activeMega) {
      replayAnimation(activeMega);
      replayAnimation(activeMega.querySelector('.fusion-nav-v2__mega-swap'));
    }
    if (overlay) {
      overlay.hidden = false;
      replayAnimation(overlay);
    }
    setBodyScroll(true);
    document.dispatchEvent(new CustomEvent('ccg:mega-nav-open'));
    var firstCat = root.querySelector(
      '.fusion-nav-v2__category[data-menu="' + menuId + '"]'
    );
    if (firstCat) selectCategory(menuId, firstCat.getAttribute('data-category'), false, false);
  }

  function selectCategory(menuId, categoryId, focusTab, animate) {
    categoryTabs.forEach(function (tab) {
      var match =
        tab.getAttribute('data-menu') === menuId &&
        tab.getAttribute('data-category') === categoryId;
      tab.classList.toggle('fusion-nav-v2__category--active', match);
      tab.setAttribute('aria-selected', match ? 'true' : 'false');
      tab.tabIndex = match ? 0 : -1;
    });
    panelPanes.forEach(function (pane) {
      var match =
        pane.getAttribute('data-menu') === menuId &&
        pane.getAttribute('data-category') === categoryId;
      pane.hidden = !match;
      if (match && animate) {
        replayAnimation(pane.querySelector('.fusion-nav-v2__panel-content'));
      }
    });
    if (focusTab) {
      var tab = root.querySelector(
        '.fusion-nav-v2__category[data-menu="' +
          menuId +
          '"][data-category="' +
          categoryId +
          '"]'
      );
      if (tab) tab.focus();
    }
  }

  function closeMobile() {
    mobileOpen = false;
    if (mobileDrawer) mobileDrawer.hidden = true;
    if (mobileToggle) {
      mobileToggle.setAttribute('aria-expanded', 'false');
      mobileToggle.setAttribute('aria-label', 'Open menu');
    }
    if (iconMenu) iconMenu.hidden = false;
    if (iconClose) iconClose.hidden = true;
    setBodyScroll(false);
  }

  function openMobile() {
    if (window.ccgSiteSearch && window.ccgSiteSearch.isOpen()) {
      window.ccgSiteSearch.close();
    }
    closeMenu();
    mobileOpen = true;
    if (mobileDrawer) mobileDrawer.hidden = false;
    if (mobileToggle) {
      mobileToggle.setAttribute('aria-expanded', 'true');
      mobileToggle.setAttribute('aria-label', 'Close menu');
    }
    if (iconMenu) iconMenu.hidden = true;
    if (iconClose) iconClose.hidden = false;
    setBodyScroll(true);
  }

  triggers.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var id = btn.getAttribute('data-menu-trigger');
      if (id) openMenu(id);
    });
  });

  if (overlay) {
    overlay.addEventListener('click', closeMenu);
  }

  categoryTabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      selectCategory(
        tab.getAttribute('data-menu'),
        tab.getAttribute('data-category'),
        false,
        true
      );
    });
    tab.addEventListener('focus', function () {
      selectCategory(
        tab.getAttribute('data-menu'),
        tab.getAttribute('data-category'),
        false,
        true
      );
    });
  });

  if (mobileToggle) {
    mobileToggle.addEventListener('click', function () {
      if (mobileOpen) closeMobile();
      else openMobile();
    });
  }

  root.querySelectorAll('[data-mobile-category]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var menuId = btn.getAttribute('data-mobile-menu');
      var catId = btn.getAttribute('data-mobile-category');
      root
        .querySelectorAll(
          '.fusion-nav-v2__mobile-category[data-mobile-menu="' + menuId + '"]'
        )
        .forEach(function (b) {
          b.classList.toggle(
            'fusion-nav-v2__mobile-category--active',
            b === btn
          );
        });
      root
        .querySelectorAll(
          '.ccg-mega-nav__mobile-pane[data-mobile-menu="' + menuId + '"]'
        )
        .forEach(function (pane) {
          pane.hidden = pane.getAttribute('data-mobile-category') !== catId;
        });
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      if (activeMenu) closeMenu();
      if (mobileOpen) closeMobile();
    }
  });

  document.addEventListener('ccg:search-open', function () {
    if (activeMenu) closeMenu();
    if (mobileOpen) closeMobile();
  });

  window.addEventListener('resize', function () {
    if (window.innerWidth >= 768 && mobileOpen) closeMobile();
  });
})();
