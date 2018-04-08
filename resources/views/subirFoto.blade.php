<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Document</title>
	    <link href="{{asset('css/app.css')}}" rel='stylesheet' type='text/css' />
	</head>
	<body>
	<br>
	<div class="container-fluid">	
		<div class="row">
			<div class="col-sm-6 col-sm-push-3 ">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">	<strong>Registro de atención {{date('d-m-Y')}}</strong> </div>
						<div class="panel-body">
							<form action=" {{ url('/subirFoto')}}" method="POST" id="formulario" class="" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="input-group">
									<input type="file" name="archivo" class="form-control"   required="required" >
									<span class="input-group-btn">
										<button class="btn btn-primary"> Subir foto</button>
									</span>
								</div>
							</form>
							<br>
							
							
							@include('partials.mensajes')
					</div>
				</div>
				<div class="panel-body">
					<h3>fotos</h3>
					<img src="{{ asset('archivos/fotos/baka_cole.jpg') }}" alt="">
				</div>
				
			</div>
		</div>	
	</div>
	</body>
</html>	