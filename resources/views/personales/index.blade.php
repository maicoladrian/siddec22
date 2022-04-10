@extends('layouts.app', ['activePage' => 'personales', 'titlePage' => __('Personal')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('personales.create')}}" class="btn btn-sm btn-primary">Agregar</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Personal</h4>
                        <p class="card-category">Personal Registrados</p>
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
                                    <th>Nombre Completo</th>
                                    <th>Cargo</th>
                                    <th>Codigo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ( $personales as $personal )
                                    <tr>
                                        <td>{{ $personal->id_personal }}</td>
                                        <td>{{ $personal->informacion->nombres }} {{ $personal->informacion->ap_paterno }} {{ $personal->informacion->ap_materno }}</td>
                                        <td>{{ $personal->cargo->descripcion_cargo}}</td>
                                        <td>{{ $personal->codigo_control }}</td>
                                        <td>
                                            @if ( $personal->condicion_personal == 1 )
                                            <span class="badge badge-pill badge-success">Activo</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('personales.edit', $personal->id_personal) }}" class="btn btn-primary btn-sm">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form action="{{ route('personales.destroy', $personal->id_personal) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                @if($personal->condicion_personal)
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="material-icons">delete</i></button>
                                                @else
                                                <button class="btn btn-success btn-sm" type="submit"><i class="material-icons">check</i></button>
                                                @endif
                                            </form>
                                        </td>

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