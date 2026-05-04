<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsuariosExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading
{
    public function __construct(
        protected string $search = ''
    ) {}

    public function query()
    {
        return User::with(['country'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nombres', 'like', "%{$this->search}%")
                        ->orWhere('apellidos', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ["%{$this->search}%"])
                        ->orWhereHas('country', fn($country) => $country->where('name', 'like', "%{$this->search}%"));
                });
            })
            ->orderBy('puntos', 'desc');
    }


    public function chunkSize(): int
    {
        return 1000;
    }


    public function headings(): array
    {
        return [
            '#',
            'Nombres',
            'Apellidos',
            'No. Documento',
            'Correo Electrónico',
            'Teléfono',
            'País',
            'Puntos Total',
            'Fecha Registro',
            'Estado',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->nombres,
            $user->apellidos,
            $user->numero_documento ?? 'N/A',
            $user->email,
            $user->telefono ?? 'N/A',
            $user->country?->name ?? 'N/A',
            $user->puntos,
            $user->created_at->timezone('America/Guatemala')->format('d/m/Y H:i'),
            $user->status_user ? 'Activo' : 'Inactivo',
        ];
    }
}
