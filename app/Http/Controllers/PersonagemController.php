<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
use heroisNW\Personagem;
use heroisNW\Classe;
use heroisNW\Especialidade;

class PersonagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personagens = Personagem::all();

        return view('personagem.personagemIndex')
            ->with('titulo', 'Personagens')
            ->with('personagens', $personagens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::all();
        $especialidades = Especialidade::all();

        return view('personagem.personagemForm')
            ->with('titulo', 'Personagens - Inclusão')
            ->with('classes', $classes)
            ->with('especialidades', $especialidades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $personagem = Personagem::create($request->all());
        $personagem->especialidades()->sync($request->input('especialidade_array'));

       return redirect()->action('PersonagemController@index');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $personagem = Personagem::find($id);
        $personagem->especialidades()->sync([]);
        $personagem->delete();

        return redirect()->action('PersonagemController@index');

    }
}
