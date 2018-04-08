@extends('layouts.backTemplate')

 @section('content')
 

<div class="container-fluid">
    
	<div class="row">
			<div class="col-md-6">
		<div class="card-box">
			
			<h4 class="m-t-0 header-title">Registro de Beneficiarios ({{ Session::get('nombre_semestre') }}) </h4>
			
			<p class="text-muted font-13 m-b-10">
                Your awesome text goes here.
            </p>
          <div class="row">
					<div class="col-md-12">

							<form action=" {{ url('beneficiario/registrar')}}" method="GET" id="formulario" class="form-inline m-b-10">
								<div class="row">
									<div class="col-md-12">
										<a href="{{ url('/beneficiario') }}" class=" btn btn-default btn-sm"><i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> Volver</a>	
										<div class="input-group pull-right">
											<input type="text" name="codigo" class="form-control input-sm " value="{{old('codigo',@$codigo)  }}" placeholder="ingrese codigo universitario o Nº Dni" maxlength="10" minlength="6" required="required" autofocus="autofocus">
											<span class="input-group-btn">
												<button class="btn btn-default input-sm "><i class="fa fa-search "></i> Buscar</button>
											</span>
										</div>
										
									</div>	
								</div>
							</form>
							@if (@$estudiante)
								 <div class="panel panel-default">
								 	<div class="panel-heading">
								 		Datos de estudiante
								 	</div>	
								 	<div class="panel-body">
								 		<form  class=" formulario" method="POST" action="{{ url('beneficiario/registrar') }}" id="formulario"> 
				                  
				                  			{{ csrf_field() }}
				                      <div class="row"> 
				                            <div class="col-md-7">
				                            	<div class="form-group">
				                            	<label>Escuela</label>
				                            	 <input type="text" class="form-control input-sm" value="{{ old('nombre_escuela',@$estudiante->escuela->nombre) }}" readonly="readonly" name="nombre_escuela" id="nombre_escuela">
				                            </div>	
				                            </div>
				                            <div class="col-md-5">
				                            	<div class="form-group">
				                            	<label>Código</label>
				                            	<input type="text" class="form-control input-sm" value="{{ old('codigo_universitario',@$estudiante->codigo_universitario) }}" readonly="readonly" name="codigo_universitario" id="codigo_universitario">

				                            </div>	
				                            </div>
				                            
				        
				                      </div>
				                       
				                      <div class="row">
				                           <div class="col-md-7">
				                               
				                                <div class="form-group">
				                                	 <label class=" control-label ">Apellidos</label>
				                                    <input type="text" class="form-control input-sm" value="{{ old('apellidos',@$estudiante->apellidos) }}" readonly="readonly" name="apellidos" id="apellidos">
				                                </div>
				                            </div>
				                            
				                     
				                        <div class="col-md-5">
				                               
				                                <div class="form-group">
				                                	 <label class=" control-label">Nombres</label>
				                                    <input type="text"  class="form-control input-sm" value="{{ old('nombres',@$estudiante->nombres) }}" name="nombres"  readonly="readonly"  required="required">
				                                </div>
				                            </div>  
				                      </div>
				                      <div class="row">
				                      
				                      
				                        <div class="form-group">
				                                <label class="col-md-2 control-label">Tipo </label>
				                                <div class="col-md-9">
				                                	<label class="checkbox-inline">
													 <input type="radio" id="radioRegular" name="tipo"  value="Regular" @if(old('tipo') == "Regular" || old('tipo')== null ) checked="checked" @endif   /> Regular
													</label>
													<label class="checkbox-inline">
													 <input type="radio" id="radioBecado" name="tipo"  value="Becado" @if(old('tipo') == "Becado") checked="checked" @endif   /> Becado
													</label>
				                                </div>

				                            </div> 

				                      </div>
				                       <div class=" alert-danger">{{ @$errors->first('tipo') }}</div> 
				                      <div class="row">
				                        <div class="col-md-12">
				                         	
				                         	<div class="form-group">
				                         		<label class="control-label " > Opservaciones </label>
				                         		<textarea class="form-control"  name="observacion" rows="3" >{{ old('observacion')}}</textarea>	
				                         	</div>
				                         	      
				                         </div>  
				                      </div>
				                         <div class=" alert-danger ">{{ @$errors->first('opservacion') }}</div>
				                     
				                   
				                  <div class="modal-footer"> 
				                       <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button> 
				                          <button  class="btn btn-primary btn-sm" id="btnGuardar">Guardar</button> 
				                     
				                  </div> 
				                </form>
								 	</div>
								 </div>
								
							@endif
							
							
					
				
             
					</div>
					
				</div><!--row-->        
				
		</div>
			</div>
			<div class="col-md-6 ">
				<div class="card-box">
					
					<h4 class="m-t-0 header-title">Historial</h4>
					
					<p class="text-muted font-13 m-b-10">
		                Your awesome text goes here.
		            </p>
		               
						
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

