<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Models\AccessoModel;
use App\Models\AutenticazioneModel;
use App\Models\ConfigurazioneModel;
use App\Models\PasswordModel;
use App\Models\SessioneModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class AccediController extends Controller
{


    /**
     * Avvia il login: se manca $hash genera la sfida (sale), altrimenti verifica la password.
     *
     * @param string $utente
     * @param string|null $hash
     * @return mixed
     */
    public function show($utente, $hash = null)
    {
        if ($hash == null) {
            return AccediController::controllo_utente($utente);
        }
        return AccediController::controllo_password($utente, $hash);
    }

    /**
     * Avvia la fase iniziale del login generando il sale per la sfida dell'utente.
     * Il sale viene restituito anche se l'utente non esiste, per non rivelare informazioni.
     *
     * @param string $utente
     * @return mixed
     */
    protected static function controllo_utente($utente)
    {
        $sale = hash("sha512", trim(Str::random(200))); //genero un sale casuale e lo rendo non leggibile con hash

        if (AutenticazioneModel::esistente_utente_valido_per_login($utente)) { //controllo se l'utente esiste ed è valido per il login

            $auth = AutenticazioneModel::where('user', $utente)->first(); //recupero il record di autenticazione dell'utente

            // secret_jwt viene generato solo se non esiste ancora
            if (empty($auth->secret_jwt)) { //controllo se il secret JWT non è ancora stato creato
                $auth->secret_jwt = hash("sha512", trim(Str::random(200))); //genero e assegno un secret JWT sicuro
            }

            // la sfida può continuare a cambiare normalmente
            $auth->inizio_sfida = date('Y-m-d H:i:s', time()); //salvo l'istante di inizio della sfida di login
            $auth->save(); //persisto le modifiche del record di autenticazione

            $record_password = PasswordModel::password_attuale($auth->id_contatto); //recupero la password attuale associata al contatto
            $record_password->sale = $sale; //assegno il nuovo sale alla password
            $record_password->save(); //salvo il sale aggiornato nel database

            return AppHelpers::risposta_custom(['sale' => $sale]); //restituisco il sale al client per completare la sfida
        } else { //gestisco il caso in cui l'utente non esista o non sia valido
            AccessoModel::aggiungi_tentativo_fallito(null); //registro un tentativo fallito senza associare un contatto
            return AppHelpers::risposta_custom(['sale' => $sale]); //restituisco comunque il sale per non dare indizi
        }
    }



    //PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD PASWORD


    /**
     * Verifica l'hash inviato dal client confrontandolo con la password mascherata
     * e gestisce durata della sfida, tentativi, scadenza password e creazione sessione.
     *
     * @param string $utente
     * @param string $hash_client
     * @return mixed
     */
    protected static function controllo_password($utente, $hash_client)
    {

        if (AutenticazioneModel::esistente_utente_valido_per_login($utente)) { // Controllo che l'utente esista ed sia abilitato al login

            $auth = AutenticazioneModel::where('user', $utente)->first(); // Recupero i dati di autenticazione associati all'utente

            $secret_jwt = $auth->secret_jwt; // Leggo il secret JWT usato per firmare il token
            $inizio_sfida = strtotime($auth->inizio_sfida); // Converto in timestamp l'istante di inizio della sfida
            $durata_sfida = ConfigurazioneModel::leggi_valore("durata_sfida"); // Recupero la durata massima della sfida
            $max_tentativi = ConfigurazioneModel::leggi_valore("max_login_errati"); // Recupero il numero massimo di tentativi consentiti
            $scadenza_sfida = $inizio_sfida + $durata_sfida; // Calcolo il momento di scadenza della sfida


            if (time() < $scadenza_sfida) { // Verifico che la sfida non sia scaduta

                $record_password = PasswordModel::password_attuale($auth->id_contatto); // Recupero il record della password attuale

                $password = $record_password->password; // Leggo la password salvata nel database
                $sale = $record_password->sale; // Leggo il sale associato alla password

                $password_nascosta_db = AppHelpers::nascondi_password($password, $sale); // Calcolo la password mascherata partendo da password e sale

                if ($hash_client === $password_nascosta_db) { // Confronto l'hash inviato dal client con quello calcolato

                    $limite_pw = ConfigurazioneModel::leggi_valore("termina_psw"); // Recupero la durata massima di validità della password

                    $created_at = strtotime($record_password->created_at); // Converto in timestamp la data di creazione della password

                    $scadenza_pw = $created_at + $limite_pw; // Calcolo la data di scadenza della password

                    if (time() <= $scadenza_pw) { // Verifico che la password non sia scaduta
                        $tentativi = AccessoModel::conta_tentativi($auth->id_contatto); // Recupero il numero di tentativi falliti effettuati

                        if ($tentativi < $max_tentativi) { // Controllo che il limite di tentativi non sia stato superato

                            $resta_collegato = request()->boolean('collegato', false); // Leggo la scelta di restare collegato dalla richiesta
                            $tk = AppHelpers::crea_token_sessione($auth->id_contatto, $secret_jwt, $resta_collegato); // Creo un nuovo token di sessione
                            AccessoModel::elimina_tentativi($auth->id_contatto); // Azzero i tentativi falliti dopo il login corretto

                            // crea nuova riga sessione con flag coerente
                            SessioneModel::crea_sessione($auth->id_contatto, $tk, $resta_collegato); // Registro la nuova sessione nel database

                            $dati = array('tk' => $tk); // Preparo i dati di risposta con il token
                            AccessoModel::nuovo_record($auth->id_contatto, 1); // Registro un accesso riuscito
                            $record_password->blocco_password = null; // Rimuovo eventuali blocchi precedenti sulla password
                            $record_password->save(); // Salvo le modifiche al record della password
                            return AppHelpers::risposta_custom($dati); // Restituisco il token come risposta
                        } else { // Gestione del superamento del limite di tentativi
                            $record_password->blocco_password = now(); // Imposto il blocco della password
                            $record_password->save(); // Salvo il blocco nel database
                            abort(403, "ATTENZIONE: LIMITE TENTATIVI DI ACCESSO TERMINATI. RIPROVA PIU' TARDI"); // Interrompo il flusso per sicurezza
                        }
                    } else { // Gestione del caso di password scaduta
                        AccessoModel::aggiungi_tentativo_fallito($auth->id_contatto); // Registro un tentativo fallito
                        abort(403, "ATTENZIONE: PASSWORD SCADUTA, AGGIUNTO TENTATIVO FALLITO."); // Blocco l'accesso
                    }
                } else { // Gestione del caso di password errata
                    AccessoModel::aggiungi_tentativo_fallito($auth->id_contatto); // Registro un tentativo fallito
                    abort(403, "ATTENZIONE: PASSWORD (o nome utente) NON TROVATA SUL DATABASE, AGGIUNTO TENTATIVO FALLITO"); // Blocco l'accesso
                }
            } else { // Gestione del caso di sfida scaduta
                AccessoModel::aggiungi_tentativo_fallito($auth->id_contatto); // Registro un tentativo fallito
                abort(403, "ATTENZIONE: TEMPO SFIDA SCADUTO, AGGIUNTO TENTATIVO FALLITO"); // Blocco l'accesso
            }
        } else { // Gestione del caso di utente inesistente o non valido
            abort(403, "ATTENZIONE: PASSWORD (o nome utente) NON TROVATA SUL DATABASE, AGGIUNTO TENTATIVO FALLITO"); // Blocco l'accesso senza rivelare dettagli
        }
    }



    /**
     * Verifico se il token può essere usato: controllo la sessione, le scadenze e poi valido il JWT.
     *
     * @param string $token
     * @return mixed|null
     */
    public static function verifica_token($token) // Avvio la validazione completa del token di sessione
    {
        $rit = null; // Imposto il valore di ritorno a null finché non trovo un token valido
        $sessione = SessioneModel::dati_sessione($token); // Recupero dal database i dati della sessione associata al token
        if ($sessione != null) { // Controllo che esista una sessione per questo token
            $resta = (bool) $sessione->resta_collegato; // Leggo se la sessione è di tipo "resta collegato"

            // controllo inattivita' sessione RIMOSSO

            // limite assoluto sessione se collegato
            if ($resta) { // Applico il limite assoluto solo se l'utente ha scelto di restare collegato
                $inizio_assoluto = strtotime($sessione->created_at); // Considero l'inizio assoluto dal momento di creazione della sessione
                $max_assoluta = (int) ConfigurazioneModel::leggi_valore('termina_sessione_assoluta'); // Leggo il limite massimo assoluto consentito
                if (time() > ($inizio_assoluto + $max_assoluta)) { // Controllo se il limite assoluto è stato superato
                    SessioneModel::where('token', $token)->delete(); // Elimino la sessione perché ha superato il limite assoluto
                    abort(403, 'ATTENZIONE:SESSIONE COLLEGATO SCADUTA (LIMITE ASSOLUTO)'); // Blocco l'accesso segnalando la scadenza assoluta
                }
            }

            // Controllo scadenza TOKEN (no controllo inattivita')
            $inizio_token_record = DB::table('autenticazioni') // Leggo dalla tabella autenticazioni le informazioni sul token
                ->where('id_contatto', $sessione->id_contatto) // Seleziono il record relativo al contatto della sessione
                ->first(['inizio_token']); // Prendo solo il campo inizio_token
            if ($inizio_token_record) { // Controllo che il record esista
                $inizio_token = strtotime($inizio_token_record->inizio_token); // Converto in timestamp l'inizio del token
                $durata_token = (int) ConfigurazioneModel::leggi_valore($resta ? 'termina_tk_collegato' : 'termina_tk_standard'); // Leggo la durata del token in base al tipo di sessione
                if (time() > ($inizio_token + $durata_token)) { // Verifico se il token è scaduto rispetto al suo inizio
                    SessioneModel::where('token', $token)->delete(); // Elimino la sessione perché il token è scaduto
                    abort(403, 'TOKEN SCADUTO'); // Blocco l'accesso segnalando che il token non è più valido
                }
            }

            $auth = AutenticazioneModel::where('id_contatto', $sessione->id_contatto)->first(); // Recupero il record di autenticazione del contatto
            if ($auth != null) { // Controllo che esista il record di autenticazione
                $secret_jwt = $auth->secret_jwt; // Prendo il secret usato per verificare la firma del JWT
                $payload = AppHelpers::valida_token($token, $secret_jwt, $sessione); // Decodifico e valido il JWT confrontandolo con la sessione
                if ($payload != null) { // Controllo che la validazione abbia prodotto un payload valido
                    $rit = $payload; // Salvo il payload come risultato finale
                } else { // Gestisco il caso in cui il payload non risulti valido
                    abort(403, 'TK_0006'); // Blocco l'accesso con un codice di errore specifico
                }
            } else { // Gestisco il caso in cui manchi il record di autenticazione
                abort(403, 'TK_0005'); // Blocco l'accesso con un codice di errore specifico
            }
        } else { // Gestisco il caso in cui non esista alcuna sessione per quel token
            abort(403, 'ATTENZIONE:TOKEN NON VALIDO'); // Blocco l'accesso perché il token non corrisponde a una sessione
        }
        return $rit; // Ritorno il payload se valido, altrimenti null (se non sono già andato in abort)
    }



    /**
     * Utility di test: calcola sha512(sale + hash_password).
     *
     * @param string $sale
     * @param string $hash_password
     * @return \Illuminate\Http\JsonResponse
     */

    public function test($sale, $hash_password)
    {
        $psw_sale = hash("sha512", $sale . $hash_password);

        return response()->json(['psw_sale' => $psw_sale]);
    }
}
