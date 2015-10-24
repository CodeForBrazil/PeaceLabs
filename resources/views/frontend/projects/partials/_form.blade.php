<div class="form-group">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name') !!}
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug') !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Descrição:') !!}
    {!! Form::textarea('description') !!}
</div>
<div class="form-group">
    {!! Form::label('profile', 'Imagem de perfil:') !!}
    {!! Form::text('profile') !!}
</div>
<div class="form-group">
    {!! Form::label('cover', 'Imagem da capa:') !!}
    {!! Form::text('cover') !!}
</div>
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>
 
