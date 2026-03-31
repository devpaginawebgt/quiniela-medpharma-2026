<?php

namespace App\Http\Services;

use App\Models\Brand;

class BrandService {

    public function getBrands()
    {
        return Brand::all();
    }

}