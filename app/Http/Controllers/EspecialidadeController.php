<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
use heroisNW\Http\Requests\EspecialidadeRequest;
use heroisNW\Especialidade;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $especialidades = Especialidade::all();

        if ($request->is('api/especialidades')) {
            return response()->json(count($especialidades) == 0 ? ['message' => 'Nenhum registro encontrado'] : $especialidades);
        } else {
            return view('especialidade.especialidadeIndex')
                ->with('titulo', 'Especialidades')
                ->with('especialidades', $especialidades);
        }
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
    public function store(EspecialidadeRequest $request)
    {
        $isApi = $request->is('api/especialidades');
        Especialidade::create($request->all());

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
        $isApi = $request->is('api/especialidades/*');
        
        $especialidade = Especialidade::find($id);
        if (is_null($especialidade)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            if ($isApi) {
                return response()->json($especialidade);
            }
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
        $especialidade = Especialidade::find($id);

        if (is_null($especialidade)) {
            return $this->retornaMensagemNaoEncontrado(false);
        } else {
            return view('especialidade.especialidadeForm')
                ->with('titulo', 'Especialidades - Alteração')
                ->with('especialidade', $especialidade);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EspecialidadeRequest $request, $id)
    {
        $isApi = $request->is('api/especialidades/*');

        $especialidade = Especialidade::find($id);
        if (is_null($especialidade)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            $especialidade->fill($request->all());
            $especialidade->save();

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
        $isApi = $request->is('api/especialidades/*');

        $especialidade = Especialidade::find($id);
        if (is_null($especialidade)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            if ($especialidade->personagens()->count() > 0) {
                $msgErro = 'Existem Personagens ativos desta Especialidade.';
                return $isApi 
                       ? response()->json(['message' => $msgErro], 500)
                       : redirect()->action('EspecialidadeController@index')->withErrors($msgErro);
            } else {
                $especialidade->delete();

                return $this->retornaMensagemSucesso($isApi, 'removida');
            }
        }
    }

    private function retornaMensagemNaoEncontrado($isApi) {
        return $isApi 
               ? response()->json(['message' => 'Especialidade não encontrada'], 404)
               : redirect()->action('EspecialidadeController@index')->withErrors('Especialidade não encontrada.');
    }

    private function retornaMensagemSucesso($isApi, $acao) {
        return $isApi
                ? response()->json(['message' => 'Especialidade ' . $acao . ' com sucesso'], 200)
                : redirect()->action('EspecialidadeController@index');
    }
}
