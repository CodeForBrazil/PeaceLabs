<div class="form-group">
    {!! Form::label('name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::text('name', NULL, array('class' => 'form-control', 'placeholder' => 'Nome')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::textarea('description', NULL, array('class' => 'form-control', 'placeholder' => 'Descrição')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('profile', 'Imagem de perfil', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::file('profile', NULL, array('class' => 'form-control', 'placeholder' => 'Imagem de perfil')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('cover', 'Imagem da capa', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::file('cover', NULL, array('class' => 'form-control', 'placeholder' => 'Imagem da capa')) !!}
    </div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	    {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
	</div>
</div>
 
