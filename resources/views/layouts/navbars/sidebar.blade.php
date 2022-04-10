<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo container">
    <a href="{{ route('home') }}" class="logo-normal">
      
      <img src="{{ asset('material')}}/img/logo-ddech.png" class="mx-auto d-block" alt="SIDDEC" style="width: 20%;">
      <div class="text-center">
        <span> <b>S.I.D.D.E.C</b></span>
      </div>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      

      <!-- personal - cargos -->
      <li class="nav-item {{ ($activePage == 'cargos' || $activePage == 'personales') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#personales" aria-expanded="false">
        <i class="material-icons text-info">person_pin</i>
          <p>{{ __('Personal') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'cargos' || $activePage == 'personales') ? ' show' : '' }}" id="personales">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'cargos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('cargos.index') }}">
                <span class="sidebar-mini"> CA </span>
                <span class="sidebar-normal">{{ __('Cargos') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'personales' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('personales.index') }}">
                <span class="sidebar-mini"> PE </span>
                <span class="sidebar-normal"> {{ __('Personal') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- horarios - asistencias -->
      <li class="nav-item {{ ($activePage == 'horarios' || $activePage == 'asistencias') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#asistencias" aria-expanded="false">
        <i class="material-icons text-warning">event_note</i>
          <p>{{ __('Asistencias') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'horarios' || $activePage == 'asistencias') ? ' show' : '' }}" id="asistencias">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'horarios' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('horarios.index') }}">
                <span class="sidebar-mini"> HO </span>
                <span class="sidebar-normal">{{ __('Horarios') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'asistencias' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('asistencias.index') }}">
                <span class="sidebar-mini"> AS </span>
                <span class="sidebar-normal"> {{ __('Asistencias') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notificaciones') }}</p>
        </a>
      </li> -->
      <li class="nav-item{{ $activePage == 'cerrar' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i> <span class="material-icons">logout</span> </i><p>{{ __('Cerrar sesion') }}</p></a>
        </a>
      </li>
      
      
    </ul>
  </div>
</div>
