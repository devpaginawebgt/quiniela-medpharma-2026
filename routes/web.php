<?php

use App\Http\Controllers\CodigoController;
use App\Http\Controllers\EstadioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\ResultadoPartidoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

/****** RUTAS GET PARA OBTENER VISTAS DE MODULOS */

Route::middleware(['auth'])->as('web.')->group(function() {

    // Inicio
    Route::controller(HomeController::class)->group(function() {
        Route::get('inicio', 'index')->name('inicio');
    });

    Route::controller(EquipoController::class)->group(function() {
        Route::get('selecciones', 'equiposWeb')->name('selecciones');
        Route::get('selecciones/{equipo}/players', 'players')->name('selecciones.players');
    });

    Route::controller(GrupoController::class)->prefix('grupos')->group(function() {            
        Route::get('', 'gruposWeb')->name('grupos');
        Route::get('{grupo_id}/equipos', 'getEquiposWeb')->name('equipos');
        Route::get('{grupo_id}/jornadas', 'getJornadasWeb')->name('jornadas');
    });

    Route::controller(EstadioController::class)->group(function() {
        Route::get('estadios', 'estadiosWeb')->name('estadios');
    });    

    Route::controller(ResultadoPartidoController::class)->group(function() {
        Route::get('quiniela', 'quinielaWeb')->name('quiniela');
        Route::post('predicciones', 'savePrediccionesWeb')->name('save-predicciones');
    });

    Route::controller(UserController::class)->as('users')->group(function() {
        Route::get('tabla-de-resultados', 'indexWeb')->name('.tabla-de-resultados');
        Route::get('ranking-general', 'getRankingGeneral')->name('.ranking-general');
        Route::get('resultados/data', 'getResultadosData')->name('.resultados.data');
        Route::get('/perfil', 'perfil')->name('.perfil');
    });

    Route::controller(PremioController::class)->group(function() {
        Route::get('/tabla-de-premios', 'recompensas')->name('tabla-de-premios');
    });

        // Rutas solo para admins
    Route::middleware('role:admin')->prefix('admin')->as('admin.')->group(function () {

        Route::controller(ReportsController::class)->as('reports.')->group(function () {
            Route::controller(ReportsController::class)->prefix('users')->as('users.')->group(function () {
                Route::get('/', 'report')->name('index');
                Route::get('/data', 'data')->name('data');
                Route::get('/export', 'export')->name('export');
            });

            Route::controller(ReportsController::class)->prefix('predictions')->as('predictions.')->group(function () {
                Route::get('/', 'predictionsReport')->name('index');
                Route::get('/data', 'predictionsData')->name('data');
                Route::get('/export', 'predictionsExport')->name('export');
            });
        });

    });

    Route::get('/', function () {
        return redirect()->route('web.inicio');
    });

});

// Route::middleware(['guest'])->group(function() {

//     // Participantes inscritos

//     Route::controller(UserController::class)->group(function() {
//         Route::get('/participantes', 'verParticipantes')->name('ver-participantes');
//     });

// });

Route::middleware('guest')->group(function () {
    Route::post('/codigo', [CodigoController::class, 'isValid'])->name('web.code');
});

require __DIR__.'/auth.php';

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
