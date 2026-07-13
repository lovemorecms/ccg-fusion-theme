/**
 * Landing template interactions — card layout tabs, compare tabs, FAQ accordion.
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
					t.classList.toggle('lpl-ms-tabs__tab--active', t === tab);
					t.setAttribute('aria-selected', t === tab ? 'true' : 'false');
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

	document.querySelectorAll('[data-lpl-card-tabs]').forEach(initCardTabs);
	document.querySelectorAll('[data-lpl-tabs]').forEach(initTabs);
	document.querySelectorAll('[data-lpl-accordion]').forEach(initAccordion);
})();
