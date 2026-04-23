import { renderMatchCard } from '../components/match-card.js';

// --- Helpers ---

const buildTeamRow = (equipo) => {
    const border = equipo.hasWhiteFlag ? 'border border-zinc-300' : '';
    return `
    <tr class="border-b border-zinc-300 text-xs sm:text-base lg:text-xl">
        <td class="px-4 py-3 lg:py-4 flex items-center gap-4">
            <img
                src="${equipo.image}"
                alt="${equipo.name}"
                class="w-12 sm:w-18 lg:w-20 aspect-8/5 object-cover rounded-tr-xl rounded-bl-xl sm:rounded-tr-2xl sm:rounded-bl-2xl shrink-0 ${border}"
            >
            <span class="uppercase whitespace-nowrap">${equipo.name}</span>
        </td>
        <td class="px-2 py-3 text-center">${equipo.pj}</td>
        <td class="px-2 py-3 text-center">${equipo.pg}</td>
        <td class="px-2 py-3 text-center">${equipo.pe}</td>
        <td class="px-2 py-3 text-center">${equipo.pp}</td>
        <td class="px-2 py-3 text-center">${equipo.gf}</td>
        <td class="px-2 py-3 text-center">${equipo.gc}</td>
        <td class="px-2 py-3 text-center">${equipo.dg}</td>
        <td class="px-2 py-3 text-center border-s border-zinc-400">${equipo.pts}</td>
    </tr>`
};

// --- Jornadas ---

const filtrarPartidosGrupo = (query) => {
    const cards = document.querySelectorAll('#jornadas-partidos-list .match-card');
    const term  = query.toLowerCase().trim();
    cards.forEach(card => {
        const equipos = card.getAttribute('data-equipos') ?? '';
        card.style.display = equipos.includes(term) ? '' : 'none';
    });
};

const renderJornadasGrupo = (jornadas) => {
    const contenedor = document.getElementById('jornadas-partidos-list');

    contenedor.innerHTML = jornadas.map(jornada => `
        <div class="mb-24">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl uppercase font-brandan mb-4 lg:mb-6 text-center md:text-start">
                Jornada ${jornada.value}
            </h2>
            <div class="divide-y divide-zinc-300">
                ${jornada.partidos.map(renderMatchCard).join('')}
            </div>
        </div>
    `).join('');

    const buscar = document.getElementById('buscar-partidos-grupo');
    
    if (buscar?.value.trim()) {
        filtrarPartidosGrupo(buscar.value.trim());
    }
};

const cargarJornadasGrupo = async (grupoId) => {
    const spinner = document.getElementById('jornadas-spinner');

    spinner?.classList.remove('hidden');

    try {
        const res      = await window.axios.get(`/grupos/${grupoId}/jornadas`);
        const jornadas = res.data.data;
        renderJornadasGrupo(jornadas);
    } catch (e) {
        console.error(e);
    } finally {
        spinner?.classList.add('hidden');
    }
};

document.addEventListener('DOMContentLoaded', () => {

    // --- Group selector ---

    const selectorGrupo = document.getElementById('selector-grupo');
    const listaEquipos  = document.getElementById('equipos-grupo-list');
    const spinner       = document.getElementById('grupos-spinner');

    if (selectorGrupo) {
        selectorGrupo.addEventListener('change', async function () {
            const grupoId = this.value;

            spinner?.classList.remove('hidden');
            listaEquipos.innerHTML = '';

            try {
                const res     = await window.axios.get(`/grupos/${grupoId}/equipos`);
                const equipos = res.data.data.equipos;

                listaEquipos.innerHTML = equipos.map(buildTeamRow).join('');
            } catch (e) {
                console.error(e);
            } finally {
                spinner?.classList.add('hidden');
            }

            cargarJornadasGrupo(grupoId);
        });
    }

    // --- Search filters ---

    const buscarPartidos = document.getElementById('buscar-partidos-grupo');

    if (buscarPartidos) {
        buscarPartidos.addEventListener('input', function () {
            filtrarPartidosGrupo(this.value);
        });
    }

    // --- Ver Jornadas toggle ---

    const btnVerJornadas  = document.getElementById('btn-ver-jornadas');
    const jornadasSection = document.getElementById('jornadas-section');

    if (btnVerJornadas && jornadasSection) {
        btnVerJornadas.addEventListener('click', () => {
            const isHidden = jornadasSection.classList.toggle('hidden');

            if (!isHidden) {
                const grupoId = selectorGrupo?.value;
                cargarJornadasGrupo(grupoId);
                jornadasSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

});
