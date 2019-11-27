<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<body style="text-align: center;">
    <?php $this->end();
    $this->start('tb_sidebar'); ?>

    <ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Editar Cadastro'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Html->link(__('Listar Funcionários'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Novo Cadastro'), ['action' => 'add']) ?> </li>
    </ul>
    <?php $this->end(); ?>

    <div class="panel panel-default" style=" margin-left: 16.7%;">
        <!-- Panel header -->
        <div class="panel-heading">
            <h3 class="panel-title" style="text-align: center; text-indent: -10%; font-size: 200%;"><?= h($user->name) ?></h3>
        </div>
        <table class="table table-striped" style="text-align: center;">
            <tr>
                <td><?= __('ID') ?></td>
                <td><?= $this->Number->format($user->id) ?></td>
            </tr>
            <tr>

                <td><?= __('Nome') ?></td>
                <td><?= h($user->name) ?></td>
            </tr>
            <tr>

                <td><?= __('Data de Nascimento') ?></td>
                <td><?= date("d/m/Y", strtotime($user->data_nasc_user)); ?></td>
            </tr>            
            <tr>
                    <td><?= __('E-mail') ?></td>
                    <td><?= h($user->email) ?></td>
            </tr>
            <tr>
                <td><?= __('CPF') ?></td>
                <td><?= h($user->cpf_user) ?></td>
            </tr>
            <tr>
                <td><?= __('RG') ?></td>
                <td><?= h($user->rg_user) ?></td>
            </tr>
            <tr>
                <td><?= __('Telefone') ?></td>
                <td><?= h($user->telefone1_user) ?></td>
            </tr>
            <tr>
                <td><?= __('Celular') ?></td>
                <td><?= h($user->telefone2_user) ?></td>
            </tr>
            <tr>
                <td><?= __('Endereço') ?></td>
                <td><?= h($user->endereco_user) ?></td>
            </tr>
            <tr>
                <td><?= __('Nº') ?></td>
                <td><?= h($user->numero_user) ?></td>
            </tr>
            <tr>
                <td><?= __('Bairro') ?></td>
                <td><?= h($user->bairro_user) ?></td>
            </tr>
            <tr>
                <td><?= __('Cidade') ?></td>
                <td><?= h($user->cidade_user) ?></td>
            </tr>
            <tr>
                <td><?= __('Estado') ?></td>
                <td><?= h($user->estado_user) ?></td>
            </tr>
            <tr style="text-align: center;">
                <td><?= __('Username') ?></td>
                <td><?= h($user->username) ?></td>
            </tr>
            <tr>
                <td><?= __('Cargo') ?></td>
                <td><?= h($user->role) ?></td>
            </tr>

            <tr>
                <td><?= __('Criado') ?></td>
                <td><?= h($user->created) ?></td>
            </tr>
            <tr>
                <td><?= __('Modificado') ?></td>
                <td><?= h($user->modified) ?></td>
            </tr>
        </table>
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
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de funcionários, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarUser2.gif" title="Editar" class="gif"></div>
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