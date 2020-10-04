<?php

namespace App\Http\Controllers;

use App\pais;
use App\User;
use App\nodos;
use App\matriz;
use App\estados;

use App\infoBancos;

use App\municipios;
use App\userMatriz;

use App\Subscription;

use App\beneficiarios;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use App\Http\Requests\registro;
use App\Mail\emailRecibimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\genericController;

class asociadocontroller extends Controller
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
    {   $sub = subscription::where('id_user','=',Auth::user()->id)->orderBy('id','desc')->first();
        $mat = userMatriz::where('idUser','=',Auth::user()->id)->orderBy('id','desc')->first();
        $matriz = matriz::where('id','=',$mat->idMatriz)->first();
        return view('asociado.index',['user'=>'null','errormail'=>json_encode('null'), 'matriz'=>$matriz,'sub'=>$sub ]);
    }
    public function create()
    {
        $pais=pais::all();
        return view('asociado.create',['pais'=>$pais]);
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
            'padre'=>Auth::user()->id,
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
        return view('asociado.index',['user'=>$user,'errormail'=>json_encode($mensaje)]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reporte() 
    {
        $users= User::where('padre','=',Auth::id())->get();
        $patrocinador = User::where('id','=',Auth::id())->first();  
        $bancos = infoBancos::all();
        $matrices = matriz::all();
        $matrizUsuarios = userMatriz::all();
       /* $users            = null;
        $usuario_matrices = userMatriz::where('idUser', Auth::id())->get();

        //matrices de un usuario
        foreach ($usuario_matrices as $usuario_matriz) {
            $matriz_usuario = matriz::findOrFail($usuario_matriz->idMatriz);

            $usuarios_matriz = userMatriz::where('idMatriz', $usuario_matriz->idMatriz)->get();
            //recorrer los usuarios de una matriz
            foreach ($usuarios_matriz as $um) {
                try {
                    $usuario      = User::findOrFail($um->idUser);
                    $patrocinador = User::where('id','=', $usuario->padre)->first();
                    $banco = DB::table('infbancos')
                            ->select('nombre')
                            ->where('idUser','=',$usuario->id)
                            ->get();
                    if(empty($users)){
                        $users[$usuario->id]['datos'] = $usuario;
                        $users[$usuario->id]['banco'] = $banco[0]->nombre;
                        $users[$usuario->id]['matriz'] = $matriz_usuario->nombre;
                        if($usuario->id != 0){
                            $users[$usuario->id]['patrocinador'] = $patrocinador->nombre." ".$patrocinador->apellidoPaterno." ".$patrocinador->apellidoMaterno;
                        }
                        else {
                            $users[$usuario->id]['patrocinador'] = "";   
                        }
                    } else{
                        if(!array_search($usuario->id, $users)){
                            $users[$usuario->id]['datos'] = $usuario;
                            $users[$usuario->id]['banco'] = $banco[0]->nombre;
                            $users[$usuario->id]['matriz'] = $matriz_usuario->nombre;
                            if($usuario->id != 0){
                                $users[$usuario->id]['patrocinador'] = $patrocinador->nombre." ".$patrocinador->apellidoPaterno." ".$patrocinador->apellidoMaterno;
                            }else{
                                $users[$usuario->id]['patrocinador'] = "";   
                            }
                        }
                    }
                }catch(\Exception $e){
                    log::info("error al obtener usuario. Error: ".$e->getMessage().". Usuario: ".$um);
                    log::info("Se continua el ciclo");
                } 
            }
        }

        return view('asociado.reporte',['usuarios' => $users]);
    }*/
    return view('asociado.reporte',['usuarios' => $users, 'patrocinador' => $patrocinador,'bancos' => $bancos, 'matrices' => $matrices, 'matrizUsuarios' => $matrizUsuarios ]);   
    }    
}
