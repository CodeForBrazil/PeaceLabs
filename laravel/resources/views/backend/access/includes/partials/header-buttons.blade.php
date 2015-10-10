    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              {{ trans('menus.header_buttons.users.button') }} <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.access.users.index')}}">{{ trans('menus.header_buttons.users.all') }}</a></li>

            @permission('create-users')
                <li><a href="{{route('admin.access.users.create')}}">{{ trans('menus.create_user') }}</a></li>
            @endauth

            <li class="divider"></li>
            <li><a href="{{route('admin.access.users.deactivated')}}">{{ trans('menus.deactivated_users') }}</a></li>
            <li><a href="{{route('admin.access.users.banned')}}">{{ trans('menus.banned_users') }}</a></li>
            <li><a href="{{route('admin.access.users.deleted')}}">{{ trans('menus.deleted_users') }}</a></li>
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              {{ trans('menus.header_buttons.roles.button') }} <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.access.roles.index')}}">{{ trans('menus.header_buttons.roles.all') }}</a></li>

            @permission('create-roles')
                <li><a href="{{route('admin.access.roles.create')}}">{{ trans('menus.create_role') }}</a></li>
            @endauth
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              {{ trans('menus.header_buttons.permissions.button') }} <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">

            @permission('create-permission-groups')
                <li><a href="{{route('admin.access.roles.permission-group.create')}}">{{ trans('menus.create_permission_group') }}</a></li>
            @endauth

            @permission('create-permissions')
                <li><a href="{{route('admin.access.roles.permissions.create')}}">{{ trans('menus.create_permission') }}</a></li>
            @endauth

            @permissions(['create-permission-groups', 'create-permissions'])
                <li class="divider"></li>
            @endauth

            <li><a href="{{route('admin.access.roles.permissions.index')}}">{{ trans('menus.header_buttons.permissions.all') }}</a></li>
            <li><a href="{{route('admin.access.roles.permissions.index')}}">{{ trans('menus.header_buttons.permissions.groups.all') }}</a></li>
          </ul>
        </div>
    </div>

    <div class="clearfix"></div>