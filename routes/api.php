<?php

use App\Http\Controllers\v1\TraduzioniController;
use App\Http\Controllers\v1\AbilitaController;
use App\Http\Controllers\v1\AccediController;
use App\Http\Controllers\v1\AccessoController;
use App\Http\Controllers\v1\AliquotaController;
use App\Http\Controllers\v1\CategoriaController;
use App\Http\Controllers\v1\CategoriaSerieController;
use App\Http\Controllers\v1\CategoriaTraduzioneController;
use App\Http\Controllers\v1\ComuneController;
use App\Http\Controllers\v1\ConfigurazioneController;
use App\Http\Controllers\v1\ContattoController;
use App\Http\Controllers\v1\EpisodioController;
use App\Http\Controllers\v1\EpisodioTraduzioneController;
use App\Http\Controllers\v1\FilmController;
use App\Http\Controllers\v1\FilmTraduzioneController;
use App\Http\Controllers\v1\IndirizzoController;
use App\Http\Controllers\v1\LinguaController;
use App\Http\Controllers\v1\NazioneController;
use App\Http\Controllers\v1\RecapitoController;
use App\Http\Controllers\v1\RegistaController;
use App\Http\Controllers\v1\RuoloController;
use App\Http\Controllers\v1\SerieController;
use App\Http\Controllers\v1\SerieTraduzioneController;
use App\Http\Controllers\v1\SessioneController;
use App\Http\Controllers\v1\StagioneController;
use App\Http\Controllers\v1\StatoUtenteController;
use App\Http\Controllers\v1\StreamingFileController;
use App\Http\Controllers\v1\TassoCambioController;
use App\Http\Controllers\v1\TipoIndirizzoController;
use App\Http\Controllers\v1\TipoRecapitoController;
use App\Http\Controllers\v1\TraduzioneController;
use App\Http\Controllers\v1\TraduzioneCustomController;
use App\Http\Controllers\v1\ValutaController;
use App\Http\Controllers\v1\VTraduzioneEffettivaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\LogoutController;
use App\Http\Controllers\v1\VnovitaController;

if (!defined('_VERS')) {
    define('_VERS', 'v1');
}

$RUOLI_UTENTI = '/^utente_.+$/';
$RUOLI_ADMIN  = '/^amministratore_.+$/';

Route::get(_VERS . '/test/{sale}/{hash_password}', [AccediController::class, 'test']);
Route::get(_VERS . '/accedi/{utente}/{hash?}', [AccediController::class, 'show']);
Route::post(_VERS . '/registrazione', [ContattoController::class, 'registrazione']);

Route::get(_VERS . "/tipi-recapiti", [TipoRecapitoController::class, 'index']);
Route::get(_VERS . "/tipi-recapiti/{tipo}", [TipoRecapitoController::class, 'show']);
Route::get(_VERS . "/nazioni", [NazioneController::class, 'index']);
Route::get(_VERS . "/nazioni/{nazione}", [NazioneController::class, 'show']);
Route::get(_VERS . "/comuni", [ComuneController::class, 'index']);
Route::get(_VERS . "/comuni/{comune}", [ComuneController::class, 'show']);
Route::get(_VERS . "/tipi-indirizzi", [TipoIndirizzoController::class, 'index']);
Route::get(_VERS . "/tipi-indirizzi/{tipoindirizzo}", [TipoIndirizzoController::class, 'show']);
Route::get(_VERS . "/lingue", [LinguaController::class, 'index']);
Route::get(_VERS . "/lingue/{lingua}", [LinguaController::class, 'show']);
Route::get(_VERS . "/traduzioni", [TraduzioneController::class, 'index']);
Route::get(_VERS . "/traduzioni/{traduzione}", [TraduzioneController::class, 'show']);
Route::get(_VERS . "/traduzioni-custom", [TraduzioneCustomController::class, 'index']);
Route::get(_VERS . "/traduzioni-custom/{traduzionecustom}", [TraduzioneCustomController::class, 'show']);
Route::get(_VERS . "/traduzioni-effettive", [VTraduzioneEffettivaController::class, 'index']);
Route::get(_VERS . "/traduzioni-effettive/{traduzioneeffettiva}", [VTraduzioneEffettivaController::class, 'show']);
Route::get(_VERS . "/categorie", [CategoriaController::class, 'index']);
Route::get(_VERS . "/categorie/{categoria}", [CategoriaController::class, 'show']);
Route::get(_VERS . "/categorie-traduzioni", [CategoriaTraduzioneController::class, 'index']);
Route::get(_VERS . "/categorie-traduzioni/{categoriatraduzione}", [CategoriaTraduzioneController::class, 'show']);
Route::get(_VERS . "/registi", [RegistaController::class, 'index']);
Route::get(_VERS . "/registi/{regista}", [RegistaController::class, 'show']);
Route::get(_VERS . "/aliquote", [AliquotaController::class, 'index']);
Route::get(_VERS . "/aliquote/{aliquota}", [AliquotaController::class, 'show']);
Route::get(_VERS . "/valute", [ValutaController::class, 'index']);
Route::get(_VERS . "/valute/{valuta}", [ValutaController::class, 'show']);
Route::get(_VERS . "/tassi-cambio", [TassoCambioController::class, 'index']);
Route::get(_VERS . "/tassi-cambio/{tassocambio}", [TassoCambioController::class, 'show']);
Route::get(_VERS . '/traduzioni-lingua/{codiceLingua}', [TraduzioniController::class, 'perLingua']);
Route::get(_VERS . '/logout', LogoutController::class);



