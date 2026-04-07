<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserRankingResource;
use App\Http\Resources\User\UserRankResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly UserService $userService,
    ) {}

    // Funciones para la web

    public function indexWeb()
    {
        $user = Auth::user();
        $user = $this->userService->getUserRank($user);

        $top10 = $this->userService->getTop10((int) $user->pais_id);

        return view('modulos.tabla-de-resultados', [
            'user_rank' => $user->posicion,
            'top10'     => $top10,
        ]);
    }

    public function getRankingGeneral()
    {
        $user = Auth::user();
        $user = $this->userService->getUserRank($user);

        return view('modulos.ranking-general', [
            'user_rank' => $user->posicion,
        ]);
    }

    /**
     * Devuelve los datos paginados del ranking vía JSON.
     */
    public function getResultadosData(Request $request)
    {
        $user = Auth::user();
        $id_pais = (int) $user->pais_id;
        $perPage = (int) $request->query('perPage', 100);

        $result = $this->userService->getRankingWeb($id_pais, $perPage);

        return $this->successResponse([
            'has_more' => $result->hasMorePages(),
            'current_page' => $result->currentPage(),
            'next_page' => $result->hasMorePages() ? $result->currentPage() + 1 : null,
            'users' => UserRankingResource::collection($result->items()),
        ]);
    }

    // public function perfil()
    // {
    //     $user = Auth::user();

    //     $user = $this->userService->getUserRank($user);
    //     $user = $this->userService->getUserPredictionsCount($user);

    //     return view('modulos.perfil', [
    //         'user' => $user,
    //     ]);
    // }

    // public function verParticipantes()
    // {

    //     $participantes = $this->userService->getUsers();

    //     return view('modulos.participantes', [
    //         'participantes' => $participantes
    //     ]);

    // }

    // API responses

    // public function getUsers()
    // {

    //     $participantes = $this->userService->getUsers();

    //     $participantes = UserResource::collection($participantes);

    //     return $this->successResponse($participantes);

    // }

    // public function getUser(Request $request)
    // {
    //     $user = $request->user();

    //     $user = $this->userService->getUserRank($user);

    //     $user = $this->userService->getUserPredictionsCount($user);

    //     $user = new UserRankResource($user);

    //     return $this->successResponse($user);

    // }

    // public function getUserRank(Request $request)
    // {
    //     $user = $request->user();

    //     $user = $this->userService->getUserRank($user);

    //     $user = $this->userService->getUserPredictionsCount($user);

    //     $user = new UserRankResource($user);

    //     return $this->successResponse($user);

    // }

    // public function getRanking(Request $request)
    // {
    //     $user = $request->user();

    //     $id_pais = (int) $user->pais_id;

    //     $users = $this->userService->getRanking($id_pais);

    //     $users = $this->userService->setUserBrands($users, $id_pais);

    //     $participantes = UserRankingResource::collection($users);

    //     return $this->successResponse($participantes);

    // }

    // public function getRanking(Request $request)
    // {
    //     $user = $request->user();
    //     $id_pais = (int) $user->pais_id;
    //     $perPage = (int) $request->query('perPage', 100);

    //     $result = $this->userService->getRanking($id_pais, $perPage);

    //     $items = collect($result->items());

    //     if ($result->currentPage() === 1) {
    //         $items = $this->userService->setUserBrands($items, $id_pais);
    //     }

    //     return $this->successResponse([
    //         'has_more' => $result->hasMorePages(),
    //         'current_page' => $result->currentPage(),
    //         'next_page' => $result->hasMorePages() ? $result->currentPage() + 1 : null,
    //         'users' => UserRankingResource::collection($items),
    //     ]);
    // }
}
