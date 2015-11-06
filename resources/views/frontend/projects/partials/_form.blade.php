<div class="form-group">
    {!! Form::label('name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::text('name', NULL, array('class' => 'form-control', 'placeholder' => 'Nome')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::text('slug', NULL, array('class' => 'form-control', 'placeholder' => 'Slug')) !!}
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
	    {!! Form::text('profile', NULL, array('class' => 'form-control', 'placeholder' => 'Imagem de perfil')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('profile', 'Imagem de perfil', array('class' => 'col-sm-2 control-label')) !!}
	<div class="controls col-sm-10">
		<div class="avatar img-preview">
			<img src="<?php echo $user->get_avatar('medium'); ?>" alt="<?php echo $user->get_name(); ?>" class="img-rounded img-responsive">
		</div>
		<span class="btn btn-default btn-file btn-xs">
		    <?php echo lang('app_browse'); ?> 
		    {!! Form::file('profile') !!}
		    <input type="file" id="user-avatar" name="avatar" />
		</span>
		<div class="alert-danger">
			<?php echo form_error('avatar'); ?>
		</div>
	</div>
</div>
<div class="form-group">
    {!! Form::label('cover', 'Imagem da capa', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	    {!! Form::text('cover', NULL, array('class' => 'form-control', 'placeholder' => 'Imagem da capa')) !!}
    </div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	    {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
	</div>
</div>
 
