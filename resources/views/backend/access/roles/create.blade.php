@extends ('backend.layouts.master')

@section ('title', trans('menus.role_management') . ' | ' . trans('menus.create_role'))

@section('page-header')
    <h1>
        {{ trans('menus.user_management') }}
        <small>{{ trans('menus.create_role') }}</small>
    </h1>
@endsection

@section('after-styles-end')
    {!! HTML::style('css/backend/plugin/jstree/themes/default/style.min.css') !!}
@stop

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li>{!! link_to_route('admin.access.users.index', trans('menus.user_management')) !!}</li>
    <li>{!! link_to_route('admin.access.roles.index', trans('menus.role_management')) !!}</li>
    <li class="active">{!! link_to_route('admin.access.roles.create', trans('menus.create_role')) !!}</li>
@stop

@section('content')
    @include('backend.access.includes.partials.header-buttons')

    {!! Form::open(['route' => 'admin.access.roles.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role']) !!}

        <div class="form-group">
            {!! Form::label('name', trans('validation.attributes.role_name'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.role_name')]) !!}
            </div>
        </div><!--form control-->

        <div class="form-group">
            <label class="col-lg-2 control-label">{{ trans('validation.attributes.associated_permissions') }}</label>
            <div class="col-lg-10">
                {!! Form::select('associated-permissions', array('all' => 'All', 'custom' => 'Custom'), 'all', ['class' => 'form-control']); !!}

                <div id="available-permissions" class="hidden">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> A permission marked with a <small><strong>(D)</strong></small> means that the permission has dependencies. They will be checked automatically when you select that permission. You can manage each permissions dependencies in the dependency tab of the edit permission screen.
                            </div><!--alert-->
                        </div><!--col-lg-12-->

                        <div class="col-lg-6">
                            <p><strong>Grouped Permissions</strong></p>

                            @if ($groups->count())
                                <div id="permission-tree">
                                    <ul>
                                        @foreach ($groups as $group)
                                            <li>{!! $group->name !!}
                                                @if ($group->permissions->count())
                                                    <ul>
                                                        @foreach ($group->permissions as $permission)
                                                            <li id="{!! $permission->id !!}" data-dependencies="{!! json_encode($permission->dependencies->lists('dependency_id')->all()) !!}">

                                                                @if ($permission->dependencies->count())
                                                                    <?php
                                                                        //Get the dependency list for the tooltip
                                                                        $dependency_list = [];
                                                                        foreach ($permission->dependencies as $dependency)
                                                                            array_push($dependency_list, $dependency->permission->display_name);
                                                                        $dependency_list = implode(", ", $dependency_list);
                                                                    ?>
                                                                    <a data-toggle="tooltip" data-html="true" title="<strong>Dependencies:</strong> {!! $dependency_list !!}">{!! $permission->display_name !!} <small><strong>(D)</strong></small></a>
                                                                @else
                                                                    {!! $permission->display_name !!}
                                                                @endif

                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                @if ($group->children->count())
                                                    <ul>
                                                        @foreach ($group->children as $child)
                                                            <li>{!! $child->name !!}
                                                                @if ($child->permissions->count())
                                                                    <ul> style="padding-left:40px;font-size:.8em">
                                                                        @foreach ($child->permissions as $permission)
                                                                            <li id="{!! $permission->id !!}" data-dependencies="{!! json_encode($permission->dependencies->lists('dependency_id')->all()) !!}">
                                                                                @if ($permission->dependencies->count())
                                                                                    <?php
                                                                                    //Get the dependency list for the tooltip
                                                                                    $dependency_list = [];
                                                                                    foreach ($permission->dependencies as $dependency)
                                                                                        array_push($dependency_list, $dependency->permission->display_name);
                                                                                    $dependency_list = implode(", ", $dependency_list);
                                                                                    ?>
                                                                                    <a data-toggle="tooltip" data-html="true" title="<strong>Dependencies:</strong> {!! $dependency_list !!}">{!! $permission->display_name !!} <small><strong>(D)</strong></small></a>
                                                                                @else
                                                                                    {!! $permission->display_name !!}
                                                                                @endif

                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p>There are no permission groups.</p>
                            @endif
                        </div><!--col-lg-6-->

                        <div class="col-lg-6">
                            <p><strong>Ungrouped Permissions</strong></p>

                            @if ($permissions->count())
                                @foreach ($permissions as $perm)
                                    <input type="checkbox" name="ungrouped[]" data-dependencies="{!! json_encode($perm->dependencies->lists('dependency_id')->all()) !!}" value="{!! $perm->id !!}" id="perm_{!! $perm->id !!}" /> <label for="perm_{!! $perm->id !!}">

                                        @if ($perm->dependencies->count())
                                            <?php
                                            //Get the dependency list for the tooltip
                                            $dependency_list = [];
                                            foreach ($perm->dependencies as $dependency)
                                                array_push($dependency_list, $dependency->permission->display_name);
                                            $dependency_list = implode(", ", $dependency_list);
                                            ?>
                                            <a style="color:black;text-decoration:none;" data-toggle="tooltip" data-html="true" title="<strong>Dependencies:</strong> {!! $dependency_list !!}">{!! $perm->display_name !!} <small><strong>(D)</strong></small></a>
                                        @else
                                            {!! $perm->display_name !!}
                                        @endif

                                    </label><br/>
                                @endforeach
                            @else
                                <p>There are no ungrouped permissions.</p>
                            @endif
                        </div><!--col-lg-6-->
                    </div><!--row-->
                </div><!--available permissions-->
            </div><!--col-lg-3-->
        </div><!--form control-->

        <div class="form-group">
            {!! Form::label('name', trans('validation.attributes.role_sort'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('sort', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.role_sort')]) !!}
            </div>
        </div><!--form control-->

        <div class="well">
            <div class="pull-left">
                <a href="{!! route('admin.access.roles.index') !!}" class="btn btn-danger btn-xs">{{ trans('strings.cancel_button') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('strings.save_button') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!--well-->

        {!! Form::hidden('permissions') !!}
    {!! Form::close() !!}
@stop

@section('after-scripts-end')
    {!! HTML::script('js/backend/plugin/jstree/jstree.min.js') !!}
    {!! HTML::script('js/backend/access/roles/script.js') !!}
@stop