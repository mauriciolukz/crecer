<?php

namespace App\Http\Controllers;
use App\pais;
use App\User;
use App\bajas;
use App\ciclo;
use App\nodos;
use App\matriz;
use App\estados;
use App\infoBancos;
use App\municipios;
use App\userMatriz;
use App\Subscription;
use App\beneficiarios;
use App\PagosUsuarios;
use Illuminate\Http\Request;
use App\Mail\NotificaciónDeTarea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Mail\CompletasteTuComunidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PreregistroCreandoCertezas;

class genericController extends Controller
{
    public function getEstados(Request $request)
    {
        $estados=estados::where('idPais',$request->pais)->get();
        return $estados;
    }

    public function getMunicipios(Request $request)
    {
        $municipios=municipios::where('idEstado',$request->estado)->get();
        return $municipios;
    }

    public function insertaEnMatriz(Request $request)
    {
        $user = User::findOrFail($request->idUser);
        $directo = User::findOrFail($user->padre);
        $matrizBronce= matriz::where('id','=',1)->get();
        userMatriz::create([
            'idUser' => $request->idUser,
            'idMatriz' => $matrizBronce[0]->id,
            'estatus' => 1
        ]);
        $nodo = nodos::create([
                'idUser' => $request->idUser,
                'idArriba' =>0,
                ]);
        ciclo::create([
            'idUser' => $request->idUser,
            'idNodo' => $nodo->id,
            'idMatriz' => $matrizBronce[0]->id,
            'tipo' => 0,
        ]);
        $cicloPadre=ciclo::where('idUser','=',$user->padre)
                        ->where('idMatriz','=',1)
                        ->where('estatus','=',0)->first();
        //se inserta
        $lleno=$this->inserta($cicloPadre->idNodo,$nodo);
        $cicloPadre->tipo += 1;
        
        // la bandera lleno significa que la matriz se lleno y debe ciclar el padre
        // En este cicla y salta siempre es la matriz bronce 
        if($lleno){
            $cicloPadre->estatus=1;
            $cicloPadre->save();
            $this->cicla($directo,$matrizBronce[0]->id);
            $this->salta($directo,$matrizBronce[0]->id);   
        }
        $cicloPadre->save();
        
        $cicla = $this->revisaArriba($nodo,$directo->id);
        
        if($cicla){
            $nodoArriba=nodos::findOrFail($nodo->idArriba);
            $nodocicla=nodos::findOrFail($nodoArriba->idArriba);
            $usercicla=User::findOrFail($nodocicla->idUser);
            $cicloUser=ciclo::where('idUser','=',$usercicla->id)
                        ->where('idMatriz','=',1)
                        ->where('estatus','=',0)->first();
            $cicloUser->estatus=1;
            $cicloUser->save();
            $this->cicla($usercicla,$matrizBronce[0]->id);
            $this->salta($usercicla,$matrizBronce[0]->id); 
        }
    }

    /*
     * Se inserta de izquierda a derecha de arriba a abajo.
     */
    public function inserta($idNodo,$nodo)
    {
        $lleno=false;
        $insertaAqui=null;
        $nodoCiclo=nodos::where('id','=',$idNodo)->first();
        if($nodoCiclo->idIzquierda != null) {
            if($nodoCiclo->idDerecha == null){
                $nodoCiclo->idDerecha=$nodo->id;
                $nodo->idArriba=$nodoCiclo->id;
                $insertaAqui=true;
            }
            if($insertaAqui==null) {
                $nodoIzquierda=nodos::where('id','=',$nodoCiclo->idIzquierda)->first();
                if($nodoIzquierda->idIzquierda == null ) {
                    $nodoIzquierda->idIzquierda=$nodo->id;
                    $nodo->idArriba=$nodoIzquierda->id;
                    $insertaAqui=true;
                }
                else{
                    if ($nodoIzquierda->idDerecha == null) {
                        $nodoIzquierda->idDerecha=$nodo->id;
                        $nodo->idArriba=$nodoIzquierda->id;
                        $insertaAqui=true;
                    }
                }
                $nodoIzquierda->save();    
            }
        }
        else{
            $nodoCiclo->idIzquierda=$nodo->id;
            $nodo->idArriba=$nodoCiclo->id;
            $insertaAqui=true;
        }
        if($insertaAqui == null && $nodoCiclo->idDerecha != null){
            $nodoDerecha=nodos::where('id','=',$nodoCiclo->idDerecha)->first();
            if($nodoDerecha->idIzquierda == null ) {
                $nodoDerecha->idIzquierda=$nodo->id;
                $nodo->idArriba=$nodoDerecha->id;
            }   
            else{
                if ( $nodoDerecha->idDerecha ==null){
                    $nodoDerecha->idDerecha=$nodo->id;
                    $nodo->idArriba=$nodoDerecha->id;
                }
            }
            $nodoDerecha->save();
        }
        else{
            if($insertaAqui == null){
                $nodoCiclo->idDerecha=$nodo->id;
                $nodo->idArriba=$nodoCiclo->id;
            }
        }
        $nodoCiclo->save();
        $nodo->save();
        $lleno=$this->seLleno($idNodo);
        return $lleno;
    }
    /*
     *
     */
    public function seLleno($idNodo)
    {
        $lleno = false;
        $nodos=nodos::findOrFail($idNodo);
        if ($nodos->idIzquierda != null && $nodos->idDerecha != null) {
            $nodoIzquierda = nodos::findOrFail($nodos->idIzquierda);
            $nodoDerecha = nodos::findOrFail($nodos->idDerecha);
            if($nodoIzquierda->idIzquierda !=null && $nodoIzquierda->idDerecha != null && $nodoDerecha->idIzquierda != null && $nodoDerecha->idDerecha != null){
                $lleno=true;
            }
        }
        return $lleno; 
    }

