<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<li><?= $this->Html->link(__('Novo Cadastro'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<body style="text-align: center; margin-left: 16%;">
    <h2 class="page-header">Funcionários</h2>
    <input class="form-control" id="myInput" type="text" placeholder="Busca" style="width: 20%; height: 30px; margin-left: 40%;">
    <br />
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="text-align: center;"><?= $this->Paginator->sort('ID'); ?></th>
                <th style="text-align: center;"><?= $this->Paginator->sort('Nome'); ?></th>
                <th style="text-align: center;"><?= $this->Paginator->sort('E-mail'); ?></th>
                <th style="text-align: center;"><?= $this->Paginator->sort('Telefone'); ?></th>
                <th style="text-align: center;"><?= $this->Paginator->sort('Cargo'); ?></th>
                <th style="text-align: center;"><?= $this->Paginator->sort('Criado'); ?></th>
                <th class="actions"><?= __(''); ?></th>
            </tr>
        </thead>

        <tbody  id="myTable" style="font-size: 110%;">
            <?php foreach ($users as $user): ?>
            <tr>
                <?php if($user->id == 1){ ?>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->telefone1_user) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['action' => 'view', $user->id], ['title' => __('Vizualizar'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['action' => 'edit', $user->id], ['title' => __('Editar'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                    </td>
                <?php 
                }else{ ?>                      
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->telefone1_user) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['action' => 'view', $user->id], ['title' => __('Vizualizar'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['action' => 'edit', $user->id], ['title' => __('Editar'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-default glyphicon glyphicon-trash" data-toggle="modal" data-target="#myModal<?=$user->id?>"></button>
                        <!-- The Modal -->
                        <div class="modal" id="myModal<?=$user->id?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Você tem certeza que deseja deletar o(a) funcionário(a) <?=$user->name?>?</h3>
                                        <br />
                                        <br />
                                        <?= $this->Form->postLink('Sim', ['action' => 'delete', $user->id], ['title' => __('Deletar'), 'class' => 'btn btn-success'])?>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                <?php
                } ?>
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
                    <option value="7">Logout no sistema</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar no módulo de funcionários, procure o cadastro que deseja ver detalhadamente as informações e clique no botão com imagem de um 'olho' do lado direito da listagem.<br /><img src="/projeto/gif/viewUse.gif" title="Vizualizar" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de funcionários, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarUser.gif" title="Editar" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no módulo de funcionários, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarUser.gif" title="Deletar" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no módulo de funcionários, clique no 'Novo cadastro' localizado do lado esquerdo da tela.<br /><img src="/projeto/gif/novoUser.gif" title="Novo" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar no módulo de funcionários, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarPagPrincipal.gif" title="Voltar" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar no módulo de funcionários, clicar no botão 'Listar Funcionários' localizado no lado esquerdo da tela.<br /><img src="/projeto/gif/listarUser.gif" title="Listar" class="gif"></div>
            <div id="7" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
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