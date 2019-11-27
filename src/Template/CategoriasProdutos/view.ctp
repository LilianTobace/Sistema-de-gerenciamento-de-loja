<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProduto $categoriasProduto
 */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('categoriasProduto.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<head>
    <?php $this->end();
    $this->start('tb_sidebar'); ?>
    <ul class="nav nav-sidebar> thIndex"
        <li><?= $this->Html->link(__('Editar Categoria'), ['action' => 'edit', $categoriasProduto->id]) ?> 
        </li>
        <li><?= $this->Html->link(__('Nova Categoria'), ['action' => 'add']) ?> 
        </li>
        <li><?= $this->Html->link(__('Listar Categorias'), ['action' => 'index']) ?> 
        </li>
        <li><?= $this->Html->link(__('Listar Produtos'), ['controller' => 'Produtos', 'action' => 'index']) ?> 
        </li>
        <li><?= $this->Html->link(__('Novo Produto'), ['controller' => 'Produtos', 'action' => 'add']) ?> 
        </li>
    </ul>
    <?php $this->end(); ?>
</head>

<body class="panel panel-default bodyView">
    <div class="panel-heading">
        <h3 class="panel-title h3View"><?= h($categoriasProduto->nome_categoria) ?></h3>
    </div>
    <table class="table table-striped thIndex" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="thIndex"><?= $this->Paginator->sort('ID'); ?></th>
                <th class="thIndex"><?= $this->Paginator->sort('Nome'); ?></th>
                <th class="thIndex"><?= $this->Paginator->sort('Cor'); ?></th>
                <th class="thIndex"><?= $this->Paginator->sort('Tecido'); ?></th>
                <th class="thIndex"><?= $this->Paginator->sort('Estoque'); ?></th>
                <th class="thIndex"><?= $this->Paginator->sort('Preço'); ?></th>
                <th class="thIndex"><?= $this->Paginator->sort('Criado'); ?></th>
        </thead>
                
        <tbody>    
            <?php foreach ($categoriasProduto->produtos as $produtos): ?>
             <tr>
                <td><?= h($produtos->id) ?></td>
                <td><?= h($produtos->name) ?></td>
                <td><?= h($produtos->cor) ?></td>
                <td><?= h($produtos->tecido) ?></td>
                <td><?= h($produtos->estoque) ?></td>
                <td>R$<?= h($produtos->preco) ?></td>
                <td><?= date("d/m/Y H:m:s", strtotime($produtos->created)); ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['controller' => 'Produtos', 'action' => 'view', $produtos->id], ['title' => __('Vizualizar'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                    <?= $this->Html->link('', ['controller' => 'Produtos', 'action' => 'edit', $produtos->id], ['title' => __('Editar'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-default glyphicon glyphicon-trash" data-toggle="modal" data-target="#myModal<?=$produtos->id?>"></button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal<?=$produtos->id?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="modal-title">Você tem certeza que deseja deletar o produto <?=$produtos->name?>?</h3>
                                    <br />
                                    <br />
                                    <?= $this->Form->postLink('Sim', ['action' => 'delete', $produtos->id], ['title' => __('Deletar'), 'class' => 'btn btn-success'])?>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                </div>
                            </div>
                        </div>
                    </div>     
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

<div class="paginator pageView">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('Voltar')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Próxima') . ' >') ?>
    </ul>
    <!-- <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) de um total de {{count}}')]) ?></p> -->
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
                    <option value="1">Vizualizar detalhes do cadastro</option>
                    <option value="2">Editar cadastro</option>
                    <option value="3">Excluir cadastro</option>
                    <option value="4">Inserir um novo cadastro</option>
                    <option value="5">Voltar para menu principal</option>
                    <option value="6">Listar cadastros</option>]
                    <option value="7">Voltar para menu principal</option>
                    <option value="8">Logout no sistema</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar no módulo de categorias, procure o cadastro que deseja ver detalhadamente as informações e clique no botão com imagem de um 'olho' do lado direito da listagem.<br /><img src="/projeto/gif/viewCategoria.gif" title="Vizualizar" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de categorias, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarCategoria.gif" title="Editar" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no módulo de categorias, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarCategoria.gif" title="Deletar" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no módulo de categorias, clique no 'Novo cadastro' localizado do lado esquerdo da tela, preencha todos os campos do cadastro e clique no botão 'Cadastrar'.<br /><img src="/projeto/gif/novaCategoria.gif" title="Novo" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar no módulo de categorias, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarProd.gif" title="Voltar" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Listar Categorias de Produtos' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/listarCategoria2.gif" title="Categoria" class="gif"></div>
            <div id="7" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
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
        $('#manual').on('change',function () {
            if($(this).val() === '1'){
                $("#1").show();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
            }
            if($(this).val() === '2'){
                $("#2").show();
                $("#1").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
            }
            if($(this).val() === '3'){
                $("#3").show();
                $("#1").hide();
                $("#2").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
            }
            if($(this).val() === '4'){
                $("#4").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#5").hide();
                $("#6").hide();
                $("#7").hide();
            }
            if($(this).val() === '5'){
                $("#5").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#6").hide();
                $("#7").hide();
            }
            if($(this).val() === '6'){
                $("#6").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#7").hide();
            }
            if($(this).val() === '7'){
                $("#7").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
            }
        });
    });
</script>
