@extends('layouts.app', ['activePage' => 'cargos', 'titlePage' => __('Editar Cargo')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('cargos.update', $cargo) }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Cargo') }}</h4>
                            <p class="card-category">{{ __('Informacion del Cargo') }}</p>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Descripcion del cargo') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('descripcion_cargo') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('descripcion_cargo') ? ' is-invalid' : '' }}" name="descripcion_cargo" id="input-descripcion_cargo" type="text" placeholder="{{ __('Descripcion del cargo') }}" value="{{ old('descripcion_cargo', $cargo->descripcion_cargo) }}" autofocus required="true" aria-required="true" />
                                        @if ($errors->has('descripcion_cargo'))
                                        <span id="descripcion_cargo-error" class="error text-danger" for="input-descripcion_cargo">{{ $errors->first('descripcion_cargo') }}</span>
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