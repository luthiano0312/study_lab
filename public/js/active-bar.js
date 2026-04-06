document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("activeBar");
    const panel = document.getElementById("appsGrid");

    if (!btn || !panel) return;

    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        panel.classList.toggle("open");
    });

    document.addEventListener("click", () => {
        panel.classList.remove("open");
    });

    panel.addEventListener("click", (e) => {
        e.stopPropagation();
    });
});
