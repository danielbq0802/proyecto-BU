<div class="form-group row">
	<label class="col-sm-2 control-label">Descripción</label>
	<div class="col-sm-8">
	
	<input type="text" name="descripcion" value="{{ old('descripcion',@$semestre->descripcion) }}" placeholder="20xx-II" class="form-control">
	</div>
	
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label">Estado</label>
	<div class="col-sm-4">
			@php
				$estados=['0'=>'Cerrado','1'=>'Abierto'];
			@endphp
			{!!Form::select('estado',$estados,@$semestre->estado,['class'=>'form-control'])!!}	
	</div>
</div>