    /*
     * Función para posicionar dentro de la misma matriz(comunidad)en un nuevo ciclo.
     */
    public function cicla($userCicla,$idMatriz)
    {
        $directo=-2;
        $nodo = nodos::create([
                'idUser' => $userCicla->id,
                'idArriba' =>0,
                ]);
        $ciclo= ciclo::create([
                'idUser' => $userCicla->id,
                'idNodo' => $nodo->id,
                'idMatriz' => $idMatriz,
                'tipo' => 0,
                ]);
        if($userCicla->id == 0){
            if($idMatriz == 1){
                $cicloPadre=ciclo::where('idUser','=',$userCicla->sigueA)
                            ->where('idMatriz','=',$idMatriz)
                            ->where('estatus','=',0)->first();
                $lleno=$this->inserta($cicloPadre->idNodo,$nodo);
                $cicloPadre->tipo += 1;
                switch ($userCicla->sigueA) {
                    case 3:
                        $userCicla->sigueA = 4;
                    break;
                    case 4:
                        $userCicla->sigueA = 5;
                    break;
                    case 5:
                        $userCicla->sigueA = 6;
                    break;
                    default:
                        $userCicla->sigueA = 3;
                    break;
                }
                $userCicla->save();
                if($lleno) {
                    $cicloPadre->estatus=1;
                }
                $cicloPadre->save();
                $this->salta($userCicla,$idMatriz);
            }else{
                $this->ciclaMaster($nodo,$idMatriz);
            }
        }else{
            $directo=$userCicla->padre;
            $cicloPadre=ciclo::where('idUser','=',$userCicla->padre)
                            ->where('idMatriz','=',$idMatriz)
                            ->where('estatus','=',0)->first();

            if($userCicla->id != 1 AND $userCicla->id != 2){
                $estaHijoCiclo=$this->revisaCicloPadre($cicloPadre, $userCicla->id);
                if($estaHijoCiclo)
                {
                    $patrocinador=User::where('id','=',$userCicla->padre)->first();
                    $cicloPadre=ciclo::where('idUser','=',$patrocinador->padre)
                                    ->where('idMatriz','=',$idMatriz)
                                    ->where('estatus','=',0)->first();
                    $directo=$patrocinador->padre;
                }
            }

            $lleno=$this->inserta($cicloPadre->idNodo,$nodo);
            $cicloPadre->tipo += 1;
            if($lleno) {
                $cicloPadre->estatus=1;
                $cicloPadre->save();
                $useralternativo=User::findOrFail($directo);
                $this->cicla($useralternativo,$idMatriz);
                $this->salta($useralternativo,$idMatriz); 
            }
            $cicloPadre->save();
        }
        $cicla = $this->revisaArriba($nodo,$directo);
        if($cicla){
            $nodoArriba=nodos::findOrFail($nodo->idArriba);
            $nodocicla=nodos::findOrFail($nodoArriba->idArriba);
            $usercicla=User::findOrFail($nodocicla->idUser);
            $cicloUser=ciclo::where('idUser','=',$usercicla->id)
                        ->where('idMatriz','=',$idMatriz)
                        ->where('estatus','=',0)->first();
            $cicloUser->estatus=1;
            $cicloUser->save();
            $this->cicla($usercicla,$idMatriz);
            $this->salta($usercicla,$idMatriz);
        }
    }

    public function revisaArriba($nodo,$directo)
    {
        $cicla=false;
        if($nodo->idArriba != 0) {
            $sube1=nodos::findOrFail($nodo->idArriba);
            $sube2=nodos::findOrFail($sube1->idArriba);
            if ($sube2->idIzquierda != null && $sube2->idDerecha != null && $sube2->idUser != $directo) {
                $nodoIzquierda = nodos::findOrFail($sube2->idIzquierda);
                $nodoDerecha = nodos::findOrFail($sube2->idDerecha);
                if($nodoIzquierda->idIzquierda !=null && $nodoIzquierda->idDerecha != null && $nodoDerecha->idIzquierda != null && $nodoDerecha->idDerecha != null){
                    $cicla=true;
                }
            }
        }

        return $cicla;
    }

    /*
     * Función que cicla matriz plata en adelante solo Master
     */
    public function ciclaMaster($nodo,$idMatriz)
    {
        $Master=User::where('id','=',0)->first();
        $cadenaControl=$Master->otraMatriz;
        switch ($idMatriz) {
            case 2:
                if($cadenaControl[0] == '1'){
                    $cicloPadre=ciclo::where('idUser','=',1)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[0]='2';
                }else
                {
                    $cicloPadre=ciclo::where('idUser','=',2)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[0]='1';
                }    
            break;
            case 3:
                if($cadenaControl[1] == '1'){
                    $cicloPadre=ciclo::where('idUser','=',1)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[1]='2';
                }else
                {
                    $cicloPadre=ciclo::where('idUser','=',2)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[1]='1';
                }  
            break;
            case 4:
                if($cadenaControl[2] == '1'){
                    $cicloPadre=ciclo::where('idUser','=',1)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[2]='2';
                }else
                {
                    $cicloPadre=ciclo::where('idUser','=',2)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[2]='1';
                }  
            break;
            case 5:
                if($cadenaControl[3] == '1'){
                    $cicloPadre=ciclo::where('idUser','=',1)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[3]='2';
                }else
                {
                    $cicloPadre=ciclo::where('idUser','=',2)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[3]='1';
                }  
            break;
            default:
                if($cadenaControl[4] == '1'){
                    $cicloPadre=ciclo::where('idUser','=',1)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[4]='2';
                }else
                {
                    $cicloPadre=ciclo::where('idUser','=',2)
                                     ->where('idMatriz','=',$idMatriz)
                                     ->where('estatus','=',0)->first();
                    $cadenaControl[4]='1';
                }  
            break;
        }
        $lleno=$this->inserta($cicloPadre->idNodo,$nodo);
        $Master->otraMatriz=$cadenaControl;
        $Master->save();
        $cicloPadre->tipo += 1;
        if($lleno)
        {
            $cicloPadre->estatus = 1;
            $cicloPadre->save();
            $useralternativo=User::findOrFail($cicloPadre->idUser);
            $this->cicla($useralternativo,$idMatriz);
            $this->salta($useralternativo,$idMatriz);
        }
        $cicloPadre->save();
        $cicla = $this->revisaArriba($nodo,$cicloPadre->idUser);
        if($cicla){
            $nodoArriba=nodos::findOrFail($nodo->idArriba);
            $nodocicla=nodos::findOrFail($nodoArriba->idArriba);
            $usercicla=User::findOrFail($nodocicla->idUser);
            $cicloUser=ciclo::where('idUser','=',$usercicla->id)
                        ->where('idMatriz','=',$idMatriz)
                        ->where('estatus','=',0)->first();
            $cicloUser->estatus=1;
            $cicloUser->save();
            $this->cicla($usercicla,$idMatriz);
            $this->salta($usercicla,$idMatriz);
        }
    }

