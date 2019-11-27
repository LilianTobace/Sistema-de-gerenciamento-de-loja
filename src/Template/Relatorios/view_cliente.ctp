<?php
use Cake\ORM\TableRegistry;
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="/projeto/webroot/js/estados_cidades.js"></script>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/relatorio.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/relatorio2.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/filtroRelatorio.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/imagemRelatorio.css>

    <li><?= $this->Html->link(__('Relatórios de Caixa'), ['action' => 'view_caixa']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Estoque'), ['action' => 'view_estoque']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Venda'), ['action' => 'view_venda']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Produtos'), ['action' => 'view_produto']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Ticket Médio'), ['action' => 'view_ticket']);?></li>
    <li><?= $this->Html->link(__('Relatórios de Despesa'), ['action' => 'view_despesa']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Pagamento'), ['action' => 'view_pagamento']); ?></li>

    <?php $this->end();
    $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
</head>

<body class="relatorio-venda">
    <h2 class="page-header">Relatório de Cliente</h2>
    <?= $this->Form->create($vendas) ?>
    <form method="post" action="/projeto/relatorios/view-venda">
        <label for="data_inicio" style="" class="filtroLabel1">Data de Ínicio: </label>
        <input type="date" name="data_inicio" maxlength="255" id="data_inicio" class="form-control input1">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="data_final" class="filtroLabel2">Data Final: </label>
        <input  type="date" name="data_final" maxlength="255" id="data_final" class="form-control input2">              
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-default btn-success button1" id="filtro">Filtrar</button>    
            <!--<tr>
                <td>
                    <label class="filtro-data filtro-data2" for="estado">Estado: </label>
                    <select class="filtro-data"  id="estado" name="estado" onchange="buscaCidades(this.value)">
                        <option>Secione o estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </td>
                <td>
                    <label class="filtro-data filtro-data2" for="">Cidade: </label>
                    <select class="filtro-data"  id="cidade" name="cidade">
                        <option>Secione a cidade</option>
                    </select>
                </td>
            </tr>-->
       
        <a href="../relatorios/graficoCliente/">
            <img src="/projeto/img/grafico.png" title="Grafico" id="grafico" class="printer imagem1">
        </a>  
        <a href="../relatorios/pdfCliente/">
            <img src="/projeto/img/impressora.png" title="Impressora" id="impressora" class="printer imagem2">
        </a>  
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="th-venda"><?= $this->Paginator->sort('ID'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Cliente'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Cidade'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Quantidade de Produtos'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Total da Venda'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Pagamentos'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Data da venda'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php if(isset($_SESSION['listaFiltrada'])){ 
                    $listaFiltrada = $_SESSION['listaFiltrada'];                    
                    for ($i=0; $i<count($listaFiltrada); $i++) { ?>
                    <tr>
                        <td><?php echo $listaFiltrada[$i]['id'] ?></td>
                        <?php         
                        $cliente = TableRegistry::getTableLocator()->get('Clientes');
                        $query = $cliente
                            ->find()
                            ->where([
                                    'id' => $listaFiltrada[$i]['clientes_id']
                            ]);
                        $results = $query->toArray();
                        if(isset($results[0])){                
                            $nome = $results[0]["name"];
                            $nomeCliente[] = $nome;
                            $_SESSION['nomeCliente'] = $nomeCliente;
                        }
                        ?>
                        <td><?php echo $nome ?></td> 
                        <?php         
                        $cliente = TableRegistry::getTableLocator()->get('Clientes');
                        $query = $cliente
                            ->find()
                            ->where([
                                    'id' => $listaFiltrada[$i]['clientes_id']
                            ]);
                        $results = $query->toArray();
                        if(isset($results[0])){                
                            $cidadeCliente = $results[0]["cidade_cliente"];
                        }
                        ?>
                        <td><?php echo $cidadeCliente ?></td>
                        <td class="quant"><?php echo $listaFiltrada[$i]['total_produto'] ?></td>
                        <td class="totalVenda"><?php echo $listaFiltrada[$i]['total_venda'] ?></td>
                        <td><?php echo $listaFiltrada[$i]['total_pagamentos']  ?></td>
                        <?php  $criado =  date("d/m/Y H:m:s", strtotime($listaFiltrada[$i]['created']));?>
                        <td><?php echo $criado ?></td>
                    </tr>

                    <script>
                        $(document).ready(function () {
                              $("#resultadoFiltro").show();
                        });
                    </script>
                <?php
                    }
                }else{
                    foreach ($vendas as $venda):
                    unset($_SESSION['listaFiltrada']);
                ?>
                    <tr>
                        <td><?= $this->Number->format($venda->id) ?></td>
                        <?php         
                        $cliente = TableRegistry::getTableLocator()->get('Clientes');
                        $query = $cliente
                            ->find()
                            ->where([
                                    'id' => $venda->clientes_id
                            ]);
                        $results = $query->toArray();
                        if(isset($results[0])){                
                            $nome = $results[0]["name"];
                        }
                        ?>
                        <td><?= $nome ?></td>
                        <?php         
                        $cliente = TableRegistry::getTableLocator()->get('Clientes');
                        $query = $cliente
                            ->find()
                            ->where([
                                    'id' => $venda->clientes_id
                            ]);
                        $results = $query->toArray();
                        if(isset($results[0])){                
                            $cidadeCliente = $results[0]["cidade_cliente"];
                        }
                        ?>
                        <td><?php echo $cidadeCliente ?></td>
                        <td class="quant"><?= h($venda->total_produto) ?></td>
                        <td class="totalVenda">R$<?= h($venda->total_venda) ?></td>
                        <td><?= h($venda->total_pagamentos) ?></td>
                        <?php $criado =  date("d/m/Y H:m:s", strtotime($venda->created));?>
                        <td><?php echo $criado ?></td>
                    </tr>
                <?php 
                endforeach;
                }   ?>
            </tbody>
        </table>
    </form>
    <?= $this->Form->end() ?>

    <!-- Resultado da filtragem -->
    <table id="resultadoFiltro" class="table resultado_relatorio">
        <tr>
            <th class="resultado_relatorio1">
                <?php 
                    $dataInicio =  $_SESSION['dataInicio'];
                    $dataFinal =   $_SESSION['dataFinal'];
                    $dateI =  date("d/m/Y", strtotime($_SESSION['dataInicio']));
                    $dateF =  date("d/m/Y", strtotime($_SESSION['dataFinal']));
                ?>
                De <?php echo $dateI ?> a <?php echo $dateF ?>
            </th>
            <!--Cliente que mais comprou e quantidade de produto-->
            <?php
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'clientes_id',
                        'sum' => $query->func()->sum('total_produto')
                ])
                ->where([
                        'created >=' => $dataInicio, 
                        'created <=' => $dataFinal
                ])
                ->group('clientes_id')
                ->order(['sum' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['cliente'] = $results[0]['clientes_id'];
                $_SESSION['produtoTotal'] = $results[0]['sum'];
                $cliente = TableRegistry::getTableLocator()->get('Clientes');
                $query = $cliente->find()
                        ->where([
                                'id' => $_SESSION['cliente']
                        ]);
                $results = $query->toArray();
                if(isset($results[0])){                
                    $nomeCliente = $results[0]["name"];
                }  
            }              
            ?>
            <th class="resultado_relatorio1">
                Cliente que mais comprou: <?php echo $nomeCliente ?>
            </th>
        <!--</tr>
        <tr>
            <?php
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'clientes_id',
                        'sum' => $query->func()->sum('clientes_id')
                ])
                ->where([
                        'created >=' => $dataInicio, 
                        'created <=' => $dataFinal
                ])
                ->group('clientes_id')
                ->order(['sum' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['clienteId'] = $results[0]['sum'];
                $clientes = TableRegistry::getTableLocator()->get('Clientes');
                $query = $clientes->find()
                    ->where([
                                'cidade_cliente' => $_SESSION['clienteId']
                        ])
                    ->select([
                            'id',
                            'sum' => $query->func()->sum('cidade_cliente')
                    ])
                    ->where([
                            'created >=' => $dataInicio, 
                            'created <=' => $dataFinal
                        ])
                        ->group('id')
                        ->order(['sum' => 'DESC']);
                    $results = $query->toArray();
                    if(isset($results[0])){
                        $cidadeCliente = $results[0]['sum'];
                    }
                }
            ?>
            <th class="resultado_relatorio1">
                Região com mais compras: <?php echo $cidadeCliente ?>
            </th>-->
            <th class="resultado_relatorio1">
                Quantidade de produto: <?php echo $_SESSION['produtoTotal'] ?>
            </th>
            <!--Valor total-->
            <?php
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'clientes_id',
                        'sum' => $query->func()->sum('total_venda')
                ])
                ->where([
                        'created >=' => $dataInicio, 
                        'created <=' => $dataFinal
                ])
                ->group('clientes_id')
                ->order(['sum' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['totalVenda'] = $results[0]['sum'];
            }
            ?>
            <th class="resultado_relatorio1">
                Valor Total:  R$<?php echo $_SESSION['totalVenda'] ?>
            </th>
        </tr>
    </table> 
</body>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('Voltar')) ?>
        <?= $this->Paginator->next(__('Próxima') . ' >') ?>
    </ul>
