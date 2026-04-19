(() => {
    "use strict";

    /* ── SIDEBAR ── */
    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("sidebar-toggle");
    const arrow = document.getElementById("toggle-arrow");
    let expanded = false;

    toggle?.addEventListener("click", () => {
        expanded = !expanded;
        sidebar.classList.toggle("expanded", expanded);
        if (arrow) arrow.style.transform = expanded ? "rotate(180deg)" : "";
    });

    /* ── SEARCH ── */
    const searchInput = document.getElementById("search-input");
    const searchClear = document.getElementById("search-clear");
    const searchCount = document.getElementById("search-count");
    const searchCountNum = document.getElementById("search-count-num");
    const noResults = document.getElementById("no-results");
    const noResultsTerm = document.getElementById("no-results-term");
    const sectionsWrapper = document.getElementById("sections-wrapper");
    const allCards = document.querySelectorAll(".content-card");
    const allSections = document.querySelectorAll(".area-section");

    function normalize(str) {
        return str
            .toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "");
    }
    function escapeRegex(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    function updateDividers() {
        Array.from(sectionsWrapper.children).forEach((el, i, arr) => {
            if (!el.classList.contains("section-divider")) return;
            const prev = arr
                .slice(0, i)
                .reverse()
                .find((c) => c.classList.contains("area-section"));
            const next = arr
                .slice(i + 1)
                .find((c) => c.classList.contains("area-section"));
            const hide =
                prev?.classList.contains("section-hidden") ||
                next?.classList.contains("section-hidden");
            el.style.display = hide ? "none" : "";
        });
    }

    function performSearch(query) {
        const q = normalize(query.trim());
        if (!q) {
            resetSearch();
            return;
        }

        searchClear.style.display = "flex";
        searchCount.style.display = "block";

        let total = 0;

        allSections.forEach((section) => {
            const cards = section.querySelectorAll(".content-card");
            const badge = section.querySelector(".badge-count");
            let vis = 0;

            cards.forEach((card) => {
                const title = normalize(card.dataset.title || "");
                const desc = normalize(
                    card.querySelector("p")?.textContent || "",
                );
                const match = title.includes(q) || desc.includes(q);

                card.classList.toggle("card-hidden", !match);

                if (match) {
                    vis++;
                    total++;
                    const h3 = card.querySelector("h3");
                    if (h3) {
                        const orig = h3.dataset.original ?? h3.textContent;
                        h3.dataset.original = orig;
                        h3.innerHTML = orig.replace(
                            new RegExp(`(${escapeRegex(query.trim())})`, "gi"),
                            '<mark class="search-highlight">$1</mark>',
                        );
                    }
                } else {
                    const h3 = card.querySelector("h3");
                    if (h3?.dataset.original) {
                        h3.textContent = h3.dataset.original;
                        delete h3.dataset.original;
                    }
                }
            });

            section.classList.toggle("section-hidden", vis === 0);
            if (badge)
                badge.textContent = vis === 0 ? "0 tópicos" : `${vis} tópicos`;
        });

        updateDividers();
        if (searchCountNum) searchCountNum.textContent = total;
        noResults.style.display = total === 0 ? "flex" : "none";
        if (noResultsTerm) noResultsTerm.textContent = query.trim();
    }

    function resetSearch() {
        searchClear.style.display = "none";
        searchCount.style.display = "none";
        noResults.style.display = "none";

        allCards.forEach((card) => {
            card.classList.remove("card-hidden");
            const h3 = card.querySelector("h3");
            if (h3?.dataset.original) {
                h3.textContent = h3.dataset.original;
                delete h3.dataset.original;
            }
        });

        allSections.forEach((s) => {
            s.classList.remove("section-hidden");
            const badge = s.querySelector(".badge-count");
            if (badge) {
                const count = s.querySelectorAll(".content-card").length;
                badge.textContent = `${count} tópicos`;
            }
        });

        document
            .querySelectorAll(".section-divider")
            .forEach((d) => (d.style.display = ""));
    }

    let debounceTimer;
    searchInput?.addEventListener("input", (e) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => performSearch(e.target.value), 150);
    });
    searchClear?.addEventListener("click", () => {
        searchInput.value = "";
        resetSearch();
        searchInput.focus();
    });

    /* ── FILTER TABS ── */
    const areaMap = {
        Matemática: "matematica",
        Física: "natureza",
        Química: "natureza",
        Biologia: "natureza",
        Linguagens: "linguagens",
        Humanas: "humanas",
        Tecnologia: "tecnologia",
        Redação: "redacao",
    };

    document.querySelectorAll(".filter-tab").forEach((tab) => {
        tab.addEventListener("click", () => {
            document
                .querySelectorAll(".filter-tab")
                .forEach((t) => t.classList.remove("active"));
            tab.classList.add("active");
            const f = tab.dataset.filter;

            allSections.forEach((s) => {
                const hide = f !== "Todos" && s.dataset.area !== areaMap[f];
                s.classList.toggle("section-hidden", hide);
            });
            updateDividers();
        });
    });

    /* ── CARD HOVER ── */
    document.querySelectorAll(".content-grid").forEach((grid) => {
        const rgb = grid.dataset.color || "255,255,255";
        grid.querySelectorAll(".content-card").forEach((card) => {
            const arrowEl = card.querySelector(".card-arrow");
            card.addEventListener("mouseenter", () => {
                card.style.background = `rgba(${rgb},0.07)`;
                card.style.borderColor = `rgba(${rgb},0.22)`;
                card.style.transform = "translateY(-2px)";
                card.style.boxShadow = `0 8px 28px rgba(${rgb},0.1)`;
                if (arrowEl) arrowEl.style.stroke = `rgb(${rgb})`;
            });
            card.addEventListener("mouseleave", () => {
                card.style.background = "rgba(255,255,255,0.025)";
                card.style.borderColor = "rgba(255,255,255,0.06)";
                card.style.transform = "";
                card.style.boxShadow = "";
                if (arrowEl) arrowEl.style.stroke = "#334155";
            });
        });
    });
})();
