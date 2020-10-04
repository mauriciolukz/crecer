<?php

namespace App\Http\Controllers;

use App\pais;
use App\User;
use App\ciclo;
use App\nodos;

use App\matriz;
use App\estados;
use App\infoBancos;

use App\municipios;

use App\beneficiarios;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use App\Http\Requests\registro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\genericController;

class ArbolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ver()
    {
    	return view('ver');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$usuario=User::where('id','=',Auth::user()->id)->first();
        $ciclos=ciclo::where('idUser','=',$usuario->id)
                       ->where('idMatriz','=',1)
                       ->get();
        $Matrices=ciclo::select('idMatriz')
                       ->where('idUser','=',$usuario->id)
                       ->distinct('idMatriz')
                       ->get();
        $userss=app(\App\Http\Controllers\genericController::class)->traeArbol($usuario,1);
        
        return view('master.matriz.ver',['users'=>$userss,'ciclos'=>$ciclos,'id'=>$usuario->id,'matrices'=>$Matrices]);
    }
    
    /*
    * Los nodos hijos(o usuarios que son "patrocinados")
    * de $usuario pasan a ser nodos hijos del padre de $usuario.
    * @param  App\User $usuario
    * @return bool
    */
    public function reorganizaArbolUsuario(User $usuario)
    {
        $nodo_reorganizado = FALSE;
        try {
            $padre        = User::findOrFail($usuario->padre);

            $nodo_usuario = nodos::where('idUser', $usuario->id)->firstOrFail();
            $nodo_padre   = nodos::where('idUser', $padre->id)->firstOrFail();

            $hijo_izq     = $nodo_usuario->idIzquierda ? User::findOrFail($nodo_usuario->idIzquierda) : null;
            $hijo_der     = $nodo_usuario->idDerecha   ? User::findOrFail($nodo_usuario->idDerecha)   : null;

            $nodo_hijo_izq = $hijo_izq ? nodos::where('idUser', $hijo_izq->id)->firstOrFail() : null;
            $nodo_hijo_der = $hijo_der ? nodos::where('idUser', $hijo_der->id)->firstOrFail() : null;

        }catch(\Exception $e){
            log::info("1-error obteniendo nodos de usuario. Error: ".$e->getMessage());
            return(FALSE);
        }

        try {
            $nodo_reorganizado = $this->reorganizaNodo($usuario, $nodo_usuario, $nodo_padre, $nodo_hijo_izq, $nodo_hijo_der);
        }catch(\Exception $e){
            log::info("2-error reorganizando nodos de usuario. Error: ".$e->getMessage());
            return(FALSE);
        }

        return($nodo_reorganizado);
    }

    public function reorganizaNodo(User $usuario, nodos $nodo, nodos $nodo_padre, nodos $nodo_hijo_izq=null, nodos $nodo_hijo_der=null)
    {
        try{
            // $nodo es el hijo izquierdo del padre
            if($this->esHijoIzquierda($nodo_padre, $nodo)){
                //$nodo no tiene hijos
                if(!$this->nodoTieneHijos($nodo)){
                    if($this->nodoTieneHijoDerecha($nodo_padre)){
                        // cambia el hijo derecha de $nodo_padre y ocupa la posicion en el arbol de $nodo
                        $nodo_padre->idIzquierda = $nodo_padre->idDerecha;
                        $nodo_padre->idDerecha   = null;
                        if(!$nodo_padre->save()){
                            log::info("error1");
                            return(FALSE);
                            //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                        }
                    }
                    // No se debe reorganizar mas

                    if(!$nodo->delete()){
                        log::info("error2");
                        return(FALSE);
                        //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                    }
                }else{
                    // $nodo tiene hijos
                    if($this->nodoTieneHijoIzquierda($nodo)){
                        // sube el hijo izq de $nodo y ocupa su posicion en el arbol
                        $usuario_hijo_izq        = User::findOrFail($nodo_hijo_izq->idUser);
                        $nodo_padre->idIzquierda = $nodo_hijo_izq->id;
                        $nodo_hijo_izq->idArriba = $nodo->idArriba;
                        $usuario_hijo_izq->padre = $usuario->padre;
                        
                        //si el nodo tambien tiene hijo derecho 
                        if($this->nodoTieneHijoDerecha($nodo)){
                            // hijo derecho de $nodo pasa a ser hijo izquierdo de $nodo_hijo_izq
                            $usuario_hijo_der           = User::findOrFail($nodo_hijo_der->idUser);
                            $nodo_hijo_izq->idIzquierda = $nodo_hijo_der->id;
                            $nodo_hijo_der->idArriba    = $nodo_hijo_izq->id;
                            $usuario_hijo_der->padre    = $usuario_hijo_izq->id;
                            if(! ($nodo_hijo_der->save() AND $usuario_hijo_der->save()) ){
                                log::info("error3");
                                return(FALSE);
                                //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                            }
                        }
                        //guarda
                        if(!($nodo->delete() AND 
                            $nodo_padre->save() AND 
                            $nodo_hijo_izq->save() AND 
                            $usuario_hijo_izq->save()) ){

                            log::info("error4");
                            return(FALSE);
                            //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                        }
                    }else{
                        if($this->nodoTieneHijoDerecha($nodo)){
                            // sube el hijo derecha de $nodo y ocupa su posicion en el arbol
                            $usuario_hijo_der        = User::findOrFail($nodo_hijo_der->idUser);
                            $nodo_padre->idIzquierda = $nodo_hijo_der->id;
                            $nodo_hijo_der->idArriba = $nodo_padre->id;
                            $usuario_hijo_der->padre = $usuario->padre;

                            if(! ($nodo_hijo_der->save() AND $usuario_hijo_der->save()) ){
                                log::info("error5");
                                return(FALSE);
                                //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                            }
                        }
                        //guarda
                        if(!($nodo->delete() AND $nodo_padre->save()) ){
                                log::info("error6");
                                return(FALSE);
                                //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                        }
                    }
                }
            }else{
                // $nodo es el hijo derecho del padre
                if($this->esHijoDerecha($nodo_padre, $nodo)){
                    //$nodo no tiene hijos
                    if(!$this->nodoTieneHijos($nodo)){
                        // No se debe reorganizar mas
                        $nodo_padre->idDerecha = NULL;

                        if( !($nodo->delete() AND $nodo_padre->save()) ){
                            log::info("error7");
                            return(FALSE);
                            throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                        }
                    }else{
                        // $nodo tiene hijos
                        if($this->nodoTieneHijoIzquierda($nodo)){
                            // sube el hijo izq de $nodo y ocupa su posicion en el arbol
                            $usuario_hijo_izq        = User::findOrFail($nodo_hijo_izq->idUser);
                            $nodo_padre->idDerecha   = $nodo_hijo_izq->id;
                            $nodo_hijo_izq->idArriba = $nodo->idArriba;
                            $usuario_hijo_izq->padre = $usuario->padre;
                            
                            //si el nodo tambien tiene hijo derecho 
                            if($this->nodoTieneHijoDerecha($nodo)){
                                // hijo derecho de $nodo pasa a ser hijo izquierdo de $nodo_hijo_izq
                                $usuario_hijo_der           = User::findOrFail($nodo_hijo_der->idUser);
                                $nodo_hijo_izq->idIzquierda = $nodo_hijo_der->id;
                                $nodo_hijo_der->idArriba    = $nodo_hijo_izq->id;
                                $usuario_hijo_der->padre    = $usuario_hijo_izq->id;
                                if(! ($nodo_hijo_der->save() AND $usuario_hijo_der->save()) ){
                                    log::info("error8");
                                    return(FALSE);
                                    //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                                }
                            }
                            
                            $usuario->estatus  = 0;

                            //guarda
                            if(!($nodo->delete() AND 
                                $nodo_padre->save() AND 
                                $nodo_hijo_izq->save() AND 
                                $usuario_hijo_izq->save()) ){
                            
                                    log::info("error4");
                                    return(FALSE);
                                    //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                            }
                        }else{
                            if($this->nodoTieneHijoDerecha($nodo)){
                                // sube el hijo derecho de $nodo y ocupa su posicion en el arbol
                                $usuario_hijo_der        = User::findOrFail($nodo_hijo_der->idUser);
                                $nodo_padre->idDerecha   = $nodo_hijo_der->id;
                                $nodo_hijo_der->idArriba = $nodo_padre->id;
                                $usuario_hijo_der->padre = $usuario->padre;
                                if(! ($nodo_hijo_der->save() AND $usuario_hijo_der->save()) ){
                                    log::info("error8");
                                    return(FALSE);
                                    //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                                }
                            }
                            $usuario->estatus  = 0;

                            //guarda
                            if(!($nodo->delete() AND $nodo_padre->save() ) ){
                                    log::info("error9");
                                    return(FALSE);
                                    //throw new \Exception("Error, no se pudieron guardar los cambios", 1);
                            }
                        }
                    }
                }else{
                    log::info("error10");
                    return(FALSE);
                    // errror, usuario no es ni hijo izquiero ni derecho
                    //throw new \Exception("Error, usuario no es hijo del padre al que apunta", 1);
                }
            }
        }catch(\Exception $e){
            $h = new Handler(app());
            log::info("error reorganizando nodo. Error: ".$e->getMessage().". Stack: ".$h->report($e));
            return(FALSE);
        }
        return(TRUE);
    }

    public function nodoTieneHijos(nodos $nodo)
    {
        if($this->nodoTieneHijoIzquierda($nodo) OR $this->nodoTieneHijoDerecha($nodo)){
            //nodo tiene al menos un hijo
            return(TRUE);
        }
        // nodo es una hoja, no tiene hijos
        return(FALSE);
    }

    public function nodoTieneHijoIzquierda(nodos $nodo)
    {
        //hijo izquierda
        if($nodo->IdIzquierda){
            return(TRUE);
        }
        // hijo izquierda es nulo, por tanto el nodo no tiene hijo izquierda
        return(FALSE);
    }

    public function nodoTieneHijoDerecha(nodos $nodo)
    {
        if($nodo->IdDerecha){
            return(TRUE);
        }
        // hijo derecha son nulos, por tanto el nodo no tiene hijo derecha
        return(FALSE);
    }

    //verifica si $nodo_usuario es hijo de la izquierda de $nodo
    public function esHijoIzquierda(nodos $nodo_padre, nodos $nodo){
        if($nodo_padre->idIzquierda == $nodo->id){
            return(TRUE);
        }
        return(FALSE);
    }

    //verifica si $nodo_usuario es hijo de la derecha de $nodo
    public function esHijoDerecha(nodos $nodo_padre, nodos $nodo){
        if($nodo_padre->idDerecha == $nodo->id){
            return(TRUE);
        }
        return(FALSE);
    }

    //mueve $nodo_hijo a la derecha de $nodo_padre
    public function mueveNodoDerechaPadre(nodos $nodo_padre, nodos $nodo_hijo)
    {
        //NO se verifica si $nodo_padre tiene hijo derecha
        $nodo_padre->idDerecha = $nodo_hijo->id;
        $nodo_hijo->idArriba     = $nodo_padre->id;
        if($nodo_hijo->save() AND $nodo_padre->save()){
            return(TRUE);
        }
        return(FALSE);
    }

    //mueve $nodo_hijo a la izquierda de $nodo_padre
    public function mueveNodoIzquierdaPadre(nodos $nodo_padre, nodos $nodo_hijo)
    {
        //NO se verifica si $nodo_padre tiene hijo izquierda
        $nodo_padre->idIzquierda = $nodo_hijo->id;
        $nodo_hijo->idArriba       = $nodo_padre->id;
        if($nodo_hijo->save() AND $nodo_padre->save()){
            return(TRUE);
        }
        return(FALSE);
    }

}
