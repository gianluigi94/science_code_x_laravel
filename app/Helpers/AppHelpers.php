<?php

namespace App\Helpers;

use App\Models\ConfigurazioneModel;
use App\Models\ContattoModel;
use App\Models\SessioneModel;
use Illuminate\Support\Arr;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use UnexpectedValueException;
use Illuminate\Support\Facades\File;

class AppHelpers
{
    /**
     * Rimuovo "required|" da ogni regola, così le regole diventano non obbligatorie.
     *
     * @param array $rules
     * @return array
     */
    public static function aggiorna_regole_helpers($rules) //ricevo l'elenco delle regole da modificare
    {
        $new_rules = Arr::map($rules, function ($value) { //scorro tutte le regole e le trasformo una per una
            return str_replace("required|", "", $value); //tolgo la parte "required|" dalla regola
        }); //ottengo il nuovo elenco di regole

        return $new_rules; //ritorno le regole aggiornate
    }


    /**
     * Creo una risposta standard con dati, messaggio e errore (se presenti).
     *
     * @param mixed $dati
     * @param string|null $msg
     * @param mixed|null $err
     * @return array
     */
    public static function risposta_custom($dati, $msg = null, $err = null) //preparo una risposta pronta da restituire
    {
        $response = array(); //creo l'array della risposta
        $response["data"] = $dati; //inserisco i dati principali nella risposta
        if ($msg != null) $response["message"] = $msg; //aggiungo il messaggio solo se è passato
        if ($err != null) $response["error"] = $err; //aggiungo l'errore solo se è passato
        return $response; //restituisco la risposta completa
    }


    /**
     * Nascondo la password creando una stringa non leggibile a partire da sale e password.
     *
     * @param string $password
     * @param string $sale
     * @return string
     */
    public static function nascondi_password($password, $sale) //ricevo password e sale per creare il valore da salvare
    {
        return hash("sha512", $sale . $password); //unisco sale e password e ne calcolo l'hash SHA-512
    }





    /**
     * Creo un token di sessione (JWT) per il contatto, includendo ruolo e abilità, e aggiorno l'inizio token nel database.
     *
     * @param int $id_contatto
     * @param string $secret_jwt
     * @param bool $resta_collegato
     * @param int|null $usa_da
     * @param int|null $scade
     * @return string
     */
    public static function crea_token_sessione($id_contatto, $secret_jwt, $resta_collegato = false, $usa_da = null, $scade = null)
    {
        $max_time = (int) ConfigurazioneModel::leggi_valore($resta_collegato ? 'termina_tk_collegato' : 'termina_tk_standard'); //leggo la durata massima del token in base al tipo di sessione
        $record_contatto = ContattoModel::where('id_contatto', $id_contatto)->first(); //recupero dal database il contatto a cui appartiene il token
        $t = time(); //prendo l'istante attuale
        $nbf = ($usa_da == null) ? $t : $usa_da; //imposto da quando il token è valido
        $exp = ($scade == null) ? $nbf + $max_time : $scade; //imposto quando il token scade
        $ruolo = $record_contatto->ruoli[0]; //prendo il primo ruolo associato al contatto
        $id_ruolo = $ruolo->id_ruolo; // salvo l'id del ruolo
        $abilita = $ruolo->abilita->toArray(); //recupero le abilità del ruolo e le trasformo in array
        $abilita = array_map(function ($arr) { //trasformo l'elenco di abilità in un elenco di soli id
            return $arr['id_abilita']; //estraggo l'id dell'abilità dalla singola voce
        }, $abilita); //ottengo l'array finale con tutti gli id_abilita

        $arr = array( //costruisco il contenuto del token
            'iss' => 'https://www.sciencecodex.net', //imposto chi ha emesso il token
            'aud' => null, //lascio vuoto il destinatario previsto del token
            'iat' => $t, //imposto quando ho creato il token
            'nbf' => $nbf, //imposto da quando il token diventa valido
            'exp' => $exp, //imposto quando il token scade
            'data' => array( //inserisco i dati che mi servono dentro al token
                'id_contatto' => $id_contatto, //salvo l'id del contatto
                'id_stato_utente' => $record_contatto->id_stato_utente, //salvo lo stato utente del contatto
                'id_ruolo' => $id_ruolo, //salvo l'id del ruolo del contatto
                'abilita' => $abilita, //salvo la lista delle abilità per controlli rapidi
                'nome' => trim($record_contatto->nome . " " . $record_contatto->cognome) //salvo il nome completo senza spazi
            )
        );

        $token = JWT::encode($arr, $secret_jwt, 'HS256'); //trasformo il payload in un JWT firmato con HS256

        $now = date('Y-m-d H:i:s'); //preparo la data attuale in formato data/ora
        DB::table('autenticazioni') //mi collego alla tabella delle autenticazioni
            ->where('id_contatto', $id_contatto) //seleziono la riga del contatto che sta effettuando l'accesso
            ->update(['inizio_token' => $now]); //aggiorno l'inizio token per segnare quando ho emesso questo token

        return $token;
    }




