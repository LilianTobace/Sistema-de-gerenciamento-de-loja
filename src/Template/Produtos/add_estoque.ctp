<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto[]|\Cake\Collection\CollectionInterface $produtos
 */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('produtos.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<head>
    <li><?= $this->Html->link(__('Lista de Produtos com Estoque Baixo'), ['action' => 'estoque']) ?></li>
    <li><?= $this->Html->link(__('Descontos'), ['action' => 'desconto']) ?></li>
    <li><?= $this->Html->link(__('Lista de Produtos'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('Novo Produto'), ['action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('Nova Categoria'),  ['controller' => 'CategoriasProdutos', 'action' => 'add']) ?>
        
    </li>
    <li><?= $this->Html->link(__('Listar Categorias de Produto'),['controller' => 'CategoriasProdutos', 'action' => 'index']) ?>
    </li>
    <?php $this->end(); ?>
    <?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
</head>

<body class="bodyAddEstoque">
    <h2 class="page-header">Editar Estoques</h2>
    <p>
        <label class="control-label">Adicionar Estoque em Todos Produtos: </label>
        <input type="number" name="addEstoque" step="any" class="form-control addDesconto inputEstoque" id="addEstoque"">
    </p>
    <?= $this->Form->create($produtos) ?>
    <form action="/projeto/produtos/estoque/" method="post">
        <table class="table table-striped"  cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" class="th"><?= $this->Paginator->sort('ID') ?></th>
                    <th scope="col" class="th"><?= $this->Paginator->sort('Nome') ?></th>
                    <th scope="col" class="th"><?= $this->Paginator->sort('Desconto') ?></th>
                    <th scope="col" class="th"><?= $this->Paginator->sort('Estoque') ?></th>
                    <th scope="col" class="th"><?= $this->Paginator->sort('Preço') ?></th>
                    <th scope="col" class="th"><?= $this->Paginator->sort('Criado') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                foreach ($produtos as $produto): 
                if($produto->estoque <= $_SESSION['configEstoque']){    
                ?> 
                    <tr>
                        <td>
                        <?= $this->Number->format($produto->id) ?>
                        <?php echo '<input type="hidden" name="id[]" value="'.$produto->id.'" step="any" class="form-control">' ?>
                        </td>
                        <td><?= h($produto->name) ?></td>
                        <td><?= h($produto->desconto) ?></td>
                        <td>
                            <input type="number" name="estoque[]" step="any" class="form-control outroDesc inputEstoque2">
                        </td>
                        <td>R$<?= $this->Number->format($produto->preco) ?></td>
                        <td><?= date("d/m/Y H:m:s", strtotime($produto->created)); ?><td>
                    </tr>
                <?php
                }
                endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary" id="click">Editar</button>
    </form>
    <?= $this->Form->end() ?>
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
            <div id="manual1" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja ver detalhadamente as informações e clique no botão com imagem de um 'olho' do lado direito da listagem.<br /><img src="/projeto/gif/viewProd.gif" title="Vizualizar" class="gif"></div>
            <div id="manual2" style="text-align: center;"><br />Ao estar no módulo de estoque, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarEstoque.gif" title="Editar" class="gif"></div>
            <div id="manual3" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarProd.gif" title="Deletar" class="gif"></div>
            <div id="manual4" style="text-align: center;"><br />Ao estar no módulo de produtos, clique no 'Novo cadastro' localizado do lado esquerdo da tela, preencha todos os campos do cadastro e clique no botão 'Cadastrar'.<br /><img src="/projeto/gif/novoProd.gif" title="Novo" class="gif"></div>
            <div id="manual5" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarProd.gif" title="Voltar" class="gif"></div>
            <div id="manual6" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Listar Produtos' localizado no lado esquerdo da tela.<br /><img src="/projeto/gif/listarProd.gif" title="Listar" class="gif"></div>
            <div id="manual7" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Configurar Estoque Baixo' localizado do lado esquerdo da tela. Depois preencher o campos e clicar no botão 'Configurar'.<br /><img src="/projeto/gif/configEstoque.gif" title="Configurar" class="gif"></div>
            <div id="manual8" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Estoque Baixo' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/entrarEstoque.gif" title="Estoque" class="gif"></div>
            <div id="manual9" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Listar Categorias de Produtos' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/listarCategoria2.gif" title="Categoria" class="gif"></div>
            <div id="manual10" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Descontos' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/entrarDesconto.gif" title="Desconto" class="gif"></div>
            <div id="manual11" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarProd.gif" title="Voltar" class="gif"></div>
            <div id="manual12" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
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
    $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
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
            $("#manual12").hide();
        }
        if($(this).val() === '11'){
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
            $("#manual12").hide();
        }
        if($(this).val() === '12'){
            $("#manual12").show();
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
            $("#manual1").hide();
        }
    });
});
    
    $("#addEstoque").on("input", function(){   
        var addEstoque = ($(this).val());
        console.log(addEstoque);
        $(".outroDesc").attr('value', addEstoque);
    });
</script>