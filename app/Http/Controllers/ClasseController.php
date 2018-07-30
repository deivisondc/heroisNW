<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
use heroisNW\Http\Requests\ClasseRequest;
use heroisNW\Classe;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::all();

        return view('classe.classeIndex')
            ->with('titulo', "Classes")
            ->with('classes', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('classe.classeForm')
            ->with('titulo', "Classes - Inclusão");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasseRequest $request)
    {
        $classe = Classe::create($request->all());

        return redirect()->action('ClasseController@index');
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
    public function edit(Request $request, $id)
    {
        $classe = Classe::find($id);

        if (is_null($classe)) {
            return redirect()->action('ClasseController@index')->withErrors('Classe não encontrada.');
        } else {
            return view('classe.classeForm')
                ->with('titulo', "Classes - Alteração")
                ->with('classe', $classe);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasseRequest $request, $id)
    {

        $classe = Classe::find($id);
        $classe->fill($request->all());
        $classe->save();

        return redirect()->action('ClasseController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::find($id);
        if (is_null($classe)) {
            return redirect()->action('ClasseController@index')->withErrors('Classe não encontrada.');
        } else {
            if ($classe->personagens()->count() > 0) {
                return redirect()->action('ClasseController@index')->withErrors('Existem Personagens ativos desta Classe.');
            } else {
                 $classe->delete();
                 return redirect()->action('ClasseController@index');
            }
        }
    }
}
