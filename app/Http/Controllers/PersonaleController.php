<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personale;
use App\Models\Informacione;
use App\Models\Cargo;
class PersonaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personales = Personale::all();
        return view('personales.index', compact('personales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // cargamos todos los cargos
        $cargos = Cargo::all();

        return view('personales.create' , compact('cargos'));
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
            'nombres' => 'required',
            'codigo_control' => 'required',
            'mac_pc' => 'required',
            'personal_id_cargo' => 'required'
        ]);

        // guardamos primero informacion
        $informacion = Informacione::create($request->all());
        // guardamos el personal
        Personale::create([
            'codigo_control' => $request->codigo_control,
            'mac_pc' => $request->mac_pc,
            'personal_id_informacion' => $informacion->id_informacion,
            'personal_id_cargo' => $request->personal_id_cargo
        ]);

        return redirect()->route('personales.index')->with('status', 'Personal creado con éxito');
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
    public function edit(Personale $personale)
    {
        // cargamos todos los cargos
        $cargos = Cargo::all();
        return view('personales.edit', compact('personale', 'cargos'));
        // return view('personales.edit', compact('personale'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personale $personale)
    {
        $request -> validate([
            'codigo_control' => 'required',
            'mac_pc' => 'required',
            'personal_id_cargo' => 'required'
        ]);
        //Actualizamos el registro de informacion
        $informacion = Informacione::find($personale->personal_id_informacion);
        $informacion->update($request->all());
        //Actualizamos el registro de personal
        $personale->update([
            'codigo_control' => $request->codigo_control,
            'mac_pc' => $request->mac_pc,
            'personal_id_cargo' => $request->personal_id_cargo
        ]);

        return redirect()->route('personales.index')->with('status', 'Personal actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personale $personale)
    {
        // eliminacion por logica de personale
        $personale->condicion_personal = !$personale->condicion_personal;
        $personale->save();
        // si condicion_cargo = 1 retornar status = Cargo activado
        // si condicion_cargo = 0 retornar status = Cargo desactivado
        if ($personale->condicion_personal) {
            return redirect()->route('personales.index')->with('status', 'Personal activado con éxito');
        } else {
            return redirect()->route('personales.index')->with('status', 'Personal eliminado con éxito');
        }      
    }
}
