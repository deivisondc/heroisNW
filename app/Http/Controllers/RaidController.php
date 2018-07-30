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
    public function index()
    {
        $raids = Raid::all();
        // $raids = [];

        return view('raid.raidIndex')
            ->with('titulo', 'Raids')
            ->with('raids', $raids);
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
        $raid = Raid::create($request->all());
        $raid->personagens()->sync($request->input('personagem_array'));

        return redirect()->action('RaidController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $raid = Raid::find($id);

        if (is_null($raid)) {
            return redirect()->action('RaidController@index')->withErrors('Raid não encontrada.');
        } else {
            return view('raid.raidShow')
                ->with('titulo', 'Raids - Detalhes')
                ->with('raid', $raid);
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
            return redirect()->action('RaidController@index')->withErrors('Raid não encontrada.');
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
        $raid = Raid::find($id);
        $raid->fill($request->all());
        $raid->personagens()->sync($request->input('personagem_array'));
        $raid->save();

        return redirect()->action('RaidController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $raid = Raid::find($id);

        if (is_null($raid)) {
            return redirect()->action('RaidController@index')->withErrors('Raid não encontrada.');
        } else {
            $raid->personagens()->sync([]);
            $raid->delete();

            return redirect()->action('RaidController@index');
        }
    }
}
