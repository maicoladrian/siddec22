<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Horario;
use App\Models\Personale;
use Carbon\Carbon;

use PDF;

use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{

    // reporte de asistencia
    public function reporte(Request $request)
    {

        // obtenemos todos los personales
        $personales = Personale::where('condicion_personal', '=', '1')->get();

        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        // dd($fecha_inicio);
        $asistencias = Asistencia::whereBetween('fecha', [$fecha_inicio, $fecha_fin])->get();

        $pdf = PDF::loadView('asistencias.reporte', compact('asistencias', 'personales'));

        // 216 mm X 330 mm = Oficio
        // 612.283 p X 935.433 p = Oficio
        return $pdf->setPaper('letter', 'landscape')->stream("SIDDEC - Reporte - ".$fecha_inicio." - ".$fecha_fin.".pdf");

        // return view('asistencias.reporte', compact('asistencias', 'personales'));
        
    }

    // muestraHora para mostrar la hora actual
    public function muestraHora(){
        $fecha = Carbon::now()->format('Y-m-d');
        $hora = Carbon::now()->format('H:i:s');
        return response()->text($fecha.' '.$hora);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // traer todas las asistencias y ordenarlas por fecha
        // $asistencias = Asistencia::all()->sortByDesc('id_asistencia');
        $busqueda = trim($request->busqueda);
        if ($busqueda != '') {
            $asistencias = Asistencia::whereDate('fecha', $busqueda)
                ->orderBy('id_asistencia', 'desc')
                ->paginate(10);
            return view('asistencias.index', compact('asistencias' , 'busqueda'));
        } else {
            $asistencias = Asistencia::orderBy('id_asistencia', 'desc')->paginate(10);
            return view('asistencias.index', compact('asistencias' , 'busqueda'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // obtener personales y retornar a la vista
        $personales = Personale::all();
        // obtener horarios y retornar a la vista
        $horarios = Horario::all()->sortByDesc("id_horario");
        return view('asistencias.create', compact('personales', 'horarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'fecha' => 'required',
            'hora' => 'required',
            'asistencia_id_personal' => 'required',
            'asistencia_id_horario' => 'required'
        ]);
        Asistencia::create($request->all());
        return redirect()->route('asistencias.index')->with('status', 'Asistencia creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        // obtener personales y retornar a la vista
        $personales = Personale::all();
        // obtener horarios y retornar a la vista
        $horarios = Horario::all()->sortByDesc("id_horario");
        return view('asistencias.edit', compact('asistencia', 'personales', 'horarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        $request -> validate([
            'fecha' => 'required',
            'hora' => 'required',
            'asistencia_id_personal' => 'required',
            'asistencia_id_horario' => 'required'
        ]);
        $asistencia->update($request->all());
        return redirect()->route('asistencias.index')->with('status', 'Asistencia actualizada con éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        // eliminacion por logica
        $asistencia->condicion_asistencia = !$asistencia->condicion_asistencia;
        $asistencia->save();
        if ($asistencia->condicion_asistencia) {
            return redirect()->route('asistencias.index')->with('status', 'Asistencia activado con éxito');
        } else {
            return redirect()->route('asistencias.index')->with('status', 'Asistencia eliminado con éxito');
        } 
    }

    //metodo para realizar el control de la asistencia del personal por el codigo de personal
    public function guardarAsistencia(Request $request){
        //en el request solamente esta llegando el codigo de personal ej. AJJ
        $codigo_control = $request->codigo_control;
        // dd($codigo_control);
        $personal = Personale::where('codigo_control', '=' , $codigo_control)->first();
        if($personal){
            // dd($personal);
            //obtenemos el ultimo horario vigente
            $horario = Horario::all();
            // dd($horario);
            // var_dump($horario->last())
            //obtenemos la fecha y hora actual
            $fechaActual = Carbon::now();
            $fechaActual = $fechaActual->format('Y-m-d');
            $horaActual = Carbon::now();
            $horaActual = $horaActual->format('H:i:s');
            // dd($personal);

            // guardar asistencia
            try{
                DB::beginTransaction();
    
                $asistencia = new Asistencia();
                $asistencia->fecha = $fechaActual;
                $asistencia->hora = $horaActual;
                $asistencia->asistencia_id_personal = $personal->id_personal;
                $asistencia->asistencia_id_horario = $horario->last()->id_horario;
                $asistencia->mac = $request->mac;
                $asistencia->save();
    
                DB::commit();
    
                return redirect()->route('welcome')->with('status', 'Asistencia registrada correctamente');
    
            } catch (\Exception $e){
                DB::rollBack();
            }
        }
        else{
            return redirect()->route('welcome')->with('status', 'El codigo de personal no existe');
        }

    }

    // consultar asistencias del dia actual por el codigo de personal
    public function consultarAsistencias(Request $request){
        //en el request solamente esta llegando el codigo de personal ej. AJJ
        $codigo_control = $request->codigo_control;
        // dd($codigo_control);
        $personal = Personale::where('codigo_control', '=' , $codigo_control)->first();
        if($personal){
            
            //obtenemos la fecha y hora actual
            $fechaActual = Carbon::now();
            $fechaActual = $fechaActual->format('Y-m-d');
            $contarAsistencias = Asistencia::where('asistencia_id_personal', '=' , $personal->id_personal)
            ->where('fecha', '=' , $fechaActual)->count();
            // dd($contarAsistencias);
            return redirect()->route('consultar')->with('status', 'Tiene '.$contarAsistencias.' asistencia(s)');

        }
        else{
            return redirect()->route('consultar')->with('status', 'El codigo de personal no existe');
        }

    }
}
