@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
 <div class="row">
	<div class="col-lg-10 col-lg-push-1">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Semestres</b></h4>
			<p class="text-muted font-13 m-b-30">
                Your awesome text goes here.
            </p>
                <div class="row">
					<div class="col-md-6">
						<form class="navbar-form " method="GET" action="{{url('/semestre')}}" >
							{{-- csrf_field() --}}
								
							    <div class="input-group">
								
							      <input type="text" class="form-control  input-sm" name="descripcion" value="{{@$descripcion}}" placeholder="Buscar por nombre  ">
							     <div class="input-group-btn">
								    
							        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-search"></i> Buscar</button>
								  </div>
							      	
							    </div><!-- /input-group -->
									  	 
						  
						 </form>
					</div>
					<div class="col-md-6">
						 <div class="pull-right">
							 		  <a href='javascript:void(0);' onclick="window.open('{{ url('/semestre/registrar') }}', '_blank', 'width=500,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=200,screeny=0');" class="btn btn-primary btn-sm">Registrar</a>	
							 		
							 </div>	
					</div>
					
				</div><!--row-->        
			<div class="table-responsive m-t-10" id="tabla">
				
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Descripción</th>
							<th>Estado</th>	          					          				
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody >
						
						@foreach($semestres as $semestre)
						<tr>
						<td>{{$semestre->id_semestre}}</td>
						<td>{{$semestre->descripcion}}</td>
							
						<td> {!! $variable = ($semestre->estado) ? "<span class='label label-primary'> Abierto <span>" : "<span class='label label-success'> Cerrado<span>"!!} </td>
						<td>
							
							 <a href='javascript:void(0);' onclick="window.open('{{ url('/semestre/'.$semestre->id_semestre.'/editar') }}', '_blank', 'width=500,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=200,screeny=0');" class="btn btn-default btn-xs"> <span class="fa fa-edit"></span> Editar</a>	
						</td>
						</tr>
						@endforeach
					</tbody>
						{{$semestres->appends(Request::only(['descripcion']))->render()}}
				</table>
			</div>	
		</div>
	</div>			
							
</div>

</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		function recargarPagina(){
    	window.location.href='{{ url()->full() }}';
    	
    	}
	</script>
@parent

@endsection 