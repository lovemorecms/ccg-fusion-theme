/**
 * Homepage announcements horizontal scroll.
 */
(function () {
  'use strict';

  var viewport = document.querySelector('[data-announcements-viewport]');
  var track = document.querySelector('[data-announcements-track]');
  if (!viewport || !track) return;

  var prev = viewport.querySelector('[data-announcements-prev]');
  var next = viewport.querySelector('[data-announcements-next]');

  function update() {
    var scrollable = track.scrollWidth > track.clientWidth + 1;
    viewport.classList.toggle('fusion-announcements__viewport-wrap--scrollable', scrollable);
    if (prev) prev.disabled = !scrollable || track.scrollLeft <= 2;
    if (next) next.disabled = !scrollable || track.scrollLeft >= track.scrollWidth - track.clientWidth - 2;
  }

  function scrollByDir(dir) {
    var card = track.querySelector('[data-announcement-card]');
    var step = (card ? card.offsetWidth : 280) + 16;
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    track.scrollBy({ left: dir * step, behavior: reduced ? 'auto' : 'smooth' });
  }

  if (prev) prev.addEventListener('click', function () { scrollByDir(-1); });
  if (next) next.addEventListener('click', function () { scrollByDir(1); });
  track.addEventListener('scroll', update, { passive: true });
  track.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft') { e.preventDefault(); scrollByDir(-1); }
    if (e.key === 'ArrowRight') { e.preventDefault(); scrollByDir(1); }
  });
  window.addEventListener('resize', update);
  update();
})();
