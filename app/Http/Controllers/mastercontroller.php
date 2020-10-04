<?php

namespace App\Http\Controllers;

use App\pais;
use App\User;
use App\Bajas;
use App\nodos;
use App\matriz;
use App\estados;
use App\infoBancos;
use App\municipios;
use App\userMatriz;
use App\beneficiarios;
use Illuminate\Http\Request;
use App\Http\Requests\registro;
use App\Mail\emailRecibimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\genericController;

class mastercontroller extends Controller
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
    public function index()
    {
        return view('master.index',['user'=>'null','errormail'=>json_encode('null')]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pais=pais::all();
        $usuarios=User::all();
        return view('master.create',['pais'=>$pais,'usuarios'=>$usuarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(registro $request)
    {
        $mensaje='null';
        $input = $request->all();
        $user = User::create([
            'nombre'=>$input['nombre'],
            'nickname'=>$input['nickname'],
            'email'=>$input['email'],
            'password'=> bcrypt( $input['password']),
            'apellidoPaterno'=>$input['apepaterno'],
            'apellidoMaterno'=>$input['apematerno'],
            'calle'=>$input['calle'],
            'numero'=>$input['numero'],
            'colonia'=>$input['colonia'],
            'codigoPostal'=>$input['cp'],
            'idEstado'=>$input['estado'],
            'idMunicipio'=>$input['municipio'],
            'telefono'=>$input['telefono'],
            'rfc'=>$input['rfc'],
            'curp'=>$input['curp'],
            'rol'=>2,
            'padre'=>$input['directo'],
            'estatus'=>1
        ]);
        infoBancos::create([
            'nombre' => $input['banco'],
            'noCuenta' => $input['cuenta'],
            'tarjeta' => $input['tarjeta'],
            'clabe' => $input['clabe'],
            'idUser' => $user->id
        ]);
        beneficiarios::create([
            'idUser' => $user->id,
            'nombre' => $input['nombreben'],
            'celular' => $input['telefonoben'],
            'email' => $input['emailben'],
            'parentesco'=>$input['parentesco'],
            'estatus'=> 1
        ]);
        $contenido= new Request;
        $contenido['idUser']=$user->id;
        app(\App\Http\Controllers\genericController::class)->insertaEnMatriz($contenido);
        try{
            Mail::to($input['email'])->send(new emailRecibimiento($user));
        }
        catch(\Exception $e){
            $mensaje="No se pudo enviar la notificación.";
        }
        return view('master.index',['user'=>$user,'errormail'=>json_encode($mensaje)]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guarda(Request $request)
    {
        $input = $request->all();
        $user=User::where('id','=',$input['idUser'])->first();
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
        //$user->padre = $input['directo'];
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

        return redirect( "master/mreporte" )->with('status','Actualizado');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('master.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('master.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edita(Request $request)
    {
        $pais=pais::all();
        $usuarios=User::where('id','!=',$request['id'])->get();
        $estados=estados::where('idPais',1)->get();
        $usuarioCambiar=DB::table('users')
                        ->join('beneficiarios', 'beneficiarios.idUser', '=', 'users.id')
                        ->join('infbancos', 'infbancos.idUser', '=', 'users.id')
                        ->select( 'users.id','users.nombre','users.nickname','users.apellidoPaterno','users.apellidoMaterno','users.calle','users.numero','users.email','users.colonia','users.codigoPostal','users.idEstado','users.idMunicipio','users.telefono','users.rfc','users.curp','users.padre','users.codigo','beneficiarios.nombre AS nombreben','beneficiarios.celular','beneficiarios.email AS correo','beneficiarios.parentesco' ,'infbancos.nombre AS banco','infbancos.noCuenta','infbancos.tarjeta','infbancos.clabe')
                        ->where('users.id','=',$request['id'])
                        ->get(); 
                        $patrocinador = User::where('id',$usuarioCambiar[0]->padre)->First(['id','nombre','apellidoPaterno','apellidoMaterno']);

        $municipios=municipios::where('idEstado',$usuarioCambiar[0]->idEstado)->get();
        return view('master.edita',['pais'=>$pais,'usuarios'=>$usuarios,'user'=>$usuarioCambiar[0],'estados'=>$estados,'municipios'=>$municipios,'patrocinador'=>$patrocinador]);
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mreporte()
    {
        $usuarios=User::select('*')->get();
        $users=null;
        foreach ($usuarios as  $user) {
            $patrocinador= User::where('id','=',$user->padre)->first();
            $banco = DB::table('infbancos')
                     ->select('nombre')
                     ->where('idUser','=',$user->id)
                     ->get();
            $users[$user->id]['datos'] = $user;
            $users[$user->id]['banco'] = $banco[0]->nombre; 
            if($user->id != 0){
                $users[$user->id]['patrocinador'] = $patrocinador->nombre." ".$patrocinador->apellidoPaterno." ".$patrocinador->apellidoMaterno;
            }
            else{
                $users[$user->id]['patrocinador'] = "";   
            }
        }
        $matrices = matriz::all();
        $matrizUsuarios = userMatriz::all();
        
        
        return view('master.mreporte',['usuarios'=>$users,'matrices' => $matrices, 'matrizUsuarios' => $matrizUsuarios]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDeshabilitar()
    {
        // get solo usuarios asociados y que no fueron dados de baja
        $usuarios = User::where('id', '!=', Auth::id())->where('rol','!=', '1')->get();

        foreach ($usuarios as $usuario) {
            if(! Bajas::where('idUser', $usuario->id)->first()){
                $usuarios_habilitados[] = $usuario;
            }
        }

        return view('master.deshabilitar_user', ['usuarios'=> $usuarios_habilitados]);
    }

    /**
     * eliminar un usuario y reogarnizar su arbol
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deshabilitar(Request $request)
    {
        $titulo  = "Usuario dado de baja";
        $mensaje = "El usuario fue dado de baja del sistema.";
        $user    = null;
        $arbol_c = new ArbolController();
        $um_c    = new UserMatrizController();

        DB::beginTransaction();
        try {
            $input = $request->all();
            $user  = User::findOrFail($input['usuario']);

            //deshabilitar usuario
            if(!$arbol_c->reorganizaArbolUsuario($user)){
                $titulo  = "Usuario NO dado de baja";
                $mensaje = "Error. El usuario NO fue dado de baja del sistema.";
                log::info("0-error reorganizando arbol de usuario");
                DB::rollBack();
            }else{
                //remover usuario de las matrices
                if(!$um_c->removerUsuario($user)){
                    $titulo  = "Usuario NO dado de baja";
                    $mensaje = "Error. El usuario NO fue dado de baja del sistema.";
                    log::info("1- error removiendo usuario");
                    DB::rollBack();
                }else{
                    //dar de baja usuario
                    $baja = new Bajas();

                    $baja->idUser = trim($input['usuario']);
                    $baja->motivo = trim($input['motivo']);
                    if(!$baja->save()){
                        $titulo  = "Usuario NO dado de baja";
                        $mensaje = "Error. El usuario NO fue dado de baja del sistema.";
                        log::info("2- error removiendo usuario");
                        DB::rollBack();
                    }
                }
            }
        }catch(\Exception $e){
            $titulo  = "Usuario NO dado de baja";
            $mensaje = "Error. El usuario NO fue dado de baja del sistema.";
            DB::rollBack();
        }
        DB::commit();
        return view('master.usuario_deshabilitado', ['titulo' => $titulo, 'mensaje' => $mensaje]);
    }


}
