@extends('layouts.master')

<script>
    setTimeout(function(){document.getElementById("bronce").click();}, 2500);
</script>
@section('content')
<br>
    <div class="row">
        <!-- Modal -->
        <div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
          <div class="modal-dialog modal-dialog-centered bd-example-modal-sm" role="document">
            <div class="modal-content modal-sm">
              <div class="modal-body">
                    <p><b> ¡¡Ya no hay nodos arriba!!</b></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
              </div>
            </div>
          </div>
        </div>

    <!--Modal 
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Mensualmente</span>
                    <h5>Generado</h5>
                </div>
                <div class="ibox-content">
                    <div class="stat-percent font-bold text-success"><i class="fa fa-dollar"> 0.00 </i></div>
                    <small>Total generado</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Anual</span>
                    <h5>Generado</h5>
                </div>
                <div class="ibox-content">
                    <div class="stat-percent font-bold text-info"><i class="fa fa-dollar"> 0.00 </i></div>
                    <small>Total</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Directos</span>
                    <h5>Invitados semanales</h5>
                </div>
                <div class="ibox-content">
                    <div class="stat-percent font-bold text-navy">0 <i class="fa fa-level-up"></i></div>
                    <small>Inscritos</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Directos</span>
                    <h5>Invitados mensuales</h5>
                </div>
                <div class="ibox-content">
                    <div class="stat-percent font-bold text-navy">0 <i class="fa fa-level-up"></i></div>
                    <small>Inscritos</small>
                </div>
            </div>
        </div>
    </div> fin modal-->

    
        <div class="container-fluid">
            <!-- <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Comunidades</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="form-group">
                            <label class="col-lg-12 control-label">Elige una Comunidad:</label></br></br>
                        </div>
                        <div class="form-group" id="btnComunidades">
                            @foreach($matrices as $matriz)
                                @switch($matriz->idMatriz)
                                    @case(1)
                                        <a href="javascript:void(0);" class="btn btn-block btn-bronce" id="bronce" onclick="javascript:traeCiclos({{ $id }},1); checarCiclo({{$id}},4,1);">Bronce</a>
                                        @break
                                    @case(2)
                                        <a href="javascript:void(0);" class="btn btn-block btn-plata" onclick="javascript:traeCiclos({{ $id }},2); checarCiclo({{$id}},4,1);">Plata</a>
                                        @break
                                    @case(3)
                                        <a href="javascript:void(0);" class="btn btn-block btn-oro" onclick="javascript:traeCiclos({{ $id }},3); checarCiclo({{$id}},4,1);">Oro</a>
                                        @break
                                    @case(4)
                                        <a href="javascript:void(0);" class="btn btn-block btn-platino" onclick="javascript:traeCiclos({{ $id }},4); checarCiclo({{$id}},4,1);">Platino</a>
                                        @break
                                    @case(5)
                                        <a href="javascript:void(0);" class="btn btn-block btn-esmeralda" onclick="javascript:traeCiclos({{ $id }},5); checarCiclo({{$id}},4,1);">Esmeralda</a>
                                        @break
                                    @case(6)
                                        <a href="javascript:void(0);" class="btn btn-block btn-diamante" onclick="javascript:traeCiclos({{ $id }},6); checarCiclo({{$id}},4,1);">Diamante</a>
                                        @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> -->
            <!--seleccion comunidad -->
            <div class="col-lg-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Elige una Comunidad 
                    </div>
                    <div class="panel-body">
                        <div class="form-group" id="btnComunidades">
                            @foreach($matrices as $matriz)
                                @switch($matriz->idMatriz)
                                    @case(1)
                                        <a href="javascript:void(0);" class="btn btn-block btn-bronce" id="bronce" onclick="javascript:traeCiclos({{ $id }},1); checarCiclo({{$id}},4,1);">Bronce</a>
                                        @break
                                    @case(2)
                                        <a href="javascript:void(0);" class="btn btn-block btn-plata" onclick="javascript:traeCiclos({{ $id }},2); checarCiclo({{$id}},4,1);">Plata</a>
                                        @break
                                    @case(3)
                                        <a href="javascript:void(0);" class="btn btn-block btn-oro" onclick="javascript:traeCiclos({{ $id }},3); checarCiclo({{$id}},4,1);">Oro</a>
                                        @break
                                    @case(4)
                                        <a href="javascript:void(0);" class="btn btn-block btn-platino" onclick="javascript:traeCiclos({{ $id }},4); checarCiclo({{$id}},4,1);">Platino</a>
                                        @break
                                    @case(5)
                                        <a href="javascript:void(0);" class="btn btn-block btn-esmeralda" onclick="javascript:traeCiclos({{ $id }},5); checarCiclo({{$id}},4,1);">Esmeralda</a>
                                        @break
                                    @case(6)
                                        <a href="javascript:void(0);" class="btn btn-block btn-diamante" onclick="javascript:traeCiclos({{ $id }},6); checarCiclo({{$id}},4,1);">Diamante</a>
                                        @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- seleccion comunidad-->

            <!-- Acomodo arbol -->
            <div class="col-lg-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Estructura de Comunidad
                    </div>
                    <div class="panel-body">
                        <!-- <div class="chart col-md-5" id="collapsable-example"></div> -->
                        <div id="collapsable-example"></div>
                    </div>
                </div>
            </div>
            <!--fin acomodo Arbol -->

            <!-- Ciclos -->
            <div class="col-lg-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Ciclos
                    </div>
                    <div class="panel-body">
                        <div class="ibox-content">
                            <div class="form-group" id="ciclos">
                                @foreach($ciclos as $value)
                                    @if($loop->last) 
                                    <?php $val=($loop->index)-1; 
                                    if($val<=1){
                                        $p=0;
                                    }else {
                                        $p=$ciclos[$val]->id;
                                    }
                                    ?>                         
                                    <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},4,{{$p}});" id="ciclo" name="b" checked=""> <i></i> Ciclo {{$loop->iteration}} (actual)</label> </br>
                                
                                @else
                                @if($loop->first)
                                        <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},1,0);" id="ciclo" name="b"> <i></i> Ciclo {{$loop->iteration}}</label> </br>
                                        @elseIf($loop->index==1)
                                        <?php $val=($loop->index)-1; ?>
                                        <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},2,{{$ciclos[$val]->id}});" id="ciclo" name="b"> <i></i> Ciclo {{$loop->iteration}}</label> </br>
                                        @elseIf($loop->index>=1) 
                                        <?php $val=($loop->index)-1; ?>
                                        <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},3,{{$ciclos[$val]->id}});" id="ciclo" name="b"> <i></i> Ciclo {{$loop->iteration}}</label> </br>
                                            
                                    @endif
                                        @endif
                                @endforeach
                                </br></br>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--fin ciclos -->

            <!-- <div class="col-lg-2" style="width: 220px !important;">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ciclos</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group" id="ciclos">
                            @foreach($ciclos as $value)
                                @if($loop->last) 
                                <?php $val=($loop->index)-1; 
                                if($val<=1){
                                    $p=0;
                                }else {
                                    $p=$ciclos[$val]->id;
                                }
                                ?>                         
                                <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},4,{{$p}});" id="ciclo" name="b" checked=""> <i></i> Ciclo {{$loop->iteration}} (actual)</label> </br>
                            
                            @else
                            @if($loop->first)
                                    <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},1,0);" id="ciclo" name="b"> <i></i> Ciclo {{$loop->iteration}}</label> </br>
                                    @elseIf($loop->index==1)
                                    <?php $val=($loop->index)-1; ?>
                                    <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},2,{{$ciclos[$val]->id}});" id="ciclo" name="b"> <i></i> Ciclo {{$loop->iteration}}</label> </br>
                                    @elseIf($loop->index>=1) 
                                    <?php $val=($loop->index)-1; ?>
                                    <label> <input class="btn-circle" type="radio" value="{{$value->id}}" onclick="traeArbolCiclo({{$value->id}}); checarCiclo({{$value->id}},3,{{$ciclos[$val]->id}});" id="ciclo" name="b"> <i></i> Ciclo {{$loop->iteration}}</label> </br>
                                        
                                @endif
                                    @endif
                            @endforeach
                            </br></br>   
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-lg-2" id="pagos" style="display: none; width: 350px !important;">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Pagos</h5>
                    </div>
                
                    <div class="ibox-content"  style="border-top: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">
                        <div class="form-group" >
                        <span>Directos <span style="float:right" id="spanDirectos"></span></span><br>
                        <span>Total Aportaciones <span style="float:right" id="spanAportaciones"></span></span><br>
                        <span>Retención <span style="float:right" id="spanRetencion"></span></span><br>
                        <span>Saldo <span style="float:right" id="spanSaldo1"></span></span><br>
                        <span>ISR(25%) <span style="float:right" id="spanIsr"></span></span><br>
                        <span>Saldo <span style="float:right" id="spanSaldo2"></span></span><br>
                        <span>Comisión Bancaria(5%) <span style="float:right"  id="spanComision"></span></span><br>
                    </div>
                    </div>
                    <div class="ibox-content">
                        <span style="font-size: 11px;">Total de comisiones <span style="float:right; font-size: 11px;" id="spanTotal">2</span></span>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-2" id="pagos1" style="width: 350px !important;">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Pagos</h5>
                    </div>
                
                    <div class="ibox-content"  style="border-top: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">
                        <div class="form-group" >
                            <center>
                            <img height="180px" src="{{asset('img/perfil/profile_small.jpg')}}">
                            </center>
                            <br>
                            <center><span class="label label-primary" style="text-align:center">No se ha llenado la comunidad.</span></center>
                    </div>
                    </div>
                    <div class="ibox-content">
                        
                    </div>
                    
                </div>
            </div>
        </div>
    
     
    <script src="{{asset('treant/raphael.js')}}"></script>
    <script src="{{asset('treant/Treant.js')}}"></script>
    <script src="{{asset('treant/jquery.easing.js')}}"></script>
    <script>
        users={!! $users !!}
        userid={!! $id !!}
    </script>
    <script src="{{asset('treant/collapsable.js')}}"></script>
    <script src="{{asset('js/codeSponsor.js')}}"></script>
@endsection