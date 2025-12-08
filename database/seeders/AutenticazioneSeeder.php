<?php

namespace Database\Seeders;

use App\Models\AutenticazioneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecapitoModel;
use App\Models\TipoRecapitoModel;

class AutenticazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
