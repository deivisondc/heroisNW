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
    public function index(Request $request)
    {
        $classes = Classe::all();

        if ($request->is('api/classes')) {
            return response()->json(count($classes) == 0 ? ['message' => 'Nenhum registro encontrado'] : $classes);
        } else {
            return view('classe.classeIndex')
                ->with('titulo', "Classes")
                ->with('classes', $classes);
        }
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
        $isApi = $request->is('api/classes');
        $classe = Classe::create($request->all());

        return $this->retornaMensagemSucesso($isApi, 'criada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $isApi = $request->is('api/classes/*');
        $classe = Classe::find($id);

        if (is_null($classe)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            if ($isApi) {
                return response()->json($classe);
            }
        }
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
            return $this->retornaMensagemNaoEncontrado(false);
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
        $isApi = $request->is('api/classes/*');
        $classe = Classe::find($id);

        if (is_null($classe)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            $classe->fill($request->all());
            $classe->save();

            return $this->retornaMensagemSucesso($isApi, 'alterada');    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isApi = $request->is('api/classes/*');
        $classe = Classe::find($id);
        if (is_null($classe)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            if ($classe->personagens()->count() > 0) {
                $msgErro = 'Existem Personagens ativos desta Classe.';
                return $isApi 
                       ? response()->json(['message' => $msgErro], 500)
                       : redirect()->action('ClasseController@index')->withErrors($msgErro);
            } else {
                 $classe->delete();

                 return $this->retornaMensagemSucesso($isApi, 'removida');
            }
        }
    }

    private function retornaMensagemNaoEncontrado($isApi) {
        return $isApi 
               ? response()->json(['message' => 'Classe não encontrada'], 404)
               : redirect()->action('ClasseController@index')->withErrors('Classe não encontrada.');
    }

    private function retornaMensagemSucesso($isApi, $acao) {
        return $isApi
                ? response()->json(['message' => 'Classe ' . $acao . ' com sucesso'], 200)
                : redirect()->action('ClasseController@index');
    }
}
