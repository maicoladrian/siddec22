@extends('layouts.app', ['activePage' => 'asistencias', 'titlePage' => __('Registrar Asistencia')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('asistencias.store') }}" autocomplete="off" class="form-horizontal">
                    @csrf

                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Asistencia') }}</h4>
                            <p class="card-category">{{ __('Informacion del Asistencia') }}</p>
                        </div>
                        <div class="card-body ">
                            <!-- option de la tabla personales -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Personal') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('asistencia_id_personal') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('asistencia_id_personal') ? ' is-invalid' : '' }}" name="asistencia_id_personal" id="input-asistencia_id_personal" required autofocus>
                                            <option>Selecione al personal</option>
                                            @foreach($personales as $personal)
                                            <option value="{{ $personal->id_personal }}" {{ old('id_personal') == $personal->id_personal ? 'selected' : '' }}>{{ $personal->informacion->ap_paterno }} {{ $personal->informacion->ap_materno }} {{ $personal->informacion->nombres }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_personal'))
                                        <span id="asistencia_id_personal-error" class="error text-danger" for="input-asistencia_id_personal">{{ $errors->first('asistencia_id_personal') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- fecha tipo date -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Fecha') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('fecha') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" name="fecha" id="input-fecha" type="date" placeholder="{{ __('Fecha') }}" value="{{ old('fecha') }}" required />
                                        @if ($errors->has('fecha'))
                                        <span id="fecha-error" class="error text-danger" for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- hora tipo time -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Hora') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('hora') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('hora') ? ' is-invalid' : '' }}" name="hora" id="input-hora" type="time" placeholder="{{ __('Hora') }}" value="{{ old('hora') }}" required />
                                        @if ($errors->has('hora'))
                                        <span id="hora-error" class="error text-danger" for="input-hora">{{ $errors->first('hora') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- option asistencia_id_horario de horarios -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Horario') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('asistencia_id_horario') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('asistencia_id_horario') ? ' is-invalid' : '' }}" name="asistencia_id_horario" id="input-asistencia_id_horario" required>
                                            <option>Seleccione el horario</option>
                                            @php
                                                $contador = 0;
                                            @endphp
                                            @foreach($horarios as $horario)
                                                @if ($contador == 0)
                                                    <option value="{{ $horario->id_horario }}" {{ old('id_horario') == $horario->id_horario ? 'selected' : '' }} selected>{{ $horario->hora_entrada_m }} - {{ $horario->hora_salida_m}}</option>
                                                @else
                                                    <option value="{{ $horario->id_horario }}" {{ old('id_horario') == $horario->id_horario ? 'selected' : '' }}>{{ $horario->hora_entrada_m }} - {{ $horario->hora_salida_m}}</option>
                                                @endif
                                                @php
                                                    $contador++;
                                                @endphp
                                            @endforeach
                                        </select>
                                        @if ($errors->has('asistencia_id_horario'))
                                        <span id="asistencia_id_horario-error" class="error text-danger" for="input-asistencia_id_horario">{{ $errors->first('asistencia_id_horario') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- motivo tipo textarea -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Motivo') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('motivo') ? ' has-danger' : '' }}">
                                        <textarea class="form-control{{ $errors->has('motivo') ? ' is-invalid' : '' }}" name="motivo" id="input-motivo" rows="5" placeholder="{{ __('Motivo') }}" value="{{ old('motivo') }}"></textarea>
                                        @if ($errors->has('motivo'))
                                        <span id="motivo-error" class="error text-danger" for="input-motivo">{{ $errors->first('motivo') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            

                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<script>
    // varibale para codigo_control
    var cod = ["", "", ""];

    // Capturar el evento del input de ap_paterno
    var ap_paterno = document.getElementById('input-ap_paterno');
    ap_paterno.addEventListener('keyup', function(e) {
        // capturar el valor del input
        var ap_paterno = document.getElementById('input-ap_paterno').value;
        // capturamos el primer caracter del input
        var ap_paterno_1 = ap_paterno.charAt(0);
        console.log(ap_paterno_1);

        cod[0] = ap_paterno_1;
        escribirCOD();
    });
    // Capturar el evento del input de ap_materno
    var ap_materno = document.getElementById('input-ap_materno');
    ap_materno.addEventListener('keyup', function(e) {
        // capturar el valor del input
        var ap_materno = document.getElementById('input-ap_materno').value;
        // capturamos el primer caracter del input
        var ap_materno_1 = ap_materno.charAt(0);

        cod[1] = ap_materno_1;
        escribirCOD();
    });
    // Capturar el evento del input de nombres
    var nombres = document.getElementById('input-nombres');
    nombres.addEventListener('keyup', function(e) {
        // capturar el valor del input
        var nombres = document.getElementById('input-nombres').value;
        // capturamos el primer caracter del input
        var nombres_1 = nombres.charAt(0);

        cod[2] = nombres_1;
        escribirCOD();
    });

    // funcion para pasar cod a codigo_control
    function escribirCOD() {
        // capturamos codigo_control
        var codigo_control = document.getElementById('input-codigo_control');
        // escribimos la variable cod en el input
        codigo_control.value = this.cod.join("");
    }
</script>
@endsection