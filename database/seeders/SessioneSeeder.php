<?php

namespace Database\Seeders;

use App\Models\SessioneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       SessioneModel::create([
            'id_contatto' => 1,
            'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3d3dy5jb2RleC5pdCIsImF1ZCI6bnVsbCwiaWF0IjoxNjE2MjM5MDIyfQ.8T1Z3ONZbKNqY7h-eqA0FS7KcS8-S3H3AxQWAK7P_4g',
            'inizio_sessione' => '2024-08-07 12:00:00',
        ]);
        SessioneModel::create([
            'id_contatto' => 2,
            'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c',
            'inizio_sessione' => '2024-08-07 12:10:00',
        ]);
    }
}
