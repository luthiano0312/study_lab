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

const toggleBtn = document.getElementById('toggleExtras');
const toggleLabel = document.getElementById('toggleLabel');
const extras = document.querySelectorAll('.app-tile[data-extra]');
let expanded = false;

toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    expanded = !expanded;
    extras.forEach(el => el.classList.toggle('visible', expanded));
    toggleLabel.textContent = expanded ? 'Ver menos apps' : 'Ver todos os apps';
});
