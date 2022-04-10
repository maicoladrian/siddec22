<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargos.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargos.create');
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
            'descripcion_cargo' => 'required'
        ]);
        Cargo::create($request->all());
        return redirect()->route('cargos.index')->with('status', 'Cargo creado con éxito');
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
    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        $request -> validate([
            'descripcion_cargo' => 'required'
        ]);
        $cargo->update($request->all());
        return redirect()->route('cargos.index')->with('status', 'Cargo actualizado con éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        // eliminacion por logica
        $cargo->condicion_cargo = !$cargo->condicion_cargo;
        $cargo->save();
        // si condicion_cargo = 1 retornar status = Cargo activado
        // si condicion_cargo = 0 retornar status = Cargo desactivado
        if ($cargo->condicion_cargo) {
            return redirect()->route('cargos.index')->with('status', 'Cargo activado con éxito');
        } else {
            return redirect()->route('cargos.index')->with('status', 'Cargo eliminado con éxito');
        }        
        // return redirect()->route('cargos.index')->with('status', 'Cargo eliminado con éxito');
    }
}
