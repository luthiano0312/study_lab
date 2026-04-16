/**
 * conteudos.js
 * Lógica da página de Conteúdos — sidebar toggle + pesquisa em tempo real
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ─── SIDEBAR TOGGLE ─── */
    const sidebar       = document.getElementById('sidebar');
    const toggle        = document.getElementById('sidebar-toggle');
    const labels        = document.querySelectorAll('.sidebar-label');
    const toggleArrow   = toggle?.querySelector('svg');
    let expanded        = false;

    const COLLAPSED_W   = '56px';
    const EXPANDED_W    = '200px';

    sidebar?.style.setProperty('width', COLLAPSED_W);
    sidebar?.style.setProperty('transition', 'width 0.25s ease');

    toggle?.addEventListener('click', () => {
        expanded = !expanded;
        sidebar.style.width = expanded ? EXPANDED_W : COLLAPSED_W;
        labels.forEach(l => {
            l.style.opacity = expanded ? '1' : '0';
        });
        if (toggleArrow) {
            toggleArrow.style.transform = expanded ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    });

    /* ─── SEARCH ─── */
    const searchInput   = document.getElementById('search-input');
    const searchClear   = document.getElementById('search-clear');
    const searchCount   = document.getElementById('search-count');
    const searchCountNum= document.getElementById('search-count-num');
    const noResults     = document.getElementById('no-results');
    const noResultsTerm = document.getElementById('no-results-term');
    const sectionsWrapper = document.getElementById('sections-wrapper');
    const allCards      = document.querySelectorAll('.content-card');
    const allSections   = document.querySelectorAll('.area-section');
    const allDividers   = document.querySelectorAll('.section-divider');

    function normalize(str) {
        return str.toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
    }

    function performSearch(query) {
        const q = normalize(query.trim());

        if (!q) {
            resetSearch();
            return;
        }

        searchClear.classList.remove('hidden');
        searchClear.classList.add('flex');
        searchCount.classList.remove('hidden');

        let total = 0;

        allSections.forEach(section => {
            const cards         = section.querySelectorAll('.content-card');
            const badgeCount    = section.querySelector('.badge-count');
            let visibleInSection = 0;

            cards.forEach(card => {
                const title = normalize(card.dataset.title || '');
                const desc  = normalize(card.querySelector('p')?.textContent || '');
                const match = title.includes(q) || desc.includes(q);

                if (match) {
                    card.classList.remove('card-hidden');
                    card.classList.add('card-visible');
                    highlightCard(card, query.trim());
                    visibleInSection++;
                    total++;
                } else {
                    card.classList.remove('card-visible');
                    card.classList.add('card-hidden');
                    removeHighlight(card);
                }
            });

            // Esconde seção inteira se não tiver matches
            if (visibleInSection === 0) {
                section.classList.add('section-hidden');
            } else {
                section.classList.remove('section-hidden');
            }

            if (badgeCount) badgeCount.textContent = visibleInSection;
        });

        // Gerencia dividers — esconde se a seção anterior ou posterior estiver oculta
        manageDividers();

        searchCountNum.textContent = total;

        if (total === 0) {
            noResults.classList.remove('hidden');
            noResults.classList.add('flex');
            noResultsTerm.textContent = query.trim();
        } else {
            noResults.classList.add('hidden');
            noResults.classList.remove('flex');
        }
    }

    function manageDividers() {
        // Rebuild: pega todos children de sections-wrapper em ordem
        const children = Array.from(sectionsWrapper.children);
        children.forEach((el, i) => {
            if (el.classList.contains('section-divider')) {
                // Encontrar section antes e depois deste divider
                const prev = children.slice(0, i).reverse().find(c => c.classList.contains('area-section'));
                const next = children.slice(i + 1).find(c => c.classList.contains('area-section'));
                const prevHidden = !prev || prev.classList.contains('section-hidden');
                const nextHidden = !next || next.classList.contains('section-hidden');
                el.style.display = (prevHidden || nextHidden) ? 'none' : '';
            }
        });
    }

    function highlightCard(card, query) {
        const h3 = card.querySelector('h3');
        if (!h3) return;
        const text = h3.dataset.original || h3.textContent;
        h3.dataset.original = text;
        const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
        h3.innerHTML = text.replace(regex, '<mark class="search-highlight">$1</mark>');
    }

    function removeHighlight(card) {
        const h3 = card.querySelector('h3');
        if (!h3) return;
        if (h3.dataset.original) {
            h3.textContent = h3.dataset.original;
            delete h3.dataset.original;
        }
    }

    function resetSearch() {
        searchClear.classList.add('hidden');
        searchClear.classList.remove('flex');
        searchCount.classList.add('hidden');
        noResults.classList.add('hidden');
        noResults.classList.remove('flex');

        allCards.forEach(card => {
            card.classList.remove('card-hidden', 'card-visible');
            removeHighlight(card);
        });

        allSections.forEach(section => {
            section.classList.remove('section-hidden');
            const badgeCount = section.querySelector('.badge-count');
            if (badgeCount) {
                // Restaura contagem original
                const originalCount = section.querySelectorAll('.content-card').length;
                badgeCount.textContent = originalCount;
            }
        });

        // Restaura dividers
        document.querySelectorAll('.section-divider').forEach(d => {
            d.style.display = '';
        });
    }

    function escapeRegex(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    let debounceTimer;
    searchInput?.addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => performSearch(e.target.value), 150);
    });

    searchClear?.addEventListener('click', () => {
        searchInput.value = '';
        resetSearch();
        searchInput.focus();
    });

    /* ─── CARD HOVER GLOW ─── */
    const colorMap = {
        pink:    '236,72,153',
        emerald: '52,211,153',
        amber:   '251,191,36',
        indigo:  '129,140,248',
        sky:     '56,189,248',
    };

    document.querySelectorAll('.content-grid').forEach(grid => {
        const color = colorMap[grid.dataset.color] || '255,255,255';
        grid.querySelectorAll('.content-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.background    = `rgba(${color},0.07)`;
                card.style.borderColor   = `rgba(${color},0.25)`;
                card.style.transform     = 'translateY(-2px)';
                card.style.boxShadow     = `0 8px 24px rgba(${color},0.08)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.background    = 'rgba(255,255,255,0.03)';
                card.style.borderColor   = 'rgba(255,255,255,0.07)';
                card.style.transform     = '';
                card.style.boxShadow     = '';
            });
        });
    });

});

