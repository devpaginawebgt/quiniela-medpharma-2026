<ul class="space-y-1">
    @can('admin.ver-reportes')
    <li>
        <a href="{{ route('web.admin.reports.users.index') }}"
            @class([ 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors' , 'text-dark bg-light font-semibold'=> request()->routeIs('web.admin.reports.users.*'),
            'hover:bg-light hover:text-dark' => ! request()->routeIs('web.admin.reports.users.*'),
            ])>
            <span class="icon-[fluent--people-16-filled] w-5 h-5"></span>
            <span>Usuarios Registrados</span>
        </a>
    </li>
    <li>
        <a href="{{ route('web.admin.reports.predictions.index') }}"
            @class([ 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors' , 'text-dark bg-light font-semibold'=> request()->routeIs('web.admin.reports.predictions.*'),
            'hover:bg-light hover:text-dark' => ! request()->routeIs('web.admin.reports.predictions.*'),
            ])>
            <span class="icon-[fluent--calendar-checkmark-center-16-filled] w-5 h-5"></span>
            <span>Pronósticos Registrados</span>
        </a>
    </li>
    @endcan
</ul>