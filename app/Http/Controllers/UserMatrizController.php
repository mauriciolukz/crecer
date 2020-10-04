<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Auth;

use App\User;
use App\userMatriz;

class UserMatrizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /*
    * Remover usuario de todas las matrices a las que pertenece
    * @param  App\User $usuario
    * @return bool
    */
    public function removerUsuario(User $usuario)
    {
        try {
            $removido = userMatriz::where('idUser', $usuario->id)->get();

            log::info("Error al buscar al usuario en matrices => " . print_r( $removido, true ) );

            for( $r = 0; $r < count( $removido ); $r++ ){

                userMatriz::where('id', $removido[$r]->id)->delete();
            }
            
            if(!$removido){
                return(FALSE);
            }
        }catch(\Exception $e){
            log::info("Error al buscar al usuario en matrices");
            return(FALSE);
        }
        return(TRUE);
    }

}
