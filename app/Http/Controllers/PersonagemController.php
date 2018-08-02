<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
use heroisNW\Http\Requests\PersonagemRequest;
use Illuminate\Support\Facades\Storage;
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
    public function index(Request $request)
    {
        $personagens = Personagem::with('classe')->with('especialidades')->get();

        if ($request->is('api/personagens')) {
            return response()->json(count($personagens) == 0 ? ['message' => 'Nenhum registro encontrado'] : $personagens);
        } else {
            return view('personagem.personagemIndex')
                ->with('titulo', 'Personagens')
                ->with('personagens', $personagens);
        }
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
        $isApi = $request->is('api/personagens');
        if ($request->hasFile('imagem')) {
            $path = Storage::putFile('personagens', $request->file('imagem'));
            $request->request->add(['thumbmail' => $path]);
        }

        $personagem = Personagem::create($request->all());
        $personagem->especialidades()->sync($request->input('especialidade_array'));

       return $this->retornaMensagemSucesso($isApi, 'criado');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $isApi = $request->is('api/personagens/*');
        $personagem = Personagem::with('classe')->with('especialidades')->where('id', $id)->get();

        if (count($personagem) == 0) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            if ($isApi) {
                return response()->json($personagem[0]);
            } else {
                return view('personagem.personagemShow')
                    ->with('titulo', 'Personagens - Detalhes')
                    ->with('personagem', $personagem[0]);
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
        $personagem = Personagem::find($id);

        if (is_null($personagem)) {
            return $this->retornaMensagemNaoEncontrado(false);
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
        $isApi = $request->is('api/personagens/*');
        $personagem = Personagem::find($id);

        if (is_null($personagem)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {

            if (!is_null($request->input('exclusao_thumbmail')) || $request->hasFile('imagem')) {
                if (!empty($personagem->thumbmail)) {
                    Storage::delete($personagem->thumbmail);
                    $personagem->thumbmail = '';
                }
            }

            if ($request->hasFile('imagem')) {
                $path = Storage::put('personagens', $request->file('imagem'));
                $request->request->add(['thumbmail' => $path]);
            }

            $personagem->fill($request->all());
            if (!is_null($request->input('especialidade_array'))) {
                $personagem->especialidades()->sync($request->input('especialidade_array'));
            }
            $personagem->save();

            return $this->retornaMensagemSucesso($isApi, 'alterado');
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
        $isApi = $request->is('api/personagens/*');        
        $personagem = Personagem::find($id);

        if (is_null($personagem)) {
            return $this->retornaMensagemNaoEncontrado($isApi);
        } else {
            if ($personagem->raids()->count() > 0) {
                return redirect()->action('PersonagemController@index')->withErrors('Existem Raids ativas das quais este Personagem participa.');
            } else {

                if (!empty($personagem->thumbmail)) {
                    Storage::delete($personagem->thumbmail);
                }

                $personagem->especialidades()->sync([]);
                $personagem->delete();

                return $this->retornaMensagemSucesso($isApi, 'removido');
            }
        }

    }

    private function retornaMensagemNaoEncontrado($isApi) {
        return $isApi 
               ? response()->json(['message' => 'Personagem não encontrado'], 404)
               : redirect()->action('PersonagemController@index')->withErrors('Personagem não encontrada.');
    }

    private function retornaMensagemSucesso($isApi, $acao) {
        return $isApi
                ? response()->json(['message' => 'Personagem ' . $acao . ' com sucesso'], 200)
                : redirect()->action('PersonagemController@index');
    }

}
