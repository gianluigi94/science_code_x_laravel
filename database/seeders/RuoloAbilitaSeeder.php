<?php

namespace Database\Seeders;

use App\Models\RuoloAbilitaModel;
use Illuminate\Database\Seeder;

class RuoloAbilitaSeeder extends Seeder
{
    public function run(): void
    {
        // visualizzare_media
        foreach ([2,3,4,5,6,7] as $r) RuoloAbilitaModel::create(['id_abilita'=>1,'id_ruolo'=>$r]);

        // visualizzare_analisi
        foreach ([6,7] as $r) RuoloAbilitaModel::create(['id_abilita'=>2,'id_ruolo'=>$r]);

        // visualizzare_pubblicita
        foreach ([2,5,7] as $r) RuoloAbilitaModel::create(['id_abilita'=>3,'id_ruolo'=>$r]);

        // MEDIA (4,5,6)
        foreach ([4,7] as $r) {
            RuoloAbilitaModel::create(['id_abilita'=>4,'id_ruolo'=>$r]);
            RuoloAbilitaModel::create(['id_abilita'=>5,'id_ruolo'=>$r]);
            RuoloAbilitaModel::create(['id_abilita'=>6,'id_ruolo'=>$r]);
        }

        // PUBBLICITÀ (7,8,9)
        foreach ([5,7] as $r) {
            RuoloAbilitaModel::create(['id_abilita'=>7,'id_ruolo'=>$r]);
            RuoloAbilitaModel::create(['id_abilita'=>8,'id_ruolo'=>$r]);
            RuoloAbilitaModel::create(['id_abilita'=>9,'id_ruolo'=>$r]);
        }

        // gestire_account (10) → tutti tranne ospite
        foreach ([2,3,4,5,6,7] as $r)
            RuoloAbilitaModel::create(['id_abilita'=>10,'id_ruolo'=>$r]);

        // registrarsi (11) → ospite
        RuoloAbilitaModel::create(['id_abilita'=>11,'id_ruolo'=>1]);

        // collegarsi (12) → ospite
        RuoloAbilitaModel::create(['id_abilita'=>12,'id_ruolo'=>1]);

        // gestire_admin (13) → principale
        RuoloAbilitaModel::create(['id_abilita'=>13,'id_ruolo'=>7]);

        // moderatore (14) → principale
        RuoloAbilitaModel::create(['id_abilita'=>14,'id_ruolo'=>7]);

        // sistemista (15) → principale
        RuoloAbilitaModel::create(['id_abilita'=>15,'id_ruolo'=>7]);
    }
}
