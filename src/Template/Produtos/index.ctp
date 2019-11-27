<?php

use Cake\ORM\TableRegistry;
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('produtos.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php 
    $user = TableRegistry::getTableLocator()->get('Users');
    $query = $user
            ->find()
            ->where([
                    'username' => $_SESSION['usuarioLogado']
            ]);
    $results = $query->toArray();
    if(isset($results[0])){
        $role = $results[0]["role"];
    }
    ?>
    <?php
    if($role == "gerente"){ ?>
        <li><?= $this->Html->link(__('Descontos'), ['action' => 'desconto']) ?></li>
    <?php
    }
    ?>
    <li><?= $this->Html->link(__('Estoque Baixo'), ['action' => 'estoque']) ?></li>
    <li><?= $this->Html->link(__('Configurar Estoque Baixo'), ['action' => 'configEstoque']) ?></li>
    <li><?= $this->Html->link(__('Novo Produto'), ['action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('Nova Categoria'),  ['controller' => 'CategoriasProdutos', 'action' => 'add']) ?>
    </li>
    <li><?= $this->Html->link(__('Listar Categorias de Produto'),['controller' => 'CategoriasProdutos', 'action' => 'index']) ?>
    </li>
    <?php $this->end(); ?>
    <?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>


<body class="bodyEstoque">
    <h2 class="page-header">Produtos</h2>
    <input class="form-control" id="myInput" type="text" placeholder="Busca" style="width: 20%; height: 30px; margin-left: 40%;">
    <br />
    <table class="table table-striped"  cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="th"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col" class="th"><?= $this->Paginator->sort('Nome') ?></th>
                <th scope="col" class="th"><?= $this->Paginator->sort('Categoria') ?></th>
                <th scope="col" class="th"><?= $this->Paginator->sort('Fornecedor') ?></th>
                <th scope="col" class="th"><?= $this->Paginator->sort('Cor') ?></th>
                <th scope="col" class="th"><?= $this->Paginator->sort('Estoque') ?></th>
                <th scope="col" class="th"><?= $this->Paginator->sort('Preço') ?></th>
                <th scope="col" class="th"><?= $this->Paginator->sort('Criado') ?></th>
            </tr>
        </thead>

        <tbody  id="myTable">
            <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $this->Number->format($produto->id) ?></td>
                <td><?= h($produto->name) ?></td>
                <td><?= h($produto->categorias_produto->nome_categoria) ?></td>
                <td><?= h($produto->fornecedore->name) ?></td>
                <td><?= h($produto->cor) ?></td>
                <td><?= $this->Number->format($produto->estoque) ?></td>
                <td>R$<?= $this->Number->format($produto->preco) ?></td>
                <td><?= date("d/m/Y H:m:s", strtotime($produto->created)); ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $produto->id], ['title' => __('Vizualizar'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $produto->id], ['title' => __('Editar'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-default glyphicon glyphicon-trash" data-toggle="modal" data-target="#myModal<?=$produto->id?>"></button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal<?=$produto->id?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="modal-title">Você tem certeza que deseja deletar o produto <?=$produto->name?>?</h3>
                                    <br />
                                    <br />
                                    <?= $this->Form->postLink('Sim', ['action' => 'delete', $produto->id], ['title' => __('Deletar'), 'class' => 'btn btn-success'])?>
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
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarProd.gif" title="Editar" class="gif"></div>
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
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
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