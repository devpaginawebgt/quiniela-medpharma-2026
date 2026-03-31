import { renderMatchCard } from '../components/match-card.js';

// --- Helpers ---

const buildTeamRow = (equipo) => `
    <tr class="border-b border-complementary-light/20">
        <td class="px-4 py-3 flex items-center gap-3">
            <img src="${equipo.image}" alt="${equipo.name}" class="h-8 w-12 object-cover rounded shrink-0">
            <span class="font-semibold whitespace-nowrap">${equipo.name}</span>
        </td>
        <td class="px-2 py-3 text-center">${equipo.pj}</td>
        <td class="px-2 py-3 text-center">${equipo.pg}</td>
        <td class="px-2 py-3 text-center">${equipo.pe}</td>
        <td class="px-2 py-3 text-center">${equipo.pp}</td>
        <td class="px-2 py-3 text-center">${equipo.gf}</td>
        <td class="px-2 py-3 text-center">${equipo.gc}</td>
        <td class="px-2 py-3 text-center">${equipo.dg}</td>
        <td class="px-2 py-3 text-center font-bold">${equipo.pts}</td>
    </tr>`;

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
        <div class="mb-8">
            <h6 class="text-xl font-semibold text-center mb-4">Jornada ${jornada.value}</h6>
            <ul class="flex flex-wrap justify-center gap-4">
                ${jornada.partidos.map(renderMatchCard).join('')}
            </ul>
        </div>
    `).join('');

    const buscar = document.getElementById('buscar-partidos-grupo');
    if (buscar?.value.trim()) {
        filtrarPartidosGrupo(buscar.value.trim());
    }
};

const cargarJornadasGrupo = async (grupoId, grupoNombre) => {
    const spinner    = document.getElementById('jornadas-spinner');
    const tituloJorn = document.getElementById('titulo-jornadas-grupo');

    tituloJorn.textContent = `Jornadas de Partidos del Grupo ${grupoNombre}`;
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
            const grupoId     = this.value;
            const grupoNombre = this.options[this.selectedIndex].text;

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

            cargarJornadasGrupo(grupoId, grupoNombre);
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
                const grupoId     = selectorGrupo?.value;
                const grupoNombre = selectorGrupo?.options[selectorGrupo.selectedIndex]?.text;
                cargarJornadasGrupo(grupoId, grupoNombre);
                jornadasSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

});
