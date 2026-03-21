    const btn = document.getElementById('activeBar');
    const grid = document.getElementById('appsGrid');

    btn.addEventListener('click', (e) => {
        e.stopPropagation(); // Evita que o clique no botão feche o menu imediatamente
        grid.classList.toggle('hidden');
    });

    // Fecha se clicar fora do menu
    document.addEventListener('click', (e) => {
        if (!grid.contains(e.target) && e.target !== btn) {
            grid.classList.add('hidden');
        }
    });