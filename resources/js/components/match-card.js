const formatFecha = (fechaStr) => {
    const fecha = new Date(fechaStr);
    const dia = fecha.toLocaleDateString('es', { weekday: 'long' });
    const num = fecha.getDate();
    const mes = fecha.toLocaleDateString('es', { month: 'long' });
    const capitalize = (s) => s.charAt(0).toUpperCase() + s.slice(1);
    return `${capitalize(dia)} ${num} de ${mes}`;
};

const formatHora = (fechaStr) => {
    const fecha = new Date(fechaStr);
    return fecha.toLocaleTimeString('es-GT', { hour: 'numeric', minute: '2-digit', hour12: true }).toUpperCase();
};

export const renderMatchCard = (partido) => {
    const equipos = `${partido.equipoUno.nombre} ${partido.equipoDos.nombre}`.toLowerCase();
    const borderTeamOne = partido.equipoUno.hasWhiteFlag ? 'border border-zinc-300' : '';
    const borderTeamTwo = partido.equipoDos.hasWhiteFlag ? 'border border-zinc-300' : '';

    return `<div
        class="match-card flex flex-col sm:flex-row items-center justify-between gap-8 sm:gap-12 py-12 sm:py-6 px-2 sm:px-4 font-optimprov"
        data-equipos="${equipos}"
    >
        <div class="flex items-center gap-3 flex-1 justify-start min-w-0">
            <img
                src="${partido.equipoUno.imagen}"
                alt="${partido.equipoUno.nombre}"
                class="w-18 sm:w-12 md:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg sm:rounded-tr-xl sm:rounded-bl-xl shrink-0 ${borderTeamOne}"
            >
            <span class="text-base sm:text-sm md:text-base lg:text-lg uppercase">${partido.equipoUno.nombre}</span>
        </div>

        <div class="flex flex-row sm:flex-col gap-2 sm:gap-0 items-center shrink-0 text-center px-2 text-xl sm:text-md md:text-xl lg:text-2xl font-brandan">
            <span>${formatFecha(partido.fechaPartido)}</span>
            <span>${formatHora(partido.fechaPartido)}</span>
        </div>

        <div class="flex items-center flex-row-reverse sm:flex-row gap-3 flex-1 justify-end min-w-0">
            <span class="text-base sm:text-sm lg:text-lg uppercase sm:text-end">${partido.equipoDos.nombre}</span>
            <img
                src="${partido.equipoDos.imagen}"
                alt="${partido.equipoDos.nombre}"
                class="w-18 sm:w-12 md:w-18 lg:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg sm:rounded-tr-xl sm:rounded-bl-xl shrink-0 ${borderTeamTwo}"
            >
        </div>
    </div>`;
};
