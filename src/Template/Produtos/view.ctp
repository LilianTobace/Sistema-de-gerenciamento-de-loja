<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
echo $this->Html->css('produtos.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<head>
    <?php $this->end();
    $this->start('tb_sidebar'); ?>

    <ul class="nav nav-sidebar th">
        <li><?= $this->Html->link(__('Editar Produto'), ['action' => 'edit', $produto->id]) ?> 
        </li>
        <li><?= $this->Html->link(__('Listar Produtos'), ['action' => 'index']) ?> 
        <li><?= $this->Html->link(__('Novo Produto'), ['action' => 'add']) ?> 
        </li>
        </li>
        <li><?= $this->Html->link(__('Listar Categoria de Produtos'), ['controller' => 'CategoriasProdutos', 'action' => 'index']) ?>
        </li>
        <li><?= $this->Html->link(__('Nova Categoria de Produto'), ['controller' => 'CategoriasProdutos', 'action' => 'add']) ?> 
        </li>
    </ul>
    <?php $this->end(); ?>
</head>
<body class="panel panel-default bodyView">
    <div class="panel-heading">
        <h3 class="panel-title h3View"><?= h($produto->name) ?></h3>
    </div>

    <table class="table table-striped th">
        <tr>
            <td><?= __('ID') ?></td>
            <td><?= $this->Number->format($produto->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Código de Barra') ?></td>
            <td><?= h($produto->codigo_barra) ?></td>
        </tr>
        <tr>
            <td><?= __('Nome') ?></td>
            <td><?= h($produto->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Categoria do Produto') ?></td>
            <td><?= h($produto->categorias_produto->nome_categoria) ?></td>
        </tr>
        <tr>
            <td><?= __('Fornecedor') ?></td>
            <td><?= h($produto->fornecedore->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Cor') ?></td>
            <td><?= h($produto->cor) ?></td>
        </tr>
        <tr>
            <td><?= __('Tecido') ?></td>
            <td><?= h($produto->tecido) ?></td>
        </tr>
        <tr>
            <td><?= __('Tamanho') ?></td>
            <td><?= h($produto->tamanho) ?></td>
        </tr>
        <tr>
            <td><?= __('Estoque') ?></td>
            <td><?= $this->Number->format($produto->estoque) ?></td>
        </tr>
        <tr>
            <td><?= __('Custo Bruto') ?></td>
            <td>R$<?= $this->Number->format($produto->custo_bruto) ?></td>
        </tr>
        <tr>
            <td><?= __('Preço') ?></td>
            <td>R$<?= $this->Number->format($produto->preco) ?></td>
        </tr>
        <tr>
            <td><?= __('Desconto') ?></td>
            <td><?= $this->Number->format($produto->desconto) ?></td>
        </tr>
        <tr>
            <td><?= __('Descrição do tecido') ?></td>
            <td><?= h($produto->descricao_tecido) ?></td>
        </tr>
        <tr>
            <td><?= __('Descrição do produto') ?></td>
            <td><?= h($produto->descricao_produto) ?></td>
        </tr>
        <tr>
            <td><?= __('Criado') ?></td>
            <td><?= date("d/m/Y H:m:s", strtotime($produto->created)); ?></td>
        </tr>
        <tr>
            <td><?= __('Modificado') ?></td>
            <td><?= date("d/m/Y H:m:s", strtotime($produto->modified)); ?></td>
        </tr>
    </table>
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
                    <option value="1">Vizualizar detalhes do cadastro</option>
                    <option value="2">Editar cadastro</option>
                    <option value="3">Excluir cadastro</option>
                    <option value="4">Inserir um novo cadastro</option>
                    <option value="5">Voltar para menu principal</option>
                    <option value="6">Listar cadastros</option>
                    <option value="7">Configurar estoque mínimo</option>
                    <option value="8">Entrar na listagem de estoque baixo</option>
                    <option value="9">Listar categoria de produto</option>
                    <option value="10">Entrar na listagem de desconto</option>
                    <option value="11">Voltar para menu principal</option>
                    <option value="12">Logout no sistema</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja ver detalhadamente as informações e clique no botão com imagem de um 'olho' do lado direito da listagem.<br /><img src="/projeto/gif/viewProd.gif" title="Vizualizar" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarProd2.gif" title="Editar" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarProd.gif" title="Deletar" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no módulo de produtos, clique no 'Novo cadastro' localizado do lado esquerdo da tela, preencha todos os campos do cadastro e clique no botão 'Cadastrar'.<br /><img src="/projeto/gif/novoProd.gif" title="Novo" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarProd.gif" title="Voltar" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Listar Produtos' localizado no lado esquerdo da tela.<br /><img src="/projeto/gif/listarProd.gif" title="Listar" class="gif"></div>
            <div id="7" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Configurar Estoque Baixo' localizado do lado esquerdo da tela. Depois preencher o campos e clicar no botão 'Configurar'.<br /><img src="/projeto/gif/configEstoque.gif" title="Configurar" class="gif"></div>
            <div id="8" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Estoque Baixo' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/entrarEstoque.gif" title="Estoque" class="gif"></div>
            <div id="9" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Listar Categorias de Produtos' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/listarCategoria2.gif" title="Categoria" class="gif"></div>
            <div id="10" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Descontos' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/entrarDesconto.gif" title="Desconto" class="gif"></div>
            <div id="11" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarProd.gif" title="Voltar" class="gif"></div>
            <div id="12" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
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
                $("#7").hide();
                $("#11").hide();
            }
        });
    });
</script>