// Public site JS — robust nav + safety cleanup
(function () {
  'use strict';

  var DESKTOP = '(min-width: 992px)';

  function getBs() { return (typeof window !== 'undefined') ? window.bootstrap : null; }

  // Close all open navbar dropdowns (used on resize / outside click).
  function closeAllDropdowns() {
    var bs = getBs();
    document.querySelectorAll('.navbar-ngo .dropdown-toggle').forEach(function (t) {
      if (bs && bs.Dropdown) {
        var inst = bs.Dropdown.getInstance(t);
        if (inst) { try { inst.hide(); } catch (e) {} }
      }
    });
    document.querySelectorAll('.navbar-ngo .dropdown-menu.show').forEach(function (m) {
      m.classList.remove('show');
    });
    document.querySelectorAll('.navbar-ngo .dropdown-toggle.show').forEach(function (t) {
      t.classList.remove('show');
      t.setAttribute('aria-expanded', 'false');
    });
  }

  // Mobile accordion: tap toggles inline; uses Bootstrap Dropdown API so
  // outside-click handling stays consistent with desktop.
  function attachMobileAccordion() {
    document.querySelectorAll('.navbar-ngo .dropdown-toggle').forEach(function (toggle) {
      if (toggle.dataset.slfBound === '1') return;
      toggle.dataset.slfBound = '1';
      toggle.addEventListener('click', function (e) {
        if (window.matchMedia(DESKTOP).matches) return; // desktop = let Bootstrap handle
        e.preventDefault();
        var menu = toggle.nextElementSibling;
        if (!menu) return;
        var isOpen = menu.classList.contains('show');
        // Close siblings within the same nav
        var nav = toggle.closest('.navbar-nav');
        if (nav) {
          nav.querySelectorAll('.dropdown-menu.show').forEach(function (m) {
            if (m !== menu) m.classList.remove('show');
          });
        }
        menu.classList.toggle('show', !isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
      });
    });
  }

  // Outside click closes any stuck open menu.
  function attachOutsideClick() {
    document.addEventListener('click', function (e) {
      var inNav = e.target.closest('.navbar-ngo');
      if (!inNav) closeAllDropdowns();
    });
  }

  // Safety cleanup: orphan modal-backdrops can intercept all clicks
  // (the "page is unclickable" Chrome bug). Remove any backdrop that
  // doesn't correspond to a visible .modal.show.
  function cleanupOrphanBackdrops() {
    var visibleModal = document.querySelector('.modal.show');
    if (!visibleModal) {
      document.querySelectorAll('.modal-backdrop').forEach(function (b) { b.remove(); });
      document.body.classList.remove('modal-open');
      document.body.style.removeProperty('overflow');
      document.body.style.removeProperty('padding-right');
    }
  }

  // ESC key force-cleanup as a last-resort escape hatch.
  function attachEscapeHatch() {
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        closeAllDropdowns();
        cleanupOrphanBackdrops();
      }
    });
  }

  function onResize() {
    if (window.matchMedia(DESKTOP).matches) closeAllDropdowns();
    cleanupOrphanBackdrops();
  }

  document.addEventListener('DOMContentLoaded', function () {
    attachMobileAccordion();
    attachOutsideClick();
    attachEscapeHatch();
    cleanupOrphanBackdrops();
    window.addEventListener('resize', onResize);
    // Periodic safety sweep — cheap and catches edge cases
    setInterval(cleanupOrphanBackdrops, 2000);
  });
})();
