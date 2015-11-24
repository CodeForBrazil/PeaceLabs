<div class="navbar navbar-fixed-top alt" data-spy="affix" data-offset-top="1000">
  <div class="container">
    <div class="navbar-header">
      <!--a href="/" class="navbar-brand">Open Brazil</a-->
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li><a href="/">{!! trans('navs.home') !!}</a></li>
        <li><a href="/#projetos">{!! trans('navs.projects') !!}</a></li>
        <li><a href="/#peacelabs">PeaceLabs</a></li>
        <li><a href="/#contato">{!! trans('navs.contact') !!}</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menus.language-picker.language') }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li>{!! link_to('lang/en', trans('menus.language-picker.langs.en')) !!}</li>
            <li>{!! link_to('lang/pt-BR', trans('menus.language-picker.langs.pt-BR')) !!}</li>
          </ul>
        </li-->

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
	</div>
  </div>
</div>
