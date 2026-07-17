/**
 * Landing template interactions — card layout tabs, compare/heroes/spotlight tabs,
 * FAQ accordion, and section reveal motion.
 */
(function () {
	'use strict';

	function initCardTabs(root) {
		var tabs = root.querySelectorAll('[data-layout]');
		var grid = root.querySelector('[data-lpl-card-grid]');
		if (!tabs.length || !grid) return;

		var cards = grid.querySelectorAll('[data-card-index]');

		function applyLayout(layout) {
			grid.className = 'lpl-card-grid lpl-card-grid--' + layout;
			if (layout === 'text') {
				grid.classList.add('lpl-card-grid--text');
			}
			cards.forEach(function (card) {
				var index = parseInt(card.getAttribute('data-card-index'), 10);
				var show = true;
				if (layout === 'two') show = index < 2;
				else if (layout === 'three' || layout === 'text') show = index < 3;
				else if (layout === 'four') show = index < 4;
				card.hidden = !show;
				card.classList.toggle('lpl-card--text', layout === 'text');
			});
		}

		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				tabs.forEach(function (t) {
					var on = t === tab;
					t.classList.toggle('lpl-ms-tabs__tab--active', on);
					t.setAttribute('aria-selected', on ? 'true' : 'false');
					t.tabIndex = on ? 0 : -1;
				});
				applyLayout(tab.getAttribute('data-layout') || 'three');
			});
		});
	}

	function initTabs(root) {
		var tabs = root.querySelectorAll('[role="tab"][data-tab]');
		var panels = root.querySelectorAll('[data-panel]');
		if (!tabs.length || !panels.length) return;

		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				var id = tab.getAttribute('data-tab');
				tabs.forEach(function (t) {
					var on = t === tab;
					t.classList.toggle('lpl-ms-tabs__tab--active', on);
					t.setAttribute('aria-selected', on ? 'true' : 'false');
					t.tabIndex = on ? 0 : -1;
				});
				panels.forEach(function (panel) {
					panel.hidden = panel.getAttribute('data-panel') !== id;
				});
			});
		});
	}

	function initAccordion(root) {
		var items = root.querySelectorAll('.lpl-acc__item');
		items.forEach(function (item) {
			var button = item.querySelector('.lpl-acc__button');
			var panel = item.querySelector('.lpl-acc__panel');
			var chevron = item.querySelector('.lpl-acc__chevron');
			if (!button || !panel) return;
			button.addEventListener('click', function () {
				var open = button.getAttribute('aria-expanded') !== 'true';
				button.setAttribute('aria-expanded', open ? 'true' : 'false');
				panel.hidden = !open;
				item.classList.toggle('lpl-acc__item--open', open);
				if (chevron) chevron.classList.toggle('lpl-acc__chevron--open', open);
			});
		});
	}

	function initSectionReveal() {
		var sections = document.querySelectorAll('.lpl-page .fusion-section-reveal');
		if (!sections.length) return;

		var reduceMotion =
			window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
			document.documentElement.classList.contains('figma-capture');

		if (reduceMotion || !('IntersectionObserver' in window)) {
			sections.forEach(function (el) {
				el.setAttribute('data-revealed', 'true');
			});
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) return;
					entry.target.setAttribute('data-revealed', 'true');
					observer.unobserve(entry.target);
				});
			},
			{ threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
		);

		sections.forEach(function (el) {
			if (el.getAttribute('data-revealed') === 'true') return;
			observer.observe(el);
		});
	}

	document.querySelectorAll('[data-lpl-card-tabs]').forEach(initCardTabs);
	document.querySelectorAll('[data-lpl-tabs]').forEach(initTabs);
	document.querySelectorAll('[data-lpl-accordion]').forEach(initAccordion);
	initSectionReveal();
})();
