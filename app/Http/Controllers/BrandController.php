<?php

namespace App\Http\Controllers;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Services\BrandService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly BrandService $brandService
    ) {}

    // public function index(Request $request)
    // {
    //     $brands = $this->brandService->getBrands();

    //     $brands = BrandResource::collection($brands);

    //     return $this->successResponse($brands);
    // }
}
