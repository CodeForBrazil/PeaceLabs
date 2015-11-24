<div class="form-group">
    {!! Form::label('name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::text('name', NULL, array('class' => 'form-control', 'placeholder' => 'Nome')) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
	    {!! Form::checkbox('completed', 1, false) !!}
	    {!! Form::label('completed', 'Tarefa executada', array('class' => 'control-label')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::textarea('description', NULL, array('class' => 'form-control', 'placeholder' => 'Descrição')) !!}
    </div>
</div>
 
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	    {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
	</div>
</div>
