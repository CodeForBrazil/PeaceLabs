    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" style="border-color: none !important;" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img alt="{{ app_name() }}" src="./public/images/peacelabs-transp.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav brand-left">
            <li><a href="#">Criar</a></li>
            <li><a href="#">Participar</a></li>
            <li>{!! link_to('/', trans('navs.home')) !!}</li>
            <li>{!! link_to('macros', trans('navs.macros')) !!}</li>
          </ul>
          <ul class="nav navbar-nav navbar-right brand-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menus.language-picker.language') }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li>{!! link_to('lang/en', trans('menus.language-picker.langs.en')) !!}</li>
                <li>{!! link_to('lang/es', trans('menus.language-picker.langs.es')) !!}</li>
                <li>{!! link_to('lang/it', trans('menus.language-picker.langs.it')) !!}</li>
                <li>{!! link_to('lang/pt-BR', trans('menus.language-picker.langs.pt-BR')) !!}</li>
                              <li>{!! link_to('lang/ru', trans('menus.language-picker.langs.ru')) !!}</li>
                <li>{!! link_to('lang/sv', trans('menus.language-picker.langs.sv')) !!}</li>
              </ul>
            </li>

            @if (Auth::guest())
              <li>{!! link_to('auth/login', trans('navs.login')) !!}</li>
              <li>{!! link_to('auth/register', trans('navs.register')) !!}</li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li>{!! link_to('dashboard', trans('navs.dashboard')) !!}</li>
                    <li>{!! link_to('auth/password/change', trans('navs.change_password')) !!}</li>

                    @permission('view-backend')
                        <li>{!! link_to_route('backend.dashboard', trans('navs.administration')) !!}</li>
                    @endauth

                  <li>{!! link_to('auth/logout', trans('navs.logout')) !!}</li>
                </ul>
              </li>
            @endif
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
