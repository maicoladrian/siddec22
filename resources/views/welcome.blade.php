@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => '', 'title' => __('S.I.D.D.E.C.')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
      <h2>{{ __('Sistema de Información Dirección Distrital de Educación Chayanta') }} </h2>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('asistencias.guardarAsistencia') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>{{ __('Control de Asistencia') }}</strong></h4>
            <div class="social-line">
              <!-- fecha y hora del servidor -->
              <p class="card-description text-center">
                {{ __('') }} <h4><strong id="hora">00-00-0000 00:00</strong></h4>
              </p>
            </div>
          </div>
          <div class="card-body">

            <p class="card-description text-center">{{ __('Ingrese su Codigo de Control') }}</p>
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <!-- capturar mac de pc en input oculto -->
              @php
                $ip_add = $_SERVER['REMOTE_ADDR'];
              @endphp
              <input id="mac" type="hidden" name="mac" value="{{ $ip_add }}">


              <!-- codigo_control -->

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="codigo_control" class="form-control" placeholder="{{ __('Codigo de control') }}" value="{{ old('codigo_control') }}" autocomplete="nope" style="text-transform: uppercase;" required autofocus>
              </div>
              @if ($errors->has('codigo_control'))
              <div id="codigo_control-error" class="error text-danger pl-3" for="codigo_control" style="display: block;">
                <strong>{{ $errors->first('codigo_control') }}</strong>
              </div>
              @endif
            </div>

          </div>
          <div class="card-footer justify-content-center">
            <!-- enlace para abrir la vista consultar -->
            <a href="{{ route('consultar') }}" class="btn btn-link btn-success">{{ __('Consultar') }}</a>
            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Registrar') }}</button>
          </div>
        </div>
      </form>

      @if (session('status'))
      <!-- cerrar alert despues de 3 segundos -->

      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-{{ (session('status')) == 'El codigo de personal no existe' ? 'danger' : 'success'}}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span>{{ session('status') }}</span>
          </div>
        </div>
      </div>
      @endif

    </div>
  </div>
</div>
<script>

  window.onload = function () {
    muestraReloj();
  }


  // cerrar alert despues de 3 segundos
  window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);


  

  function muestraReloj() {
    let reloj = document.getElementById("hora");
    fetch("{{ route('muestraHora') }}")
      .then(response => response.text())
      .then(data => reloj.innerHTML = data)
  }
  setInterval(muestraReloj, 60000)
</script>
@endsection