<x-app-layout>
    <section class="w-full flex flex-1 items-center justify-center px-6 py-12">
        <div class="max-w-xl w-full text-center text-light">
            <p class="font-brandan text-[8rem] sm:text-[10rem] leading-none text-secondary uppercase">
                404
            </p>

            <h1 class="font-brandan uppercase text-3xl sm:text-4xl text-dark mb-4">
                Página no encontrada
            </h1>

            <p class="text-complementary-dark mb-8 max-w-md mx-auto">
                La página que buscas no existe o fue movida.
            </p>

            <a
                href="{{ route('web.inicio') }}"
                class="inline-flex items-center justify-center gap-2 bg-secondary text-light font-bold rounded-lg px-6 py-3 hover:brightness-110 focus:ring-4 focus:ring-secondary/50"
            >
                <span class="icon-[fluent--home-24-filled] w-5 h-5"></span>
                Volver al inicio
            </a>
        </div>
    </section>
</x-app-layout>
