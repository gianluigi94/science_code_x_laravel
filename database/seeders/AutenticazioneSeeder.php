<?php

namespace Database\Seeders;

use App\Models\AutenticazioneModel;
use Illuminate\Database\Seeder;
use App\Models\RecapitoModel;
use App\Models\TipoRecapitoModel;

class AutenticazioneSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        // Generaro lo username salvato in `autenticazioni.user` a partire dall'email del contatto, usando un hash (SHA-512)

        $idTipoEmail = TipoRecapitoModel::where('tipo', 'email')->value('id_tipo_recapito');

        $hashEmail = function (int $idContatto) use ($idTipoEmail): string {
            $email = RecapitoModel::where('id_contatto', $idContatto)
                ->where('id_tipo_recapito', $idTipoEmail)
                ->value('recapito');

            return hash('sha512', strtolower(trim($email)));
        };

        AutenticazioneModel::create([
            'id_autenticazione' => 1,
            'id_contatto' => 1,
            'user' => $hashEmail(1),
        ]);

        AutenticazioneModel::create([
            'id_autenticazione' => 2,
            'id_contatto' => 2,
            'user' => $hashEmail(2),
        ]);
    }
}
