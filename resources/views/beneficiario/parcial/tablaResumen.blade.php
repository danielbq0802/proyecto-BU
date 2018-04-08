<div class="panel panel-default">
	<div class="panel-heading"><strong>Beneficiarios Por escuela</strong></div>
	<div class="panel-body">
		<table class="table table-bordered table-condensed table-striped">
			<thead>
				<tr>
				<th>Carrera</th>
				<th>Beneficiarios</th>
			</tr>	
			</thead>
			<tbody>
				@foreach ($escuelas as $escuela)
					<tr>
						<td>{{$escuela->nombre }}</td>
						<td>{{$escuela->total}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>