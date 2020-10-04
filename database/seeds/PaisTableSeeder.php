<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pais')->truncate();

        DB::table('pais')->insert([
            /*'id' => '0',*/
            'id' => '1',
            'nombre' => 'México',
            'estatus' => '1',
        ]);
    }
}
