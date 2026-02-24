document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll(".reveal");
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.remove("opacity-0", "translate-y-10");
        entry.target.classList.add("opacity-100", "translate-y-0");
      } else {
        entry.target.classList.add("opacity-0", "translate-y-10");
        entry.target.classList.remove("opacity-100", "translate-y-0");
      }
    });
  }, { threshold: 0.15 });
  elements.forEach(el => observer.observe(el));
});