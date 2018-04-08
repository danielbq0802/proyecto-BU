<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	  <link href="{{asset('css/app.css')}}" rel='stylesheet' type='text/css' >
	  <link href="{{asset('css/coree.css')}}" rel='stylesheet' type='text/css' >
	   <link href="{{asset('css/icons.css')}}" rel='stylesheet' type='text/css' >
	   <link href="{{asset('css/toastr.min.css')}}" rel='stylesheet' type='text/css' >
</head>
<body>
<div class="container-fluid">
	<h3 class=" text-center"> Registro de semestres</h3>



    
    	<div class="row">
			<div class="col-lg-12">
				@include('parcial.mensajesValidacion') 
				<section class="panel panel-default">
				  	<header class="panel-heading"> <strong>Registrar semestre</strong></header>
						<form class="" action="{{url('/semestre/registrar')}} " method="POST" >
							{{csrf_field() }}
					  		<div class="panel-body">
					  			@include('semestre.formulario')
					  		</div>
					  		<div class="panel-footer text-center">
						  		<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i>Guardar</button>
						  		<!--a href="{{url('semestre')}}" class="btn btn-sm btn-default"><i class="fa fa-close"></i> Cancelar</a-->
						  	
						  		<button type="button" onclick="CerrarPopup();" class="btn btn-default btn-sm" >Cancelar</button>
				  				
						  	</div>
					  	</form>
				  	
				</section> 
					
			</div>
		</div>
    
</div>
	 <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    @include('parcial.mensajeGeneral')
    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript">
    	function CerrarPopup(){
    		window.close();
    		//opener.window

    	}

    </script>
</body>
</html>