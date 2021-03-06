<?php

namespace App\Http\Controllers;

use App\Musica;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MusicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $inicioDaRequisicao = Carbon::now();

        $itensPorPagina = 10;
        $paginaAtual = $request->input('page')?: 1;
        $offset = ($paginaAtual - 1) * $itensPorPagina;

        $musicas = Musica::getPagina($offset, $itensPorPagina);
        $totalMusicas = Musica::total();

        $paginador = new LengthAwarePaginator($musicas, $totalMusicas, $itensPorPagina);
        $paginador->setPath($request->url());
        $paginador->appends(array('page' => $paginaAtual));

        if($itensPorPagina != 0 && $paginaAtual > $paginador->lastPage())
        {
            abort(404);
        }

        $tempoExecucao = Carbon::now()->diffInMilliseconds($inicioDaRequisicao) / 1000;
        return view('musicas.index', compact('musicas'))->with('paginador', $paginador)->with('tempoExecucao', $tempoExecucao);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Musica  $musica
     * @return \Illuminate\Http\Response
     */
    public function show(Musica $musica)
    {
        $inicioDaRequisicao = Carbon::now();

        $tempoExecucao = Carbon::now()->diffInMilliseconds($inicioDaRequisicao) / 1000;
        return view('musicas.show', compact('musica'))->with('tempoExecucao', $tempoExecucao);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Musica  $musica
     * @return \Illuminate\Http\Response
     */
    public function edit(Musica $musica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Musica  $musica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Musica $musica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Musica  $musica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Musica $musica)
    {
        //
    }
}
