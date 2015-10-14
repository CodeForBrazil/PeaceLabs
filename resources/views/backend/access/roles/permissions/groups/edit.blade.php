@extends ('backend.layouts.master')

@section ('title', trans('menus.permission_management') . ' | ' . trans('menus.edit_permission_group'))

@section('page-header')
    <h1>
        {{ trans('menus.permission_management') }}
        <small>{{ trans('menus.edit_permission_group') }}</small>
    </h1>
@endsection

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li>{!! link_to_route('admin.access.users.index', trans('menus.user_management')) !!}</li>
    <li>{!! link_to_route('admin.access.roles.permissions.index', trans('menus.permission_management')) !!}</li>
    <li class="active">{!! link_to_route('admin.access.roles.permission-group.edit', trans('menus.edit_permission_group'), $group->id) !!}</li>
@stop

@section('content')

    @include('backend.access.includes.partials.header-buttons')

    {!! Form::model($group, ['route' => ['admin.access.roles.permission-group.update', $group->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch']) !!}

    <div class="form-group">
        {!! Form::label('name', trans('validation.attributes.permission_group_name'), ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.permission_group_name')]) !!}
        </div>
    </div><!--form control-->

    <div class="well">
        <div class="pull-left">
            <a href="{!! route('admin.access.roles.permissions.index') !!}" class="btn btn-danger btn-xs">{{ trans('strings.cancel_button') }}</a>
        </div>

        <div class="pull-right">
            <input type="submit" class="btn btn-success btn-xs" value="{{ trans('strings.save_button') }}" />
        </div>
        <div class="clearfix"></div>
    </div><!--well-->

    {!! Form::close() !!}
@stop