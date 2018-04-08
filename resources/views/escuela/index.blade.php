@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
 <div class="row">
	<div class="col-lg-10 col-lg-push-1">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Escuela Academico Profesional</b></h4>
			<p class="text-muted font-13 m-b-30">
                Your awesome text goes here.
            </p>
          <div class="row">
					<div class="col-md-6">
						<form class="navbar-form " method="GET" action="{{url('/escuela')}}" >
							{{-- csrf_field() --}}
								
							    <div class="input-group">
								
							      <input type="text" class="form-control  input-sm" name="nombre" value="{{@$nombre}}" placeholder="Buscar por nombre  ">
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
				
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre EAP</th>
							<th>Siglas EAP</th>
							<th>Grupo</th>	          					          				
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="datos">
						
						@foreach($escuelas as $escuela)
						<tr>
						<td>{{$escuela->id_escuela}}</td>
						<td>{{$escuela->nombre}}</td>
						<td>{{$escuela->siglas}}</td>
						<td>{{$escuela->grupo}}</td>
						<td>
							
							<a href="#" OnClick="editarEscuela('{{$escuela->id_escuela}}','{{$escuela->nombre}}','{{$escuela->siglas}}','{{$escuela->grupo}}');"  class='text-primary' data-toggle='modal' data-target='#modalCrearEscuela'><i class='fa fa-edit'></i> Editar</a>
						</td>
						</tr>
						@endforeach
					</tbody>
						{{$escuelas->appends(Request::only(['nombre']))->render()}}
				</table>
			</div>	
		</div>
	</div>			
							
</div>
	
	   <div class="modal fade" id="modalCrearEscuela" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
      <div class="modal-dialog modal-md">
        <div class="modal-content">
        
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">Escuela</h4> 
                </div> 
               
                <form role="form" class="formEscuela"  method="POST" action=""  id="formEscuela"> 
                  <div class="modal-body"> 
                      <div class="row"> 
                        <input type="hidden" name="id_escuela" id="idEscuela">
                        <input type="hidden" name="ruta" id="ruta">
                          <div class="col-md-8"> 
                              <div class="form-group"> 
                                  <label for="field-1" class="">Nombre escuela</label> 
                                  <input type="text" class="form-control " id="nombreEscuela"  name="nombre" placeholder=" "> 
                              </div> 
                          </div> 
                          <div class="col-md-4"> 
                              <div class="form-group"> 
                                  <label for="field-2" class="">Siglas</label> 
                                   <input type="text" class="form-control " id="siglasEscuela"  name="siglas" placeholder=" "> 
                              </div> 
                          </div> 
                      </div> 
                      <div class="row ">
                         <div class="col-md-6">
                           <div class="form-group">
                              
                              <label for="field-1" class="">Grupo de atencion</label>  
                             	@php
									$grupos=['0'=>'Seleccione','A'=>'A','B'=>'B','C'=>'C'];
								@endphp
								{!!Form::select('grupo',$grupos,null,['class'=>'form-control ','id'=>'grupoEscuela'])!!}	 
					                             

                          </div>
                             
                        </div>
                      </div>  
                   </div> 
                  <div class="modal-footer"> 
                       <button  class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button> 
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
 function editarEscuela(idEscuela,nombreEscuela,siglasEscuela,grupoEscuela){
   $("#mensajes").html('');
   $('#idEscuela').val(idEscuela);//asiganr un valor
   $('#nombreEscuela').val(nombreEscuela);//asiganr un valor
   $('#siglasEscuela').val(siglasEscuela);
   $('#grupoEscuela').val(grupoEscuela);
   $('#ruta').val('{{ url('')}}/escuela/'+idEscuela+'/actualizar');

 }
 
 function actualizarTabla() {
    var route="{{ url('/colacion') }}";
    $.get(route,function(datos){
      $("#tabla").html(datos);
    
    }); 
  }

 $("#btnAbrirModal").click(function(){// cuando click en el boton modal linpie todo lo que este llenado
    $("#mensajes").html('');
    $('#nombreEscuela').val('');
    $('#siglasEscuela').val('');
    $('#grupoEscuela').val('0');
    $('#ruta').val("{{ url('escuela/insertar') }}");
 });

  $(document).on("submit",".formEscuela", function(e){

    e.preventDefault();

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
          $('#modalCrearEscuela').modal('toggle');

          $('#nombreEscuela').val('');
           $('#siglasEscuela').val('');
           $('#grupoEscuela').val('0');

        }
        else{
          	$('#nombreEscuela').val('');
           	$('#siglasEscuela').val('');
           	$('#grupoEscuela').val('0');

        }
		recargarPagina();
        //$("#modalCrearAlternativa").modal('toggle');
        msjSuccess(respuesta.mensaje);
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
 function msjError(lista){
  $("#mensajes").html("<div class=' alert alert-danger alert-dismissible ' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></button><strong>Mesajes de validacion !!</strong>"+lista+"</div>");
}
 

</script>
@parent

@endsection 