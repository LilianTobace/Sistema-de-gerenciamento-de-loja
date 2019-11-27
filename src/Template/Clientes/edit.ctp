<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto[]|\Cake\Collection\CollectionInterface $produtos
 */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('formCliente.css');
echo $this->Html->css('formularios.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<head class="panel panel-default">
    <?php $this->end();
    $this->start('tb_sidebar'); ?>
    <ul class="nav nav-sidebar">
        <li style="text-align: center;"><?= $this->Html->link(__('Listar Clientes'), ['action' => 'index']) ?></li>
        <li style="text-align: center;"><?= $this->Html->link(__('Novo Cadastro'), ['action' => 'add']) ?></li>
    </ul>
    <?php $this->end(); ?>
</head>

<body class="panel panel-default body">
    <h1 style="text-align: center;" class="page-header">Editar Cadastro de Cliente</h1>
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
            $this->Form->control('created', array('type' => 'hidden'));
            echo '<input type="hidden" name="modified" value="'.$modified.'">';
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
            <div id="1" style="text-align: center;"><br />Ao estar no módulo de clientes, procure o cadastro que deseja ver detalhadamente as informações e clique no botão com imagem de um 'olho' do lado direito da listagem.<br /><img src="/projeto/gif/viewCliente.gif" title="Vizualizar" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de clientes, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarCliente.gif" title="Editar" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no módulo de clientes, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarCliente.gif" title="Deletar" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no módulo de clientes, clique no 'Novo cadastro' localizado do lado esquerdo da tela.<br /><img src="/projeto/gif/novoCliente.gif" title="Novo" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar no módulo de clientes, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarCliente.gif" title="Voltar" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar no módulo de clientes, clicar no botão 'Listar Clientes' localizado no lado esquerdo da tela.<br /><img src="/projeto/gif/listarCliente.gif" title="Listar" class="gif"></div>
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
    
        $("input[id='data_nasc_cliente']").val("<?php echo $_SESSION['clienteData']; ?>");
        var estado = $('#estado_cliente').val("<?php echo $_SESSION['clienteEstado']; ?>");
        $('#estado_cliente option[value="' + estado + '"]').attr({ selected : "selected" })
        $("input[id='comentario_cliente']").val("<?php echo $_SESSION['clienteComentario']; ?>");
        $("input[id='cidade_cliente']").val("<?php echo $_SESSION['clienteCidade']; ?>");
    });
</script>
