<?php

namespace heroisNW\Http\Controllers;

use Illuminate\Http\Request;
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
    public function store(Request $request)
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
        $raid = Raid::find($id);
        $raid->personagens()->sync([]);
        $raid->delete();

        return redirect()->action('RaidController@index');
    }
}
