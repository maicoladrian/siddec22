@extends('layouts.app', ['activePage' => 'asistencias', 'titlePage' => __('Asistencias')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('asistencias.index')}}" method="get" autocomplete="off">
                            <div class="form-row">
                                <div class="col">
                                    <input type="date" class="form-control" name="busqueda" placeholder="Buscar..." value="{{ $busqueda}}">
                                </div>
                                <div class="col">
                                    <input type="submit" class="btn btn-sm btn-primary" value="Buscar">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-4 text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#m">
                            Reporte
                        </button>
                        <a href="{{ route('asistencias.create')}}" class="btn btn-sm btn-primary">Agregar</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Asistencias</h4>
                        <p class="card-category">Asistencias Registrados</p>
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
                                <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>PERSONAL</th>
                                    <th>FECHA Y HORA</th>
                                    <th>MOTIVO</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    <!-- si hay 0 asistencias mostrar mensaje -->
                                    @if($asistencias->count() == 0)
                                    <tr>
                                        <td colspan="8" class="text-center">No hay asistencias registradas</td>
                                    </tr>
                                    @endif
                                    @foreach ( $asistencias as $asistencia )
                                    <tr>
                                        @php
                                        $fecha = \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y');
                                        $hora = \Carbon\Carbon::parse($asistencia->hora)->format('H:i');
                                        @endphp
                                        <td>{{ $asistencia->id_asistencia }}</td>
                                        <td>{{ $asistencia->personal->informacion->nombres }} {{ $asistencia->personal->informacion->ap_paterno }} {{ $asistencia->personal->informacion->ap_materno }}</td>
                                        <td>{{ $fecha }} {{ $hora }}</td>
                                        <td>{{ $asistencia->motivo }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('asistencias.edit', $asistencia->id_asistencia) }}" class="btn btn-primary btn-sm">
                                                <i class="material-icons">edit</i>
                                            </a>

                                        </td>

                                        @endforeach
                                </tbody>
                            </table>
                            {{ $asistencias->links() }}

                            
                            <!-- Modal -->
                            <div class="modal fade text-center" id="m" tabindex="-1" role="dialog" aria-labelledby="ml" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ml">Elija las fechas para obtener el reporte</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('asistencias.reporte')}}" method="post">
                                                @csrf
                                                <div class="form-group" style="padding: 0 0 !important;">
                                                    <label for="fecha_inicio">Fecha Inicio</label>
                                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="fecha_fin">Fecha Fin</label>
                                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" formtarget="_blank">
                                                        Obtener
                                                    </button>

                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- fin modal -->

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