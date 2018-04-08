@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
 <div class="row">
	<div class="col-lg-10 col-lg-push-1">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Beneficiarios ({{ Session::get('nombre_semestre') }})</b></h4>
			<p class="text-muted font-13 m-b-10">
                Your awesome text goes here.
            </p>
          <div class="row">
					<div class="col-md-6">
						<form class="navbar-form " method="GET" action="{{url('/beneficiario')}}" >
													
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
                    <a href="{{ url('beneficiario/registrar') }}" class="btn btn-primary btn-sm  " >Registrar</a>
                  
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
							<th><i class="fa fa-sort" aria-hidden="true"></i> Apellidos y Nombres</th>
              <th><i class="fa fa-sort" aria-hidden="true"></i> Tipo</th> 
              <th><i class="fa fa-sort" aria-hidden="true"></i> Estado</th> 	          					          				
							<th><i class="fa fa-sort" aria-hidden="true"></i> Escuela</th>
            
              <th>Opciones</th>
						</tr>
					</thead>
					<tbody >
            @php
              $i=1;
            @endphp
						@foreach($beneficiarios as $beneficiario)
             
						<tr>
             <td>{{ $i++}}</td>
						<td>{{$beneficiario->codigo_universitario}}</td>
            <td>{{$beneficiario->dni}}</td>
						<td>{{$beneficiario->apellidos}} {{$beneficiario->nombres}}</td>
           
						<td> {{ $beneficiario->tipo }}</td>
              <td> {!! $variable = ($beneficiario->tipo) ? "<span class='label label-success'> Activo <span>" : "<span class='label label-warning'> Suspendido<span>"!!}</td>
            
				
            <td>{{ $beneficiario->siglas }}</td>
            
						<td> <button href="#" OnClick="cargarBeneficiario('{{$beneficiario->id_beneficiario}}','{{$beneficiario->nombres}} {{ $beneficiario->apellidos }}');"  class="btn btn-danger btn-xs" title="Eliminar"  data-toggle="tooltip" data-placement="right" ><i class='fa fa-trash-o fa-lg '></i> </button>

                <button href="#" OnClick="cargarBeneficiario('{{$beneficiario->id_beneficiario}}','{{$beneficiario->nombres}} {{ $beneficiario->apellidos }}');"  class="btn btn-default btn-xs" title="Suspender"  data-toggle="tooltip" data-placement="right" ><i class="fa fa-user-times fa-lg " aria-hidden="true"></i></button>

                <button href="#" OnClick="cargarBeneficiario('{{$beneficiario->id_beneficiario}}','{{$beneficiario->nombres}} {{ $beneficiario->apellidos }}');"  class="btn btn-default btn-xs" title="Editar"  data-toggle="tooltip" data-placement="right" ><i class="fa fa-edit fa-lg " aria-hidden="true"></i></button>

                 <button href="#" OnClick="cargarBeneficiario('{{$beneficiario->id_beneficiario}}','{{$beneficiario->nombres}} {{ $beneficiario->apellidos }}');"  class="btn btn-default btn-xs" title="Ver"  data-toggle="tooltip" data-placement="right" ><i class="fa fa-eye fa-lg " aria-hidden="true"></i></button>
             </td>
						
						</tr>
						@endforeach
					</tbody>
						
				</table>
       
			</div>
      <div class="row">
        <div class="col-md-6">
          <div class="pull-left">
             Mostrando {{ $beneficiarios->firstItem()}} a  {{ $beneficiarios->lastItem()}} de  {{ $beneficiarios->total()}} entradas 
          </div>
         
        </div>
        <div class="col-md-6">
          <div class="pull-right">
             {{$beneficiarios->appends(Request::only(['parametro']))->render()}}   
          </div>
        </div>
      </div>
      
		</div>
	</div>			
							
</div>
	<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">Eliminar Beneficiario</h4> 
                </div> 
               
                <form role="form" class="fomrServicio"  method="POST" action="{{ url('beneficiario/eliminar') }}"  id="formEliminar"> 
                  <div class="modal-body"> 
                    {{ csrf_field() }}
                      <div class="row"> 
                        <input type="hidden" name="id_beneficiario" id="id_beneficiario">
                        
                          
                          <label class="control-label">¿Esta seguro de eliminar  de la lista de beneficiarios a: <b id="nombeBeneficiario" > </b> ?</label>
                          
                      </div> 
                       
                   </div> 
                  <div class="modal-footer"> 
                       <button  type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button> 
                          <button type="button" class="btn btn-danger btn-sm" onclick="eliminarBeneficiario();" id="btnGuardar"> <i class=" fa fa-trash-o fa-lg"></i> Eliminar</button> 

                     
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
 function cargarBeneficiario(id_beneficiario,nombeBeneficiario){
  $('#modalEliminar').modal('toggle');
   $("#id_beneficiario").val(id_beneficiario);
   $("#nombeBeneficiario").text(nombeBeneficiario);
 }
 function eliminarBeneficiario(){
  $("#formEliminar").submit();
 }
 


  

</script>
@parent

@endsection 