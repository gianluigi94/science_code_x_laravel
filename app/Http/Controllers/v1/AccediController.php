<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Models\AccessoModel;
use App\Models\AutenticazioneModel;
use App\Models\ConfigurazioneModel;
use App\Models\PasswordModel;
use App\Models\SessioneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class AccediController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($utente, $hash = null)
    {
        if ($hash == null) {
            return AccediController::controllo_utente($utente);
        }
        return AccediController::controllo_password($utente, $hash);
    }


    // protected static function controllo_utente($utente)
    // {
    //     // $hashed_user = hash("sha512", trim($utente));
    //     $sale = hash("sha512", trim(Str::random(200)));

    //     if (AutenticazioneModel::esistente_utente_valido_per_login($utente)) {

    //         $auth = AutenticazioneModel::where('user', $utente)->first();

    //         $auth->secret_jwt = hash("sha512", trim(Str::random(200)));
    //         $auth->inizio_sfida = date('Y-m-d H:i:s', time());
    //         $auth->save();
    //         $record_password = PasswordModel::password_attuale($auth->id_contatto);
    //         $record_password->sale = $sale;
    //         $record_password->save();

    //         // $dati = array("sale" => $sale);
    //         // return AppHelpers::risposta_custom($dati);
    //         return AppHelpers::risposta_custom(['sale' => $sale]);
    //     } else {
    //         AccessoModel::aggiungi_tentativo_fallito(null);
    //         return AppHelpers::risposta_custom(['sale' => $sale]);
    //     }
    // }

    protected static function controllo_utente($utente)
{
    $sale = hash("sha512", trim(Str::random(200)));

    if (AutenticazioneModel::esistente_utente_valido_per_login($utente)) {

        $auth = AutenticazioneModel::where('user', $utente)->first();

        // 🔸 secret_jwt viene generato SOLO se non esiste ancora
        if (empty($auth->secret_jwt)) {
            $auth->secret_jwt = hash("sha512", trim(Str::random(200)));
        }

        // la sfida può continuare a cambiare normalmente
        $auth->inizio_sfida = date('Y-m-d H:i:s', time());
        $auth->save();

        $record_password = PasswordModel::password_attuale($auth->id_contatto);
        $record_password->sale = $sale;
        $record_password->save();

        return AppHelpers::risposta_custom(['sale' => $sale]);
    } else {
        AccessoModel::aggiungi_tentativo_fallito(null);
        return AppHelpers::risposta_custom(['sale' => $sale]);
    }
}


    //PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD

    protected static function controllo_password($utente, $hash_client)
    {

        if (AutenticazioneModel::esistente_utente_valido_per_login($utente)) {
            // esiste
            $auth = AutenticazioneModel::where('user', $utente)->first();

            $secret_jwt = $auth->secret_jwt;
            $inizio_sfida = strtotime($auth->inizio_sfida);
            $durata_sfida = ConfigurazioneModel::leggi_valore("durata_sfida");
            $max_tentativi = ConfigurazioneModel::leggi_valore("max_login_errati");
            $scadenza_sfida = $inizio_sfida + $durata_sfida;


            if (time() < $scadenza_sfida) {
                Log::info('ARRIVATO1');
                $record_password = PasswordModel::password_attuale($auth->id_contatto);

                $password = $record_password->password;
                $sale = $record_password->sale;

                $password_nascosta_db = AppHelpers::nascondi_password($password, $sale);

                // $hash_client_hash = hash("sha512", trim($hash_client));
                // $psw_sale = hash("sha512", $sale . $hash_client_hash);a

                if ($hash_client === $password_nascosta_db) {

                    $limite_pw = ConfigurazioneModel::leggi_valore("termina_psw");

                    $created_at = strtotime($record_password->created_at);

                    $scadenza_pw = $created_at + $limite_pw;

                    if (time() <= $scadenza_pw) {
                        $tentativi = AccessoModel::conta_tentativi($auth->id_contatto);

                        if ($tentativi < $max_tentativi) {

                            $resta_collegato = request()->boolean('collegato', false);
                            $tk = AppHelpers::crea_token_sessione($auth->id_contatto, $secret_jwt, $resta_collegato);
                            AccessoModel::elimina_tentativi($auth->id_contatto);

                            // crea nuova riga sessione con flag coerente
                            SessioneModel::crea_sessione($auth->id_contatto, $tk, $resta_collegato);

                            $dati = array('tk' => $tk);
                            AccessoModel::nuovo_record($auth->id_contatto, 1);
                            $record_password->blocco_password = null;
                            $record_password->save();
                            return AppHelpers::risposta_custom($dati);
                        } else {
                            $record_password->blocco_password = now();
                            $record_password->save();
                            abort(403, "ATTENZIONE: LIMITE TENTATIVI DI ACCESSO TERMINATI. RIPROVA PIU' TARDI");
                        }
                    } else {
                        AccessoModel::aggiungi_tentativo_fallito($auth->id_contatto);
                        abort(403, "ATTENZIONE: PASSWORD SCADUTA, AGGIUNTO TENTATIVO FALLITO.");
                    }
                } else {
                    AccessoModel::aggiungi_tentativo_fallito($auth->id_contatto);
                    abort(403, "ATTENZIONE: PASSWORD (o nome utente) NON TROVATA SUL DATABASE, AGGIUNTO TENTATIVO FALLITO");
                }
            } else {
                AccessoModel::aggiungi_tentativo_fallito($auth->id_contatto);
                abort(403, "ATTENZIONE: TEMPO SFIDA SCADUTO, AGGIUNTO TENTATIVO FALLITO");
            }
        } else {
            abort(403, "ATTENZIONE: PASSWORD (o nome utente) NON TROVATA SUL DATABASE, AGGIUNTO TENTATIVO FALLITO");
        }
    }





    public static function verifica_token($token)
    {
        $rit = null;
        $sessione = SessioneModel::dati_sessione($token);
        if ($sessione != null) {
            $resta = (bool) $sessione->resta_collegato;
            $inizio_sessione = strtotime($sessione->updated_at);
            $durata_sessione = (int) ConfigurazioneModel::leggi_valore($resta ? 'termina_sessione_idle' : 'durata_sessione_standard');
            $scadenza_sessione = $inizio_sessione + $durata_sessione;

            if (time() < $scadenza_sessione) {

                // limite assoluto sessione se collegato
                if ($resta) {
                    $inizio_assoluto = strtotime($sessione->created_at);
                    $max_assoluta = (int) ConfigurazioneModel::leggi_valore('termina_sessione_assoluta');
                    if (time() > ($inizio_assoluto + $max_assoluta)) {

                        SessioneModel::where('token', $token)->delete();
                        abort(403, 'ATTENZIONE:SESSIONE COLLEGATO SCADUTA (LIMITE ASSOLUTO)');
                    }
                }

                // Controllo scadenza TOKEN prima del decode
                $inizio_token_record = DB::table('autenticazioni')
                    ->where('id_contatto', $sessione->id_contatto)
                    ->first(['inizio_token']);
                if ($inizio_token_record) {
                    $inizio_token = strtotime($inizio_token_record->inizio_token);
                    $durata_token = (int) ConfigurazioneModel::leggi_valore($resta ? 'termina_tk_collegato' : 'termina_tk_standard');
                    if (time() > ($inizio_token + $durata_token)) {

                        SessioneModel::where('token', $token)->delete();
                        abort(403, 'TOKEN SCADUTO');
                    }
                }

                $auth = AutenticazioneModel::where('id_contatto', $sessione->id_contatto)->first();
                if ($auth != null) {
                    $secret_jwt = $auth->secret_jwt;
                    $payload = AppHelpers::valida_token($token, $secret_jwt, $sessione);
                    if ($payload != null) {
                        $rit = $payload;
                    } else {
                        abort(403, 'TK_0006');
                    }
                } else {
                    abort(403, 'TK_0005');
                }
            } else {

                SessioneModel::where('token', $token)->delete();
                abort(
                    403,
                    $resta
                        ? 'ATTENZIONE: SESSIONE COLLEGATA SCADUTA PER INATTIVITÀ'
                        : 'ATTENZIONE: SESSIONE STANDARD SCADUTA'
                );
            }
        } else {
            abort(403, 'ATTENZIONE:TOKEN NON VALIDO');
        }
        return $rit;
    }



    public function test($sale, $hash_password)
    {
        $psw_sale = hash("sha512", $sale . $hash_password);

        return response()->json(['psw_sale' => $psw_sale]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
