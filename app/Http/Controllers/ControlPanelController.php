<?php

namespace App\Http\Controllers;

use App\Models\ParadaEquipamento;
use App\Models\Produto;
use App\Models\Equipamento;
use App\Models\OrdemProducao;
use App\Models\RecursosProducao;
use App\Models\PecasEquipamentos;
use DateTime;
use Illuminate\Http\Request;

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

class ControlPanelController extends Controller
{
    public function index(Request $request)
    {
        $produtos = 2;
        $qnt = 1;
        $executaAtualizacao = 0;
        if ($executaAtualizacao == 5) {
            //$produto = Produto::find($produtos); //busca o registro do produto com o id da entrada do produto
            $totRegPecEquip = PecasEquipamentos::select('id')->max('id');
            // $totRegPecEquip = 13;
            $x = 1;
            while ($x <= $totRegPecEquip) {
                //echo "The number is: $x <br>";

                $numRegistroPecaEquip = PecasEquipamentos::find($x); //busca o registro do produto com o id da entrada do produto
                if (!empty($numRegistroPecaEquip)) { //verifica se exite este registro
                    $numRegistroPecaEquip->horas_proxima_manutencao = $numRegistroPecaEquip->horas_proxima_manutencao - 10; // soma estoque antigo com a entrada de produto
                    $numRegistroPecaEquip->save();
                } else {
                    // echo ('este registro é nullo');
                }

                //$produto->estoque_ideal = $produto->estoque_ideal - $request->input('quantidade'); // soma estoque antigo com a entrada de produto
                //dd($numRegistroPecaEquip );
                // $numRegistroPecaEquip->save();
                //echo ($numRegistroPecaEquip) . "<br>";
                $x += 1;
            }
            if ($x = $totRegPecEquip) {

                $x = 0;
                return view('site.control_panel');
            }
        }
        // $dataAtual=Date('now',$timezone);
        $diaAtual = date('d');
        $mesAtual = date('m');
        $anoAatual = date('y');
        $diaPassado = 5;
        $mesPassado = 1;
        $anoPassado = 23;
        // $dataAntiga=new DateTime('25/10/2022');
        // $timezone = new DateTimeZone('America/Sao_Paulo');
        echo ('<h1>Apartir do ano 2000 </h1>' . '<br>');
        echo ('O dia do mes hoje é=' . $diaAtual . '<br>');
        echo ('O mês atual é=' . $mesAtual . '<br>');
        echo ('O ano atual é=' . $anoAatual . '<br><hr></>');
        $totalDiasAtual = ($diaAtual + ($mesAtual * 31) + ($anoAatual * 365)) - 30;
        $totHorasAtual = $totalDiasAtual * 24;
        echo ('Total de dias é=' . $totalDiasAtual . '<br>');
        echo ('Total de horas é=' . $totHorasAtual . '<br><hr></>');
        $totDiasPassado = ($diaPassado + ($mesPassado * 31) + ($anoPassado * 365)) - 30;
        $totHorasPassado = $totDiasPassado * 24;
        echo ('Total de dias passado é=' . $totDiasPassado . '<br>');
        echo ('Total de horas passado é=' . $totHorasPassado . '<br><hr></>');
        $totIntervaloPassado = $totHorasAtual - $totHorasPassado;
        echo ('Total de horas que se passaram=' . $totIntervaloPassado . '<br><hr></>');
        $numRegistroPecaEquip = PecasEquipamentos::find(13); //busca o registro do produto com o id da entrada do produto
        $numRegistroPecaEquip->data_susbstituicao = $numRegistroPecaEquip->data_susbstituicao; // soma estoque antigo com a entrada de produto
        //$diaProximaManu= $numRegistroPecaEquip->data_susbstituicao('d');
        //echo ('datra sub=' . $numRegistroPecaEquip->data_proxima_manutencao. '<br><hr></>');
        echo ('datra sub=' . $numRegistroPecaEquip->data_proxima_manutencao . '<br><hr></>');
        $dataFutura = $numRegistroPecaEquip->data_proxima_manutencao;
        //$dataFuturaFormat = DateTime::createFromFormat('d/m/Y',$dataFutura);
        $data = implode("/", array_reverse(explode("-", $dataFutura))); //converte uma data para formato brasileiro trazido do banco mysql
        //$data = implode("-",array_reverse(explode("/",$data))); enviando para o banco
        echo ('Data futura=' . $data . '<br><hr></>');
        //Crindo uma nova data
        $data_final = $data;
        // $ontem = DateTime::createFromFormat('d/m/Y', $data_final)->modify('-1 day');
        $ontem = DateTime::createFromFormat('d/m/Y', $data_final);

        echo ('ontem=' . $ontem->format('d/m/Y') . '<hr></>');
        echo ('Dia=' . $ontem->format('d') . '<hr></>');
        echo ('Mes=' . $ontem->format('m') . '<hr></>');
        echo ('Ano=' . $ontem->format('y') . '<hr></>');
        $totDiasFuturo = ($ontem->format('d') + ($ontem->format('m')  * 31) + ($ontem->format('y') * 365)) - 30;
        $totHorasFuturo =  $totDiasFuturo * 24;
        echo ('Dias futuro=' . $totDiasFuturo . '<hr></>');
        echo ('Horas futuro=' . $totHorasFuturo . '<hr></>');
        echo ('Diferença de horas entre datas=' . ($totHorasFuturo- $totHorasAtual) . '<hr></>');
        //echo ('Data sub=' . $numRegistroPecaEquip. '<br><hr></>');
        //$numRegistroPecaEquip->horas_proxima_manutencao = $numRegistroPecaEquip->horas_proxima_manutencao - 10; // soma estoque antigo com a entrada de produto
        //$numRegistroPecaEquip->save();


        // echo ('Tempo='.$timezone.'<br>');
        //$produto->estoque_ideal = $produto->estoque_ideal -($qnt); // soma estoque antigo com a entrada de produto
        //$produto->estoque_ideal = $produto->estoque_ideal -($qnt); // soma estoque antigo com a entrada de produto
        //$produto->save();
        //return view('site.control_panel', ['produtos' => $produtos]);


    }
}// 