    /**
     * Controllo se il token è valido e coerente con la sessione, e ritorno i dati del token se tutto torna.
     *
     * @param string $token
     * @param string $secret_jwt
     * @param mixed $sessione
     * @return mixed|null
     */
    public static function valida_token($token, $secret_jwt, $sessione) //verifico e decodifico il token usando la chiave segreta
    {
        $rit = null; //preparo il valore di ritorno, che resta null se qualcosa non torna

        try { //provo a decodificare il token
            $payload = JWT::decode($token, new Key($secret_jwt, 'HS256')); //decodifico il JWT e verifico la firma HS256
        } catch (ExpiredException $e) { //gestisco il caso in cui il token sia scaduto
            try { //provo a pulire la sessione associata al token
                SessioneModel::where('token', $token)->delete(); //elimino la sessione dal database perché il token non è più valido
            } catch (\Throwable $t) { //ignoro eventuali errori durante la cancellazione
            }

            abort(401, 'TOKEN SCADUTO'); //blocco la richiesta con errore 401
        } catch (SignatureInvalidException $e) { //gestisco il caso in cui la firma del token non sia valida
            abort(403, 'TOKEN NON VALIDO'); //blocco la richiesta con errore 403 e
        } catch (BeforeValidException $e) { //gestisco il caso in cui il token non sia ancora valido
            abort(403, 'TOKEN NON ANCORA VALIDO'); //blocco la richiesta con errore 403
        } catch (UnexpectedValueException $e) { //gestisco il caso in cui il token sia malformato o inatteso
            abort(403, 'TOKEN NON VALIDO'); //blocco la richiesta con errore 403 perché il token non è leggibile correttamente
        } catch (\Throwable $e) { //gestisco qualsiasi altro errore non previsto
            abort(403, 'TOKEN NON VALIDO'); //blocco la richiesta con errore 403 per sicurezza
        }

        if ($payload->iat <= strtotime($sessione->updated_at)) { //controllo che il token sia stato emesso prima dell'ultimo aggiornamento della sessione
            if ($payload->data->id_contatto == $sessione->id_contatto) { //controllo che il token appartenga allo stesso contatto della sessione
                $rit = $payload; //considero valido il token e preparo i suoi dati come ritorno
            }
        }

        return $rit; //ritorno il payload se valido, altrimenti null
    }


     /**
     * Carico e decodifico il JSON della lingua richiesta dalla cartella storage/app/json_db.
     *
     * @param string $lang Codice lingua del file (es. "it" o "en")
     * @return array Dati decodificati dal JSON, oppure array vuoto se il file manca o non è valido
     */
    public static function loadLangJson(string $lang): array
    {
        $path = storage_path("app/json_db/{$lang}.json"); // costruisco il percorso del file JSON della lingua richiesta
        if (!File::exists($path)) { // controllo se il file esiste
            return []; // se non esiste, ritorno un array vuoto
        }

        $data = json_decode(File::get($path), true); // leggo e decodifico il JSON come array associativo
        return is_array($data) ? $data : []; // se è un array lo ritorno, altrimenti ritorno array vuoto
    }


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
