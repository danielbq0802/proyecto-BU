<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <title>SIAACU</title> 
  
 
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	  <link href="{{asset('css/app.css?nocache=')}}" rel='stylesheet' type='text/css' >
	 
	   <link href="{{asset('css/icons.css')}}" rel='stylesheet' type='text/css' >
	    <link href="{{asset('css/core.css?nocache=')}}" rel='stylesheet' type='text/css' >
	     <link href="{{asset('css/toastr.min.css?nocache=')}}" rel='stylesheet' type='text/css' >

	   
    
<style type="text/css">
	/*body { padding-top: 70px; }*/

</style>
  </head>
  <body>
  	<nav class="navbar navbar-default ">
  	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{ url('/panel') }}">SIAACU</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <!--li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li-->
	        
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>Admin. C.U <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="{{ url('/semestre') }}">Semestre-periodo</a></li>
	            <li><a href="{{ url('/escuela') }}"> EAP </a></li>
	            <li><a href="{{ url('/servicio') }}">Servicios </a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="{{ url('/cupoprogramado') }}">Cupos por EAP</a></li>
	           
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>Estudiantes <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="{{ url('/estudiante') }}">Registro estudiantes</a></li>
	            <li><a href="#">Matricula estudiantes</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="{{url('/beneficiario')  }}">Registro Beneficiarios</a></li>
	            
	          </ul>
	        </li>
	        
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>Usuarios <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="{{ url('/usuario') }}">Registro usuarios</a></li>
	            <li><a href="#">Perfiles </a></li>
	            </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>Venta<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Mis Datos</a></li>
	           
	            <li role="separator" class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>Consumo<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Mis Datos</a></li>
	           
	            <li role="separator" class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	      </ul>
	     
	      <ul class="nav navbar-nav navbar-right">
	      	 
	      	 <li class=" hidden-xs"><a href="#">Semestre</a> </li>
	      	<form class="navbar-form navbar-left">
		        <div class="form-group">
		           <select class="form-control">
		           	<option value="">2017-I</option>
		           	<option value="">2017-II</option>
		           	<option value="">2018-I</option>
		           </select>
		        </div>
		       
		    </form>
	        
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user fa-lg"></span> {{ Session::get('nombre') }}<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Mis datos	</a></li>
	            <li>  <a href='javascript:void(0);' onclick="window.open('{{ url('/cambiarPassword') }}', '_blank', 'width=650,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=300,screeny=20');" ">Cambiar contraseña </a>	</li>
	            <li role="separator" class="divider"></li>
	            <li><a href="{{ url('/cerrarSesion') }}">Cerrar sesión</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	 <div id="page-wrapper">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-lg-12">
	                
					@yield('content')
	            </div>
	            <!-- /.col-lg-12 -->
	        </div>
	        <!-- /.row -->
	    </div>
	    <!-- /.container-fluid -->
	</div> <!-- jQuery -->
    	
    <script src="{{asset('js/jquery.min.js')}}"></script>
     <script src="{{asset('js/jquery.tablesorter.min.js')}}"></script>
     <script src="{{asset('js/toastr.min.js')}}"></script>
      
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->

   	<script type="text/javascript">
   		$(document).ready(function() 
		    { 
		        $("#tablesorter").tablesorter(); 
		    } 
		); 
		 $(".limpiarfiltro").click(function(){// cuando click en el boton modal linpie todo lo que este llenado
		    $("#txtbuscar").val('')
		  
		   
		 });
		 $(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})

		 	
		
   	</script>
     @include('parcial.mensajeGeneral')
    @section('scripts')
    @show




	
</body>
</html>