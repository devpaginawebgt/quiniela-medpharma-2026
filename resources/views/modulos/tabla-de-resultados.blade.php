<x-app-layout>
    <div class="pt-20">
        <x-main-banner/>

        {{-- Título y posición del usuario --}}
        <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
            <h1 class="text-3xl lg:text-4xl font-black">Resultados<br>de Quiniela</h1>

            <div class="flex flex-col items-end">
                <span class="text-sm font-bold text-secondary uppercase">Mi posici&oacute;n</span>
                <span class="text-5xl font-black leading-none">{{ $user_rank ?? '-' }}</span>
                <a href="#mi-posicion" class="text-sm font-semibold text-secondary hover:underline mt-1">Ver mi posici&oacute;n</a>
            </div>
        </div>

        {{-- Subtítulo --}}
        <h2 class="text-lg font-bold mb-4">Top 10 Quiniela</h2>

        {{-- Tabla de ranking --}}
        <div class="max-w-4xl mx-auto">
            <div class="relative overflow-x-auto rounded-2xl">
                <table class="w-full text-sm text-left text-light">
                    <thead class="text-xs uppercase bg-dark text-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 font-bold text-center">Posici&oacute;n</th>
                            <th scope="col" class="px-4 py-3 font-bold">Nombre</th>
                            <th scope="col" class="px-4 py-3 font-bold text-center">Puntos</th>
                        </tr>
                    </thead>
                    <tbody id="ranking-list"></tbody>
                </table>
            </div>

            {{-- Loader --}}
            <div id="ranking-loader" class="flex justify-center py-8">
                <svg class="animate-spin h-8 w-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>

            {{-- Empty state --}}
            <p id="ranking-empty" class="text-center text-complementary-light py-4 hidden">
                No hay participantes para mostrar
            </p>

            {{-- Load more (comentado por ahora) --}}
            {{--
            <div class="flex justify-center mt-4 mb-6">
                <button id="btn-cargar-mas"
                    class="hidden bg-secondary text-dark font-semibold px-6 py-2.5 rounded-full hover:bg-secondary/80 transition-colors">
                    Cargar m&aacute;s
                </button>
            </div>
            --}}
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rankingList = document.getElementById('ranking-list');
            const loader = document.getElementById('ranking-loader');
            const emptyState = document.getElementById('ranking-empty');
            // const btnCargarMas = document.getElementById('btn-cargar-mas');

            let currentPage = 1;
            let loading = false;

            function renderRows(participantes) {
                const html = participantes.map(function (p) {
                    return '<tr class="border-b border-complementary-light/20">' +
                        '<td class="px-4 py-3 text-center font-bold">' + p.posicion + '</td>' +
                        '<td class="px-4 py-3 font-semibold whitespace-nowrap">' + p.nombres.toUpperCase() + ' ' + p.apellidos.toUpperCase() + '</td>' +
                        '<td class="px-4 py-3 text-center font-bold">' + p.puntos + '</td>' +
                    '</tr>';
                }).join('');

                rankingList.insertAdjacentHTML('beforeend', html);
            }

            function fetchRanking(page) {
                if (loading) return;
                loading = true;

                loader.classList.remove('hidden');
                // btnCargarMas?.classList.add('hidden');

                axios.get('{{ route("web.users.resultados.data") }}', {
                    params: { page: page }
                })
                .then(function (response) {
                    const data = response.data.data.users;
                    const hasMore = response.data.data.has_more;

                    if (data.length === 0 && page === 1) {
                        emptyState.classList.remove('hidden');
                        return;
                    }

                    renderRows(data);

                    // if (hasMore) {
                    //     btnCargarMas?.classList.remove('hidden');
                    // }

                    currentPage = page;
                })
                .catch(function (error) {
                    console.error('Error cargando ranking:', error);
                })
                .finally(function () {
                    loading = false;
                    loader.classList.add('hidden');
                });
            }

            // btnCargarMas?.addEventListener('click', function () {
            //     fetchRanking(currentPage + 1);
            // });

            fetchRanking(1);
        });
    </script>

</x-app-layout>
