<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\nodos;
use App\matriz;
use App\userMatriz;
use App\ciclo;
use App\estados;
use App\municipios;
use App\InfoBancos;
use App\Beneficiarios;
use App\Subscription;
use App\PagosUsuarios;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'id' => '0',
            'codigo' => 'MCC-MCC-AB001',
            'nickname' => 'Master',
            'nombre' => 'Master',
            'apellidoPaterno' => '',
            'apellidoMaterno' => '',
            'email' => 'master@crecer.com',
            'password' =>bcrypt('123456'),
            'calle' => 'Home',
            'numero' => '100',
            'colonia' => 'Home',
            'codigoPostal' => '0000000',
            'idMunicipio' => '1',
            'idEstado' => '19',
            'telefono' => '1234567890',
            'rfc'=> 'CCO200504G62',
            'curp' => 'CCO200504G62000000',
            'rol' => '1',
            'padre' => '0',
            'estatus' => '1',
            'sigueA' => '4',
            'otraMatriz' => '',
        ]);

        
    }
}
