/**
 * Fusion Toolkit — sticky in-page nav (scroll spy + show/hide).
 */
(function () {
	'use strict';

	var SECTION_IDS = ['overview', 'basecamp', 'helix', 'lens', 'match'];
	var nav = document.querySelector('.ft-sticky-nav');
	if (!nav) return;

	var links = nav.querySelectorAll('.ft-sticky-nav__link');
	var hero = document.getElementById('overview');
	var activeId = 'overview';
	var pendingTarget = null;
	var rafId = null;

	function getScrollSpyOffset() {
		var siteHeader = document.querySelector('.fusion-site-nav');
		if (siteHeader) {
			var stickyParent = siteHeader.closest('.sticky') || siteHeader;
			return stickyParent.getBoundingClientRect().bottom;
		}
		var shell = nav.querySelector('.ft-sticky-nav__shell');
		if (nav.classList.contains('ft-sticky-nav--visible') && shell) {
			return shell.getBoundingClientRect().bottom + 8;
		}
		return 88;
	}

	function setActive(id) {
		if (id === activeId) return;
		activeId = id;
		links.forEach(function (link) {
			var match = link.getAttribute('href') === '#' + id;
			link.classList.toggle('ft-sticky-nav__link--active', match);
			if (match) {
				link.setAttribute('aria-current', 'true');
				if (nav.classList.contains('ft-sticky-nav--visible')) {
					link.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' });
				}
			} else {
				link.removeAttribute('aria-current');
			}
		});
	}

	function pickActiveSection() {
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
			setActive(SECTION_IDS[SECTION_IDS.length - 1]);
			return;
		}

		var current = SECTION_IDS[0];
		SECTION_IDS.forEach(function (id) {
			var el = document.getElementById(id);
			if (el && el.getBoundingClientRect().top <= offset) {
				current = id;
			}
		});
		setActive(current);
	}

	function scheduleUpdate() {
		if (rafId !== null) return;
		rafId = window.requestAnimationFrame(function () {
			rafId = null;
			pickActiveSection();
		});
	}

	if (hero && 'IntersectionObserver' in window) {
		var showObserver = new IntersectionObserver(
			function (entries) {
				nav.classList.toggle('ft-sticky-nav--visible', !entries[0].isIntersecting);
				nav.setAttribute('aria-hidden', entries[0].isIntersecting ? 'true' : 'false');
			},
			{ threshold: 0, rootMargin: '-1px 0px 0px 0px' }
		);
		showObserver.observe(hero);
	}

	links.forEach(function (link) {
		link.addEventListener('click', function (e) {
			var href = link.getAttribute('href');
			if (!href || href.charAt(0) !== '#') return;
			var id = href.slice(1);
			var target = document.getElementById(id);
			if (!target) return;
			e.preventDefault();
			pendingTarget = id;
			setActive(id);
			target.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	});

	pickActiveSection();
	window.addEventListener('scroll', scheduleUpdate, { passive: true });
	window.addEventListener('resize', scheduleUpdate, { passive: true });
})();
