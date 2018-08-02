<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
use heroisNW\Http\Requests\RaidRequest;
use heroisNW\Raid;
use heroisNW\Personagem;

class RaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Rever se faço lazy para quando for API e eager para quando for API
        $raids = Raid::with('personagens.classe')->with('personagens.especialidades')->get();
        
        if ($request->is('api/raids')) {
            return response()->json(count($raids) == 0 ? ['message' => 'Nenhum registro encontrado'] : $raids);
        } else {
            return view('raid.raidIndex')
                ->with('titulo', 'Raids')
                ->with('raids', $raids);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personagens = Personagem::all();

        return view('raid.raidForm')
            ->with('titulo', 'Raids - Inclusão')
            ->with('personagens', $personagens);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RaidRequest $request)
    {
        $isApi = $request->is('api/raids');
        $raid = Raid::create($request->all());
        $raid->personagens()->sync($request->input('personagem_array'));

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
        $isApi = $request->is('api/raids/*');
        $raid = Raid::with('personagens.classe')->with('personagens.especialidades')->where('id',$id)->get();

        if (count($raid) == 0) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            if ($isApi) {
                return response()->json($raid[0]);
            } else {
                return view('raid.raidShow')
                    ->with('titulo', 'Raids - Detalhes')
                    ->with('raid', $raid[0]);
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
        $raid = Raid::find($id);

        if (is_null($raid)) {
            return $this->retornaMensagemNaoEncontrado(false);
        } else {
            $personagens = Personagem::all();

            return view('raid.raidForm')
                ->with('titulo', 'Raids - Alteração')
                ->with('raid', $raid)
                ->with('personagens', $personagens);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RaidRequest $request, $id)
    {
        $isApi = $request->is('api/raids/*');
        $raid = Raid::find($id);

        if (is_null($raid)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            $raid->fill($request->all());
            if(!is_null($request->input('personagem_array'))) {
                $raid->personagens()->sync($request->input('personagem_array'));
            }
            $raid->save();

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
        $isApi = $request->is('api/raids/*');
        $raid = Raid::find($id);

        if (is_null($raid)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            $raid->personagens()->sync([]);
            $raid->delete();

            return $this->retornaMensagemSucesso($isApi, 'removida');
        }
    }

    private function retornaMensagemNaoEncontrado($isApi) {
        return $isApi 
               ? response()->json(['message' => 'Raid não encontrada'], 404)
               : redirect()->action('RaidController@index')->withErrors('Raid não encontrada.');
    }

    private function retornaMensagemSucesso($isApi, $acao) {
        return $isApi
                ? response()->json(['message' => 'Raid ' . $acao . ' com sucesso'], 200)
                : redirect()->action('RaidController@index');
    }
}
