<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Equipamento;
use App\Models\PecasEquipamentos;

class PecaEquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $equipamento)
    {
        //
        $equipamento_id = $equipamento->get('equipamento');
        $pecasEquip = PecasEquipamentos::where('equipamento',  $equipamento_id)->get();
        $equipamento = Equipamento::where('id',  $equipamento_id)->get();
        // echo($equipamento);
        return view('app.peca_equipamento.index', ['pecas_equipamento' => $pecasEquip, 'equipamento' => $equipamento]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $equipamento_id)
    {
        //
        $equipamentoId = $equipamento_id->get('equipamento');
        $produtos = Produto::all();
        $equipamento = Equipamento::where('id',  $equipamentoId)->get();
        return view('app.peca_equipamento.create', [
            'produtos' => $produtos,
            'equipamento' => $equipamento,
        ]);
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
        PecasEquipamentos::create($request->all());
        $equipamentoId = $request->get('equipamento');
        $equipamento = Equipamento::where('id', $equipamentoId)->get();
        $pecasEquip = PecasEquipamentos::where('equipamento',$equipamentoId)->get();
        return view('app.peca_equipamento.index', ['pecas_equipamento' => $pecasEquip, 'equipamento' => $equipamento]);
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
        //
    }
}
