<?php
use Cake\ORM\TableRegistry;
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('promocoes.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<head>
    <li><?= $this->Html->link(__('Adicionar Nova Promoção'), ['action' => 'add']) ?></li>
    <?php $this->end(); ?>
    <?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
</head>
<body class="bodyindex">
    <h2 class="page-header">Promoções</h2>
    <input class="form-control" id="myInput" type="text" placeholder="Busca" style="width: 20%; height: 30px; margin-left: 40%;">
    <br />
    <table class="table table-striped"  cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="thindex"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col" class="thindex"><?= $this->Paginator->sort('Categoria do Produto') ?></th>
                <th scope="col" class="thindex"><?= $this->Paginator->sort('Valor') ?></th>
                <th scope="col" class="thindex"><?= $this->Paginator->sort('Status') ?></th>
                <th scope="col" class="thindex"><?= $this->Paginator->sort('Data Inicial') ?></th>
                <th scope="col" class="thindex"><?= $this->Paginator->sort('Data Final') ?></th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php foreach ($promocoes as $promoco): ?>
            <tr>
                <td><?= $this->Number->format($promoco->id) ?></td>
                <td><?= $promoco->has('categorias_produto') ? $this->Html->link($promoco->categorias_produto->nome_categoria, ['controller' => 'CategoriasProdutos', 'action' => 'view', $promoco->categorias_produto->id]) : '' ?></td>
                <td><?= $this->Number->format($promoco->promocao) ?>%</td>
                <td>
                    <?php
                    if($promoco->status == 1){
                        $status = "Ativado";
                    }else{
                        $status = "Desativado";
                    }
                    echo $status;?>
                </td>
                <td><?php
                    $dataInicial = date('d/m/Y', strtotime($promoco->data_inicio));
                    $dataFinal = date('d/m/Y', strtotime($promoco->data_final));
                    echo $dataInicial;
                ?></td>
                <td><?php echo $dataFinal ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'edit', $promoco->id], ['title' => __('Editar'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-default glyphicon glyphicon-trash" data-toggle="modal" data-target="#myModal<?=$promoco->id?>"></button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal<?=$promoco->id?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="modal-title">Você tem certeza que deseja deletar a promoção de ID <?=$promoco->id?>?</h3>
                                    <br />
                                    <br />
                                    <?= $this->Form->postLink('Sim', ['action' => 'delete', $promoco->id], ['title' => __('Deletar'), 'class' => 'btn btn-success'])?>
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
                    <option value="1">Editar promoção</option>
                    <option value="2">Excluir promoção</option>
                    <option value="3">Inserir um nova promoção</option>
                    <option value="4">Voltar para menu principal</option>
                    <option value="5">Logout no sistema</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar no módulo de Promoção, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarPromo.gif" title="Editar" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de Promoção, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarPromo.gif" title="Deletar" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no módulo de Promoção, clique no 'Novo cadastro' localizado do lado esquerdo da tela, preencha todos os campos do cadastro e clique no botão 'Cadastrar'.<br /><img src="/projeto/gif/novaPromo.gif" title="Novo" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no módulo de Promoção, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarPagPrincipal.gif" title="Voltar" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
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
        $('#manual').on('change',function () {
            if($(this).val() === '1'){
                $("#1").show();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
            }
            if($(this).val() === '2'){
                $("#2").show();
                $("#1").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
            }
            if($(this).val() === '3'){
                $("#3").show();
                $("#1").hide();
                $("#2").hide();
                $("#4").hide();
                $("#5").hide();
            }
            if($(this).val() === '4'){
                $("#4").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#5").hide();
            }
            if($(this).val() === '5'){
                $("#5").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
            }
        });
    });
</script>