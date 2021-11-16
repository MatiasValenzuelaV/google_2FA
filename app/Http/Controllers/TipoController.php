<?php

namespace App\Http\Controllers;

use App\Models\Tipos;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Tipos::latest()->paginate(5);
        return view('tipos.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tipos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        Tipos::create($request->all());

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo creado exitosamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function show(Tipos $tipos)
    {
        //
        return view('tipos.show', compact('tipos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipos $tipos)
    {
        //
        return view('tipos.edit', compact('tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipos $tipos)
    {
        //
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $tipos->update($request->all());

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipos $tipos)
    {
        //
        $tipos->delete();

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo eliminado exitosamente');
    }
}
