@extends('layouts.app', ['activePage' => 'cargos', 'titlePage' => __('Cargos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('cargos.create')}}" class="btn btn-sm btn-primary">Agregar</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Cargos</h4>
                        <p class="card-category">Cargos Registrados</p>
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
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ( $cargos as $cargo )
                                    <tr>
                                        <td>{{ $cargo->id_cargo }}</td>
                                        <td>{{ $cargo->descripcion_cargo }}</td>
                                        <td>
                                            @if ( $cargo->condicion_cargo == 1 )
                                            <span class="badge badge-pill badge-success">Activo</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('cargos.edit', $cargo->id_cargo) }}" class="btn btn-primary btn-sm">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form action="{{ route('cargos.destroy', $cargo->id_cargo) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                @if($cargo->condicion_cargo)
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