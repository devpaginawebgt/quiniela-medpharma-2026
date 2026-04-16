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

    Route::get('/', function () {
        return redirect()->route('web.inicio');
    });

});

// Route::controller(JornadaController::class)->group(function() {
    //     Route::get('calendario', 'calendarioWeb')->name('calendario');
    //     Route::post('/partidos-grupo', 'partidosGrupo');
    //     Route::get('/partidos-jornada/{jornada}', 'partidosJornada');
    // });

// Route::middleware(['guest'])->group(function() {

//     // Participantes inscritos

//     Route::controller(UserController::class)->group(function() {
//         Route::get('/participantes', 'verParticipantes')->name('ver-participantes');
//     });

// });

// Los metodos post se cambiaron a put porque el servidor donde se alojara la aplicacion no permite post


// Embed (público, sin auth — para Flutter WebView)

Route::post('/codigo', [CodigoController::class, 'isValid'])->name('web.code');

Route::get('/embed/bracket', fn() => view('embed.bracket'))->name('embed.bracket');

require __DIR__.'/auth.php';
