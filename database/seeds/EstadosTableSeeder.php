<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->truncate();

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '1',
            'clave' => '01', 
            'idPais' => '1', 
            'nombre' => 'Aguascalientes',
            'abrev' => 'Ags.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '2',
            'clave' => '02', 
            'idPais' => '1', 
            'nombre' => 'Baja California',
            'abrev' => 'BC',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '3',
            'clave' => '03', 
            'idPais' => '1', 
            'nombre' => 'Baja California Sur',
            'abrev' => 'BCS.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '4',
            'clave' => '04', 
            'idPais' => '1', 
            'nombre' => 'Campeche',
            'abrev' => 'Camp..',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '5',
            'clave' => '05', 
            'idPais' => '1', 
            'nombre' => 'Coahuila de Zaragoza',
            'abrev' => 'Coah..',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '6',
            'clave' => '06', 
            'idPais' => '1', 
            'nombre' => 'Colima',
            'abrev' => 'Col..',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '7',
            'clave' => '07', 
            'idPais' => '1', 
            'nombre' => 'Chiapas',
            'abrev' => 'Chis.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '8',
            'clave' => '08', 
            'idPais' => '1', 
            'nombre' => 'Chihuahua',
            'abrev' => 'Chih.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '9',
            'clave' => '09', 
            'idPais' => '1', 
            'nombre' => 'CDMX',
            'abrev' => 'CDMX',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '10',
            'clave' => '10', 
            'idPais' => '1', 
            'nombre' => 'Durango',
            'abrev' => 'Dur.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '11',
            'clave' => '11', 
            'idPais' => '1', 
            'nombre' => 'Guanajuato',
            'abrev' => 'Gto.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '12',
            'clave' => '12', 
            'idPais' => '1', 
            'nombre' => 'Guerrero',
            'abrev' => 'Gro.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '13',
            'clave' => '13', 
            'idPais' => '1', 
            'nombre' => 'Hidalgo',
            'abrev' => 'Hgo.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '14',
            'clave' => '14', 
            'idPais' => '1', 
            'nombre' => 'Jalisco',
            'abrev' => 'Jal.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '15',
            'clave' => '15', 
            'idPais' => '1', 
            'nombre' => 'México',
            'abrev' => 'Mex.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '16',
            'clave' => '16', 
            'idPais' => '1', 
            'nombre' => 'Michoacan de Ocampo',
            'abrev' => 'Mich.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '17',
            'clave' => '17', 
            'idPais' => '1', 
            'nombre' => 'Morelos',
            'abrev' => 'Mor.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '18',
            'clave' => '18', 
            'idPais' => '1', 
            'nombre' => 'Nayarit',
            'abrev' => 'Nay.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '19',
            'clave' => '19', 
            'idPais' => '1', 
            'nombre' => 'Nuevo León',
            'abrev' => 'NL.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '20',
            'clave' => '20', 
            'idPais' => '1', 
            'nombre' => 'Oaxaca',
            'abrev' => 'Oax.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '21',
            'clave' => '21', 
            'idPais' => '1', 
            'nombre' => 'Puebla',
            'abrev' => 'Pue.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '22',
            'clave' => '22', 
            'idPais' => '1', 
            'nombre' => 'Querétaro',
            'abrev' => 'Qro.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '23',
            'clave' => '23', 
            'idPais' => '1', 
            'nombre' => 'Quintana Roo',
            'abrev' => 'Q. Roo.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '24',
            'clave' => '24', 
            'idPais' => '1', 
            'nombre' => 'San Luis Potosí',
            'abrev' => 'SLP.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '25',
            'clave' => '25', 
            'idPais' => '1', 
            'nombre' => 'Sinaloa',
            'abrev' => 'Sin.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '26',
            'clave' => '26', 
            'idPais' => '1', 
            'nombre' => 'Sonora',
            'abrev' => 'Son.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '27',
            'clave' => '27', 
            'idPais' => '1', 
            'nombre' => 'Tabasco',
            'abrev' => 'Tab.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '28',
            'clave' => '28', 
            'idPais' => '1', 
            'nombre' => 'Tamaulipas',
            'abrev' => 'Tamps.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '29',
            'clave' => '29', 
            'idPais' => '1', 
            'nombre' => 'Tlaxcala',
            'abrev' => 'Tlax.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '30',
            'clave' => '30', 
            'idPais' => '1', 
            'nombre' => 'Veracruz de Ignacio de la Llave',
            'abrev' => 'Ver.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '31',
            'clave' => '31', 
            'idPais' => '1', 
            'nombre' => 'Yucatán',
            'abrev' => 'Yuc.',
            'activo' => '1',
        ]);

        DB::table('estados')->insert([
            /*'id' => '0',*/
            'id' => '32',
            'clave' => '32', 
            'idPais' => '1', 
            'nombre' => 'Zacatecas',
            'abrev' => 'Zac.',
            'activo' => '1',
        ]);
    }
}
