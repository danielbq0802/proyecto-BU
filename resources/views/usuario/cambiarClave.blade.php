<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cambiar Contraseña</title>

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	  <link href="{{asset('css/app.css')}}" rel='stylesheet' type='text/css' >
	  <link href="{{asset('css/coree.css')}}" rel='stylesheet' type='text/css' >
	   <link href="{{asset('css/icons.css')}}" rel='stylesheet' type='text/css' >
</head>
<body>
	<div class="m-t-20"></div>
	<div class="container-fluid">
		 <div class="row">
	<div class="col-lg-8 col-lg-push-2">
		<div class="card-box">
			<h4 class="m-t-0 header-title text-center"><b>Cambiara contraseña</b></h4>
			<!--p class="text-muted font-13 m-b-30">
                Your awesome text goes here.
            </p-->
                <div class="row">
					<div class="col-md-12">
						<form class="" action="{{url('/cambiarPassword')}} " method="POST" >
							{{csrf_field() }}
					  		
					  			<div class="form-group row">
									<label class="col-sm-2 control-label">Cntraseña Actual</label>
									<div class="col-sm-10">
									
									<input type="password" name="password" value="{{ old('password') }}" placeholder="Ingrese su contraseña actual" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 control-label">Contraseña Nueva</label>
									<div class="col-sm-10">
									
									<input type="password" name="nuevo_password" value="" placeholder="Ingrese su contraseña actual" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 control-label">Repita contraseña nueva</label>
									<div class="col-sm-10">
									
									<input type="password" name="repetir_nueva" value="" placeholder="Ingrese su contraseña actual" class="form-control">
									</div>
								</div>
								
					  		
					  		<div class="card-box-footer text-center">
						  		<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Guardar</button>
						  			<button type="button" onclick="CerrarPopup();" class="btn btn-default btn-sm" >Cancelar / Cerrar</button>
						  		
						  	</div>
					  	</form>
					  	<div class="m-t-10">
					  		@include('parcial.mensajesValidacion') 
					  	</div>
					  		
					</div>
				</div><!--row-->        
			
		</div>
	</div>				
	</div>
	
							
</div>

	 <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/app.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript">
    	$(document).ready(function() {
    		@if (Session::has('msj-success'))
    			recargarPadre();
    		@endif
    		
    	});
    	function CerrarPopup(){
    		window.close();
    	}
    	function recargarPadre(){
    	 window.opener.recargarPagina(); 
    	}

    </script>
    @include('parcial.mensajeGeneral')
</body>

</html>