    /*
     * Función para saltar de matriz
     */
    public function  salta($userSalta,$idMatriz)
    {
        $directo=$userSalta->padre;
        if($idMatriz < 6){
            
            $ciclosUser=ciclo::where('idUser','=',$userSalta->id)
                             ->where('estatus','=',1)
                             ->where('idMatriz','=',$idMatriz)
                             ->get();
            $valida= ciclo::where('idUser','=',$userSalta->id)
                          ->where('idMatriz','=',($idMatriz+1))
                          ->get();
            if($userSalta->id > 2 && count($valida) == 0) {
                if($idMatriz == 1) {
                    $ciclo1Directo=0;
                    $ciclo2Directo=0;
                    foreach ($ciclosUser as $ciclo){
                        if($ciclo->tipo >=2){
                            $ciclo2Directo++;
                        }
                        else{
                            if ($ciclo->tipo == 1) {
                                $ciclo1Directo++;
                            }
                        }
                    }
                    if(($ciclo1Directo > 0 && $ciclo2Directo > 0) || $ciclo2Directo > 1 ){
                        $nodo = nodos::create([
                                'idUser' => $userSalta->id,
                                'idArriba' =>0,
                                ]);
                        $matriz= $idMatriz+1;
                        $ciclo= ciclo::create([
                                'idUser' => $userSalta->id,
                                'idNodo' => $nodo->id,
                                'idMatriz' => $matriz,
                                'tipo' => 0,
                                ]);
                        userMatriz::create([
                                'idUser' => $userSalta->id,
                                'idMatriz' => $matriz,
                                'estatus'=> 1
                                ]);
                        $cicloPadre = $this->buscaNodoPadre($userSalta,$matriz);
                        $lleno = $this->inserta($cicloPadre->idNodo,$nodo);
                        $cicloPadre->tipo += 1;
                        if($lleno){
                            $cicloPadre->estatus = 1;
                            $cicloPadre->save();
                            $useralternativo=User::findOrFail($cicloPadre->idUser);
                            $this->cicla($useralternativo,$matriz);
                            $this->salta($useralternativo,$matriz); 
                        }
                        $cicloPadre->save();
                        $cicla = $this->revisaArriba($nodo,$cicloPadre->idUser);
                        if($cicla){
                            $nodoArriba=nodos::findOrFail($nodo->idArriba);
                            $nodocicla=nodos::findOrFail($nodoArriba->idArriba);
                            $usercicla=User::findOrFail($nodocicla->idUser);
                            $cicloUser=ciclo::where('idUser','=',$usercicla->id)
                                        ->where('idMatriz','=',$matriz)
                                        ->where('estatus','=',0)->first();
                            $cicloUser->estatus=1;
                            $cicloUser->save();
                            $this->cicla($usercicla,$matriz);
                            $this->salta($usercicla,$matriz);
                        }
                    }
                }
                elseif (count($ciclosUser) > 1) {
                    $directosCiclo = false;
                    foreach ($cicloUser as $ciclo) {
                        $directos=$this->directosCiclo($ciclo);
                        if($directos == 2) {
                            $directosCiclo = true;
                        }
                    }
                    if($directosCiclo)
                    {
                        $nodo = nodos::create([
                                'idUser' => $userSalta->id,
                                'idArriba' =>0,
                                ]);
                        $matriz= $idMatriz+1;
                        $ciclo= ciclo::create([
                                'idUser' => $userSalta->id,
                                'idNodo' => $nodo->id,
                                'idMatriz' => $matriz,
                                'tipo' => 0,
                                ]);
                        userMatriz::create([
                                'idUser' => $userSalta->id,
                                'idMatriz' => $matriz,
                                'estatus'=> 1
                        ]);
                        $cicloPadre = $this->buscaNodoPadre($userSalta,$matriz);
                        $lleno = $this->inserta($cicloPadre->idNodo,$nodo);
                        $cicloPadre->tipo += 1;
                        if($lleno){
                            $cicloPadre->estatus = 1;
                        }
                        $cicloPadre->save();
                        $cicla = $this->revisaArriba($nodo,$directo);
                        if($cicla){
                            $nodoArriba=nodos::findOrFail($nodo->idArriba);
                            $nodocicla=nodos::findOrFail($nodoArriba->idArriba);
                            $usercicla=User::findOrFail($nodocicla->idUser);
                            $cicloUser=ciclo::where('idUser','=',$usercicla->id)
                                        ->where('idMatriz','=',$matriz)
                                        ->where('estatus','=',0)->first();
                            $cicloUser->estatus=1;
                            $cicloUser->save();
                            $this->cicla($usercicla,$matriz);
                            $this->salta($usercicla,$matriz);
                        }
                    }
                }
            }
        }
    }
    /*
     * Busca Directos en el Ciclo
     */
    public function directosCiclo($ciclo)
    {
        $directos = 0;
        $nodoCiclo=nodos::where('id','=',$ciclo->idNodo)->first();
        $usuariosCiclo=$this->llenaArbol($nodoCiclo);
        $hijos=User::where('padre','=',$ciclo->idUser)->get();

        foreach ($usuariosCiclo as $user) {
            foreach ($hijos as $hijo) {
                if($hijo->id == $user->id){
                    $directos++;
                }
            }
        }
        return $directos;
    }
    /*
     * Busca el patrocinador dentro de la matriz si no busca hacía arriba
     */
    public function buscaNodoPadre($idUsuario,$idMatriz)
    {

        $usuario = User::where('id','=',$idUsuario->padre)->first();
        do{
            $userMatriz=userMatriz::where('idUser','=', $usuario->id)
                                  ->where('idMatriz','=',$idMatriz)->first();
            if($userMatriz==null){
                $usuario = User::where('id','=',$usuario->padre)->first();
            }
        }while($userMatriz == null);
        $cicloUsuario=ciclo::where('idUser','=',$usuario->id)
                            ->where('idMatriz','=',$idMatriz)
                            ->where('estatus','=',0)->first();
        
        return $cicloUsuario;
    }
    /*
     * Revisa el ciclo del padre no sea el mismo donde se va a insertar el usuario que cicla.
     */
    public function revisaCicloPadre($cicloPadre, $idUserCicla)
    {
        $noEsta=false;
        $nodoCiclo=nodos::where('id','=',$cicloPadre->idNodo)->first();
        $usuarios=json_decode($this->llenaArbol($nodoCiclo));
        foreach ($usuarios as $user) {
            if(isset($user->id) && $user->id == $idUserCicla){
                $noEsta=true;
            }
        }
        return $noEsta;
    }
    /*
     * Dado un usuario trae su descendencia 
     */
    public function traeDescendencia($usuario,&$users)
    {
        $usersDirectos=User::where('padre','=',$usuario->id)->get();
        foreach ($usersDirectos as $user) {
            $users[] = $user;
            $this->traeDescendencia($user,$users);
        }
    }
    /* 
     * Función traeArbol: trae el arbol actual del usuario
     * pista Tommy
     */
     public function traeArbol($usuario, $idMatriz) 
    {   
        $ciclo = ciclo::where('idUser', '=', $usuario->id)
                      ->where('idMatriz', '=', $idMatriz)
                      ->where('estatus', '=', 0)->first();

        $nodo = nodos::where('id', '=', $ciclo->idNodo)->first();
        return $this->llenaArbol($nodo);
    }
    /* Función traeArbolCiclo: trae el arbol del ciclo que selecciono el usuario
     */
    public function traeArbolCiclo(Request $request)
    {
        $input = $request->all();
        $ciclo=ciclo::where('id','=',$input['ciclo'])->first();
        $nodo=nodos::where('id','=',$ciclo->idNodo)->first();
        return $this->llenaArbol($nodo);
    }

