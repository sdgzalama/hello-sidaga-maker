// Admin JS
document.addEventListener('DOMContentLoaded', function () {
  var toggle = document.querySelector('.sidebar-toggle');
  var sidebar = document.querySelector('.sidebar');
  if (toggle && sidebar) {
    toggle.addEventListener('click', function () { sidebar.classList.toggle('open'); });
  }

  // Pre-fill edit modals
  document.querySelectorAll('[data-edit]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var modalId = btn.getAttribute('data-bs-target');
      var modal   = document.querySelector(modalId);
      if (!modal) return;
      Object.keys(btn.dataset).forEach(function (key) {
        if (key === 'bsTarget' || key === 'edit') return;
        var input = modal.querySelector('[name="' + key + '"]');
        if (input) input.value = btn.dataset[key];
      });
    });
  });
});
