@extends('layouts.app', ['activePage' => 'horarios', 'titlePage' => __('Horarios')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('horarios.create')}}" class="btn btn-sm btn-primary">Agregar</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Horarios</h4>
                        <p class="card-category">Horarios Registrados</p>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <!-- cerrar alert despues de 3 segundos -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ session('status') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                
                                <thead class="text-primary text-center">
                                    <tr>
                                        <th rowspan="2">ID</th>
                                        <th colspan="2">MAÑANA</th>
                                        <th colspan="2">TARDE</th>
                                        <th rowspan="2">ESTADO</th>
                                    </tr>
                                    <tr>
                                        <th>HORA ENTRADA</th>
                                        <th>HORA SALIDA</th>
                                        <th>HORA ENTRADA</th>
                                        <th>HORA SALIDA</th>
                                    </tr>
                                    <tr>

                                    </tr>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $contador = 1;
                                    @endphp
                                    @foreach ( $horarios as $horario )
                                    <tr>
                                        <td class="tex-left">{{ $horario->id_horario }}</td>
                                        <td class="text-center">{{ $horario->hora_entrada_m }}</td>
                                        <td class="text-center">{{ $horario->hora_salida_m }}</td>
                                        <td class="text-center">{{ $horario->hora_entrada_t }}</td>
                                        <td class="text-center">{{ $horario->hora_salida_t }}</td>

                                        @if ($contador == 1)
                                        <td class="text-center"><span class="badge badge-pill badge-info">Activo</span></td>
                                        @endif
                                        @php
                                            $contador++;
                                        @endphp
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>
@endsection