    /* 
     * Función traeArbolNodo: trae el arbol del nodo que selecciono el usuario
     */
    public function traeArbolNodo(Request $request)
    {
        $input = $request->all();
        $nodo  = nodos::where('id','=', $input['nodo'])->first();
        return($this->llenaArbol($nodo));
    }

    /* Función para subir un nivel del nodo superior
    */
    public function subeArbol(Request $request)
    {
        $input = $request->all();
        $matrices = matriz::where('idInicial', '=', $input['nodo'])->first();
        $arbol = null;
        if ($matrices == null) {
            $nodo = nodos::where('id','=',$input['nodo'])->first();
            $nodoArriba = nodos::where('id','=',$nodo->idArriba)->first();
            $arbol = $this->llenaArbol($nodoArriba);    
        }
        return $arbol;
    }
    /*Función para traer los ciclos de la matriz seleccionada
    */
    public function traeCiclos(Request $request)
    {
        $input=$request->all();
        $valores=null;
        $valores['ciclos']=ciclo::where('idUser','=',$input['idUsuario'])
                                ->where('idMatriz','=',$input['idMatriz'])
                                ->get();
        $nodo=nodos::where('id','=',$valores['ciclos'][count($valores['ciclos'])-1]->idNodo)->first();
        $valores['arbol']=$this->llenaArbol($nodo);
        return json_encode($valores);
    }

