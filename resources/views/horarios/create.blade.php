@extends('layouts.app', ['activePage' => 'horarios', 'titlePage' => __('Registrar Horario')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('horarios.store') }}" autocomplete="off" class="form-horizontal">
                    @csrf

                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Horario') }}</h4>
                            <p class="card-category">{{ __('Informacion del Horario') }}</p>
                        </div>
                        <div class="card-body ">
                            <!-- input de tipo time para hora_entrada_m -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Hora de entrada mañana') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('hora_entrada_m') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('hora_entrada_m') ? ' is-invalid' : '' }}" name="hora_entrada_m" id="input-hora_entrada_m" type="time" placeholder="{{ __('Hora de entrada mañana') }}" value="{{ old('hora_entrada_m') }}" autofocus required="true" aria-required="true" />
                                        @if ($errors->has('hora_entrada_m'))
                                        <span id="hora_entrada_m-error" class="error text-danger" for="input-hora_entrada_m">{{ $errors->first('hora_entrada_m') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- input de tipo time para hora_salida_m -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Hora de salida mañana') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('hora_salida_m') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('hora_salida_m') ? ' is-invalid' : '' }}" name="hora_salida_m" id="input-hora_salida_m" type="time" placeholder="{{ __('Hora de salida mañana') }}" value="{{ old('hora_salida_m') }}" required="true" aria-required="true" />
                                        @if ($errors->has('hora_salida_m'))
                                        <span id="hora_salida_m-error" class="error text-danger" for="input-hora_salida_m">{{ $errors->first('hora_salida_m') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- input de tipo time para hora_entrada_t -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Hora de entrada tarde') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('hora_entrada_t') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('hora_entrada_t') ? ' is-invalid' : '' }}" name="hora_entrada_t" id="input-hora_entrada_t" type="time" placeholder="{{ __('Hora de entrada tarde') }}" value="{{ old('hora_entrada_t') }}" required="true" aria-required="true" />
                                        @if ($errors->has('hora_entrada_t'))
                                        <span id="hora_entrada_t-error" class="error text-danger" for="input-hora_entrada_t">{{ $errors->first('hora_entrada_t') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- input de tipo time para hora_salida_t -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Hora de salida tarde') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('hora_salida_t') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('hora_salida_t') ? ' is-invalid' : '' }}" name="hora_salida_t" id="input-hora_salida_t" type="time" placeholder="{{ __('Hora de salida tarde') }}" value="{{ old('hora_salida_t') }}" required="true" aria-required="true" />
                                        @if ($errors->has('hora_salida_t'))
                                        <span id="hora_salida_t-error" class="error text-danger" for="input-hora_salida_t">{{ $errors->first('hora_salida_t') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- input de tipo date para fecha_horario -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Fecha') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('fecha_horario') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('fecha_horario') ? ' is-invalid' : '' }}" name="fecha_horario" id="input-fecha_horario" type="date" placeholder="{{ __('Fecha') }}" value="{{ old('fecha_horario') }}" required="true" aria-required="true" />
                                        @if ($errors->has('fecha_horario'))
                                        <span id="fecha_horario-error" class="error text-danger" for="input-fecha_horario">{{ $errors->first('fecha_horario') }}</span>
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
@endsection