<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\CodigoService;
use App\Http\Services\CountryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly CountryService $countryService,
        private readonly CodigoService $codigoService,
    ) {}

    public function create(Request $request)
    {
        $ip = $request->ip();

        $country_code = 'GT';

        try {
            $response = Http::timeout(3)->get("http://api.ipinfo.io/lite/{$ip}", [
                'token' => config('services.geolocation.key'),
            ]);

            if ($response->ok() && !empty($response->json('country_code'))) {
                $country_code = $response->json('country_code');
            }
        } catch (\Exception $e) {
            // fallback silencioso
        }

        $country = $this->countryService->getCountryByCode($country_code)
            ?? $this->countryService->getCountryByCode('GT');

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