     /*Arreglo de acomodo de posiciones en comunidad - No duplica posición en comunidad*/
    public function llenaArbol( $nodo )
{
log::info( "Error al buscar al usuario en matrices => " . print_r( $nodo, true ) );

$empty = new User([
'id' => -1,
'nombre' => '',
'nickname' => '',
'email' => '',
'password' => '',
'apellidoPaterno' => '',
'apellidoMaterno' => '',
'calle' => '',
'numero' => '',
'colonia' => '',
'codigoPostal' => '',
'idEstado' => 0,
'idMunicipio' => 0,
'telefono' => '',
'rfc' => '',
'curp' => '',
'rol' => 0,
'padre' => -1,
'otraMatriz' => 0,
'estatus' => 33,
]);

if( !empty( $nodo ) ){

$userInsertar = User::where('id', '=', $nodo->idUser)->first();
$userInsertar["nodo"] = $nodo->id;
//Primer nodo
$users[] = $userInsertar;
if($nodo->idIzquierda == null){
$users[] = $empty;
$users[] = $empty;
$users[] = $empty;
}
else{
$nodoIzquierda = nodos::where('id', '=', $nodo->idIzquierda) ->first();
$userInsertar = User::where('id', '=', $nodoIzquierda->idUser)->first();
$userInsertar["nodo"] = $nodo->idIzquierda;
$flag = 0;
foreach ($users as &$user) {
if ($user->id == $userInsertar->id) {
$flag = 1;
}
}

if ($flag == 0) {
$users[] = $userInsertar;
}else{
$users[] = $empty;
}

if($nodoIzquierda->idIzquierda == null){
$users[] = $empty;
}
else{
$nodoIzquierda2 = nodos::where('id', '=', $nodoIzquierda->idIzquierda)->first();
$userInsertar = User::where('id', '=', $nodoIzquierda2->idUser) ->first();
$userInsertar["nodo"] = $nodoIzquierda->idIzquierda;
// Tercero
$flag = 0;
foreach ($users as &$user) {
if ($user->id == $userInsertar->id) {
$flag = 1;
}
}

if ($flag == 0) {
$users[] = $userInsertar;
}else{
$users[] = $empty;
}
}
if($nodoIzquierda->idDerecha == null ){
$users[] = $empty;
}
else{
$nodoIzquierda2 = nodos::where('id', '=', $nodoIzquierda->idDerecha)->first();
$userInsertar = User::where('id', '=', $nodoIzquierda2->idUser) ->first();
$userInsertar["nodo"] = $nodoIzquierda->idDerecha;
// Cuarto
$flag = 0;
foreach ($users as &$user) {
if ($user->id == $userInsertar->id) {
$flag = 1;
}
}

if ($flag == 0) {
$users[] = $userInsertar;
}else{
$users[] = $empty;
}
}
}
if($nodo->idDerecha == null){
$users[] = $empty;
$users[] = $empty;
$users[] = $empty;
}
else{
$nodoDerecha = nodos::where('id', '=', $nodo->idDerecha) ->first();
$userInsertar = User::where('id', '=', $nodoDerecha->idUser)->first();
$userInsertar["nodo"] = $nodo->idDerecha;
// Quinto
$flag = 0;
foreach ($users as &$user) {
if ($user->id == $userInsertar->id) {
$flag = 1;
}
}

if ($flag == 0) {
$users[] = $userInsertar;
}else{
$users[] = $empty;
}

if($nodoDerecha->idIzquierda == null){
$users[] = $empty;
}else{
$nodoDerecha2 = nodos::where('id', '=', $nodoDerecha->idIzquierda)->first();
$userInsertar = User::where('id', '=', $nodoDerecha2->idUser) ->first();
$userInsertar["nodo"] = $nodoDerecha->idIzquierda;
// Quinto
$flag = 0;
foreach ($users as &$user) {
if ($user->id == $userInsertar->id) {
$flag = 1;
}
}

if ($flag == 0) {
$users[] = $userInsertar;
}else{
$users[] = $empty;
}
}

if($nodoDerecha->idDerecha == null) {
$users[] = $empty;
}else{
$nodoDerecha2 = nodos::where('id', '=', $nodoDerecha->idDerecha)->first();
$userInsertar = User::where('id', '=', $nodoDerecha2->idUser) ->first();
$userInsertar["nodo"] = $nodoDerecha->idDerecha;
// Sexto

$flag = 0;
foreach ($users as &$user) {
if ($user->id == $userInsertar->id) {
$flag = 1;
}
}

if ($flag == 0) {
$users[] = $userInsertar;
}else{
$users[] = $empty;
}
}
}
return json_encode($users);
}
else{

return json_encode( array() );
}
}


    //tommy
 
    public function crearUsuarios(Request $request)
    {
        $padre=0;
if($request->idPatrocinador!=''){
    $padre=$request->idPatrocinador;
}
        $user = User::where('email', '=', $request->email)->first();
        $userCurp = User::where('curp', '=', $request->curp)->first();
        $pat = User::where('id', '=', $request->idPatrocinador)->first();
if ($userCurp === null) {
if ($user === null) {
   // checar si correo existe en base de datos, si no existe crear usuario
    $caracteresPermitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num=rand(3,4);
    $apP=$request->apepaterno;
    $apM=$request->apematerno;
    if ($apP=='') {
       $apP=substr(str_shuffle($caracteresPermitidos), 0, 1);
    }

    if ($apM=='') {
       $apM=substr(str_shuffle($caracteresPermitidos), 0, 1);
    }
$codigo1=$request->nombre[0].''.$request->apepaterno[0].''.$request->apematerno[0];
if ($pat!='' ) {
$codigo2=$pat->nombre[0].''.$apP[0].''.$apM[0];
}else{
   $codigo2=substr(str_shuffle($caracteresPermitidos), 0, 3); 
}

$codigo3=substr(str_shuffle($caracteresPermitidos), 0, $num);
$codigo= $codigo1.'-'.$codigo2.'-'.$codigo3;
    $user = User::create([
        'nickname'=>$request->nombre[0].''.$apP,
            'nombre'=>$request->nombre,
            'email'=>$request->email,
            'apellidoPaterno'=>$request->apepaterno,
            'apellidoMaterno'=>$request->apematerno,
            'telefono'=>$request->telefono,
            'curp'=>$request->curp,
            'rol'=>2,
            'padre'=>$padre,
            'estatus'=>0,
            'codigo'=>$codigo,
            'password'=> bcrypt('cambiame1234'),
        ]);
   infoBancos::create([
            'nombre' => 'Indefinido',
            'noCuenta' => '0000000000000000',
            'tarjeta' => '0000000000000000',
            'clabe' => '000000000000000000',
            'idUser' => $user->id
        ]);
        Beneficiarios::create([
            'idUser' => $user->id,
            'parentesco'=>1,
            'estatus'=> 1
        ]);
        
        //Mauricio
        //$contenido= new Request;
        //$contenido['idUser']=$user->id;
        // app(\App\Http\Controllers\genericController::class)->insertaEnMatriz($contenido);
        Mail::to($user->email)->send(new PreregistroCreandoCertezas ($user,$codigo,$request->email,$request->nombre));
 return redirect()->back()->with('status','Pre-Registro creado con exito.');
        }

//si el usuario existe mandar error en la pagina.
  return redirect()->back()->with('error','Existe un usuario con este correo');
    }
return redirect()->back()->with('error','Existe un usuario con este curp');
}
    public function datos(Request $request)
{ 
    if(request()->ajax())
{
//$datos = User::where('codigo','=',$request->codigo)->first();
$datos =User::where('codigo', $request->codigo)
->orWhere('email', 'like', '%' . $request->codigo . '%')
->orWhere('nombre', 'like', '%' . $request->codigo . '%')
->orWhere('apellidoPaterno', 'like', '%' . $request->codigo . '%')
->orWhere('apellidoMaterno', 'like', '%' . $request->codigo . '%')->get();

  
            return Response($datos);
                            
                

            }
        }

public function validar(){
    
    $usuarios=User::where('estatus','=',0)->get();
    $users=User::all();
    
    return view('/master.validar_user', [
           
            "usuarios"=>  $usuarios,
            "users"=>  $users,
        ]);
    }


