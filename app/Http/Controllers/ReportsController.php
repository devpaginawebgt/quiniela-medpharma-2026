<?php

namespace App\Http\Controllers;

use App\Exports\PronosticosExport;
use App\Exports\UsuariosExport;
use App\Http\Services\PrediccionService;
use App\Http\Services\ReportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    public function __construct(
        protected readonly ReportService $reportService,
        protected readonly PrediccionService $prediccionService,
    ) {}

    public function report()
    {
        return view('modulos.admin.users');
    }

    public function data()
    {
        $query = $this->reportService->getUsuarios();

        return DataTables::eloquent($query)
            ->addColumn('nombre_completo', fn($u) => $u->nombres . ' ' . $u->apellidos)
            ->addColumn('numero_documento', fn($u) => $u->numero_documento ?? 'N/A')
            ->addColumn('email', fn($u) => $u->email ?? 'N/A')
            ->addColumn('pais', fn($u) => $u->country?->name ?? 'N/A')
            ->addColumn('puntos', fn($u) => $u->puntos ?? '0')
            ->addColumn('fecha_registro', fn($u) => $u->created_at->timezone('America/Guatemala')->format('d/m/Y h:i A'))
            ->addColumn('estado_badge', function ($u) {
                if ($u->status_user) {
                    return '
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-xs font-medium rounded-full border bg-green-100 text-green-700 border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Activo
                        </span>
                    ';
                }

                return '
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-xs font-medium rounded-full border bg-red-100 text-red-700 border-red-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                        Inactivo
                    </span>
                ';
            })
            ->filterColumn('nombre_completo', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nombres', 'like', "%{$keyword}%")
                        ->orWhere('apellidos', 'like', "%{$keyword}%")
                        ->orWhereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ["%{$keyword}%"]);
                });
            })
            ->filterColumn('pais', function ($query, $keyword) {
                $query->whereHas('country', fn($q) => $q->where('name', 'like', "%{$keyword}%"));
            })
            ->rawColumns(['estado_badge'])
            ->make(true);
    }

    public function export(Request $request)
    {
        $search = (string) ($request->get('search') ?? '');

        $fileName = 'usuarios_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new UsuariosExport($search), $fileName);
    }

    public function predictionsReport()
    {
        return view('modulos.admin.predictions');
    }

    public function predictionsData()
    {
        $query = $this->reportService->getPronosticos();

        return DataTables::eloquent($query)
            ->addColumn('usuario', fn($p) => $p->user->nombres . ' ' . $p->user->apellidos)
            ->addColumn('email', fn($p) => $p->user->email)
            ->addColumn('telefono', fn($p) => $p->user->telefono)
            ->addColumn('numero_documento', fn($p) => $p->user->numero_documento ?? 'N/A')
            ->addColumn('pais', fn($p) => $p->user->country?->name ?? 'N/A')            
            ->addColumn('partido', function ($p) {
                $equipos = $p->partido?->equipos;
                if (!$equipos) return 'N/A';
                $e1 = $equipos->equipoUno?->nombre ?? '?';
                $e2 = $equipos->equipoDos?->nombre ?? '?';
                return "{$e1} VS {$e2}";
            })
            ->addColumn('jornada', fn($p) => $p->partido?->jornada ? 'Jornada ' . $p->partido->jornada->name : 'N/A')
            ->addColumn('fecha_partido', fn($p) => $p->partido?->fecha_partido?->timezone('America/Guatemala')->format('d/m/Y h:i A') ?? 'N/A')
            ->addColumn('fecha_registro', fn($p) => $p->created_at->timezone('America/Guatemala')->format('d/m/Y h:i A'))
            ->addColumn('fecha_actualizacion', fn($p) => $p->updated_at->timezone('America/Guatemala')->format('d/m/Y h:i A'))
            ->addColumn('pronostico', fn($p) => $p->goles_equipo_1 . ' - ' . $p->goles_equipo_2)
            ->addColumn('resultado_real', function ($p) {
                $r = $p->resultado;
                if (!$r) return '<span class="text-gray-600 text-sm">Sin resultado</span>';
                return $r->goles_equipo_1 . ' - ' . $r->goles_equipo_2;
            })
            ->addColumn('puntos_badge', function ($p) {
                $pts = $this->prediccionService->getResultadoPrediccion($p, $p->resultado, $p->partido?->puntos);
                $color = match ($pts) {
                    5 => 'bg-green-100 text-green-700 border-green-200',
                    4 => 'bg-green-100 text-green-700 border-green-200',
                    2 => 'bg-blue-100 text-blue-700 border-blue-200',
                    1 => 'bg-blue-100 text-blue-700 border-blue-200',
                    0 => 'bg-gray-100 text-gray-500 border-gray-200',
                    default => 'bg-green-100 text-green-700 border-green-200',
                };
                return "
                    <span class=\"inline-flex items-center justify-center px-2.5 py-0.5 text-xs font-bold rounded-full border {$color}\">
                        {$pts} pts
                    </span>
                ";
            })
            ->addColumn('estado_badge', function ($p) {
                if ($p->status === 1) {
                    return '
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-xs font-medium rounded-full border bg-green-100 text-green-700 border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Puntos acreditados
                        </span>
                    ';
                }
                return '
                   <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-xs font-medium rounded-full border bg-red-100 text-red-700 border-red-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        Pendiente de procesar
                    </span>
                ';
            })
            ->filterColumn('usuario', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('nombres', 'like', "%{$keyword}%")
                        ->orWhere('apellidos', 'like', "%{$keyword}%")
                        ->orWhereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ["%{$keyword}%"]);
                });
            })
            ->filterColumn('email', function ($query, $keyword) {
                $query->whereHas('user', fn($q) => $q->where('email', 'like', "%{$keyword}%"));
            })
            ->filterColumn('pais', function ($query, $keyword) {
                $query->whereHas('user.country', fn($q) => $q->where('name', 'like', "%{$keyword}%"));
            })
            ->filterColumn('jornada', function ($query, $keyword) {
                $query->whereHas('partido.jornada', fn($q) => $q->where('name', 'like', "%{$keyword}%"));
            })
            ->rawColumns(['resultado_real', 'puntos_badge', 'estado_badge'])
            ->make(true);
    }

    public function predictionsExport(Request $request)
    {
        $search = (string) ($request->get('search') ?? '');

        $fileName = 'pronosticos_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new PronosticosExport($search), $fileName);
    }
}
