<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subir excel</title>
</head>
<body>
<center>
	@include('parcial.mensajes');
	<h2>Registar Estudiantes desde Excel</h2>
		<form action="{{ url('subirExcel') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<label><strong>Seleccione archivo Excel</strong></label><br>
			<input type="file" name="archivo"><br><br>
			<button>Subir Excel</button>
		</form>
</center>
	
</body>
</html>