    public function eliminarU($id){ 
        //condicion para poder elimiar registro de pre-registro

        $id = (int) $id;
        $user = User::where( 'id', $id )->first();

        $userExist = nodos::where( 'idUser','=', $id )->get();

        if( $user->estatus == 0 && count( $userExist ) == 0 ){

            User::where('id',$id)->delete();
            return redirect()->back()->with( 'status', 'Pre-Registro eliminado.' );
        }
        else{

            return redirect()->back()->with( 'status','El usuario ' . $user->nombre . ' ' . $user->apellidoPaterno . ' ' . $user->apellidoMaterno . ' ya ha sido inactivo' );
            /*app(\App\Http\Controllers\UserMatrizController::class)->removerUsuario($user);
            $event = User::where('id',$id)->delete();
            $where = array('padre' => $id);
            $updateArr = ['padre' => 0];
            $event  = User::where($where)->update($updateArr);
            $event = Subscription::where('id_user',$id)->delete();
            return redirect()->back()->with('status','Pre-Registro eliminado.');*/
        }
    }

public function validarU($id, $motivo = null){

    $id = (int) $id;
    $user=User::where('id','=',$id)->first();
    $where = array('id' => $id);

    if($user->estatus==1){
        $updateArr = ['estatus' => 0];
    // Mauricio
    }
    elseif ($user->estatus==0){
        $nodoCiclo=nodos::where('idUser','=',$id)->first();
        if($nodoCiclo == null) {
            $contenido= new Request;
            $contenido['idUser']=$id;
            app(\App\Http\Controllers\genericController::class)->insertaEnMatriz($contenido);
        }
    }

    if( !empty( $motivo ) ){

        $newBajas = new bajas;
        $newBajas->idUser = $id;
        $newBajas->motivo = $motivo;
        $newBajas->created_at = date( "Y-m-d H:i:s" );
        $newBajas->save();
    }

    // Mauricio
    $amount=150;
    if($user->estatus==0){
        $updateArr = ['estatus' => 1];
        $matriz = userMatriz::where('idUser','=',$id)->orderBy('id','desc')->first();
      
        if($matriz->idMatriz==2){
            $amount=300;   
        }
        if($matriz->idMatriz==3){
            $amount=750;   
        }
        if($matriz->idMatriz==4){
            $amount=1850;   
        }
        if($matriz->idMatriz==5){
            $amount=3750;   
        }
        if($matriz->idMatriz==6){
            $amount=7500;   
        }
        $subscribetion = Subscription::create([
            'id_user'=>$id,
                'amount'=>$amount,
                'id_matriz'=>$matriz->idMatriz,
            ]);
    }
    $pago=$amount;
    $event  = User::where($where)->update($updateArr);
    $contacto = User::where( "id","=",$id)->get();
    foreach ($contacto as $contt) {
       if ($contt->email!='') {
        $titulo='titulo mensaje';
        $mensaje='Texto del mensaje a enviar';
        
         Mail::to($contt->email)->send(new NotificaciónDeTarea($titulo,$mensaje,$pago,$contt));
       }
    }
    return redirect()->back()->with('status','Pre-Registro validado con exito.');
    }


