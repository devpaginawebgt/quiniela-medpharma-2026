import { initAccordions } from 'flowbite';

/**
 * Inicializa el modal/drawer de selecciones (team-card).
 * Gestiona apertura, cierre, populate de datos, fetch de jugadores y tecla Escape.
 */
export const initTeamModal = () => {

    const modal = document.getElementById('modal-equipo');

    if (!modal) return;

    const panel           = document.getElementById('modal-equipo-panel');
    const modalImg        = document.getElementById('modal-equipo-img');
    const modalNombre     = document.getElementById('modal-equipo-nombre');
    const modalDesc       = document.getElementById('modal-equipo-descripcion');
    const backdrop        = document.getElementById('modal-equipo-backdrop');
    const closeBtn        = document.getElementById('modal-equipo-close');
    const playersLoading  = document.getElementById('modal-equipo-players-loading');
    const playersEmpty    = document.getElementById('modal-equipo-players-empty');
    const playersAccordion = document.getElementById('modal-equipo-players-accordion');

    const playersCache = new Map();
    let activeFetchId = 0;

    const openModal = () => {
        modal.classList.remove('pointer-events-none');
        backdrop.classList.remove('opacity-0');
        panel.classList.remove('translate-y-full', 'opacity-0');
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        backdrop.classList.add('opacity-0');
        panel.classList.add('translate-y-full', 'opacity-0');
        document.body.style.overflow = '';
        panel.addEventListener('transitionend', () => {
            modal.classList.add('pointer-events-none');
        }, { once: true });
    };

    const whiteFlagClasses = ['border-2', 'border-zinc-300'];

    const escapeHtml = (str) => String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');

    const renderPlayer = (player) => {
        const photo = player.photo
            ? `<img src="${escapeHtml(player.photo)}" alt="${escapeHtml(player.name)}" class="w-10 h-10 rounded-full object-cover bg-complementary-light shrink-0" loading="lazy">`
            : `<div class="w-10 h-10 rounded-full bg-complementary-light flex items-center justify-center shrink-0">
                   <span class="icon-[fluent--person-20-regular] w-5 h-5 text-complementary-dark"></span>
               </div>`;

        const age = player.age != null
            ? `<span class="text-xs text-complementary-dark shrink-0">${escapeHtml(player.age)} años</span>`
            : '';

        return `
            <li class="flex items-center gap-3 py-2 border-b border-complementary-light/60 last:border-b-0">
                ${photo}
                <span class="flex-1 text-sm text-dark truncate">${escapeHtml(player.name)}</span>
                ${age}
            </li>
        `;
    };

    const renderAccordion = (grupos, equipoId) => {
        playersAccordion.innerHTML = '';

        const sectionsHtml = grupos
            .filter(g => g.players.length > 0)
            .map((g, idx) => {
                const headingId  = `players-heading-${equipoId}-${idx}`;
                const bodyId     = `players-body-${equipoId}-${idx}`;
                const isFirst    = idx === 0;
                const expanded   = isFirst ? 'true' : 'false';
                const hiddenAttr = isFirst ? '' : 'hidden';

                return `
                    <h2 id="${headingId}">
                        <button
                            type="button"
                            class="flex items-center justify-between w-full px-4 py-3 font-optimprov text-sm uppercase text-dark border border-complementary-light hover:bg-complementary-light/30 cursor-pointer"
                            data-accordion-target="#${bodyId}"
                            aria-expanded="${expanded}"
                            aria-controls="${bodyId}"
                        >
                            <span>${escapeHtml(g.position_label)} <span class="text-complementary-dark text-xs ml-1">(${g.players.length})</span></span>
                            <span class="icon-[fluent--chevron-down-20-filled] w-4 h-4 transition-transform shrink-0 rotate-180"></span>
                        </button>
                    </h2>
                    <div id="${bodyId}" class="${hiddenAttr}" aria-labelledby="${headingId}">
                        <ul class="px-4 py-2 border border-t-0 border-complementary-light">
                            ${g.players.map(renderPlayer).join('')}
                        </ul>
                    </div>
                `;
            })
            .join('');

        playersAccordion.innerHTML = sectionsHtml;

        if (sectionsHtml === '') {
            playersAccordion.classList.add('hidden');
            playersEmpty.classList.remove('hidden');
            return;
        }

        playersAccordion.classList.remove('hidden');
        playersEmpty.classList.add('hidden');
        initAccordions();
    };

    const fetchPlayers = async (equipoId) => {
        playersAccordion.classList.add('hidden');
        playersAccordion.innerHTML = '';
        playersEmpty.classList.add('hidden');
        playersLoading.classList.remove('hidden');
        playersLoading.classList.add('flex');

        const fetchId = ++activeFetchId;

        try {
            let grupos = playersCache.get(equipoId);

            if (!grupos) {
                const { data } = await window.axios.get(`/selecciones/${equipoId}/players`);
                grupos = data.grupos ?? [];
                playersCache.set(equipoId, grupos);
            }

            if (fetchId !== activeFetchId) return;

            renderAccordion(grupos, equipoId);
        } catch (e) {
            if (fetchId !== activeFetchId) return;
            playersAccordion.classList.add('hidden');
            playersEmpty.textContent = 'No se pudo cargar la plantilla.';
            playersEmpty.classList.remove('hidden');
        } finally {
            if (fetchId === activeFetchId) {
                playersLoading.classList.add('hidden');
                playersLoading.classList.remove('flex');
            }
        }
    };

    document.querySelectorAll('.team-card').forEach(card => {
        card.addEventListener('click', () => {
            modalNombre.textContent = card.dataset.nombre;
            modalImg.src            = card.dataset.imagen;
            modalImg.alt            = card.dataset.nombre;
            modalDesc.textContent   = card.querySelector('.team-card-descripcion').textContent.trim();

            if (card.dataset.hasWhiteFlag === 'true') {
                modalImg.classList.add(...whiteFlagClasses);
            } else {
                modalImg.classList.remove(...whiteFlagClasses);
            }

            openModal();

            const equipoId = card.dataset.equipoId;
            if (equipoId) fetchPlayers(equipoId);
        });
    });

    backdrop.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('pointer-events-none')) closeModal();
    });

};
