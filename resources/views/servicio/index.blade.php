@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
 <div class="row">
	<div class="col-lg-10 col-lg-push-1">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Servicios</b></h4>
			<p class="text-muted font-13 m-b-30">
                Your awesome text goes here.
            </p>
                <div class="row">
					<div class="col-md-6">
						<form class="navbar-form " method="GET" action="{{url('/servicio')}}" >
							    <div class="input-group">
								
							      <input type="text" class="form-control  input-sm" name="descripcion" value="{{@$descripcion}}" placeholder="Buscar por nombre  ">
							     <div class="input-group-btn">
								    
							        <button class="btn btn-default btn-sm " type="submit"><i class="fa fa-search"></i> Buscar</button>
								  </div>
							      	
							    </div><!-- /input-group -->
						 </form>
					</div>
          <div class="col-md-6">
             <div class="pull-right">
                    <!--a href="#" class="btn btn-primary btn-sm  " id="btnAbrirModal" data-toggle="modal" data-target="#modalCrear"> Registrar</a-->
                  
               </div>
          </div>
					
				</div><!--row-->        
			<div class="table-responsive m-t-10 " id="tabla">
				
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Descripcion</th>
							<th>Precio</th>
							<th>Estado</th>	          					          				
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="datos">
					
						@foreach($servicios as $servicio)
						<tr>
						<td>{{$servicio->id_servicio}}</td>
						<td>{{$servicio->descripcion}}</td>
            <td><b>S/.</b>{{$servicio->precio}}</td>

						<td> {!! $variable = ($servicio->estado) ? "<span class='label label-primary'> Activo <span>" : "<span class='label label-warning'> Inactivo <span>"!!}</td>
						
						<td>
							
							<a href="#" OnClick="editarServicio('{{$servicio->id_servicio}}','{{$servicio->descripcion}}','{{$servicio->precio}}','{{$servicio->estado}}');"  class='text-primary' data-toggle='modal' data-target='#modalCrear'><i class='fa fa-edit'></i> Editar</a>
						</td>
						</tr>
						@endforeach
					</tbody>
						{{$servicios->appends(Request::only(['descripcion']))->render()}}
				</table>
			</div>	
		</div>
	</div>			
							
</div>
	
	   <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
      <div class="modal-dialog modal-md">
        <div class="modal-content">
        
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">Servicio</h4> 
                </div> 
               
                <form role="form" class="fomrServicio"  method="POST" action=""  id="fomrServicio"> 
                  <div class="modal-body"> 
                      <div class="row"> 
                        <input type="hidden" name="id_servicio" id="idServicio">
                        <input type="hidden" name="ruta" id="ruta">
                          <div class="col-md-8"> 
                              <div class="form-group"> 
                                  <label for="field-1" class="">Descripcion</label> 
                                  <input type="text" class="form-control " id="descripcion"  name="descripcion" placeholder=" "> 
                              </div> 
                          </div> 
                          <div class="col-md-4"> 
                              <div class="form-group"> 
                                  <label for="field-2" class="">Precio</label> 
                                   <input type="text" class="form-control " id="precio"  name="precio" placeholder=" "> 
                              </div> 
                          </div> 
                      </div> 
                      <div class="row ">
                         <div class="col-md-6">
                           <div class="form-group">
                              
                              <label for="field-1" class="">Estado</label>  
                             	@php
									$estados=['0'=>'Inactivo','1'=>'Activo'];
								@endphp
								{!!Form::select('estado',$estados,null,['class'=>'form-control ','id'=>'estado'])!!}	 
					                             

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
 function editarServicio(idServicio,descripcion,precio,estado){
   $("#mensajes").html('');
   $('#idServicio').val(idServicio);//asiganr un valor
   $('#descripcion').val(descripcion);//asiganr un valor
   $('#precio').val(precio);
   $('#estado').val(estado);
   $('#ruta').val('{{ url('')}}/servicio/'+idServicio+'/actualizar');

 }
 
 function actualizarTabla() {
    var route="{{ url('/colacion') }}";
    $.get(route,function(datos){
      $("#tabla").html(datos);
    
    }); 
  }

 $("#btnAbrirModal").click(function(){// cuando click en el boton modal linpie todo lo que este llenado
    $("#mensajes").html('');
    $('#descripcion').val('');
    $('#precio').val('');
    $('#estado').val('0');
    $('#ruta').val("{{ url('escuela/insertar') }}");
 });

  $(document).on("submit",".fomrServicio", function(e){

    e.preventDefault();

     var datos= new FormData($("#fomrServicio")[0]);//esto es para capturar todos los input del formulario

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
          $('#modalCrear').modal('toggle');

          $('#descripcion').val('');
           $('#precio').val('');
           $('#estado').val('0');

        }
        else{
          	 $('#descripcion').val('');
           $('#precio').val('');
           $('#estado').val('0');


        }
		
        //$("#modalCrearAlternativa").modal('toggle');
        msjSuccess(respuesta.mensaje);
        recargarPagina();
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

  })
}
 function msjError(lista){
  $("#mensajes").html("<div class=' alert alert-danger alert-dismissible ' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></button><strong>Mesajes de validacion !!</strong>"+lista+"</div>");
}
 

</script>
@parent

@endsection 