    public function checarCiclo($ciclo,$anterior){
       // $directos=$this->directosCiclo($ciclo);
        //$nodo=nodos::where('id','=',$ciclo->idNodo)->first();
        $directosA = 0;
        if($anterior!=0){
            $cicloA=ciclo::where('id','=',$anterior)->first();
           
        $nodoCicloA=nodos::where('id','=',$cicloA->idNodo)->first();
        $usuariosCicloA=$this->llenaArbol($nodoCicloA);
        $hijosA=User::where('padre','=',$cicloA->idUser)->get();
        $decodedA = json_decode($usuariosCicloA, true);
      foreach ($decodedA as $uA) {
            foreach ($hijosA as $hijoA) {
                if($hijoA->id == $uA['id']){
                   $directosA++;
                }
            }
        }
        }
        
        $ciclo=ciclo::where('id','=',$ciclo)->first();
        $matriz=matriz::where('id','=',$ciclo->idMatriz)->first();
        $lleno = 0;
        $nodos=nodos::findOrFail($ciclo->idNodo);
        if ($nodos->idIzquierda != null && $nodos->idDerecha != null) {
            $nodoIzquierda = nodos::findOrFail($nodos->idIzquierda);
            $nodoDerecha = nodos::findOrFail($nodos->idDerecha);
            if($nodoIzquierda->idIzquierda !=null && $nodoIzquierda->idDerecha != null && $nodoDerecha->idIzquierda != null && $nodoDerecha->idDerecha != null){
                $lleno=1;
            }
        }
        $directos = 0;
        $nodoCiclo=nodos::where('id','=',$ciclo->idNodo)->first();
        $usuariosCiclo=$this->llenaArbol($nodoCiclo);
        $hijos=User::where('padre','=',$ciclo->idUser)->get();
        $decoded = json_decode($usuariosCiclo, true);
      foreach ($decoded as $u) {
            foreach ($hijos as $hijo) {
                if($hijo->id == $u['id']){
                   $directos++;
                }
            }
        }
        if(Auth::user()->id==0){
            $directos=$directos-1;
            $directosA=$directosA-1;
        }
        //$lleno=$this->seLleno($nodo->id);
        $data = ["directos" => $directos,"directosA" => $directosA, "estatus" => $lleno, "matriz" => $matriz->nombre ];
    
       return Response(json_encode($data));
}

public function registrarPago($id){
    $where = array('id' => $id);
    $updateArr = ['estatus' => 1];
    $event  = PagosUsuarios::where($where)->update($updateArr);
    return redirect()->back()->with('status','Pago Procesado');
 
}

public function listarPagos($estatus){
    if(Auth::check()){
    $bancos=infoBancos::all();
    if($estatus!=3){
        $pagos=PagosUsuarios::where('estatus','=',$estatus)->paginate(25);
    }else{
        $pagos=PagosUsuarios::paginate(25);
    } 
    $users=User::all();
    $matrices=Matriz::all();  
    return view('/master/pagos',
    [
        'bancos'    => $bancos,
        'pagos'   => $pagos,
        'users'       => $users,
        'matrices' => $matrices
    ]
);
}
}
      
