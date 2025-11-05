<?php

namespace App\Helpers;

use App\Models\AutenticazioneModel;
use App\Models\ConfigurazioneModel;
use App\Models\ContattoModel;
use App\Models\SessioneModel;
use Illuminate\Support\Arr;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;

class AppHelpers
{
    public static function aggiorna_regole_helpers($rules)
    {
        $new_rules = Arr::map($rules, function ($value, $key) {
            return str_replace("required|", "", $value);
        });

        return  $new_rules;
    }

    public static function risposta_custom($dati, $msg = null, $err = null)
    {
        $response = array();
        $response["data"] = $dati;
        if ($msg != null) $response["message"] = $msg;
        if ($err != null) $response["error"] = $err;
        return $response;
    }

    public static function nascondi_password($password, $sale)
    {
        return hash("sha512", $sale . $password);
    }




    public static function crea_token_sessione($id_contatto, $secret_jwt, $resta_collegato = false, $usa_da = null, $scade = null)
    {
        $max_time = (int) ConfigurazioneModel::leggi_valore($resta_collegato ? 'termina_tk_collegato' : 'termina_tk_standard');
        $record_contatto = ContattoModel::where('id_contatto', $id_contatto)->first();
        $t = time();
        $nbf = ($usa_da == null) ? $t : $usa_da;
        $exp = ($scade == null) ? $nbf + $max_time : $scade;
        $ruolo = $record_contatto->ruoli[0];
        $id_ruolo = $ruolo->id_ruolo;
        $abilita = $ruolo->abilita->toArray();
        $abilita = array_map(function ($arr) {
            return $arr['id_abilita'];
        }, $abilita);

        $arr = array(
            'iss' => 'https://www.codex.it',
            'aud' => null,
            'iat' => $t,
            'nbf' => $nbf,
            'exp' => $exp,
            'data' => array(
                'id_contatto' => $id_contatto,
                'id_stato_utente' => $record_contatto->id_stato_utente,
                'id_ruolo' => $id_ruolo,
                'abilita' => $abilita,
                'nome' => trim($record_contatto->nome . " " . $record_contatto->cognome)
            )
        );

        $token = JWT::encode($arr, $secret_jwt, 'HS256');

        $now = date('Y-m-d H:i:s');
        DB::table('autenticazioni')
            ->where('id_contatto', $id_contatto)
            ->update(['inizio_token' => $now]);


        return $token;
    }



    public static function valida_token($token, $secret_jwt, $sessione)
    {
        $rit = null;

        $payload = JWT::decode($token, new \Firebase\JWT\Key($secret_jwt, 'HS256'));


        if ($payload->iat <= strtotime($sessione->updated_at)) {
            if ($payload->data->id_contatto == $sessione->id_contatto) {
                $rit = $payload;
            }
        }
        return $rit;
    }

    /**
     * riavvia inizio_sessione dell'utente nelle rotte aperte.
     *
     * @param Request $request, si estrae il token.
     */
    public static function gestisci_sessione($request)
    {
        // Estraggo il token dal bearer
        $token = $request->bearerToken();

        $contatto_autenticato = SessioneModel::where('token', $token)->first();
        if ($contatto_autenticato) {
            // Solo traccia attività; il TOKEN NON CAMBIA.
             SessioneModel::where('id_contatto', $contatto_autenticato->id_contatto)
     ->update(['updated_at' => now()]);
        }
    }
}
