<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\CodigoService;
use App\Http\Services\CountryService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly CodigoService $codigoService,
        private readonly CountryService $countryService,
    ) {}

    public function create(Request $request)
    {
        $country = $this->userService->getGuestCountry();

        return view('modulos.register', compact('country'));
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['puntos'] = 0;

        $data['password'] = Hash::make($data['password']);

        $result = $this->codigoService->validate($data['codigo'], $data['pais_id']);

        if (!$result['success']) {
            throw ValidationException::withMessages(['codigo' => $result['message']]);
        }

        $codigo = $result['codigo'];

        $data['codigo_id'] = $codigo->id;

        $user = User::create($data);

        $this->codigoService->markAsUsed($codigo);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}