    public function listarPagos1(){
        if(Auth::check()){  
        $bancos=infoBancos::all();
        $pagos=PagosUsuarios::paginate(25);        
    $users=User::all();
    $matrices=Matriz::all();
    return view('/master/pagos',
    [
        'bancos'    => $bancos,
        'pagos'   => $pagos,
        'users'       => $users,
        'matrices' => $matrices
    ]
);
}
}


public function crearDispersion()
{
   $users=User::all();
   foreach($users as $user){
$comunidad=0;
//$matrices=matriz::all();
//dd($matrices);
//foreach($matrices as $matriz){
$ciclos = ciclo::where('idUser', '=', $user->id)
                  
                  ->where('estatus', '=', 1)
                  ->where('estatusPago', '=', 0)->get();
                //  dd($ciclos);
                $i = 0;
foreach($ciclos as $ciclo){
   // dd($ciclos);
   $i++;
    if($i==1){
        $comunidad=1;
    }elseif($i==2){
        $comunidad=2;
   }else{
    $comunidad=3;         
        }

        $directos = 0;
        $nodoCiclo=nodos::where('id','=',$ciclo->idNodo)->first();
        $usuariosCiclo=app(\App\Http\Controllers\genericController::class)->llenaArbol($nodoCiclo);
        $hijos=User::where('padre','=',$ciclo->idUser)->get();
        $decoded = json_decode($usuariosCiclo, true);
      foreach ($decoded as $u) {
            foreach ($hijos as $hijo) {
                if($hijo->id == $u['id']){
                   $directos++;
                }
            }
        }

        if($ciclo->idMatriz==1){
            if($directos==0){
                if($comunidad==1){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr); 
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>    $comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos==1){
                if($comunidad==1){
                    $comisiones=2000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=2000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=2000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos>=2){
                if($comunidad==1){
                    $comisiones=6000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=2000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=6000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
        }
    
        if($ciclo->idMatriz==2){
            if($directos==0){
                if($comunidad==1){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos==1){
                if($comunidad==1){
                $comisiones=4000;
                $pagos= PagosUsuarios::create([
                    'user_id'=>$ciclo->idUser,
                        'ciclo_id'=>$ciclo->id,
                        'matriz_id'=>$ciclo->idMatriz,
                        'comunidad'=>$comunidad,
                        'comisiones'=>$comisiones,
                        'estatus'=>0
                    ]);
                    $where = array('id' => $ciclo->id);
                    $updateArr = ['estatusPago' => 1];
                    $event  = ciclo::where($where)->update($updateArr);
                    $titulo='titulo mensaje';
                    $mensaje='Texto del mensaje a enviar';
                    $pago=$comisiones;
                    Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=4000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=4000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos>=2){
                if($comunidad==1){
                    $comisiones=2000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=12000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=12000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
        }
        if($ciclo->idMatriz==3){
            if($directos==0){
                if($comunidad==1){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=0;  
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos==1){
                if($comunidad==1){
                    $comisiones=10000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=10000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=10000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos>=2){
                if($comunidad==1){
                    $comisiones=5000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=30000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=30000;  
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
        }
    
        if($ciclo->idMatriz==4){
            if($directos==0){
                if($comunidad==1){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos==1){
                if($comunidad==1){
                    $comisiones=25000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=25000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=25000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos>=2){
                if($comunidad==1){
                    $comisiones=25000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=75000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=75000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
        }

        if($ciclo->idMatriz==5){
            if($directos==0){
                if($comunidad==1){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=0;  
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=0; 
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos==1){
                if($comunidad==1){
                    $comisiones=50000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=50000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=50000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos>=2){
                if($comunidad==1){
                    $comisiones=50000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=150000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=150000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
        }

        if($ciclo->idMatriz==6){
            if($directos==0){
                if($comunidad==1){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=0;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=0; 
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos==1){
                if($comunidad==1){
                    $comisiones=100000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,    
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=100000; 
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=100000;  
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
            if($directos>=2){
                if($comunidad==1){
                    $comisiones=300000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==2){
                    $comisiones=300000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
                if($comunidad==3){
                    $comisiones=300000;
                    $pagos= PagosUsuarios::create([
                        'user_id'=>$ciclo->idUser,
                            'ciclo_id'=>$ciclo->id,
                            'matriz_id'=>$ciclo->idMatriz,
                            'comunidad'=>$comunidad,
                            'comisiones'=>$comisiones,
                            'estatus'=>0
                        ]);
                        $where = array('id' => $ciclo->id);
                        $updateArr = ['estatusPago' => 1];
                        $event  = ciclo::where($where)->update($updateArr);
                        $titulo='titulo mensaje';
                        $mensaje='Texto del mensaje a enviar';
                        $pago=$comisiones;
                        Mail::to($user->email)->send(new CompletasteTuComunidad($titulo,$mensaje,$pago,$user));
                }
            }
        }








    }
}
//}












   
}



public function edita()
{
    if(Auth::check()){
        $pais=pais::all();
        $usuarios=User::where('id','!=',Auth::user()->id)->get();
        $estados=estados::where('idPais',1)->get();
        $usuarioCambiar=DB::table('users')
                    ->join('beneficiarios', 'beneficiarios.idUser', '=', 'users.id')
                    ->join('infbancos', 'infbancos.idUser', '=', 'users.id')
                    ->select( 'users.id','users.nombre','users.nickname','users.apellidoPaterno','users.apellidoMaterno','users.calle','users.numero','users.email','users.colonia','users.codigoPostal','users.idEstado','users.idMunicipio','users.telefono','users.rfc','users.curp','users.padre','beneficiarios.nombre AS nombreben','beneficiarios.celular','beneficiarios.email AS correo','beneficiarios.parentesco' ,'infbancos.nombre AS banco','infbancos.noCuenta','infbancos.tarjeta','infbancos.clabe','users.codigo')
                    ->where('users.id','=',Auth::user()->id)
                    ->get();
        $patrocinador = User::where('id',$usuarioCambiar[0]->padre)->First(['id','nombre','apellidoPaterno','apellidoMaterno']);

        $municipios=municipios::where('idEstado',$usuarioCambiar[0]->idEstado)->get();

        return view('asociado.edita',['pais'=>$pais,'usuarios'=>$usuarios,'user'=>$usuarioCambiar[0],'estados'=>$estados,'municipios'=>$municipios,'patrocinador'=>$patrocinador]);
    }
}
public function editar()
{
    if(Auth::check()){
    $pais=pais::all();
    $usuarios=User::where('id','!=',Auth::user()->id)->get();
    $estados=estados::where('idPais',1)->get();
    $usuarioCambiar=DB::table('users')
                    ->join('beneficiarios', 'beneficiarios.idUser', '=', 'users.id')
                    ->join('infbancos', 'infbancos.idUser', '=', 'users.id')
                    ->select( 'users.id','users.nombre','users.nickname','users.apellidoPaterno','users.apellidoMaterno','users.calle','users.numero','users.email','users.colonia','users.codigoPostal','users.idEstado','users.idMunicipio','users.telefono','users.rfc','users.curp','users.padre','beneficiarios.nombre AS nombreben','beneficiarios.celular','beneficiarios.email AS correo','beneficiarios.parentesco' ,'infbancos.nombre AS banco','infbancos.noCuenta','infbancos.tarjeta','infbancos.clabe','users.codigo')
                    ->where('users.id','=',Auth::user()->id)
                    ->get();
    $patrocinador = User::where('id',$usuarioCambiar[0]->padre)->First(['id','nombre','apellidoPaterno','apellidoMaterno']);

    $municipios=municipios::where('idEstado',$usuarioCambiar[0]->idEstado)->get();
    return view('master.edita',['pais'=>$pais,'usuarios'=>$usuarios,'user'=>$usuarioCambiar[0],'estados'=>$estados,'municipios'=>$municipios,'patrocinador'=>$patrocinador]);
}}

public function guarda(Request $request)
    {    if(Auth::check()){
        $input = $request->all();
        $id=$input['idUser'];
     
        if($input['idUser']==''){
            $id=Auth::user()->id;
        }
        $user=User::where('id','=',$id)->first();
        $user->nombre = $input['nombre'];
        $user->nickname = $input['nickname'];
        if($input['password'] != ""){
            $user->password =  bcrypt( $input['password']);    
        }
        $user->apellidoPaterno = $input['apepaterno'];
        $user->apellidoMaterno = $input['apematerno'];
        $user->calle = $input['calle'];
        $user->numero = $input['numero'];
        $user->colonia = $input['colonia'];
        $user->codigoPostal = $input['cp'];
        $user->idEstado = $input['estado'];
        $user->idMunicipio = $input['municipio'];
        $user->telefono = $input['telefono'];
        $user->rfc = $input['rfc'];
        $user->curp = $input['curp'];
        #$user->padre = $input['directo'];
        $user->save();
        $banco=infoBancos::where('idUser','=',$input['idUser'])->first();
        $banco->nombre = $input['banco'];
        $banco->noCuenta =$input['cuenta'];
        $banco->tarjeta = $input['tarjeta'];
        $banco->clabe = $input['clabe'];
        $banco->save();
        $beneficiario = beneficiarios::where('idUser','=',$input['idUser'])->first();
        $beneficiario->nombre = $input['nombreben'];
        $beneficiario->celular = $input['telefonoben'];
        $beneficiario->email = $input['emailben'];
        $beneficiario->parentesco = $input['parentesco'];
        $beneficiario->save();
       // dd($input);
        return redirect()->back()->with('status','Actualizado');
    }
    }
}