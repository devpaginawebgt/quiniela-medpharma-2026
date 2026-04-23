import { initMarcadorButtons } from '../components/marcador.js';
import { showToastErrors } from '../components/toast-errors.js';

initMarcadorButtons();

document.addEventListener('DOMContentLoaded', () => {

    // Logica para cambiar de jornada 
    
    const select = document.getElementById('selector-jornada');
    const formPredicciones = document.getElementById('form-quiniela');

    if (select && formPredicciones) {
        const urlQuiniela = formPredicciones.dataset.urlQuiniela;

        select.addEventListener('change', function () {
            window.location.href = urlQuiniela + "?jornada=" + this.value;
        });
    }

    // Logica para guardar predicciones via AJAX

    if (formPredicciones) {
        
        const btnSubmit = formPredicciones.querySelector('button[type="submit"]');

        const inputsMarcador = formPredicciones.querySelectorAll('.marcador-equipo');

        function setFormDisabled(disabled) {
            if (btnSubmit) {
                btnSubmit.disabled = disabled;
                btnSubmit.classList.toggle('opacity-50', disabled);
                btnSubmit.classList.toggle('pointer-events-none', disabled);
            }

            inputsMarcador.forEach(input => {
                input.disabled = disabled;
                input.classList.toggle('opacity-50', disabled);
            });
        }

        formPredicciones.addEventListener('submit', function (e) {
            e.preventDefault();

            setFormDisabled(true);

            const partidoInputs = document.querySelectorAll('.partido-jornada-quiniela');

            const predicciones = [];

            partidoInputs.forEach(function (input) {
                const parsedId = parseInt(input.value);
                const idPartido = isNaN(parsedId) ? null : parsedId;

                const inputEquipo1 = document.querySelector(`[name="prediccion_equipo1_${input.value}"]`);
                const inputEquipo2 = document.querySelector(`[name="prediccion_equipo2_${input.value}"]`);

                const rawEquipo1 = inputEquipo1 ? parseInt(inputEquipo1.value) : NaN;
                const rawEquipo2 = inputEquipo2 ? parseInt(inputEquipo2.value) : NaN;

                const prediccionEquipoUno = isNaN(rawEquipo1) ? null : rawEquipo1;
                const prediccionEquipoDos = isNaN(rawEquipo2) ? null : rawEquipo2;

                if (idPartido !== null && prediccionEquipoUno !== null && prediccionEquipoDos !== null) {
                    predicciones.push({
                        idPartido,
                        prediccionEquipoUno,
                        prediccionEquipoDos,
                    });
                }
            });

            const url = formPredicciones.dataset.urlPredicciones;

            axios.post(url, { predicciones })
                .then(response => {
                    const data = response.data.data;
                    openModalResultado(data.prediccionesProcesadas, data.prediccionesRechazadas);
                })
                .catch(error => {
                    if (error.response?.status === 422) {
                        const errors = error.response.data.errors;
                        const messages = Object.values(errors).flat();
                        showToastErrors(messages);
                        return;
                    }

                    showToastErrors(['Ocurrió un error inesperado. Intenta de nuevo.']);
                })
                .finally(() => setFormDisabled(false));
        });

        // Logica para filtrar los registros de predicciones en la vista

        // const buscar = document.getElementById('buscar-partidos');
        // const lista  = document.getElementById('partidos-jornada-general');

        // if (buscar && lista) {
        //     buscar.addEventListener('input', function () {
        //         const term = this.value.toLowerCase().trim();
        //         lista.querySelectorAll('li[data-equipos]').forEach(card => {
        //             card.style.display = (card.dataset.equipos ?? '').includes(term) ? '' : 'none';
        //         });
        //     });
        // }
    }

    // Modal resultado de predicciones

    const modal = document.getElementById('modal-resultado-predicciones');
    const backdrop = document.getElementById('modal-resultado-backdrop');
    const panel = document.getElementById('modal-resultado-panel');
    const cardsContainer = document.getElementById('modal-resultado-cards');
    const btnClose = document.getElementById('modal-resultado-close');

    function createResultCard(prediccion, tipo) {
        const isAceptada = tipo === 'aceptada';
        const badgeBg = isAceptada ? 'bg-green-600' : 'bg-red-600';
        const badgeIcon = isAceptada
            ? '<span class="icon-[fluent--checkmark-16-filled] w-5 h-5"></span>'
            : '<span class="icon-[fluent--dismiss-16-filled] w-5 h-5"></span>';
        const badgeText = isAceptada ? 'Aceptada' : 'Rechazada';

        const pred1 = prediccion.prediccionEquipoUno ?? '-';
        const pred2 = prediccion.prediccionEquipoDos ?? '-';

        const borderTeamOne = prediccion.equipoUno.hasWhiteFlag ? 'border border-zinc-300' : '';
        const borderTeamTwo = prediccion.equipoDos.hasWhiteFlag ? 'border border-zinc-300' : '';

        return `
            <div class="border-b border-zinc-200 py-5 px-2 sm:px-4 ">
                <div class="flex flex-col md:flex-row items-center md:justify-between w-full gap-3 md:gap-4 lg:gap-8 font-optimprov">
                    <!-- Equipo 1 + marcador -->
                    <div class="flex items-center justify-between w-full md:w-auto md:flex-1 md:min-w-0 gap-3">
                        <div class="flex items-center gap-3">
                            <img src="${prediccion.equipoUno.imagen}" alt="${prediccion.equipoUno.nombre}" class="w-12 md:w-14 lg:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg md:rounded-tr-xl md:rounded-bl-xl shrink-0 ${borderTeamOne}">
                            <span class="text-sm lg:text-lg uppercase">${prediccion.equipoUno.nombre}</span>
                        </div>
                        <span class="text-xl lg:text-3xl font-bold shrink-0">${pred1}</span>
                    </div>

                    <!-- VS -->
                    <span class="text-lg text-zinc-400 font-brandan shrink-0">VS</span>

                    <!-- Marcador + Equipo 2 -->
                    <div class="flex items-center justify-between flex-row-reverse md:flex-row w-full md:w-auto md:flex-1 md:min-w-0 gap-3">
                        <span class="text-xl lg:text-3xl font-bold shrink-0">${pred2}</span>
                        <div class="flex items-center flex-row-reverse md:flex-row gap-3">
                            <span class="text-sm lg:text-lg uppercase text-start md:text-end">${prediccion.equipoDos.nombre}</span>
                            <img src="${prediccion.equipoDos.imagen}" alt="${prediccion.equipoDos.nombre}" class="w-12 md:w-14 lg:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg md:rounded-tr-xl md:rounded-bl-xl shrink-0 ${borderTeamTwo}">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <p class="text-zinc-500 lg:text-lg">${prediccion.message}</p>
                    <span class="flex items-center gap-1 ${badgeBg} text-white font-semibold px-2 py-1 rounded-full shrink-0">
                        ${badgeIcon}
                        ${badgeText}
                    </span>
                </div>
            </div>`;
    }

    function openModalResultado(procesadas, rechazadas) {
        cardsContainer.innerHTML = '';

        (procesadas || []).forEach(p => {
            cardsContainer.insertAdjacentHTML('beforeend', createResultCard(p, 'aceptada'));
        });

        (rechazadas || []).forEach(p => {
            cardsContainer.insertAdjacentHTML('beforeend', createResultCard(p, 'rechazada'));
        });

        document.body.classList.add('overflow-hidden');
        modal.style.display = '';
        modal.classList.remove('pointer-events-none');

        requestAnimationFrame(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0');
        });
    }

    function closeModalResultado() {
        backdrop.classList.add('opacity-0');
        panel.classList.add('opacity-0');

        setTimeout(() => {
            modal.style.display = 'none';
            modal.classList.add('pointer-events-none');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    if (btnClose) {
        btnClose.addEventListener('click', closeModalResultado);
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeModalResultado);
    }
});
