// Public site JS — minimal
document.addEventListener('DOMContentLoaded', function () {
  // Mobile: turn navbar dropdowns into accordions (tap to expand inline)
  const mq = window.matchMedia('(max-width: 991.98px)');
  document.querySelectorAll('.navbar-ngo .dropdown-toggle').forEach(function (toggle) {
    toggle.addEventListener('click', function (e) {
      if (!mq.matches) return;
      e.preventDefault();
      e.stopPropagation();
      const menu = toggle.nextElementSibling;
      if (!menu) return;
      const isOpen = menu.classList.contains('show');
      // Close siblings
      toggle.closest('.navbar-nav')
        .querySelectorAll('.dropdown-menu.show')
        .forEach(function (m) { if (m !== menu) m.classList.remove('show'); });
      menu.classList.toggle('show', !isOpen);
    });
  });
});