</div>

<!-- The Modal -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="div-modal modal-dialog modal-lg">
        <div class="modal-content">
        <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="h2-modal modal-title h2Modal">Manual do Usuário</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="div2Modal">
                <select class="form-control"  title="manual" id="manual" style="width: 30%; margin-left: 35%;">
                    <option>Secione sua dúvida</option>
                    <option value="1">Filtrar relatório de venda</option>
                    <option value="2">Visualizar gráfico de venda</option>
                    <option value="3">Imprimir relatório de venda</option>
                    <option value="4">Filtrar relatório de caixa</option>
                    <option value="5">Visualizar gráfico de caixa</option>
                    <option value="6">Imprimir relatório de caixa</option>
                    <option value="7">Filtrar relatório de estoque</option>
                    <option value="8">Visualizar gráfico de estoque</option>
                    <option value="9">Imprimir relatório de estoque</option>
                    <option value="10">Filtrar relatório de cliente</option>
                    <option value="11">Visualizar gráfico de cliente</option>
                    <option value="12">Imprimir relatório de cliente</option>
                    <option value="13">Filtrar relatório de produtos</option>
                    <option value="14">Visualizar gráfico de produtos</option>
                    <option value="15">Imprimir relatório de produtos</option>
                    <option value="16">Filtrar relatório de ticket médio</option>
                    <option value="17">Visualizar gráfico de ticket médio</option>
                    <option value="18">Imprimir relatório de ticket médio</option>
                    <option value="19">Filtrar relatório de despesas</option>
                    <option value="20">Visualizar gráfico de despesas</option>
                    <option value="21">Imprimir relatório de despesas</option>
                    <option value="22">Filtrar relatório de pagamento</option>
                    <option value="23">Imprimir relatório de pagamento</option>
                    <option value="24">Logout no sistema</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioVenda.gif" title="Relatório de Venda" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de um gráfico no canto direito da tela.<br /><img src="/projeto/gif/graficoVenda.gif" title="Gráfico Venda" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfVenda.gif" title="PDF Venda" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioCaixa.gif" title="Relatório de Caixa" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de um gráfico no canto direito da tela.<br /><img src="/projeto/gif/graficoCaixa.gif" title="Gráfico Caiax" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfCaixa.gif" title="PDF Caixa" class="gif"></div>
            <div id="7" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioEstoque.gif" title="Relatório de Estoque" class="gif"></div>
            <div id="8" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de um gráfico no canto direito da tela.<br /><img src="/projeto/gif/graficoEstoque.gif" title="Gráfico Caixa" class="gif"></div>
            <div id="9" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfEstoque.gif" title="PDF Estoque" class="gif"></div>
            <div id="10" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioCliente.gif" title="Relatório de Cliente" class="gif"></div>
            <div id="11" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de um gráfico no canto direito da tela.<br /><img src="/projeto/gif/graficoCliente.gif" title="Gráfico Cliente" class="gif"></div>
            <div id="12" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfCliente.gif" title="PDF Cliente" class="gif"></div>
            <div id="13" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioProdutos.gif" title="Relatório de Produtos" class="gif"></div>
            <div id="14" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de um gráfico no canto direito da tela.<br /><img src="/projeto/gif/graficoProdutos.gif" title="Gráfico Produtos" class="gif"></div>
            <div id="15" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfProdutos.gif" title="PDF Produtos" class="gif"></div>
            <div id="16" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioTicket.gif" title="Relatório de Ticket Médio" class="gif"></div>
            <div id="17" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de um gráfico no canto direito da tela.<br /><img src="/projeto/gif/graficoTicket.gif" title="Gráfico Ticket Médio" class="gif"></div>
            <div id="18" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfTicket.gif" title="PDF Ticket Médio" class="gif"></div>
            <div id="19" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioDespesa.gif" title="Relatório de Despesa" class="gif"></div>
            <div id="20" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de um gráfico no canto direito da tela.<br /><img src="/projeto/gif/graficoDespesa.gif" title="Gráfico Despesa" class="gif"></div>
            <div id="21" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfDespesa.gif" title="PDF Despesa" class="gif"></div>
            <div id="22" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'.<br /><img src="/projeto/gif/relatorioPagamento.gif" title="Relatório de Pagamento" class="gif"></div>
            <div id="23" style="text-align: center;"><br />Ao estar no módulo de relatório, deve-se preenccher todos os campos do filtro e clicar no botão 'Filtrar'. Depois clicar na imagem de uma impressora no canto direito da tela.<br /><img src="/projeto/gif/pdfPagamento.gif" title="PDF Pagamento" class="gif"></div>
            <div id="24" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
        </div>
    </div> 
