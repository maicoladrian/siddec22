<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // obtener todos los horarios y ordenar por id_horario
        $horarios = Horario::orderBy('id_horario', 'DESC')->get();
        // $horarios = Horario::all();
        return view('horarios.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horarios.create');
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
            'hora_entrada_m' => 'required',
            'hora_salida_m' => 'required',
            'hora_entrada_t' => 'required',
            'hora_salida_t' => 'required',
            'fecha_horario' => 'required'
        ]);
        Horario::create($request->all());
        return redirect()->route('horarios.index')->with('status', 'Horario creado con éxito');
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
    public function edit(Horario $horario)
    {
        return view('horarios.edit', compact('horario'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        $request -> validate([
            'hora_entrada_m' => 'required',
            'hora_salida_m' => 'required',
            'hora_entrada_t' => 'required',
            'hora_salida_t' => 'required',
            'fecha_horario' => 'required'
        ]);
        $horario->update($request->all());
        return redirect()->route('horarios.index')->with('status', 'Horario actualizado con éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        // eliminacion por logica
        $horario->condicion_horario = !$horario->condicion_horario;
        $horario->save();
        if ($horario->condicion_horario) {
            return redirect()->route('horarios.index')->with('status', 'Horario activado con éxito');
        } else {
            return redirect()->route('horarios.index')->with('status', 'Horario eliminado con éxito');
        } 
    }
}
