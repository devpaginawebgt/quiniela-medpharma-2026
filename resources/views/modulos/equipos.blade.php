<x-app-layout>
    <div class="pt-16">
        <x-main-banner/>

        <section>
            <img
                src="{{ asset('/images/portadas/portada-selecciones.jpg') }}"
                alt="Quiniela"
                class="w-full"
            >
        </section>
    </div>

    {{-- Modal / Drawer Selección --}}
    <x-team-modal />

</x-app-layout>
