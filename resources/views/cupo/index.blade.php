@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
 <div class="row">
		
  <div class="col-md-7">
   
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Cupos asignados por Escuela</b></h4>
      <p class="text-muted font-13 m-b-10">
                Your awesome text goes here.
            </p>
        <div class="table-responsive m-t-10 " >
        
        <table class="table table-striped table-condensed table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre EAP</th>
              <th>Grupo</th>
              <th>Cupos/Servicio</th>  
            
            </tr>
          </thead>
          <tbody id="datos">
            
            @foreach($cuposEscuela as $escuela)
            <tr>
            <td style="width:30px;">{{$escuela->id_escuela}}</td>
            <td >{{$escuela->nombre}}</td>
            <td style="width:50px;">{{$escuela->grupo}}</td>
            <td>
              @foreach ($escuela->cuposprogramados as $cupo)
              
               <li><b>{{ $cupo->cantidad }}</b> {{ $cupo->servicio->descripcion }}   <button type="button"  OnClick="editarCupo('{{ $escuela->nombre}}','{{ $cupo->servicio->descripcion}}','{{  $cupo->id_cupoprogramado }}','{{ $cupo->cantidad }}');" data-toggle='modal' data-target='#modalCrear'  data-toggle="tooltip" data-placement="right" title=" Editar" class="btn btn-xs btn-default"><span class="fa fa-edit fa-lg " ></span></button></li>
            @endforeach
          </td>
            
           
            </tr>
            @endforeach
          </tbody>
          
        </table>
      </div>           
     
    </div>
  </div>	
  <div class="col-md-5 ">
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Cupos Pendientes por EAP</b></h4>
      <p class="text-muted font-13 m-b-10">
                Your awesome text goes here.
            </p>
                 
      <div class="table-responsive m-t-10 " id="tabla">
        
        <table class="table table-striped table-condensed table-bordered">
          <thead>
            <tr>
               <th>Servicio</th>
              <th>ID</th>
              <th>Nombre EAP</th>
              
              <th>Grupo</th>
             
                              
            </tr>
          </thead>
          <tbody id="datos">
            @for ($i = 0; $i <count($escuelas) ; $i++)
            @if (!empty($desayunoNoProgramados[$i]['nombre_servicio']) || !empty($almuerzoNoProgramados[$i]['nombre_servicio']))
                <tr>
                  <td style="width:50px;">
                    @if (!empty($desayunoNoProgramados[$i]['nombre_servicio']))
                       <button data-toggle='modal' data-target='#modalCrear' class="btn btn-default btn-xs" OnClick="crearCupo('{{$escuelas[$i]->id_escuela}}','{{ $escuelas[$i]->nombre}}','1','{{ $desayunoNoProgramados[$i]['nombre_servicio'] }}');" ><i class="fa fa-arrow-circle-left fa-lg text-primary" aria-hidden="true"></i> {{ $desayunoNoProgramados[$i]['nombre_servicio']}} </button> 
                    @endif
                       
                      @if (!empty($almuerzoNoProgramados[$i]['nombre_servicio']))
                       <button href="#"  data-toggle='modal' data-target='#modalCrear' class="btn btn-default btn-xs "  OnClick="crearCupo('{{$escuelas[$i]->id_escuela}}','{{ $escuelas[$i]->nombre}}','2','{{  $almuerzoNoProgramados[$i]['nombre_servicio'] }}');"> <i class="fa fa-arrow-circle-left fa-lg text-success" aria-hidden="true"></i> {{ $almuerzoNoProgramados[$i]['nombre_servicio']}} </button>
                    @endif
                       
                      
                  </td>
                  <td>{{$escuelas[$i]->id_escuela}}</td>
                  <td>{{$escuelas[$i]->nombre}}</td>
                  <td>{{$escuelas[$i]->grupo}}</td> 
                  
              </tr>
            @endif
              
              
            @endfor
            
          </tbody>
          
        </table>
      </div>  
    </div>
  </div>	
							
