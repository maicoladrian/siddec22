@extends('layouts.app', ['activePage' => 'asistencias', 'titlePage' => __('Editar Asistencia')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('asistencias.update', $asistencia) }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Asistencia') }}</h4>
                            <p class="card-category">{{ __('Informacion del Asistencia') }}</p>
                        </div>
                        <div class="card-body ">
                            <!-- asistencia_id_personal, option de la tabla personales -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Personal') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('asistencia_id_personal') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('asistencia_id_personal') ? ' is-invalid' : '' }}" name="asistencia_id_personal" id="input-asistencia_id_personal" required autofocus>
                                            <option>Selecione al personal</option>
                                            @foreach($personales as $personal)
                                            <option value="{{ $personal->id_personal }}" {{ $personal->id_personal == $asistencia->asistencia_id_personal ? 'selected' : '' }}>{{ $personal->informacion->ap_paterno }} {{ $personal->informacion->ap_materno }} {{ $personal->informacion->nombres }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_personal'))
                                        <span id="asistencia_id_personal-error" class="error text-danger" for="input-asistencia_id_personal">{{ $errors->first('asistencia_id_personal') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- fecha, tipo date -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Fecha') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('fecha') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" name="fecha" id="input-fecha" type="date" placeholder="{{ __('Fecha') }}" value="{{ old('fecha', $asistencia->fecha) }}" required />
                                        @if ($errors->has('fecha'))
                                        <span id="fecha-error" class="error text-danger" for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- hora, tipo time -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Hora') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('hora') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('hora') ? ' is-invalid' : '' }}" name="hora" id="input-hora" type="time" placeholder="{{ __('Hora') }}" value="{{ old('hora', $asistencia->hora) }}" required />
                                        @if ($errors->has('hora'))
                                        <span id="hora-error" class="error text-danger" for="input-hora">{{ $errors->first('hora') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- asistencia_id_horario, option de la tabla horarios -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Horario') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('asistencia_id_horario') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('asistencia_id_horario') ? ' is-invalid' : '' }}" name="asistencia_id_horario" id="input-asistencia_id_horario" required autofocus>
                                            <option>Selecione al horario</option>

                                            @foreach($horarios as $horario)
                                            @php
                                            $entrada_m = \Carbon\Carbon::parse($horario->hora_entrada_m)->format('H:i');
                                            $salida_m = \Carbon\Carbon::parse($horario->hora_salida_m)->format('H:i');
                                            @endphp
                                            <option value="{{ $horario->id_horario }}" {{ $horario->id_horario == $asistencia->asistencia_id_horario ? 'selected' : '' }}>{{ $horario->id_horario}} -> {{ $entrada_m}} - {{ $salida_m}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_horario'))
                                        <span id="asistencia_id_horario-error" class="error text-danger" for="input-asistencia_id_horario">{{ $errors->first('asistencia_id_horario') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- motivo, textarea -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Motivo') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('motivo') ? ' has-danger' : '' }}">
                                        <textarea class="form-control{{ $errors->has('motivo') ? ' is-invalid' : '' }}" style="text-transform: uppercase;" name="motivo" id="input-motivo" type="text" placeholder="{{ __('Motivo') }}" rows="5" />{{ old('motivo', $asistencia->motivo) }}</textarea>
                                        @if ($errors->has('motivo'))
                                        <span id="motivo-error" class="error text-danger" for="input-motivo">{{ $errors->first('motivo') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- mac -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('IP de PC') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('mac') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('mac') ? ' is-invalid' : '' }}" name="mac" id="input-mac" type="text" placeholder="{{ __('IP de PC') }}" value="{{ old('mac', $asistencia->mac) }}" />
                                        @if ($errors->has('mac'))
                                        <span id="mac-error" class="error text-danger" for="input-mac">{{ $errors->first('mac') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </diac de PC

                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-info mr-5">
                                {{ __('Regresar') }}
                            </a>
                            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection