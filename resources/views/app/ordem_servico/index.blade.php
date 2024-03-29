@extends('app.layouts.app')
@section('content')
<script src="{{ asset('js/update_datatime.js') }}" defer></script>
<script src="{{ asset('js/timeline_google.js') }}" defer></script>
<main class="content">
    <div class="card">
        <style>
            .card-header {
                background-color: rgb(211, 211, 211);
                opacity: 0.95;
            }
        </style>
        <div class="card-header">
            <script>
                function Funcao() {
                    alert('teste');
                    document.getElementById("t1").value = "{{ $funcionarios }}"
                }
            </script>
            <!------------------------------------->
            <!----teste de url--------------------->
            <div class="form-row">
                <form action="{{ 'filtro-os' }}" method="POST">
                    @csrf

            </div>x
            <!------------------------------------------------------------------------------------------->
            <!----datas---------------------------------------------------------------------------------->
            <!------------------------------------------------------------------------------------------->
            <div class="form-row">
                <div class="col-md-1">
                    <label for="id">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" placeholder="ID Os" value="">
                </div>
                <p>
                    <!----------------------------------->
                <div class="col-md-1">
                    <label for="data_inicio">Data inicial:</label>
                    <input type="date" class="form-control" name="data_inicio" id="data_inicio" placeholder="dataPrevista" value="">
                </div>
                <div class="col-md-1">
                    <label for="hora_inicio">Hora prevista:</label>
                    <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" placeholder="horaPrevista" value="">
                </div>
                <div class="col-md-1">
                    <label for="dataFim">Data final:</label>
                    <input type="date" class="form-control" name="data_fim" id="dataFim" placeholder="dataFim" value="">
                </div>
                <div class="col-md-1">
                    <label for="horaFim">Hora fim:</label>
                    <input type="time" class="form-control" name="hora_fim" id="horaFim" placeholder="horaFim" value="">
                </div>
                <div class="col-md-6 mb-0">
                    <label for="responsavel" class="">Responsável:</label>
                    <select name="responsavel" id="responsavel" class="form-control-template">
                        <option value="todos">todos</option>
                        @foreach ($funcionarios as $funcionario_find)
                        <option value="{{ $funcionario_find->primeiro_nome }}" {{ ($funcionario_find->responsavel ?? old('responsavel')) == $funcionario_find->primeiro_nome ? 'selected' : '' }}>
                            {{ $funcionario_find->primeiro_nome }}
                        </option>
                        @endforeach
                    </select>
                    {{ $errors->has('responsavel') ? $errors->first('responsavel') : '' }}
                </div>
                <!----------------------------------->
                <div class="col-md-2 mb-0">
                    <label for="situacao" class="">Situação:</label>
                    <select class="form-control" name="situacao" id="situacao" value="">
                        <option value="aberto">aberto</option>
                        <option value="fechado">fechado</option>
                        <option value="indefinido">indefinido</option>
                        <option value="cancelada">cancelada</option>
                        <option value="em andamento">em andamento</option>
                    </select>
                </div>
                <div class="col-md-2 mb-0">
                    <label for="tipo_consulta" class="">Tipo de consulta:</label>

                    <select class="form-control" name="tipo_consulta" id="tipo_consulta" value="">
                        <option value="1">Pelo ID</option>
                        <option value="2">>=Data inicial <= Data inicial </option>
                        <option value="3">>=Data inicial e <=Data final</option>
                        <option value="4">=Data final</option>
                        <option value="5">Data inicial e equipamento</option>
                        <option value="6">Data inicial e empresa</option>
                        <option value="7">Imprimir</option>
                    </select>
                </div>
                <!--------------------------------------------------------------------------------------->
                <!---------Select empresa------------->
                <!--------------------------------------------------------------------------------------->
                <div class="col-md-5 mb-0">
                    <label for="empresas" class="">Empresa:</label>
                    <select name="empresa_id" id="empresa_id" class="form-control-template">
                        <option value=""> --Selecione a empresa--</option>
                        @foreach ($empresa as $empresas_find)
                        <option value="{{ $empresas_find->id }}" {{ ($empresas_find->empresa_id ?? old('empresa_id')) == $empresas_find->id ? 'selected' : '' }}>
                            {{ $empresas_find->razao_social }}
                        </option>
                        @endforeach
                    </select>
                    {{ $errors->has('empresa_id') ? $errors->first('empresa_id') : '' }}
                </div>
                <!------------------------------------------------------------------------------------------->
                <!---------Select o equipament--------------------------------------------------------------->
                <!------------------------------------------------------------------------------------------->
                <div class="col-md-3 mb-0">
                    <label for="id">Patrimônio:</label>
                    <input type="number" class="form-control" id="patrimonio" name="patrimonio_id" placeholder="ID patrimonio" value="">
                </div>
                <!------------------------------------------------------------------------------------------->
                <div class="col-md-0">
                    <label for="btFiltrar" class="">Filtrar:</label>
                    <p>
                        <input type="submit" class="btn btn-info btn-icon-split" value="Filtrar">

                        <span class="icon text-white-50">
                            <i class="icofont-filter"></i>
                        </span>
                        <span class="text"></span>

                        </input>
                </div>
                </form>
                <!--------------------------------------->
                <div class="col-md-0">
                    <label for="btFiltrar" class="">Nova os</label>
                    <p>
                        <a href="{{ route('empresas.index') }}" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="icofont-plus-circle"></i>
                            </span>
                            <span class="text">Nova ordem</span>
                        </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <style>
                #tblOs {
                    font-family: arial, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                    background-color: rgb(211, 211, 211);
                }

                thead {
                    background-color: rgb(169, 169, 169);
                }

                td,
                th {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }

                tr:nth-child(even) {
                    background-color: #dddddd;
                }

                tr:hover {
                    background-color: rgb(169, 169, 169);
                }
            </style>
            <table id="tblOs">
                <thead>
                    <tr>
                        <th scope="col" class="">ID</th>
                        <th scope="col" class="" hidden>Data emissao</th>
                        <th scope="col" class="" hidden>Hora</th>
                        <th scope="col" class="">Data prevista</th>
                        <th scope="col" class="">Hora prevista</th>
                        <th scope="col" class="">Data fim</th>
                        <th scope="col" class="">Hora fim</th>
                        <th scope="col" class="">Empresa</th>
                        <th scope="col" class="">Patrimônio</th>
                        <th scope="col" class="">Emissor</th>
                        <th scope="col" class="">Responsável</th>
                        <th scope="col" class="">Descrição</th>
                        <th scope="col" class="">Executado</th>
                        <th>link foto</th>
                        <th>Status</th>
                        <th>Valor</th>
                        <th>Operações</th>
                        <th>check</th>

                    </tr>
                </thead>
                @foreach ($ordens_servicos as $ordem_servico)
                <tbody>
                    <tr>
                        <td>{{ $ordem_servico->id }}</td>
                        <td hidden>{{ $ordem_servico->data_emissao }}</td>
                        <td hidden>{{ $ordem_servico->hora_emissao }}</td>
                        <td>{{ $ordem_servico->data_inicio }}</td>
                        <td>{{ $ordem_servico->hora_inicio }}</td>
                        <td>{{ $ordem_servico->data_fim }}</td>
                        <td>{{ $ordem_servico->hora_fim }}</td>
                        <td>

                            {{ $ordem_servico->Empresa->razao_social }}

                        </td>
                        <td>{{ $ordem_servico->equipamento->nome }}</td>
                        <td>{{ $ordem_servico->equipamento->id }}</td>
                        <td>{{ $ordem_servico->emissor }}</td>
                        <td>{{ $ordem_servico->responsavel }}</td>
                        <td id="descricao">

                            {{ $ordem_servico->descricao }}

                        </td>
                        <td>
                            {{ $ordem_servico->Executado }}

                        </td>

                        <td><a href="{{ $ordem_servico->link_foto }}" target="blank">link foto</a></td>
                        <td>{{ $ordem_servico->situacao }}
                            <input type="text" value="{{ $ordem_servico->status_servicos }}" id="progress-input" hidden>

                            <!--Exemplo de progressbar com um input texto-->
                            <div class="progress">
                                <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{ $ordem_servico->status_servicos }}%</div>
                            </div>

                            <script>
                                //document.addEventListener('DOMContentLoaded', function() {
                                    var progressBar = document.getElementById('progress-bar');
                                    var progressInput = document.getElementById('progress-input');

                                    // Função para atualizar a barra de progresso
                                    function updateProgressBar(value) {
                                        progressBar.style.width = value + '%';
                                        progressBar.setAttribute('aria-valuenow', value);
                                    }

                                    // Chama a função de atualização da barra de progresso com o valor inicial do input
                                    updateProgressBar(progressInput.value);

                                    // Adiciona um ouvinte de eventos para o input
                                    progressInput.addEventListener('input', function() {
                                        var value = progressInput.value;
                                        updateProgressBar(value);
                                    });
                                //});
                            </script>
                            <!--Fim Exemplo de progressbar com um input texto-->
        </div>
        </td>
        <td id="valor" value="{{ $ordem_servico->valor }}">{{ $ordem_servico->valor }}</td>
        <!--Div operaçoes do registro da ordem des serviço-->
        <td>
            <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                <a class="btn btn-sm-template btn-outline-primary" href="{{ route('ordem-servico.show', ['ordem_servico' => $ordem_servico->id]) }}">
                    <i class="icofont-eye-alt"></i>
                </a>

                <a class="btn btn-sm-template btn-outline-success  @can('user') disabled @endcan" href="{{ route('ordem-servico.edit', ['ordem_servico' => $ordem_servico->id]) }}">

                    <i class="icofont-ui-edit"></i> </a>

                <!--Condoçes para deletar a os-->
                <form id="form_{{ $ordem_servico->id }}" method="post" action="{{ route('ordem-servico.destroy', ['ordem_servico' => $ordem_servico->id]) }}">
                    @method('DELETE')
                    @csrf

                </form>
                <a class="btn btn-sm-template btn-outline-danger @can('user') disabled @endcan" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick=" DeletarOs()">
                    <i class="icofont-ui-delete"></i>
                    <script>
                        function DeletarOs() {
                            var x;
                            var r = confirm("Deseja deletar a ordem de serviço?");
                            if (r == true) {

                                document.getElementById('form_{{ $ordem_servico->id }}').submit()
                            } else {
                                x = "Você pressionou Cancelar!";
                            }
                            document.getElementById("demo").innerHTML = x;
                        }
                    </script>
                </a>
                <!------------------------------>

            </div>
        <td>
            <div class="col-md-2 mb-0">
                <input type="checkbox" name="" id="">
            </div>
        </td>

        </tr>

        </tbody>
        @endforeach

        </table>
        <p></p>

        <div class="card border-success mb-3 md-1" style="max-width: 18rem;" id="valorTotal">
            <style>
                #valorTotal {
                    font-size: 20px;
                    font-weight: 700;
                    font-stretch: normal;
                    float: right;
                    padding: 10px;
                }
            </style>
            Valor Total:R$ {{ $valorTotal }}
        </div>
    </div>

    <div class="row mb-0 md-0">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="executaTimeLine()">
                Gerar timeline
            </button>
        </div>
    </div>
    <!--------------------------------------------------------------------->
    <!--Código que gera o gáfico de gantt-->
    <!--------------------------------------------------------------------->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <div id="timeline" style="height:100%;">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!--------------------------------------------------------------------->
        <!--Código que gera o gáfico de pizza-->
        <!--------------------------------------------------------------------->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <button onclick="agruparNumerosIguais1(),GerarGráficoLinhas()">Gerar tabela de geração de ordens</button>
    <table id="tabelaAgrupada">
        <caption>Tabela Agrupada</caption>
        <thead>
            <tr>
                <th>Nome do equipamento</th>
                <th>Id</th>
                <th>Quantidade de ordens geradas</th>
            </tr>
        </thead>
        <tbody id="corpoTabelaAgrupada">
            <!-- Aqui será preenchido dinamicamente com JavaScript -->
        </tbody>
    </table>
    <style>
        .container-chart {
            display: flex;
            height: 100%;
            width: 100%;
        }

        .item {
            flex: 1;
            border: 1px solid black;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }
    </style>
    <div class="container-chart">
        <div class="item">
            <!-- Onde o gráfico será exibido -->
            <div id="graficoPizza"></div>
            <!-- Onde o gráfico será exibido -->
            <!--<div id="graficoPizza"></div>-->
            <canvas id="myChart" hidden></canvas>
        </div>
        <div class="item">
            <canvas id="myChart3"></canvas>
        </div>
        <div class="item">
            <canvas id="myChart2"></canvas>
        </div>
    </div>

    <script>
        //-------------------------------------------------------------------------------------------------------

        function VerTabela() {
            agruparNumerosIguais() //chama criar tabela
            table1 = document.getElementById("tblOs");
            let totalColumnsTbOs = (table1.rows.length);

            for (var i = 1; i < table1.rows.length; i++) {
                let equipamentoId =
                    document.getElementById("tblOs").rows[i].cells[9].innerHTML;
                //FunAjaxGetcontEquip()
            };
            if (i = totalColumnsTbOs) {

            }
        }
        //Funçoes em ajax
        //$(document).ready(function()
        function FunAjaxGetcontEquip(url, sidinei, sucessoCallback, erroCallback) {
            let valorInput = $("#os1").val(); //pega o valor do input
            let date1 = $("#date1").val(); //pega o valor do input
            let date2 = $("#date2").val(); //pega o valor do input
            var linha = $("#tblOs tr:eq(1)"); // Pega a segunda linha da tabela (índice 1)
            var equipamentoId = linha.find("td:eq(8)").text(); // Pega o texto da segunda célula (índice 1) da linha
            var dataInicio = linha.find("td:eq(1)").text(); // Pega o texto da terceira célula (índice 2) da linha
            var dataFim = linha.find("td:eq(3)").text(); // Pega o texto da terceira célula (índice 2) da linha

            // Exibe um alerta com os valores obtidos
            alert("esta fução busca e conta registros de equipaento nesta data-Equipamento id: " + equipamentoId +
                "Datas: " + date1 + '...' + date2);
            $.ajax({

                // url: "route('get-cont-os-equip'", // Substitua 'pagina.php' pelo URL da sua página de destino
                type: "get", // Ou "GET" dependendo do tipo de requisição que você deseja fazer
                data: {

                    parametro1: date1,
                    parametro2: date2,
                    parametro3: equipamentoId
                }, // Se necessário, envie parâmetros para a página de destino
                success: function(response) {
                    // Executa essa função quando a requisição for bem-sucedida
                    alert("Requisição bem-sucedida! Resposta: " +
                        response); // Mostra um alerta com a resposta da requisição
                    document.getElementById('os1').value = response;
                    // Alterando a cor de fundo do input
                    $("#os1").css("background-color", "#ff0000");
                },
                error: function(xhr, status, error) {
                    // Executa essa função se houver um erro na requisição
                    // alert("Ocorreu um erro na requisição: " + xhr.responseText); // Mostra um alerta com a mensagem de erro
                }
            });
        };
    </script>
    </body>
</main>
@endsection
<footer>
</footer>

</html>

</body>


<script>
    function agruparNumerosIguais1() {
        var tabela = document.getElementById("tblOs");
        var numeros = {};

        for (var i = 1; i < tabela.rows.length; i++) {
            var nome = tabela.rows[i].cells[8].innerHTML;
            var numero = tabela.rows[i].cells[9].innerHTML;
            if (!numeros[nome]) {
                numeros[nome] = {};
            }
            if (!numeros[nome][numero]) {
                numeros[nome][numero] = 1;
            } else {
                numeros[nome][numero]++;
            }
        }

        var tabelaAgrupada = document.getElementById("tabelaAgrupada");
        var corpoTabelaAgrupada = document.getElementById("corpoTabelaAgrupada");
        corpoTabelaAgrupada.innerHTML = "";

        for (var nome in numeros) {
            for (var numero in numeros[nome]) {
                var row = corpoTabelaAgrupada.insertRow();
                var cellNome = row.insertCell(0);
                var cellNumero = row.insertCell(1);
                var cellQuantidade = row.insertCell(2);
                cellNome.innerHTML = nome;
                cellNumero.innerHTML = numero;
                cellQuantidade.innerHTML = numeros[nome][numero];

            }
        }
        // Criar gráfico de pizza
        // Obter os dados da tabela
        const table = document.getElementById('tabelaAgrupada');
        const rows = table.getElementsByTagName('tr');
        const data = {
            labels: [],
            values: []
        };

        // Iterar sobre as linhas da tabela e extrair os dados
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            data.labels.push(cells[0].innerText);
            const value1 = parseInt(cells[0].innerText);
            const value2 = parseInt(cells[2].innerText);
            data.values.push(value1 + value2);
        }
        GerarPieChart()
    }

    function GerarPieChart() {
        // Obter os dados da tabelaFF
        const table = document.getElementById('tabelaAgrupada');
        const rows = table.getElementsByTagName('tr');
        const data = {
            labels: [],
            values: []
        };

        // Iterar sobre as linhas da tabela e extrair os dados
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            data.labels.push(cells[0].innerText);
            const value1 = parseInt(cells[1].innerText);
            const value2 = parseInt(cells[2].innerText);
            data.values.push(value1 + value2);

        }

        // Criar o gráfico de pizza
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Valores Agrupados',
                    data: data.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(255, 209, 86, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        const canvas = document.getElementById('myChart');
        canvas.width = 200;
        canvas.height = 200;
        GeraGraficoPizza() //chama gerar gráfico pe chart google
    }
    // fim gerar gráfico pei chart
</script>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <input type="button" value="gerar" onclick="Gera()">
    <script type="text/javascript">
        function Gera() {
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                let n1
                let nome
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Pizza');
                data.addColumn('number', 'Populartiy');
                table1 = document.getElementById("tblOs");
                let totalColumnsTbOs = (table1.rows.length);

                for (var i = 1; i < table1.rows.length; i++) {
                    let equipamentoId =
                        document.getElementById("tblOs").rows[i].cells[16].innerHTML;


                    if (equipamentoId == 80) {
                        n1 = 30
                        nome = 'sidinei'
                        alert(equipamentoId)
                    }
                    if (equipamentoId == 120) {
                        n1 = 50
                        nome = 'sidinei rosa'
                        alert(equipamentoId)
                    }
                    data.addRows([
                        ['nome', n1],

                    ]);
                };
                var options = {
                    title: 'Popularity of Types of Pizza',
                    sliceVisibilityThreshold: .2
                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        }
    </script>

</head>
</body>
<script>
    function GerarGráficoLinhas() {
        // Extrai os dados da tabela HTML
        const table = document.getElementById('tblOs');
        const data = Array.from(table.querySelectorAll('tbody tr')).map(row => {
            const cells = Array.from(row.cells);
            return {
                data: cells[1].textContent,
                gasto: parseFloat(cells[16].textContent)
            };
        });

        // Prepara os dados para o gráfico
        const labels = data.map(item => item.data);
        const dataset = {
            label: 'Gasto',
            data: data.map(item => item.gasto),
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        };

        // Cria o gráfico de linhas
        const ctx = document.getElementById('myChart2').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [dataset]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Extrai os dados da tabela HTML
        const table = document.getElementById('tblOs');
        const data = Array.from(table.querySelectorAll('tbody tr')).map(row => {
            const cells = Array.from(row.cells);
            return {
                data: cells[1].textContent,
                gasto: parseFloat(cells[16].textContent)
            };
        });

        // Prepara os dados para o gráfico
        const labels = data.map(item => item.data);
        const dataset = {
            label: 'Gasto',
            data: data.map(item => item.gasto),
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        };

        // Cria o gráfico de barras
        const ctx = document.getElementById('myChart3').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Altera o tipo de gráfico para barras
            data: {
                labels: labels,
                datasets: [dataset]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Exemplo de Gráfico de Pizza com Google Charts</title>
    <!-- Importar a biblioteca do Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        function GeraGraficoPizza() {

            // Carregar a biblioteca de visualização e preparar para desenhar o gráfico
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(desenharGrafico);

            function desenharGrafico() {
                // Obter os dados da tabela
                var dadosTabela = [];
                var table = document.getElementById('tabelaAgrupada');
                var linhas = table.getElementsByTagName('tr');
                for (var i = 1; i < linhas.length; i++) { // Começar do índice 1 para pular a linha de cabeçalho
                    var celulas = linhas[i].getElementsByTagName('td');
                    if (celulas.length === 3) {
                        dadosTabela.push([celulas[0].textContent, parseFloat(celulas[2].textContent), parseFloat(celulas[1].textContent)]);
                    }
                }

                // Criar e preencher a DataTable
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Tarefa');
                data.addColumn('number', 'Horas por Dia');
                data.addColumn('number', 'Outro Valor'); // Adicionar um terceiro valor
                data.addRows(dadosTabela);

                // Configurar as opções do gráfico
                var options = {
                    title: 'Meu Dia Típico',
                    width: 500,
                    height: 500
                };

                // Instanciar e desenhar o gráfico, passando os dados e opções
                var chart = new google.visualization.PieChart(document.getElementById('graficoPizza'));
                chart.draw(data, options);
            }
        }
    </script>
</head>