</div>
    <div class="modal fade formulario" id="modalCrear" data-controls-modal="modalCrear" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
      <div class="modal-dialog modal-md">
        <div class="modal-content">
        
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">Cupos por Escuela</h4> 
                </div> 
               
                <form  class="form-horizontal formulario" method="POST" action="{{ url('') }}" id="formulario"> 
                  <div class="modal-body"> 
                    <li><small>Ingrese la cantidad de cupos q desea asignar a la EAP</small> </li>
                      <div class="row"> 
                        <input type="hidden" name="id_escuela" id="id_escuela">
                        <input type="hidden" name="id_servicio" id="id_servicio">
                        <input type="hidden" name="id_cupoprogramado" id="id_cupoprogramado">
                        <input type="hidden" name="ruta" id="ruta">
                         
                            <div class="form-group">
                                <label class="col-md-2 control-label">Escuela</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm" value="" disabled="disabled" name="nombre_escuela" id="nombre_escuela">
                                </div>
                            </div>
        
                      </div> 
                      <div class="row">
                           <div class="form-group">
                                <label class="col-md-2 control-label">Servicio</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm" value="" disabled="disabled" name="nombre_servicio" id="nombre_servicio">
                                </div>
                            </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                                <label class="col-md-2 control-label">Cantidad</label>
                                <div class="col-md-7">
                                    <input type="number" min="1" class="form-control input-sm" name="cantidad"  placeholder="Ingrese  cantidad de cupos" id="cantidad " autofocus required="required">
                                </div>
                            </div>  
                      </div>
                     
                   </div> 
                  <div class="modal-footer"> 
                       <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button> 
                          <button  class="btn btn-primary btn-sm" id="btnGuardar">Guardar</button> 
                     
                  </div> 
                </form>
         <div id="mensajes" class="m-t-5"></div> 
            </div>

        </div>
    </div><!-- /.modal -->
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
    function recargarPagina(){
      window.location.href='{{ url()->full() }}';
      
      }
      function crearCupo(id_escuela,nombre_escuela,id_servicio,nombre_servicio){

        $("#id_escuela").val(id_escuela);
        $("#id_servicio").val(id_servicio);
        $("#nombre_escuela").val(nombre_escuela);
        $("#nombre_servicio").val(nombre_servicio);
         $('#ruta').val("{{ url('cupoprogramado/insertar') }}");
      }
 function editarCupo(nombre_escuela,nombre_servicio,id_cupoprogramado,cantidad,){
    $("#mensajes").html('');
    $("#nombre_escuela").val(nombre_escuela);
    $("#nombre_servicio").val(nombre_servicio);
    $("[type=number]").val(cantidad);
    $("#id_cupoprogramado").val(id_cupoprogramado);
    $('#ruta').val('{{ url('')}}/cupoprogramado/actualizar');

 }
 
 function pulsar(e) { //funcion para evitar tecla enter
  tecla = (document.all) ? e.keyCode :e.which; 
  return (tecla!=13); 
} 



  $(document).on("submit","#formulario", function(e){
    $('#btnGuardar').attr("disabled", false);//desabilitamos el boton
    e.preventDefault();

     var datos= new FormData($("#formulario")[0]);//esto es para capturar todos los input del formulario

      var route=$("#ruta").val();
    $.ajax({
      url:route,
      headers:{'X-CSRF-TOKEN': "{{csrf_token()}}" },// envio del token
      type:'POST',
      datatype: 'json',
      data: datos,//nombrq q va a recibirl el controllador : nombre de la variable
      //cache: false,//ESTABLECER  FALSE PARA ENVIAR ARCHIVOS VIA AJAX
      contentType: false,//ESTABLECER EN FALSE PARA ENVIARDATOS FORMDATA
      processData: false,
      success: function(respuesta){
        if (respuesta.parametro=='edicion') {
          //  $('#modalCrear').modal('toggle');
           
        }
        
    //recargarPagina();
        //$("#modalCrearAlternativa").modal('toggle');
        msjSuccess(respuesta.mensaje);
        window.setInterval("recargarPagina()",1500);
        $('#btnGuardar').attr("disabled", true);//desabilitamos el boton

      },
      error: function(xhr, textStatus, thrownError){
            var listaErrores='';
                        $.each($.parseJSON(xhr.responseText), function (ind, elem) { 
                   listaErrores +="<li>"+ elem+"</li>"; 
       });
          msjError(listaErrores);
      }

    });
  });

  function msjSuccess(mensaje){
    toastr.success(mensaje,"",{
    "timeOut":10000,
    "progressBar": true,
    "showMethod": "fadeIn",
      "hideMethod": "fadeOut"

  });
 
}
 function msjError(lista){
  $("#mensajes").html("<div class=' alert alert-danger alert-dismissible ' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></button><strong>Mesajes de validacion !!</strong>"+lista+"</div>");
}
 

</script>

@parent

@endsection 