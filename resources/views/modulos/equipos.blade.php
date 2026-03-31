<x-app-layout>
    <div>
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
