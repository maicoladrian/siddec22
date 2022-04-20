<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.I.D.D.E.C. - Reporte</title>
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="../public/material/css/bootstrap.min.css">

    {{-- Configuraciones para reporte con encabezado y pie de pagina --}}
    <style>
        /** 
            Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
            puede ser de altura y anchura completas.
         **/
        @page {
            margin: 0cm 1cm;
        }

        /** Defina ahora los márgenes reales de cada página en el PDF **/
        body {
            margin-top: 4cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 0.5cm;
        }

        /** Definir las reglas del encabezado **/
        header {
            position: fixed;
            top: 1cm;
            left: 0cm;
            right: 0cm;
            height: 0cm;
        }

        /** Definir las reglas del pie de página **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
        }
    </style>

</head>

<body>

    <header>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%;" class="text-center"><img src="../public/material/img/escudo_bolivia.jpg" alt=""
                            width="55%"></th>
                    <th class="text-center">
    
                        <h6>CONTROL DE ASISTENCIA</h6>
                        <h6>PERSONAL DE LA DIRECCIÓN DISTRITAL DE EDUCACIÓN CHAYANTA</h6>
                    </th>
                    <th style="width: 15%;" class="text-center"><img src="../public/material/img/logo_dde_pdf.jpg" alt=""
                            width="70%"></th>
                </tr>
            </thead>
        </table>
        <hr>
    </header>
    {{-- <footer>
        
    </footer> --}}

    

    <main>
        <div class="">
        
            @php
            // obtener todas las fechas sin repetir de las asistencias
            $fechas = $asistencias->pluck('fecha')->unique();
            // obtener todos los personales sin repetir de las asistencias
            $id_personales = $asistencias->pluck('asistencia_id_personal')->unique();
            @endphp
    
            {{-- inicio for fechas --}}
            @foreach ($fechas as $key => $fecha)
            <table class="table table-bordered table-sm" style="font-size: xx-small">
                @php
                    $dia = \Carbon\Carbon::parse($fecha)->isoFormat('dddd');
                    $dia = ucwords($dia);
                    $mifecha = \Carbon\Carbon::parse($fecha)->format('d/m/Y');
                @endphp
                <caption style="font-size: xx-small">Dia y fecha: {{ $dia}}, {{ $mifecha}}</caption>
                <thead class="text-center">
                    <tr >
                        <th rowspan="2" style="vertical-align: middle;">NOMBRES Y APELLIDOS</th>
                        <th rowspan="2" style="vertical-align: middle;">CARGO</th>
                        <th colspan="2" style="vertical-align: middle;">MAÑANA</th>
                        <th colspan="2" style="vertical-align: middle;">TARDE</th>
                        <th rowspan="2" style="vertical-align: middle; width: 180px;">ACT/OBS.</th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">H. ENTRADA</th>
                        <th style="vertical-align: middle;">H. SALIDA</th>
                        <th style="vertical-align: middle;">H. ENTRADA</th>
                        <th style="vertical-align: middle;">H. SALIDA</th>
                    </tr>
                </thead>
                
                <tbody>
    
                    {{-- inicio for id_personales --}}
                    @foreach ($id_personales as $id_personal)
                        @php
                            $contador = 0;
                            $turnos = ["entrada_m", "salida_m", "entrada_t", "salida_t"];
                            $personal_cargo = array();
                            $asistencias_del_personal = array();
                            $motivos_personal = array();
                        @endphp
    
                        {{-- inicio for asistencias --}}
                        @foreach ($asistencias as $asistencia)
                            
                                @if ($asistencia->fecha == $fecha && $asistencia->asistencia_id_personal == $id_personal)
                                    
                                    @php
                                    $personal = ucwords(strtolower($asistencia->personal->informacion->nombres.'
                                    '.$asistencia->personal->informacion->ap_paterno.' '.$asistencia->personal->informacion->ap_materno))
                                    @endphp
    
                                    @php
                                        $mi_hora = \Carbon\Carbon::parse($asistencia->hora)->format('H:i');
    
                                        if ($contador == 0){
                                        $personal_cargo[] = $personal;
                                        $personal_cargo[] = $asistencia->personal->cargo->descripcion_cargo;
                                        $asistencias_del_personal[] = $mi_hora;
                                        $motivos_personal[] = $asistencia->motivo;
                                        }
                                        else{
                                        $asistencias_del_personal[] = $mi_hora;
                                        $motivos_personal[] = $asistencia->motivo;
                                        }
                                    @endphp
    
                                    @php
                                        $contador++;
                                    @endphp
                                @endif
                            
                        @endforeach
                        {{-- fin for asistencias --}}
                        @php
                            // contar los registros de personal_cargo
                            $contador_personal_cargo = count($personal_cargo);
                            // contar los registros de asistencias_del_personal
                             $contador_asistencias_del_personal = count($asistencias_del_personal);
                            //  contar los registros de motivos_personal
                            $contador_motivos_personal = count($motivos_personal);
                        @endphp
                        @if ($contador_personal_cargo > 0 && $contador_asistencias_del_personal > 0)
                            <tr>
                                <td>{{ $personal_cargo[0]}}</td>
                                <td class="text-center">{{ $personal_cargo[1]}}</td>
    
                                @php
                                    $e_m = "";  // hora entrada mañana
                                    $s_m = "";  // hora salida mañana
                                    $e_t = "";  // hora entrada tarde
                                    $s_t = "";  // hora salida tarde
                                @endphp
    
                                @foreach ($asistencias_del_personal as $asis)
                                    @if ($contador_asistencias_del_personal >= 4)
                                        {{-- buscamos la hora de entrada de la mañana --}}
                                        @if ($asis < '12:00')
                                            @if ($e_m == "")
                                                @php
                                                    $e_m = $asis;
                                                @endphp
                                            @endif
                                        @else
                                            {{-- buscamos la hora de salida de la mañana y/o entrada de la tarde --}}
                                            @if ($asis >= '12:00' && $asis < '18:00')
                                                @if ($s_m == "")
                                                    @php
                                                        $s_m = $asis;
                                                    @endphp
                                                @else
                                                    @if ($e_t == "")
                                                        @php
                                                            $e_t = $asis;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @else
                                                {{-- buscamos la hora de salida de la tarde --}}
                                                @if ($asis >= '18:00')
                                                    @if ($s_t == "")
                                                        @php
                                                            $s_t = $asis;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        {{-- comprobamos si las asistencias son de la mañana --}}
                                        @if ($asistencias_del_personal[0] < '12:00')
                                            @if ($asis < '12:00')
                                                @if ($e_m == "")
                                                    @php
                                                        $e_m = $asis;
                                                    @endphp
                                                @endif
                                            @else
                                                @php
                                                    $s_m = $asis;
                                                @endphp
                                            @endif
                                        @else
                                            @if ($asis >= '12:00')
                                                @if ($e_t == "")
                                                    @php
                                                        $e_t = $asis;
                                                    @endphp
                                                @else
                                                    @if ($s_t == "")
                                                        @php
                                                            $s_t = $asis;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $e_m}}</td>
                                <td class="text-center">{{ $s_m}}</td>
                                <td class="text-center">{{ $e_t}}</td>
                                <td class="text-center">{{ $s_t}}</td>
                                
    
    
                                @if ($contador_motivos_personal > 0)
                                    <td class="text-center">{{ $motivos_personal[0]}}</td>
                                @else
                                    <td class="text-center"> - </td>                                
                                @endif
                            </tr>
                        @endif
                    @endforeach
                    {{-- fin for id_personales --}}
    
                </tbody>
            </table>
            
            @endforeach
            {{-- fin for fechas --}}
    
        </div>
    </main>



</body>

</html>