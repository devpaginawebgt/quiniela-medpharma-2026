<?php

namespace App\Http\Services;

use App\Models\Premio;
use Illuminate\Database\Eloquent\Builder;

class PremioService {

    public function getPremios($id_pais)
    {
        return Premio::where('pais_id', $id_pais)->get();
    }

}