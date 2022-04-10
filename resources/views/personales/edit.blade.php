@extends('layouts.app', ['activePage' => 'personales', 'titlePage' => __('Editar Personal')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('personales.update', $personale) }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Personal') }}</h4>
                            <p class="card-category">{{ __('Informacion del Personal') }}</p>
                        </div>
                        <div class="card-body ">
                            <!-- ap_paterno -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Apellido Paterno') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('ap_paterno') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('ap_paterno') ? ' is-invalid' : '' }}" 
                                        name="ap_paterno" id="input-ap_paterno" type="text" placeholder="{{ __('Apellido Paterno') }}" 
                                        value="{{ old('ap_paterno', $personale->informacion->ap_paterno) }}" autofocus />
                                        @if ($errors->has('ap_paterno'))
                                        <span id="ap_paterno-error" class="error text-danger" for="input-ap_paterno">{{ $errors->first('ap_paterno') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- ap_materno -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Apellido Materno') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('ap_materno') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('ap_materno') ? ' is-invalid' : '' }}" autocomplete="nope" 
                                        name="ap_materno" id="input-ap_materno" type="text" placeholder="{{ __('Apellido Materno') }}" 
                                        value="{{ old('ap_materno', $personale->informacion->ap_materno) }}" />
                                        @if ($errors->has('ap_materno'))
                                        <span id="ap_materno-error" class="error text-danger" for="input-ap_materno">{{ $errors->first('ap_materno') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- nombres -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Nombres') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('nombres') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" autocomplete="nope" 
                                        name="nombres" id="input-nombres" type="text" placeholder="{{ __('Nombres') }}" 
                                        value="{{ old('nombres', $personale->informacion->nombres) }}" required />
                                        @if ($errors->has('nombres'))
                                        <span id="nombres-error" class="error text-danger" for="input-nombres">{{ $errors->first('nombres') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- ci -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Cedula de identidad') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('ci') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('ci') ? ' is-invalid' : '' }}" 
                                        name="ci" id="input-ci" type="text" placeholder="{{ __('Cedula de identidad') }}" 
                                        value="{{ old('ci', $personale->informacion->ci) }}" />
                                        @if ($errors->has('ci'))
                                        <span id="ci-error" class="error text-danger" for="input-ci">{{ $errors->first('ci') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- celular -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Celular') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" 
                                        name="celular" id="input-celular" type="text" placeholder="{{ __('Celular') }}" 
                                        value="{{ old('celular', $personale->informacion->celular) }}" />
                                        @if ($errors->has('celular'))
                                        <span id="celular-error" class="error text-danger" for="input-celular">{{ $errors->first('celular') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- codigo_control -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Codigo de control') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('codigo_control') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('codigo_control') ? ' is-invalid' : '' }}" autocomplete="nope" 
                                        name="codigo_control" id="input-codigo_control" type="text" placeholder="{{ __('Codigo de control') }}" 
                                        value="{{ old('codigo_control', $personale->codigo_control) }}" required />
                                        @if ($errors->has('codigo_control'))
                                        <span id="codigo_control-error" class="error text-danger" for="input-codigo_control">{{ $errors->first('codigo_control') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- mac_pc -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Mac de la PC') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('mac_pc') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('mac_pc') ? ' is-invalid' : '' }}" 
                                        name="mac_pc" id="input-mac_pc" type="text" placeholder="{{ __('Mac de la PC') }}" 
                                        value="{{ old('mac_pc', $personale->mac_pc) }}" required />
                                        @if ($errors->has('mac_pc'))
                                        <span id="mac_pc-error" class="error text-danger" for="input-mac_pc">{{ $errors->first('mac_pc') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- personal_id_cargo, option de la tabla cargos -->
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Cargo') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('personal_id_cargo') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('personal_id_cargo') ? ' is-invalid' : '' }}" 
                                        name="personal_id_cargo" id="input-personal_id_cargo" required>
                                            <option value="">{{ __('Seleccione un cargo') }}</option>
                                            @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id_cargo }}" {{ old('personal_id_cargo', $personale->personal_id_cargo) == $cargo->id_cargo ? 'selected' : '' }}>
                                                {{ $cargo->descripcion_cargo }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('personal_id_cargo'))
                                        <span id="personal_id_cargo-error" class="error text-danger" for="input-personal_id_cargo">{{ $errors->first('personal_id_cargo') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            
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