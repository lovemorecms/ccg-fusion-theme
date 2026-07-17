/**
 * Shared interior section nav — pin under site header, scroll-spy, sliding underline.
 * Ported from React InteriorSectionNav (sentinel + spacer model).
 * Supports in-page hash links and cross-page hrefs (active via aria-current / --active).
 */
(function () {
	'use strict';

	var roots = document.querySelectorAll('.interior-section-nav-root');
	if (!roots.length) return;

	function getSiteHeaderBottom() {
		var siteNav = document.querySelector('.fusion-site-nav');
		if (siteNav) {
			var stickyParent = siteNav.closest('.sticky') || siteNav.closest('.fusion-site-header') || siteNav;
			return stickyParent.getBoundingClientRect().bottom;
		}
		return 80;
	}

	function getScrollSpyOffset() {
		var pinnedShell = document.querySelector(
			'.interior-section-nav--pinned .interior-section-nav__shell'
		);
		if (pinnedShell) {
			return pinnedShell.getBoundingClientRect().bottom + 8;
		}
		return getSiteHeaderBottom();
	}

	function prefersReducedMotion() {
		return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	}

	function getActiveLink(links) {
		var active = null;
		links.forEach(function (link) {
			if (
				link.classList.contains('interior-section-nav__link--active') ||
				link.getAttribute('aria-current') === 'page' ||
				link.getAttribute('aria-current') === 'true'
			) {
				active = link;
			}
		});
		return active || links[0] || null;
	}

	function initRoot(root) {
		var sentinel = root.querySelector('.interior-section-nav__sentinel');
		var nav = root.querySelector('.interior-section-nav');
		var shell = root.querySelector('.interior-section-nav__shell');
		var list = root.querySelector('.interior-section-nav__list');
		var indicator = root.querySelector('.interior-section-nav__indicator');
		var links = root.querySelectorAll('.interior-section-nav__link');
		var main = document.getElementById('main-content');
		var breadcrumbs = main
			? main.querySelectorAll('.kc-breadcrumb-bar, .tpl-2col-breadcrumb-bar')
			: document.querySelectorAll('.kc-breadcrumb-bar, .tpl-2col-breadcrumb-bar');

		if (!sentinel || !nav || !shell || !list || !links.length) return;

		var sectionIds = [];
		links.forEach(function (link) {
			var href = link.getAttribute('href') || '';
			var hashIndex = href.indexOf('#');
			if (hashIndex < 0) return;
			var hash = href.slice(hashIndex + 1);
			// Only treat pure in-page hashes (or same-page path#hash) as scroll-spy targets.
			var path = hashIndex === 0 ? '' : href.slice(0, hashIndex);
			var isInPage =
				hashIndex === 0 ||
				path === '' ||
				path === window.location.pathname ||
				path === window.location.pathname.replace(/\/$/, '') + '/' ||
				path.replace(/\/$/, '') === window.location.pathname.replace(/\/$/, '');
			if (hash && isInPage && sectionIds.indexOf(hash) === -1 && document.getElementById(hash)) {
				sectionIds.push(hash);
			}
		});

		var hasScrollSpy = sectionIds.length > 0 && root.getAttribute('data-manual-active') !== 'true';
		var activeId = hasScrollSpy ? sectionIds[0] : null;
		var pendingTarget = null;
		var isPinned = false;
		var spacerHeight = 0;
		var spacerEl = null;
		var rafId = null;

		function setBreadcrumbHidden(hidden) {
			breadcrumbs.forEach(function (bar) {
				bar.classList.toggle('fusion-interior-breadcrumb-bar--hidden', hidden);
				if (hidden) {
					bar.setAttribute('aria-hidden', 'true');
				} else {
					bar.removeAttribute('aria-hidden');
				}
			});
		}

		function ensureSpacer() {
			if (spacerEl) return spacerEl;
			spacerEl = document.createElement('div');
			spacerEl.className = 'interior-section-nav__spacer';
			spacerEl.setAttribute('aria-hidden', 'true');
			root.insertBefore(spacerEl, nav);
			return spacerEl;
		}

		function removeSpacer() {
			if (spacerEl && spacerEl.parentNode) {
				spacerEl.parentNode.removeChild(spacerEl);
			}
			spacerEl = null;
		}

		function setPinned(next) {
			if (next === isPinned) return;
			isPinned = next;
			nav.classList.toggle('interior-section-nav--pinned', isPinned);
			if (isPinned) {
				nav.style.top = Math.max(0, getSiteHeaderBottom()) + 'px';
			} else {
				nav.style.removeProperty('top');
			}
			if (main) {
				main.classList.toggle('interior-section-nav--page-pinned', isPinned);
			}
			setBreadcrumbHidden(isPinned);
			if (isPinned) {
				ensureSpacer().style.height = spacerHeight + 'px';
			} else {
				removeSpacer();
			}
		}

		function updatePinState() {
			var stickTop = getSiteHeaderBottom();
			if (isPinned) {
				nav.style.top = Math.max(0, stickTop) + 'px';
			}
			setPinned(sentinel.getBoundingClientRect().top < stickTop);
		}

		function measureShell() {
			spacerHeight = shell.getBoundingClientRect().height;
			if (isPinned && spacerEl) {
				spacerEl.style.height = spacerHeight + 'px';
			}
		}

		function updateIndicator() {
			if (!indicator) return;
			var activeLink = null;
			if (hasScrollSpy && activeId) {
				links.forEach(function (link) {
					var href = link.getAttribute('href') || '';
					if (href === '#' + activeId || href.split('#').pop() === activeId) {
						activeLink = link;
					}
				});
			}
			if (!activeLink) {
				activeLink = getActiveLink(links);
			}
			if (!activeLink) {
				indicator.style.opacity = '0';
				return;
			}
			var listRect = list.getBoundingClientRect();
			var linkRect = activeLink.getBoundingClientRect();
			indicator.style.transform = 'translateX(' + (linkRect.left - listRect.left) + 'px)';
			indicator.style.width = linkRect.width + 'px';
			indicator.style.opacity = '1';
		}

		function setActive(id) {
			if (!hasScrollSpy) {
				updateIndicator();
				return;
			}
			if (id === activeId) {
				updateIndicator();
				return;
			}
			activeId = id;
			links.forEach(function (link) {
				var href = link.getAttribute('href') || '';
				var match = href === '#' + id || href.split('#').pop() === id;
				link.classList.toggle('interior-section-nav__link--active', match);
				if (match) {
					link.setAttribute('aria-current', 'true');
					if (isPinned) {
						link.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' });
					}
				} else {
					link.removeAttribute('aria-current');
				}
			});
			updateIndicator();
		}

		function pickActiveSection() {
			if (!hasScrollSpy) return;

			if (pendingTarget) {
				var pendingEl = document.getElementById(pendingTarget);
				if (pendingEl && pendingEl.getBoundingClientRect().top > getScrollSpyOffset() + 4) {
					return;
				}
				pendingTarget = null;
			}

			var offset = getScrollSpyOffset();
			var scrollBottom = window.scrollY + window.innerHeight;
			var docBottom = document.documentElement.scrollHeight;

			if (scrollBottom >= docBottom - 64) {
				setActive(sectionIds[sectionIds.length - 1]);
				return;
			}

			var current = sectionIds[0];
			sectionIds.forEach(function (id) {
				var el = document.getElementById(id);
				if (el && el.getBoundingClientRect().top <= offset) {
					current = id;
				}
			});
			setActive(current);
		}

		function scheduleUpdate() {
			if (!hasScrollSpy) return;
			if (rafId !== null) return;
			rafId = window.requestAnimationFrame(function () {
				rafId = null;
				pickActiveSection();
			});
		}

		function handleNavClick(e) {
			var link = e.currentTarget;
			var href = link.getAttribute('href') || '';
			var hashIndex = href.indexOf('#');
			if (hashIndex < 0) return;
			var id = href.slice(hashIndex + 1);
			var target = id ? document.getElementById(id) : null;
			if (!target) return;
			e.preventDefault();
			pendingTarget = id;
			setActive(id);
			target.scrollIntoView({
				behavior: prefersReducedMotion() ? 'auto' : 'smooth',
				block: 'start',
			});
		}

		links.forEach(function (link) {
			link.addEventListener('click', handleNavClick);
		});

		list.addEventListener('scroll', updateIndicator, { passive: true });

		if (typeof ResizeObserver !== 'undefined') {
			var ro = new ResizeObserver(measureShell);
			ro.observe(shell);
		}

		measureShell();
		updatePinState();
		if (hasScrollSpy) {
			pickActiveSection();
		}
		updateIndicator();

		window.addEventListener('scroll', updatePinState, { passive: true });
		window.addEventListener('resize', updatePinState, { passive: true });
		window.addEventListener('scroll', scheduleUpdate, { passive: true });
		window.addEventListener('resize', scheduleUpdate, { passive: true });
		window.addEventListener('resize', function () {
			measureShell();
			updateIndicator();
		}, { passive: true });
	}

	roots.forEach(initRoot);
})();
