<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
use heroisNW\Especialidade;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = Especialidade::all();

        return view('especialidade.especialidadeIndex')
            ->with('titulo', 'Especialidades')
            ->with('especialidades', $especialidades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidade.especialidadeForm')
            ->with('titulo', 'Especialidades - Inclusão');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Especialidade::create($request->all());

        return redirect()->action('EspecialidadeController@index');

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
    public function edit($id)
    {
        $especialidade = Especialidade::find($id);

        return view('especialidade.especialidadeFormEdit')
            ->with('titulo', 'Especialidades - Alteração')
            ->with('especialidade', $especialidade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $especialidade = Especialidade::find($id);
        $especialidade->fill($request->all());
        $especialidade->save();

        return redirect()->action('EspecialidadeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especialidade = Especialidade::find($id);
        $especialidade->delete();

        return redirect()->action('EspecialidadeController@index');
    }
}
