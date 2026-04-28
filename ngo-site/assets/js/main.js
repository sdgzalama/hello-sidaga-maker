// Highlight active nav link based on current page
document.addEventListener("DOMContentLoaded", function () {
  const path = window.location.pathname.split("/").pop() || "index.html";
  document.querySelectorAll(".navbar-ngo .nav-link").forEach((link) => {
    const href = link.getAttribute("href");
    if (href === path) link.classList.add("active");
  });
});
