// Sidebar toggle for mobile
document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.getElementById("sidebarToggle");
  const sidebar = document.getElementById("sidebar");
  if (toggle && sidebar) {
    toggle.addEventListener("click", () => sidebar.classList.toggle("open"));
  }

  // Wire up "Add New" button: clears modal form
  document.querySelectorAll("[data-action='add']").forEach((btn) => {
    btn.addEventListener("click", () => {
      const form = document.getElementById("itemForm");
      if (form) form.reset();
      const titleEl = document.getElementById("modalTitle");
      if (titleEl) titleEl.textContent = "Add New Item";
    });
  });

  // Wire up "Edit" buttons: prefill mock data
  document.querySelectorAll("[data-action='edit']").forEach((btn) => {
    btn.addEventListener("click", () => {
      const row = btn.closest("tr");
      if (!row) return;
      const title = row.querySelector("[data-field='title']")?.textContent.trim() || "";
      const date = row.querySelector("[data-field='date']")?.textContent.trim() || "";
      const titleInput = document.querySelector("#itemForm [name='title']");
      const dateInput = document.querySelector("#itemForm [name='event_date']");
      if (titleInput) titleInput.value = title;
      if (dateInput) dateInput.value = date;
      const titleEl = document.getElementById("modalTitle");
      if (titleEl) titleEl.textContent = "Edit Item";
    });
  });

  // Wire up "Delete" buttons (UI only, no persistence)
  document.querySelectorAll("[data-action='delete']").forEach((btn) => {
    btn.addEventListener("click", () => {
      if (confirm("Are you sure you want to delete this item?")) {
        const row = btn.closest("tr");
        if (row) row.remove();
      }
    });
  });
});