</div>

<script>
    $(document).ready(function () {
        $("#1").hide();
        $("#2").hide();
        $("#3").hide();
        $("#4").hide();
        $("#5").hide();
        $("#6").hide();
        $("#7").hide();
        $("#8").hide();
        $("#9").hide();
        $("#10").hide();
        $("#11").hide();
        $("#12").hide();
        $("#13").hide();
        $("#14").hide();
        $("#15").hide();
        $("#16").hide();
        $("#17").hide();
        $("#18").hide();
        $("#19").hide();
        $("#20").hide();
        $("#21").hide();
        $("#22").hide();
        $("#23").hide();
        $("#24").hide();
        $('#manual').on('change',function () {
            if($(this).val() === '1'){
                $("#1").show();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '2'){
                $("#2").show();
                $("#1").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '3'){
                $("#3").show();
                $("#1").hide();
                $("#2").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '4'){
                $("#4").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '5'){
                $("#5").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#6").hide();
                $("#7").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '6'){
                $("#6").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#7").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '7'){
                $("#7").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '8'){
                $("#8").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '9'){
                $("#9").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#7").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '10'){
                $("#10").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#7").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '11'){
                $("#11").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#7").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '12'){
                $("#12").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#7").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '13'){
                $("#13").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#7").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '14'){
                $("#14").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#7").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '15'){
                $("#15").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#7").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '16'){
                $("#16").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#7").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '17'){
                $("#17").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#7").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '18'){
                $("#18").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#7").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '19'){
                $("#19").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#7").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '20'){
                $("#20").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#7").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '21'){
                $("#21").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#7").hide();
                $("#22").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '22'){
                $("#22").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#7").hide();
                $("#23").hide();
                $("#24").hide();
            }
            if($(this).val() === '23'){
                $("#23").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#7").hide();
                $("#24").hide();
            }
            if($(this).val() === '24'){
                $("#24").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#11").hide();
                $("#12").hide();
                $("#13").hide();
                $("#14").hide();
                $("#15").hide();
                $("#16").hide();
                $("#17").hide();
                $("#18").hide();
                $("#19").hide();
                $("#20").hide();
                $("#21").hide();
                $("#22").hide();
                $("#23").hide();
                $("#7").hide();
            }
        });
    });

    $("#resultadoFiltro").hide();

function buscaCidades(e){
   document.querySelector("#cidade").innerHTML = '';
   var cidade_select = document.querySelector("#cidade");

   var num_estados = json_cidades.estados.length;
   var j_index = -1;

   // aqui eu pego o index do Estado dentro do JSON
   for(var x=0;x<num_estados;x++){
      if(json_cidades.estados[x].sigla == e){
         j_index = x;
      }
   }

   if(j_index != -1){
  
      //percorrer todas as cidades e cria os OPTIONS
      json_cidades.estados[j_index].cidades.forEach(function(cidade){
         var cid_opts = document.createElement('option');
         cid_opts.setAttribute('value',cidade)
         cid_opts.innerHTML = cidade;
         cidade_select.appendChild(cid_opts);
      });
   }else{
      document.querySelector("#cidade").innerHTML = '';
   }
}
</script>       