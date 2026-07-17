(function () {
  'use strict';

  var root = document.querySelector('.ss-page');
  var searchForm = root ? root.querySelector('[data-ss-search]') : null;
  if (!root || (!searchForm && !root.querySelector('[data-ss-category]'))) {
    return;
  }

  var scope = root;
  var categories = Array.prototype.slice.call(scope.querySelectorAll('[data-ss-category]'));
  var categoryList = scope.querySelector('.ss-acc-list');
  var navRoot = scope.querySelector('.interior-section-nav-root--icon');
  var navLinks = navRoot
    ? Array.prototype.slice.call(navRoot.querySelectorAll('.interior-section-nav__link[data-section-id]'))
    : [];
  var searchInput = searchForm ? searchForm.querySelector('[data-ss-search-input]') : null;
  var clearButton = searchForm ? searchForm.querySelector('[data-ss-search-clear]') : null;
  var resultsStatus = scope.querySelector('[data-ss-results-status]');
  var defaultResultsText = resultsStatus ? resultsStatus.textContent : '';
  var originalOrder = categories.map(function (category) {
    return category.id;
  });

  function setOpen(category, open) {
    var trigger = category.querySelector('[data-ss-accordion-trigger]');
    var panel = trigger ? document.getElementById(trigger.getAttribute('aria-controls')) : null;
    var chevronWrap = category.querySelector('.ss-acc__chevron-wrap');
    var chevron = category.querySelector('.ss-acc__chevron');

    category.classList.toggle('ss-acc--open', open);
    if (trigger) {
      trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
    }
    if (panel) {
      panel.hidden = !open;
    }
    if (chevronWrap) {
      chevronWrap.classList.toggle('ss-acc__chevron-wrap--open', open);
    }
    if (chevron) {
      chevron.classList.toggle('ss-acc__chevron--open', open);
    }
  }

  function setActiveNav(id) {
    navLinks.forEach(function (link) {
      var active = link.getAttribute('data-section-id') === id;
      link.classList.toggle('interior-section-nav__link--active', active);
      if (active) {
        link.setAttribute('aria-current', 'true');
        link.scrollIntoView({ block: 'nearest', inline: 'nearest' });
      } else {
        link.removeAttribute('aria-current');
      }
    });

    window.requestAnimationFrame(function () {
      window.dispatchEvent(new Event('resize'));
    });
  }

  function restoreCategoryOrder() {
    if (!categoryList) {
      return;
    }
    originalOrder.forEach(function (id) {
      var category = document.getElementById(id);
      if (category) {
        categoryList.appendChild(category);
      }
    });
  }

  function moveCategoryToTop(category) {
    if (categoryList && categoryList.firstElementChild !== category) {
      categoryList.insertBefore(category, categoryList.firstElementChild);
    }
  }

  function scrollCategoryToTop(category) {
    function alignSelectedCategory(behavior) {
      var sectionNav = navRoot ? navRoot.querySelector('.interior-section-nav') : null;
      var sectionShell = navRoot ? navRoot.querySelector('.interior-section-nav__shell') : null;
      var siteNav = document.querySelector('.fusion-site-nav');
      var siteHeader = siteNav
        ? (siteNav.closest('.sticky') || siteNav.closest('.fusion-site-header') || siteNav)
        : null;
      var headerBottom = siteHeader ? Math.max(0, siteHeader.getBoundingClientRect().bottom) : 80;
      var offset = headerBottom + (sectionShell ? sectionShell.getBoundingClientRect().height : 0) + 8;

      if (sectionNav && sectionNav.classList.contains('interior-section-nav--pinned')) {
        offset = sectionNav.getBoundingClientRect().bottom + 8;
      }

      window.scrollTo({
        top: Math.max(0, window.scrollY + category.getBoundingClientRect().top - offset),
        behavior: behavior
      });
    }

    window.requestAnimationFrame(function () {
      window.requestAnimationFrame(function () {
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        alignSelectedCategory(reduceMotion ? 'auto' : 'smooth');
        window.setTimeout(function () {
          alignSelectedCategory('auto');
        }, reduceMotion ? 0 : 450);
      });
    });
  }

  function selectCategory(category, shouldScroll) {
    if (!category) {
      return;
    }

    if (searchInput && searchInput.value) {
      searchInput.value = '';
      filterServices();
    }

    categories.forEach(function (item) {
      setOpen(item, item === category);
    });
    moveCategoryToTop(category);
    setActiveNav(category.id);

    if (shouldScroll) {
      scrollCategoryToTop(category);
    }
  }

  categories.forEach(function (category) {
    var trigger = category.querySelector('[data-ss-accordion-trigger]');
    if (!trigger) {
      return;
    }
    trigger.addEventListener('click', function () {
      var willOpen = trigger.getAttribute('aria-expanded') !== 'true';
      setOpen(category, willOpen);
      if (willOpen) {
        setActiveNav(category.id);
      }
    });
  });

  function updateResultsStatus(query, matchingCategories) {
    if (!resultsStatus) {
      return;
    }
    if (!query) {
      resultsStatus.textContent = defaultResultsText;
    } else if (matchingCategories === 0) {
      resultsStatus.textContent = 'No services match “' + searchInput.value.trim() + '”.';
    } else {
      resultsStatus.textContent =
        'Showing ' + matchingCategories + ' categor' +
        (matchingCategories === 1 ? 'y' : 'ies') +
        ' matching “' + searchInput.value.trim() + '”.';
    }
  }

  function filterServices() {
    var query = searchInput ? searchInput.value.trim().toLowerCase() : '';
    var matchingCategories = 0;

    categories.forEach(function (category) {
      var cards = Array.prototype.slice.call(category.querySelectorAll('[data-ss-service]'));
      var categoryCount = 0;
      var categoryHaystack = [
        category.getAttribute('data-category-title') || '',
        category.getAttribute('data-category-description') || ''
      ].join(' ').toLowerCase();
      var categoryMatches = Boolean(query && categoryHaystack.indexOf(query) !== -1);

      cards.forEach(function (card) {
        var haystack = [
          card.getAttribute('data-title') || '',
          card.getAttribute('data-description') || '',
          card.getAttribute('data-tag') || ''
        ].join(' ').toLowerCase();
        var matches = !query || categoryMatches || haystack.indexOf(query) !== -1;
        card.hidden = !matches;
        if (matches) {
          categoryCount += 1;
        }
      });

      category.hidden = categoryCount === 0;
      if (categoryCount > 0) {
        matchingCategories += 1;
      }
      var badge = category.querySelector('.ss-acc__count');
      if (badge) {
        badge.textContent = categoryCount + (categoryCount === 1 ? ' service' : ' services');
      }
      if (query && categoryCount > 0) {
        setOpen(category, true);
      } else if (!query) {
        setOpen(category, false);
      }
    });

    if (clearButton) {
      clearButton.hidden = !query;
    }
    updateResultsStatus(query, matchingCategories);

    if (!query) {
      restoreCategoryOrder();
      setActiveNav(originalOrder[0] || '');
    } else {
      var firstMatch = categories.find(function (category) {
        return !category.hidden;
      });
      if (firstMatch) {
        setActiveNav(firstMatch.id);
      }
    }
  }

  if (searchForm) {
    searchForm.addEventListener('submit', function (event) {
      event.preventDefault();
    });
  }
  if (searchInput) {
    searchInput.addEventListener('input', filterServices);
  }
  if (clearButton) {
    clearButton.addEventListener('click', function () {
      searchInput.value = '';
      filterServices();
      searchInput.focus();
    });
  }

  if (navRoot) {
    navRoot.addEventListener('click', function (event) {
      var link = event.target.closest('.interior-section-nav__link[data-section-id]');
      if (!link || !navRoot.contains(link)) {
        return;
      }
      var category = document.getElementById(link.getAttribute('data-section-id'));
      if (!category || !category.hasAttribute('data-ss-category')) {
        return;
      }
      event.preventDefault();
      event.stopPropagation();
      selectCategory(category, true);
    }, true);
  }

  function openHashCategory() {
    if (!window.location.hash) {
      return;
    }

    var id;
    try {
      id = decodeURIComponent(window.location.hash.slice(1));
    } catch (error) {
      id = window.location.hash.slice(1);
    }

    var category = categories.find(function (item) {
      return item.id === id;
    });
    if (!category) {
      return;
    }

    selectCategory(category, true);
  }

  setActiveNav(originalOrder[0] || '');
  openHashCategory();
  window.addEventListener('hashchange', openHashCategory);
}());
