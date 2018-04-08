@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
 <div class="row">
	<div class="col-lg-10 col-lg-push-1">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Estudiantes</b></h4>
			<p class="text-muted font-13 m-b-10">
                Your awesome text goes here.
            </p>
          <div class="row">
					<div class="col-md-6">
						<form class="navbar-form " method="GET" action="{{url('/estudiante')}}" >
							{{-- csrf_field() --}}
								
							    <div class="input-group">
								
							   
                    <div class="form-group  has-feedback">
                    <label class="control-label sr-only" for="inputSuccess5">Hidden label</label>
                    <input type="text" class="form-control input-sm" name="parametro" value="{{ @$parametro }}" placeholder="Nombre,Código,Dni" id="txtbuscar"><span class="fa fa-times limpiarfiltro text-inverse"></span>
                    
                    
                  </div>
                  <div class="input-group-btn">
								    
							        <button class="btn btn-default btn-sm waves-effect waves-light" type="submit"><i class="fa fa-search"></i> Buscar</button>
								  </div>
							      	
							    </div><!-- /input-group -->	  	 
						 </form>
             
					</div>
					<div class="col-md-6">
                <div class="pull-right">
                    <a href="#" class="btn btn-primary btn-sm  " id="btnAbrirModal" data-toggle="modal" data-target="#modalCrearEscuela">Registrar</a>
                  
               </div> 
             </div>
				</div><!--row-->        
			<div class="table-responsive m-t-10 " id="tabla">
				
				<table class="table table-striped table-condensed table-bordered table-hover" id="tablesorter">
					<thead style="cursor:pointer">
						<tr>
              <th>#</th>
							<th><i class="fa fa-sort" aria-hidden="true"></i> Código</th>
							<th><i class="fa fa-sort" aria-hidden="true"></i> Dni</th>
							<th><i class="fa fa-sort" aria-hidden="true"></i> Apellidos</th>
							<th><i class="fa fa-sort" aria-hidden="true"></i> Nombre</th>	          					          				
							<th><i class="fa fa-sort" aria-hidden="true"></i> Escuela</th>
              <th><i class="fa fa-sort" aria-hidden="true"></i> Matriculado</th>
              <th>Opciones</th>
						</tr>
					</thead>
					<tbody >
            @php
              $i=1;
            @endphp
						@foreach($estudiantes as $estudiante)
             
						<tr>
             <td>{{ $i++}}</td>
						<td>{{$estudiante->codigo_universitario}}</td>
						<td>{{$estudiante->dni}}</td>
						<td>{{$estudiante->apellidos}}</td>
						<td>{{$estudiante->nombres}}</td>
            <td>{{$estudiante->escuela->siglas}}</td>
            <td> {!! $variable = ($estudiante->matriculado) ? "<span class='label label-success'> Si <span>" : "<span class='label label-warning'> No <span>"!!}</td>
						<td>
							
							<a href="#" OnClick="editarEstudiante('{{$estudiante->codigo_universitario}}','{{$estudiante->dni}}','{{$estudiante->apellidos}}','{{$estudiante->nombres}}','{{$estudiante->id_escuela}}');"  class='' data-toggle='modal' data-target='#modalCrearEscuela'><i class='fa fa-edit'></i> Editar</a>
						</td>
						</tr>
						@endforeach
					</tbody>
						
				</table>
       
			</div>
      <div class="row">
        <div class="col-md-6">
          <div class="pull-left">
             Mostrando {{ $estudiantes->firstItem()}} a  {{ $estudiantes->lastItem()}} de  {{ $estudiantes->total()}} entradas 
          </div>
         
        </div>
        <div class="col-md-6">
          <div class="pull-right">
             {{$estudiantes->appends(Request::only(['parametro']))->render()}}   
          </div>
        </div>
      </div>
      
		</div>
	</div>			
							
