<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('produtovenda.css');
echo $this->Html->css('formCliente.css');
echo $this->Html->css('formularios.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<head>
    <li><?= $this->Html->link(__('Voltar para o carrinho'), ['controller' => 'Vendas', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('Novo Cadastro'), ['action' => 'addCliente']) ?></li>
    <?php $this->end(); ?>
    <?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
</head>
<body style="text-align: center; margin-left: 16%;">
    <h2 class="page-header">Clientes</h2>
    <input class="form-control" id="myInput" type="text" placeholder="Busca" style="width: 20%; height: 30px; margin-left: 40%;">
    <br />
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Nome') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('E-mail') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Telefone') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Cidade') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Estado') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Criado') ?></th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?= $this->Form->create("selecionarCliente", ["class " => "form-add", "action" => "selecionarCliente", "controller" => "Clientes"]) ?>
            <?php foreach ($clientes as $i => $cliente):
            if($i != 0) { ?>
                <tr>
                    <td><?= $this->Number->format($cliente->id) ?></td>
                    <td><?= h($cliente->name) ?></td>
                    <td><?= h($cliente->email) ?></td>
                    <td><?= h($cliente->telefone1_cliente) ?></td>
                    <td><?= h($cliente->cidade_cliente) ?></td>
                    <td><?= h($cliente->estado_cliente) ?></td>
                    <td><?php  echo(date("d/m/Y H:m:s", strtotime($cliente->created))); ?></td>

                    <td class="actions">
                        <button type="submit" class="btn-success btn addcart">+</button>
                        <input type="checkbox" id="name" name="name[]" class="checkTodos input-produto" value="<?php echo $cliente['name'];?>">
                        <input type="checkbox" id="id" name="id" class="checkTodos input-produto" value="<?php echo $cliente['id'];?>">
                    </td>
                </tr>
            <?php
            }
            endforeach; ?>
            <?= $this->Form->end() ?>
        </tbody>
    </table>
</body>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('Voltar')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Próxima') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) de um total de {{count}}')]) ?></p>
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
                    <option value="1">Adicionar cliente na venda</option>
                    <option value="2">Adicionar produto na venda</option>
                    <option value="3">Adicionar produto na venda pelo código de barra</option>
                    <option value="4">Cancelar venda</option>
                    <option value="5">Pagar com cartão de crédito</option>
                    <option value="6">Pagar com cartão de débito</option>
                    <option value="7">Pagar com cartão dinheiro</option>
                    <option value="8">Pagar venda com várias formas de pagamento</option>
                    <option value="9">Inserir desconto na venda</option>
                    <option value="10">Realizar venda</option>
                    <option value="11">Logout no sistema</option>

                </select> 
            </div>
            <br />
            <div id="manual1" style="text-align: center;"><br />Ao estar na tela de venda, deve-se clicar no botão 'Adicionar Cliente'. Depois é só procurar o nome do cliente que deseja adicionar na venda e clicar no botão '+'.<img src="/projeto/gif/addClienteVenda.gif" title="Adicionar Cliente" class="gif"><br /></div>
            <div id="manual2" style="text-align: center;"><br /> Ao estar na tela de venda, deve-se clicar no botão 'Adicionar Item'. Depois só clicar no botão 'Adicionar' do(s) item(s) que deseja inserir no carrinho e depois clicar em 'carrinho'.<br /><img src="/projeto/gif/addItem.gif" title="Adicionar Produto" class="gif"></div>
            <div id="manual3" style="text-align: center;"><br />Ao estar na tela de venda, deve-se clicar no campo 'Código de Barra', passar o leitor no código do produto desejado.<br /><img src="/projeto/gif/codigoBarra.gif" title="Adicionar Produto" class="gif"></div>
            <div id="manual4" style="text-align: center;"><br />Ao estar na tela de venda, deve-se clilcar no botão 'Cancelar Venda'. Depois procure pela venda que deseja cancelar e clicar no botão 'Cancelar' e preencher todos os campos e clicar novamente em 'Cancelar'.<br /><img src="/projeto/gif/cancelarVenda.gif" title="Cancelar" class="gif"></div>
            <div id="manual5" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar forma de pagamento cartão de crédito, inserir o valor e selecionar as parcelas. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/credito.gif" title="Crédito" class="gif"></div>
            <div id="manual6" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar forma de pagamento cartão de débito, inserir o valor. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/debito.gif" title="Débito" class="gif"></div>
            <div id="manual7" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar forma de pagamento em dinheiro, inserir o valor. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/dinheiro.gif" title="Dinheiro" class="gif"></div>
            <div id="manual8" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar a(s) forma(s) de pagamento cartão de crédito, débito ou dinheiro, inserir o valor. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/variosPag.gif" title="Vários pagamentos" class="gif"></div>
            <div id="manual9" style="text-align: center;"><br />Ao estar na tela de venda com produto(s) inserido no carrinho, adicionar o valor do desconto no campo 'desconto'.<br /><img src="/projeto/gif/descontoVenda.gif" title="Desconto" class="gif"></div>
            <div id="manual10" style="text-align: center;"><br />Ao estar na tela de venda, deve-se inserir produtos pelo código de barra ou adicionar itens manualmente. Após itens estarem inseridos no carrinho, altere a quantidade e desconto conforme necessário, após isso clique em 'Pagar Venda', insira a(s) forma(s) de pagamento desejado e clique em 'Realizar pagamento' e por ultimo 'Fechar Venda'.<br /><img src="/projeto/gif/venda.gif" title="Realizar Venda" class="gif"></div>
            <div id="manual11" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
        </div>
    </div> 
</div>

<script>
 $(document).ready(function () {
    $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#manual1").hide();
        $("#manual2").hide();
        $("#manual3").hide();
        $("#manual4").hide();
        $("#manual5").hide();
        $("#manual6").hide();
        $("#manual7").hide();
        $("#manual8").hide();
        $("#manual9").hide();
        $("#manual10").hide();
        $("#manual11").hide();
        $('#manual').on('change',function () {
            if($(this).val() === '1'){
                $("#manual1").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '2'){
                $("#manual2").show();
                $("#manual1").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '3'){
                $("#manual3").show();
                $("#manual2").hide();
                $("#manual1").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '4'){
                $("#manual4").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual1").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '5'){
                $("#manual5").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual1").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '6'){
                $("#manual6").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual1").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '7'){
                $("#manual7").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual1").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '8'){
                $("#manual8").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual1").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '9'){
                $("#manual9").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual1").hide();
                $("#manual10").hide();
                $("#manual11").hide();
            }
            if($(this).val() === '10'){
                $("#manual10").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual1").hide();
                $("#manual11").hide();
            }
            if($(this).val() ==='11' ){
                $("#manual11").show();
                $("#manual2").hide();
                $("#manual3").hide();
                $("#manual4").hide();
                $("#manual5").hide();
                $("#manual6").hide();
                $("#manual7").hide();
                $("#manual8").hide();
                $("#manual9").hide();
                $("#manual10").hide();
                $("#manual1").hide();
            }
        });
    });

    $(".addcart").on("click", function() {
        let checkbox = $(this).siblings(".checkTodos");// Procurar pelo 'irmao' do botao com a classe `.checkTodos`
        checked = checkbox.prop("checked"); // Ve se o checkbox se esta marcado ou não
        checkbox.prop("checked",!checked); // Inverter o status de marcado ou não (toggle)
    });   
</script>