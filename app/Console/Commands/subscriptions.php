<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\ciclo;
use App\userMatriz;
use App\Subscription;
use App\PagosUsuarios;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificaciónDeTarea;
class subscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:diario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commando que verifica la suscripcion de los usuarios a diario';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $users=User::all();
       foreach($users as $user){
        $id = $user->id; 
        $sub = Subscription::where('id_user','=',$id)->orderBy('id','desc')->first();       
        $where = array('id' => $id);
        $updateArr = ['estatus' => 0];
            $matriz = userMatriz::where('idUser','=',$id)->orderBy('id','desc')->first();
            $amount=150;
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
            if($sub!=''){
        if($sub->created_at->addDays(30)->isPast()){
            $event  = User::where($where)->update($updateArr);
            $titulo='titulo mensaje';
            $mensaje='Texto del mensaje a enviar';
            $pago=$amount;
            Mail::to($user->email)->send(new NotificaciónDeTarea($titulo,$mensaje,$pago,$user));
            }
        }
      }     
      app(\App\Http\Controllers\genericController::class)->crearDispersion();









       
    }
}
