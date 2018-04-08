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
							<form action=" {{ url('/consumo')}}" method="POST" id="formulario" class="">
								{{csrf_field()}}
								<div class="input-group">
									<input type="text" name="codigo" class="form-control" placeholder="ingrese codigo..." maxlength="10" minlength="6" required="required" autofocus="autofocus">
									<span class="input-group-btn">
										<button class="btn btn-default"> Buscar</button>
									</span>
								</div>
							</form>
							<br>
							@if (@$estudiante)
								<label>Código universitario: </label> {{$estudiante->codigo }}<br>
								<label>Dni:  </label> {{$estudiante->dni }}<br>
								<label>Nombres: </label> {{$estudiante->nombre }}<br>
								<label>Apellidos: </label> {{$estudiante->apellido }}<br>
								
								<label>Carrera: </label> {{$estudiante->escuela->nombre }}<br>
								
							@endif
							
							@include('partials.mensajes')
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Resumen de atención</strong></div>
					<div class="panel-body">
						<table class="table table-bordered table-condensed table-striped">
							<thead>
								<tr>
								<th>Carrera</th>
								<th>Atendidos</th>
							</tr>	
							</thead>
							<tbody>
								@foreach ($escuelas as $escuela)
									<tr>
										<td>{{$escuela->nombre }}</td>
										<td>{{$escuela->estudiantes_count }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>	
	</div>
	</body>
</html>	