</div>
	
	   <div class="modal fade" id="modalCrearEscuela" data-controls-modal="modalCrearEscuela" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
      <div class="modal-dialog modal-md">
        <div class="modal-content">
        
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button> 
                    <h4 class="modal-title">Registro de estudiante</h4> 
                </div> 
               <div id='cargador'></div>
                <form role="form" class="formEscuela"  method="POST" action=""  id="formEscuela"> 
                  <div class="modal-body"> 
                      <div class="row"> 
                        <input type="hidden" name="id_escuela" id="idEscuela">
                        <input type="hidden" name="ruta" id="ruta">
                          <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-1" class="">Código</label> 
                                  <input type="text" class="form-control " id="codigo"  name="codigo_universitario" placeholder=" Ingrese Código universitario  "> 
                              </div> 
                          </div> 
                          <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-2" class="">Dni</label> 
                                   <input type="text" class="form-control " id="dni"  name="dni" placeholder="Ingrese Dni"> 
                              </div> 
                          </div> 
                      </div>
                      <div class="row"> 
                       
                          <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-1" class="">Apellidos</label> 
                                  <input type="text" class="form-control " id="apellidos"  name="apellidos" placeholder="Ingrese Apellidos"> 
                              </div> 
                          </div> 
                          <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-2" class="">Nombre</label> 
                                   <input type="text" class="form-control " id="nombres"  name="nombres" placeholder=" Ingrese Nombres"> 
                              </div> 
                          </div> 
                      </div> 
                      <div class="row ">
                         <div class="col-md-8">
                           <div class="form-group">
                              
                              <label for="field-1" class="">Escuela académico profesional</label>  
          								    {!!Form::select('id_escuela',$escuelas,null,['class'=>'form-control ','id'=>'escuelas'])!!}	 
                          </div>
                             
                        </div>
                      </div>  
                   </div> 
                  <div class="modal-footer"> 
                       <button  class="btn btn-default btn-sm" data-dismiss="modal" >Cancelar</button> 
                          <button type="submit" class="btn btn-primary btn-sm" id="btnGuardar">Guardar</button> 
                     
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
 function editarEstudiante(codigo,dni,apellidos,nombres,id_escuela){
   $("#codigo").val(codigo)
   $('#dni').val(dni);//asiganr un valor
   $('#apellidos').val(apellidos);//asiganr un valor
   $('#nombres').val(nombres);
   $('#escuelas').val(id_escuela);
   $('#ruta').val('{{ url('')}}/estudiante/'+codigo+'/actualizar');

 }
 
 function actualizarTabla() {
    var route="{{ url('/colacion') }}";
    $.get(route,function(datos){
      $("#tabla").html(datos);
    
    }); 
  }

 $("#btnAbrirModal").click(function(){// cuando click en el boton modal linpie todo lo que este llenado
    $("#codigo").val('')
    $('#dni').val('');//asiganr un valor
    $('#apellidos').val('');//asiganr un valor
    $('#nombres').val('');
    $('#escuela').val('');
    $('#ruta').val("{{ url('estudiante/insertar') }}");
 });

  $(document).on("submit",".formEscuela", function(e){

    e.preventDefault();
       $("#cargador").html("<i class='fa fa-spinner fa-pulse <fa-lg></fa-lg> fa-fw'></i><span class='sr-only'>Loading...</span>");
     var datos= new FormData($("#formEscuela")[0]);//esto es para capturar todos los input del formulario

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
         // $('#modalCrearEscuela').modal('toggle');

         // $('#nombreEscuela').val('');
           //$('#siglasEscuela').val('');
           //$('#grupoEscuela').val('0');
         //  recargarPagina();

        }
        else{
            $("#codigo").val('')
            $('#dni').val('');//asiganr un valor
            $('#apellidos').val('');//asiganr un valor
            $('#nombres').val('');
            $('#escuelas').val('0');

        }
		//recargarPagina();
        //$("#modalCrearAlternativa").modal('toggle');
         $("#cargador").html("");
        msjSuccess(respuesta.mensaje);
      },
      error: function(xhr, textStatus, thrownError){
        $("#cargador").html("");
            var listaErrores='';
                        $.each($.parseJSON(xhr.responseText), function (id, elem) { 
                   listaErrores +="<li>"+ elem+"</li>"; 
                   if(id=="codigo_universitario"){
                    console.log(" error co uni "+elem);
                   }
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
function cargador(){
  $("#cargador").html("<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><span class='sr-only'>Loading...</span>");
 
}
 

</script>
@parent

@endsection 