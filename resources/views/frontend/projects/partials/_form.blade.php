<div class="form-group">
    {!! Form::label('name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::text('name', NULL, array('class' => 'form-control', 'placeholder' => 'Nome')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('status', 'Status do projeto', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::select('status', 
	    			[ 'Brainstorm' => 'Brainstorm' , 
	    			  'Pesquisa' => 'Pesquisa' ,
	    			  'Prototipação' => 'Prototipação' , 
	    			  'Protótipo Navegável' => 'Protótipo Navegável' , 
	    			  'Desenvolvimento' => 'Desenvolvimento' , 
	    			  'Produção' => 'Produção'
	    			 ],
	    			 NULL, array('class' => 'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description_short', 'Descrição curta', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::textarea('description_short', NULL, array('rows' => 2, 'class' => 'form-control', 'placeholder' => 'Descrição curta')) !!}
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
    {!! Form::label('url_1', 'Links para seu projetos', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::text('url_1', NULL, array('class' => 'form-control', 'placeholder' => 'Ex: Landing page, Github, Facebook, Twitter... ')) !!}
	    {!! Form::text('url_2', NULL, array('class' => 'form-control', 'placeholder' => 'Ex: Landing page, Github, Facebook, Twitter... ')) !!}
	    {!! Form::text('url_3', NULL, array('class' => 'form-control', 'placeholder' => 'Ex: Landing page, Github, Facebook, Twitter... ')) !!}
    </div>
</div>



<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	    {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
	</div>
</div>
 