Route::middleware(['autenticazione', "contatto_ruolo:$RUOLI_UTENTI,$RUOLI_ADMIN"])->group(function () {
    Route::get(_VERS . '/novita', [VnovitaController::class, 'index']);
    Route::get(_VERS . '/novita/{indice}', [VnovitaController::class, 'show']);
    Route::get(_VERS . "/categoria-serie", [CategoriaSerieController::class, 'index']);
    Route::get(_VERS . "/categoria-serie/{categoriaserie}", [CategoriaSerieController::class, 'show']);
    Route::get(_VERS . "/streaming-file", [StreamingFileController::class, 'index']);
    Route::get(_VERS . "/streaming-file/{streamingfile}", [StreamingFileController::class, 'show']);
    Route::get(_VERS . "/serie", [SerieController::class, 'index']);
    Route::get(_VERS . "/serie/{serie}", [SerieController::class, 'show']);
    Route::get(_VERS . "/serie-traduzioni", [SerieTraduzioneController::class, 'index']);
    Route::get(_VERS . "/serie-traduzioni/{serietraduzione}", [SerieTraduzioneController::class, 'show']);
    Route::get(_VERS . "/stagioni", [StagioneController::class, 'index']);
    Route::get(_VERS . "/stagioni/{stagione}", [StagioneController::class, 'show']);
    Route::get(_VERS . "/episodi", [EpisodioController::class, 'index']);
    Route::get(_VERS . "/episodi/{episodio}", [EpisodioController::class, 'show']);
    Route::get(_VERS . "/episodi-traduzioni", [EpisodioTraduzioneController::class, 'index']);
    Route::get(_VERS . "/episodi-traduzioni/{episodiotraduzione}", [EpisodioTraduzioneController::class, 'show']);
    Route::get(_VERS . "/film", [FilmController::class, 'index']);
    Route::get(_VERS . "/film/{film}", [FilmController::class, 'show']);
    Route::get(_VERS . "/film-traduzioni", [FilmTraduzioneController::class, 'index']);
    Route::get(_VERS . "/film-traduzioni/{filmtraduzione}", [FilmTraduzioneController::class, 'show']);


    Route::get(_VERS . "/recapiti/{recapito}", [RecapitoController::class, 'show']); // u +
    Route::get(_VERS . "/contatti/{contatto}", [ContattoController::class, 'show']); // u +
    Route::get(_VERS . "/indirizzi/{indirizzo}", [IndirizzoController::class, 'show']);
});



Route::middleware(['autenticazione', 'contatto_ruolo:amministratore_principale'])->group(function () {

    Route::get(_VERS . "/contatti", [ContattoController::class, 'index']);
    Route::get(_VERS . "/recapiti", [RecapitoController::class, 'index']);
    Route::get(_VERS . "/indirizzi", [IndirizzoController::class, 'index']);
    Route::get(_VERS . "/accessi", [AccessoController::class, 'index']);
    Route::get(_VERS . "/accessi/{accesso}", [AccessoController::class, 'show']);
    Route::get(_VERS . "/sessioni", [SessioneController::class, 'index']);
    Route::get(_VERS . "/sessioni/{sessione}", [SessioneController::class, 'show']);
    Route::get(_VERS . "/stati-utenti", [StatoUtenteController::class, 'index']);
    Route::get(_VERS . "/stati-utenti/{statoutente}", [StatoUtenteController::class, 'show']);
    Route::get(_VERS . "/ruoli", [RuoloController::class, 'index']);
    Route::get(_VERS . "/ruoli/{ruolo}", [RuoloController::class, 'show']);
    Route::get(_VERS . "/abilita", [AbilitaController::class, 'index']);
    Route::get(_VERS . "/abilita/{abilita}", [AbilitaController::class, 'show']);
    Route::get(_VERS . "/configurazioni", [ConfigurazioneController::class, 'index']);
    Route::get(_VERS . "/configurazioni/{configurazione}", [ConfigurazioneController::class, 'show']);
});
