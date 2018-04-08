@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
 <div class="row">
	<div class="col-lg-10 col-lg-push-1">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Usuarios</b></h4>
			<p class="text-muted font-13 m-b-30">
                Your awesome text goes here.
            </p>
                <div class="row">
					<div class="col-md-6">
						<form class="navbar-form " method="GET" action="{{url('/usuario')}}" >
							    <div class="input-group">
								
							      <input type="text" class="form-control  input-sm" name="nombres" value="{{@$nombres}}" placeholder="Buscar por nombre  ">
							     <div class="input-group-btn">
								    
							        <button class="btn btn-default btn-sm " type="submit"><i class="fa fa-search"></i> Buscar</button>
								  </div>
							      	
							    </div><!-- /input-group -->
						 </form>
					</div>
          <div class="col-md-6">
             <div class="pull-right">
                    <a href="#" class="btn btn-primary btn-sm  " id="btnAbrirModal" data-toggle="modal" data-target="#modalCrear"> Registrar</a>
                  
               </div>
          </div>
					
				</div><!--row-->        
			<div class="table-responsive m-t-10 " id="tabla">
				
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
              <th>ID</th>
							<th>Dni</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Email</th>
              <th>Estado</th>	
              <th>Perfil</th>           					          				
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="datos">
					
						@foreach($usuarios as $usuario)
						<tr>
            <td>{{ $usuario->id_usuario }}</td>  
						<td>{{$usuario->dni}}</td>
						<td>{{$usuario->nombres}}</td>
            <td>{{$usuario->apellidos}}</td>
            <td>{{$usuario->email}}</td>
          
						<td> {!! $variable = ($usuario->estado) ? "<span class='label label-success'> Activo <span>" : "<span class='label label-warning'> Inactivo <span>"!!}</td>
            <td>{{$usuario->perfil->nombre}}</td>
						
						<td>
							
							<a href="#" OnClick="editarUsuario('{{$usuario->id_usuario}}','{{$usuario->dni}}','{{$usuario->nombres}}','{{$usuario->apellidos}}','{{$usuario->email}}','{{$usuario->estado}}','{{$usuario->id_perfil}}');"  class='text-primary' data-toggle='modal' data-target='#modalCrear'><i class='fa fa-edit'></i> Editar</a>
						</td>
						</tr>
						@endforeach
					</tbody>
						{{$usuarios->appends(Request::only(['nombres']))->render()}}
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
                    <h4 class="modal-title">Usiarios</h4> 
                </div> 
               
                <form role="form" class="formUsuario"  method="POST" action=""  id="formUsuario"> 
                  <div class="modal-body"> 
                      <div class="row"> 
                        <input type="hidden" name="id_usuario" id="idUsuario">
                        <input type="hidden" name="ruta" id="ruta">
                          <div class="col-md-5"> 
                              <div class="form-group"> 
                                  <label for="field-1" class="">DNI</label> 
                                  <input type="text" class="form-control " id="dni"  name="dni"  placeholder="Digite Nro. de DNI "> 
                              </div> 
                          </div> 
                           
                      </div> 
                      <div class="row"> 
                       
                          <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-1" class="">Nombres</label> 
                                  <input type="text" class="form-control " id="nombres"  name="nombres" placeholder=" Ingrese Nombres"> 
                              </div> 
                          </div> 
                          <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-2" class="">Apellidos</label> 
                                   <input type="text" class="form-control " id="apellidos"  name="apellidos" placeholder=" Ingrese apellidos"> 
                              </div> 
                          </div> 
                      </div> 
                      <div class="row ">
                         <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-2" class="">E-mail</label> 
                                   <input type="text" class="form-control " id="email"  name="email" placeholder="Ingrese su dirección  de correo electrónico"> 
                              </div> 
                          </div> 
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
                      <div class="row ">
                         <div class="col-md-6"> 
                              <div class="form-group"> 
                                  <label for="field-2" class="">Perfíl</label> 
                                   {!!Form::select('id_perfil',$perfiles,null,['class'=>'form-control ','id'=>'idPerfil'])!!}
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
 function editarUsuario(idUsuario,dni,nombres,apellidos,email,estado,idPerfil){
   $("#mensajes").html('');
   $('#dni').val(dni);//asiganr un valor 
   $('#nombres').val(nombres);//asiganr un valor
   $('#apellidos').val(apellidos);//asiganr un valor
   $('#email').val(email);
   $('#estado').val(estado);
    $('#idPerfil').val(idPerfil);
   $('#ruta').val('{{ url('')}}/usuario/'+idUsuario+'/actualizar');

 }
 
 function actualizarTabla() {
    var route="{{ url('/colacion') }}";
    $.get(route,function(datos){
      $("#tabla").html(datos);
    
    }); 
  }

 $("#btnAbrirModal").click(function(){// cuando click en el boton modal linpie todo lo que este llenado
    $("#mensajes").html('');
      $('#dni').val('');//asiganr un valor 
   $('#nombres').val('');//asiganr un valor
   $('#apellidos').val('');//asiganr un valor
   $('#email').val('');
   $('#estado').val(0);
    $('#perfil').val(0);
    $('#ruta').val("{{ url('usuario/insertar') }}");
 });

  $(document).on("submit",".formUsuario", function(e){

    e.preventDefault();

     var datos= new FormData($("#formUsuario")[0]);//esto es para capturar todos los input del formulario

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
        }
        else{
          	 $('#nombres').val('');
           $('#apellidos').val('');
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