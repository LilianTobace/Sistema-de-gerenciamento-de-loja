<?php
use Cake\ORM\TableRegistry;
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/relatorio.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/relatorio2.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/relatorioProduto.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/filtroRelatorio.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/imagemRelatorio.css>

<head>
    <li><?= $this->Html->link(__('Relatórios de Caixa'), ['action' => 'view_caixa']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Cliente'), ['action' => 'view_cliente']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Estoque'), ['action' => 'view_estoque']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Venda'), ['action' => 'view_venda']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Ticket Médio'), ['action' => 'view_ticket']);?></li>
    <li><?= $this->Html->link(__('Relatórios de Despesa'), ['action' => 'view_despesa']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Pagamento'), ['action' => 'view_pagamento']); ?></li>

    <?php $this->end();
    $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
</head>

<body class="relatorio-venda">
    <h2 class="page-header">Relatório de Produto</h2>
    <?= $this->Form->create($produtosVendas) ?>
    <form method="post" action="/projeto/relatorios/view-produto">
        <label for="data_inicio" style="" class="filtroLabel1">Data de Ínicio: </label>
        <input type="date" name="data_inicio" maxlength="255" id="data_inicio" class="form-control input1">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="data_final" class="filtroLabel2">Data Final: </label>
        <input  type="date" name="data_final" maxlength="255" id="data_final" class="form-control input2">              
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-default btn-success button1" id="filtro">Filtrar</button>
        <a href="../relatorios/graficoProduto/">
            <img src="/projeto/img/grafico.png" title="Grafico" id="grafico" class="printer imagem1">
        </a>  
        <a href="../relatorios/pdfProduto/">
            <img src="/projeto/img/impressora.png" title="Impressora" id="impressora" class="printer imagem2">
        </a>  
        <table class="table table-striped" cellpadding="0" cellspacing="0">   
            <thead>
                <tr>
                    <th class="th-venda"><?= $this->Paginator->sort('ID Venda'); ?></th>        
                    <th class="th-venda"><?= $this->Paginator->sort('ID Produto'); ?></th>        
                    <th class="th-venda"><?= $this->Paginator->sort('Nome'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Quantidade'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Desconto'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Preço Unitário'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Total'); ?></th>
                    <th class="th-venda"><?= $this->Paginator->sort('Data'); ?></th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                if(isset($_SESSION['listaFiltrada'])){
                    $listaFiltrada = $_SESSION['listaFiltrada'];   ?>
                    <?php                
                    for ($i=0; $i<count($listaFiltrada); $i++) { ?>
                        <tr>
                            <td><?php echo $listaFiltrada[$i]['vendas_id'] ?></td>
                            <td><?php echo $listaFiltrada[$i]['produtos_id'] ?></td>
                            <td><?php echo $listaFiltrada[$i]['name'] ?></td>
                            <td><?php echo $listaFiltrada[$i]['quantidade'] ?></td>
                            <td><?php echo $listaFiltrada[$i]['desconto'] ?></td>
                            <td><?php echo $listaFiltrada[$i]['preco'] ?></td>
                            <td><?php echo $listaFiltrada[$i]['subtotal'] ?></td>
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
                    foreach ($produtosVendas as $produtosVenda):
                    unset($_SESSION['listaFiltrada']);
                ?>
                    <tr>
                        <td><?= $this->Number->format($produtosVenda->vendas_id) ?></td>
                        <td><?= $this->Number->format($produtosVenda->produtos_id) ?></td>
                        <td><?= h($produtosVenda->name) ?></td> 
                        <td><?= h($produtosVenda->quantidade) ?></td> 
                        <td><?= h($produtosVenda->desconto) ?></td> 
                        <td><?= h($produtosVenda->preco) ?></td> 
                        <td><?= h($produtosVenda->subtotal) ?></td> 
                        <?php  $criado =  date("d/m/Y H:m:s", strtotime($produtosVenda->created));?>
                        <td><?php echo $criado ?></td>
                    </tr>
                <?php 
                endforeach;
                }   ?>
            </tbody>
        </table>
    </form>
    <?= $this->Form->end()?>

    <!-- Resultado da filtragem -->
    <table id="resultadoFiltro" class="table resultado_relatorio">
        <tr>
            <th class="resultado_relatorio1 trRodape">
                <?php 
                $produtoVendido = $_SESSION['produtoVendido'];
                    $dateI =  date("d/m/Y", strtotime($_SESSION['dataInicio']));
                    $dateF =  date("d/m/Y", strtotime($_SESSION['dataFinal']));
                ?>
                De <?php echo $dateI ?> a <?php echo $dateF ?>
            </th>
            <?php 
            $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
            $query = $produtosVendas
                        ->find()
                        ->where([
                                'id' => $produtoVendido
                        ]);
                $results = $query->toArray();
            if(isset($results[0])){   
                $nomeProduto =  $results[0]['name'];          
            }
            ?>
            <th class="resultado_relatorio1 trRodape">Produto mais vendido: <?php echo $nomeProduto ?></th>
            <th class="resultado_relatorio1 trRodape">ID Produto: <?php echo $_SESSION['produtoVendido'] ?></th>
        </tr>
        <tr>
            <th class="resultado_relatorio1 trRodape">
                Quantidade:  <?php echo $_SESSION['quantidadeProduto'] ?>
            </th>            
            <th class="resultado_relatorio1 trRodape">
                Valor Total:  R$<?php echo $_SESSION['valorTotalProduto'] ?>
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
</script>       