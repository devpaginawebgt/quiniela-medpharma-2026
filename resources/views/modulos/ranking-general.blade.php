<x-app-layout>
    <div class="flex flex-col flex-1">
        <x-main-banner/>

        <div class="relative flex-1">
            {{-- Background image --}}
            <img
                src="{{ asset('images/portadas/portada_shared_sm.jpg') }}"
                alt=""
                class="absolute inset-0 w-full h-full object-cover"
            >
            {{-- White overlay --}}
            <div class="absolute inset-0 bg-white mx-4 lg:mx-8 mb-4 lg:mb-8"></div>

            <div class="relative px-6 md:px-8 lg:px-12 pb-16 pt-8 mx-auto" style="max-width: min(84rem, calc(100vw - 2rem));">

            {{-- Titulo y posicion del usuario --}}
            <div class="flex flex-col md:flex-row justify-center items-center md:items-start gap-4 lg:gap-8 2xl:gap-12 mx-auto mb-8 lg:mb-12">
                <h1 class="text-center md:text-start text-5xl sm:text-7xl lg:text-8xl uppercase font-brandan">
                    Resultados de quiniela
                </h1>

                <div class="flex flex-col items-center md:items-end shrink-0 my-6 md:my-0">
                    <span class="text-4xl font-brandan text-zinc-400 uppercase">
                        Mi posici&oacute;n
                    </span>
                    <span class="text-8xl lg:text-9xl font-black leading-none my-2 md:my-0" data-user-rank="{{ $user_rank ?? '' }}">
                        {{ $user_rank ?? '-' }}
                    </span>
                    <a href="{{ route('web.users.tabla-de-resultados') }}" class="text-3xl font-brandan text-fuchsia-800">
                        Ver top 10
                    </a>
                </div>
            </div>

            {{-- Subtitulo --}}
            <h2 class="text-2xl sm:text-3xl lg:text-4xl uppercase font-brandan mb-2 mx-auto">
                Mi Posición
            </h2>

            {{-- Tabla de ranking con scroll interno --}}
            <div
                id="ranking-scroll-container"
                class="mx-auto rounded-t-3xl overflow-y-auto overflow-x-auto"
                style="max-width: min(84rem, calc(100vw - 2rem)); max-height: 70vh;"
            >
                <table class="w-full text-left text-dark">
                    <thead class="uppercase bg-dark text-light sticky top-0 z-10">
                        <tr class="font-optimprov text-sm sm:text-lg lg:text-2xl">
                            <th scope="col" class="px-4 py-3 text-center font-bold">Posici&oacute;n</th>
                            <th scope="col" class="px-4 py-3 font-bold">Nombre</th>
                            <th scope="col" class="px-4 py-3 text-center font-bold">Puntos</th>
                        </tr>
                    </thead>
                    <tbody id="ranking-body">
                    </tbody>
                </table>

                {{-- Loader --}}
                <div
                    id="ranking-loader"
                    class="flex justify-center items-center py-8"
                >
                    <div role="status">
                        <svg aria-hidden="true" class="w-8 h-8 custom-animate-spin text-complementary-light fill-secondary" viewBox="0 0 100 101" fill="none">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>

                {{-- Mensaje vacío --}}
                <p id="ranking-empty" class="hidden text-center text-zinc-400 py-20 text-lg sm:text-xl lg:text-2xl font-brandan uppercase">
                    No hay participantes para mostrar
                </p>

                {{-- Botón cargar más --}}
                <div class="hidden" id="load-more-container">
                    <button
                        id="load-more-btn"
                        class="w-full py-4 bg-dark text-light font-brandan text-xl uppercase hover:bg-zinc-600 transition-colors cursor-pointer rounded-b-3xl"
                    >
                        Cargar m&aacute;s
                    </button>
                </div>
            </div>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const userRankEl = document.querySelector('[data-user-rank]');
        const userRankValue = userRankEl ? userRankEl.dataset.userRank : '';
        const userRank = userRankValue !== '' ? parseInt(userRankValue) : null;
        const dataUrl = "{{ route('web.users.resultados.data') }}";
        const scrollContainer = document.getElementById('ranking-scroll-container');
        const tbody = document.getElementById('ranking-body');
        const loader = document.getElementById('ranking-loader');
        const loadMoreContainer = document.getElementById('load-more-container');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const emptyMessage = document.getElementById('ranking-empty');

        let nextPage = 1;
        let hasMore = true;
        let isLoading = false;
        let userFound = false;

        function createRow(user) {
            const tr = document.createElement('tr');
            tr.setAttribute('data-position', user.posicion);
            tr.className = 'border-b border-zinc-300 text-lg sm:text-2xl lg:text-3xl font-brandan';

            tr.innerHTML =
                '<td class="px-4 py-3 lg:py-4 text-center">' + user.posicion + '</td>' +
                '<td class="px-4 py-3 lg:py-4 uppercase whitespace-nowrap">' + user.nombres + ' ' + user.apellidos + '</td>' +
                '<td class="px-4 py-3 lg:py-4 text-center">' + user.puntos + '</td>';

            return tr;
        }

        function highlightUserRow() {
            if (userRank === null) return false;

            const row = tbody.querySelector('tr[data-position="' + userRank + '"]');
            if (row) {
                row.classList.add('bg-secondary');
                row.classList.add('text-light');
                userFound = true;

                setTimeout(function () {
                    const containerTop = scrollContainer.getBoundingClientRect().top;
                    const rowTop = row.getBoundingClientRect().top;
                    const offset = rowTop - containerTop - (scrollContainer.clientHeight / 2);
                    scrollContainer.scrollTo({ top: scrollContainer.scrollTop + offset, behavior: 'smooth' });
                }, 100);

                return true;
            }
            return false;
        }

        function showLoadMore() {
            if (hasMore) loadMoreContainer.classList.remove('hidden');
            loader.classList.add('hidden');
        }

        function hideLoadMore() {
            loadMoreContainer.classList.add('hidden');
        }

        async function fetchPage(page) {
            if (isLoading || !hasMore) return;
            isLoading = true;
            loader.classList.remove('hidden');
            hideLoadMore();

            try {
                const response = await axios.get(dataUrl, {
                    params: { perPage: 400, page: page }
                });

                const data = response.data.data;
                hasMore = data.has_more;
                nextPage = data.next_page;

                if (data.users.length === 0 && page === 1) {
                    emptyMessage.classList.remove('hidden');
                    loader.classList.add('hidden');
                    isLoading = false;
                    return;
                }

                data.users.forEach(function (user) {
                    tbody.appendChild(createRow(user));
                });

                // Verificar si la posición del usuario está en el listado
                if (userRank !== null && !userFound) {
                    const found = highlightUserRow();

                    // Si no se encontró y hay más páginas, seguir cargando
                    if (!found && hasMore) {
                        isLoading = false;
                        fetchPage(nextPage);
                        return;
                    }
                }

                // Mostrar botón o ocultar loader
                if (hasMore) {
                    showLoadMore();
                } else {
                    loader.classList.add('hidden');
                    hideLoadMore();
                }
            } catch (error) {
                console.error('Error al cargar ranking:', error);
                loader.classList.add('hidden');
            }

            isLoading = false;
        }

        loadMoreBtn.addEventListener('click', function () {
            if (nextPage && hasMore) fetchPage(nextPage);
        });

        // Botón "Ver mi posición" — scroll a la fila del usuario
        const scrollToUserBtn = document.getElementById('scroll-to-user-btn');

        if (scrollToUserBtn) {
            scrollToUserBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (userRank === null) return;
    
                const row = tbody.querySelector('tr[data-position="' + userRank + '"]');
                if (row) {
                    const containerTop = scrollContainer.getBoundingClientRect().top;
                    const rowTop = row.getBoundingClientRect().top;
                    const offset = rowTop - containerTop - (scrollContainer.clientHeight / 2);
                    scrollContainer.scrollTo({ top: scrollContainer.scrollTop + offset, behavior: 'smooth' });
                }
            });
        }

        // Cargar primera página
        fetchPage(1);
    });
    </script>
</x-app-layout>
