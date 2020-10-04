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
use Illuminate\Http\Request;
use App\Http\Requests\registro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\genericController;

class arbolasociadocontroller extends Controller
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
    public function verMatriz()
    {
    	return view('verMatriz');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$usuario  = User::where('id', '=', Auth::user()->id)->first();
        $ciclos   = ciclo::where('idUser', '=', $usuario->id)->where('idMatriz', '=', 1)->get();
        $matrices = ciclo::select('idMatriz')->where('idUser', '=', $usuario->id)->distinct('idMatriz')->get();
        $userss   = app(\App\Http\Controllers\genericController::class)->traeArbol($usuario, 1);
       
        return view('asociado.matriz.verMatriz',
                    [
                        'users'    => $userss,
                        'ciclos'   => $ciclos,
                        'id'       => $usuario->id,
                        'matrices' => $matrices
                    ]
        );
    }
}
