<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
use heroisNW\Http\Requests\PersonagemRequest;
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
    public function store(PersonagemRequest $request)
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
        $personagem = Personagem::find($id);

        if (is_null($personagem)) {
            return redirect()->action('PersonagemController@index')->withErrors('Personagem não encontrado.');
        } else {
            return view('personagem.personagemShow')
                ->with('titulo', 'Personagens - Detalhes')
                ->with('personagem', $personagem);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personagem = Personagem::find($id);

        if (is_null($personagem)) {
            return redirect()->action('PersonagemController@index')->withErrors('Personagem não encontrado.');
        } else {
            $classes = Classe::all();
            $especialidades = Especialidade::all();

            return view('personagem.personagemForm')
                ->with('titulo', 'Personagens - Alteração')
                ->with('personagem', $personagem)
                ->with('classes', $classes)
                ->with('especialidades', $especialidades);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonagemRequest $request, $id)
    {
        $personagem = Personagem::find($id);
        $personagem->fill($request->all());
        $personagem->especialidades()->sync($request->input('especialidade_array'));
        $personagem->save();

        return redirect()->action('PersonagemController@index');
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

        if (is_null($personagem)) {
            return redirect()->action('PersonagemController@index')->withErrors('Personagem não encontrado.');
        } else {
            if ($personagem->raids()->count() > 0) {
                return redirect()->action('PersonagemController@index')->withErrors('Existem Raids ativas das quais este Personagem participa.');
            } else {
                $personagem->especialidades()->sync([]);
                $personagem->delete();

                return redirect()->action('PersonagemController@index');
            }
        }

    }
}
