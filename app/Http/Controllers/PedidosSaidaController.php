<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipamento;
use App\Models\Funcionario;
use App\Models\PedidoCompra;
use App\Models\Empresas;
use App\Models\PedidoSaida;
use App\Models\SaidaProduto;
use App\Models\Fornecedor;
use App\Models\OrdemServico;

class PedidosSaidaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ordem_servico=$request->get('ordem_servico');
        
        $tipoFiltro = $request->get('tipofiltro');
        $situacao = $request->get('status');
        $produto= $request->get('produto');
        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();
        $empresas = Empresas::all();
        if ($tipoFiltro == 1) {
            $pedidos_saida = PedidoSaida::where('status', $situacao)->get();
            return view('app.pedido_saida.index', ['equipamentos' => $equipamentos, 'funcionarios' => $funcionarios, 'pedidos_saida' => $pedidos_saida]);
        }
        if ($tipoFiltro == 2) {
            $pedidos_saida = PedidoSaida::where('status', $situacao)->get();
            return view('app.pedido_saida.index', ['equipamentos' => $equipamentos, 'funcionarios' => $funcionarios, 'pedidos_saida' => $pedidos_saida]);
        }
        if ($tipoFiltro == 4) {
           
            $pedidos_saida = PedidoSaida::where('ordem_servico_id',$ordem_servico)->get();
            return view('app.pedido_saida.index', ['equipamentos' => $equipamentos, 'funcionarios' => $funcionarios, 'pedidos_saida' => $pedidos_saida]);
        }
        if ((empty($tipoFiltro))) {
            $pedidos_saida = PedidoSaida::where('id',2)->get();
            return view('app.pedido_saida.index', ['equipamentos' => $equipamentos, 'funcionarios' => $funcionarios, 'pedidos_saida' => $pedidos_saida]);
            echo('vazio');
        }
    }
    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $requ)
    {
        //
        $ordem_servico_id = $requ->get('ordem_servico');
        $ordem_servico = OrdemServico::where('id', $ordem_servico_id)->get();
        $pedidos_saida = PedidoSaida::all();
        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();
        $empresas = Empresas::all();
        $fornecedores = Fornecedor::all();
        return view('app.pedido_saida.create', [
            'equipamentos' => $equipamentos, 'funcionarios' => $funcionarios, 'pedidos_saida' => $pedidos_saida,
            'empresa' => $empresas,
            'fornecedores' => $fornecedores,
            'ordem_servico' => $ordem_servico
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        PedidoSaida::create($req->all());
        $pedidos_saida = PedidoSaida::all();
        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();
        $empresas = Empresas::all();
        $fornecedores = Fornecedor::all();
        return view('app.pedido_saida.index', ['equipamentos' => $equipamentos, 'funcionarios' => $funcionarios, 'pedidos_saida' => $pedidos_saida]);
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
     * @param  \App\PedidoSaida  $PedidoSaida
     * @return \Illuminate\Http\Response
     */

    public function edit(PedidoSaida $pedidoSaida)
    {

        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();
        $empresas = Empresas::all();
        $fornecedores = Fornecedor::all();
        return view('app.pedido_saida.edit', [
            'equipamentos' => $equipamentos, 'funcionarios' => $funcionarios, 'pedidos_saida' => $pedidoSaida,
            'empresa' => $empresas,
            'fornecedores' => $fornecedores,
        ]);
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
