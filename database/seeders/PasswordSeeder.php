<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PasswordModel;

class PasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PasswordModel::create([
            'id_contatto' => 1,
            'password' => hash('sha512', 'cAnemagico1*')
        ]);
        PasswordModel::create([
            'id_contatto' => 2,
            'password' => hash('sha512', 'gAttomagico1*')

        ]);
    }
}
