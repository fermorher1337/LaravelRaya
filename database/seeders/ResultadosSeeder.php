<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultadosSeeder extends Seeder

{

    public function run()

    {

        DB::table('resultados')->insert([

            [

                'id' => 1,

                'ganador' => 'Fertest',

                'fecha' => '2024-11-29 06:37:22',

                'created_at' => '2024-11-29 06:37:22',

                'updated_at' => '2024-11-29 06:37:22',

            ],

            [

                'id' => 2,

                'ganador' => 'GMT',

                'fecha' => '2024-11-29 06:38:44',

                'created_at' => '2024-11-29 06:38:44',

                'updated_at' => '2024-11-29 06:38:44',

            ],

            [

                'id' => 3,

                'ganador' => 'Eur',

                'fecha' => '2024-11-29 06:39:54',

                'created_at' => '2024-11-29 06:39:54',

                'updated_at' => '2024-11-29 06:39:54',

            ],

            [

                'id' => 4,

                'ganador' => 'Mad',

                'fecha' => '2024-11-29 07:44:08',

                'created_at' => '2024-11-29 07:44:08',

                'updated_at' => '2024-11-29 07:44:08',

            ],

        ]);

    }

}