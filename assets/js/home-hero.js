/**
 * Homepage hero carousel.
 */
(function () {
  'use strict';

  var hero = document.getElementById('fusion-hero');
  if (!hero) return;

  var slides = hero.querySelectorAll('[data-hero-slide]');
  var dots = hero.querySelectorAll('[data-hero-dot]');
  var prev = hero.querySelector('[data-hero-prev]');
  var next = hero.querySelector('[data-hero-next]');
  var count = slides.length;
  var index = 0;

  function show(i) {
    index = (i + count) % count;
    slides.forEach(function (slide, n) {
      var on = n === index;
      slide.hidden = !on;
      slide.setAttribute('aria-hidden', on ? 'false' : 'true');
      slide.classList.toggle('fusion-hero__slide--active', on);
      if (on && !slide.querySelector('#fusion-hero-heading')) {
        var h = slide.querySelector('.fusion-hero__headline');
        if (h) h.id = 'fusion-hero-heading';
      } else if (!on) {
        var h2 = slide.querySelector('.fusion-hero__headline');
        if (h2) h2.removeAttribute('id');
      }
    });
    dots.forEach(function (btn, n) {
      var on = n === index;
      btn.setAttribute('aria-pressed', on ? 'true' : 'false');
      var dot = btn.querySelector('.fusion-hero__carousel-dot');
      if (dot) dot.classList.toggle('fusion-hero__carousel-dot--active', on);
    });
  }

  if (prev) prev.addEventListener('click', function () { show(index - 1); });
  if (next) next.addEventListener('click', function () { show(index + 1); });
  dots.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var i = parseInt(btn.getAttribute('data-hero-dot'), 10);
      if (!isNaN(i)) show(i);
    });
  });

  var well = hero.querySelector('.fusion-hero__carousel-well');
  if (well) {
    well.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') { e.preventDefault(); show(index - 1); }
      if (e.key === 'ArrowRight') { e.preventDefault(); show(index + 1); }
    });
  }
})();
