<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('formCliente.css');
echo $this->Html->css('formularios.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<head>
    <li style="text-align: center;"><?= $this->Html->link(__('Listar Clientes'), ['action' => 'addClienteNaVenda']); ?></li>
    <?php $this->end(); ?>
    <?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
</head>
<body class="panel panel-default body">
    <h1 style="text-align: center;" class="page-header">Novo Cadastro de Cliente</h1>
    <div class="bodyDiv">
        <?= $this->Form->create($cliente) ?>
        <fieldset class="fieldset">  
            <div class="divNome">
                <?php echo $this->Form->control('name', array('label' => 'Nome: ', 'class' => 'nome', 'placeholder' => 'Nome Sobrenome')); ?>
            </div>
            <div class="text required div-form">
                <label class="label-form form-data2" for="data_nasc_cliente">Data de Nascimento: </label>
                <input type="date" name="data_nasc_cliente" required="required" maxlength="255" id="data_nasc_cliente" class="form-control-customizada form-data" style="width: 126%;">
            </div>
            <div class="divRg">
                <?php echo $this->Form->control('rg_cliente', array('label' => 'RG: ', 'class' => 'rg', 'placeholder' => '00.000.000-0'));?>
            </div>
            <br />
            <br />
            <br />
            <br />
            <div class="divCpf">
                <?php echo $this->Form->control('cpf_cliente', array('label' => 'CPF: ', 'class' => 'cpf', 'placeholder' => '000.000.000-00')); ?>
            </div>
            <div class="divTelefone1">
                <?php echo $this->Form->control('telefone1_cliente', array('label' => 'Telefone: ', 'class' => 'telefone1', 'placeholder' => '(00) 0000-0000', 'type' => 'number')); ?>
            </div>
            <div class="divTelefone2">
                <?php echo $this->Form->control('telefone2_cliente', array('label' => 'Celular: ', 'class' => 'telefone2', 'placeholder' => '(00) 0000-0000', 'type' => 'number')); ?>
            </div>
            <br />
            <br />
            <br />
            <br />
            <div class="divEndereco">
                <?php echo $this->Form->control('endereco_cliente', array('label' => 'Endereço: ', 'class' => 'endereco', 'placeholder' => 'Rua X')); ?>
            </div>
            <div class="divNumero">
                <?php echo $this->Form->control('numero_cliente', array('label' => 'Número: ', 'class' => 'numero', 'placeholder' => 'N.º: 000')); ?>
            </div>
            <div class="divBairro">
                <?php echo $this->Form->control('bairro_cliente', array('label' => 'Bairro: ', 'class' => 'bairro', 'placeholder' => 'Bairro X')); ?>
            </div>
            <br />
            <br />
            <br />
            <br />
            <div class="divEstado">
                <label class="control-label" for="estado_cliente">Estado: </label>
                <select class="form-control estado"  id="estado_cliente" name="estado_cliente">
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
            </div>
            <div class="divCidade">
                <?php echo $this->Form->control('cidade_cliente', array('label' => 'Cidade: ', 'class' => 'cidade', 'placeholder' => 'Cidade')); ?>
            </div>
            <div class="divCep">
                <?php echo $this->Form->control('cep_cliente', array('label' => 'CEP: ', 'class' => 'cep', 'placeholder' => '00000-000', 'type' => 'number')); ?>
            </div>
            <br />
            <br />
            <br />
            <br />

            <div class="divEmail">
                <?php echo $this->Form->control('email', array('label' => 'E-mail: ', 'class' => 'e-mail', 'placeholder' => 'email@email.com')); ?>
            </div>

            <div class="divComentario">
                <label class="label-form " for="comentario_cliente">Comentário: </label>
                <input name="comentario_cliente" id="comentario_cliente" class="form-control comentario">
            </div>
            <?php
            date_default_timezone_set('America/Fortaleza');
            $modified = date("Y-m-d H:i:s");
            $created = date("Y-m-d H:i:s");
            $this->Form->control('created');
            echo '<input type="hidden" name="modified" value="'.$modified.'">';
            echo '<input type="hidden" name="created" value="'.$created.'">';
            ?>

        </fieldset>
        <div class="botao-form">
            <button type="submit" class="btn btn-default botao-form2">Editar</button>
            <?= $this->Form->end() ?>
        </div>
    </div>
</body>

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
</script>