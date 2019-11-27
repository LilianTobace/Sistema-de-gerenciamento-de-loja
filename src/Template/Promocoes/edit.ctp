<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('promocoes.css');
echo $this->Html->css('formularios.css');

?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<head class="panel panel-default">
    <?php $this->end();
    $this->start('tb_sidebar'); ?>
    <ul class="nav nav-sidebar">
        <li class="liedit"><?= $this->Html->link(__('Listar Promoções'), ['action' => 'index']) ?></li>
    </ul>
    <?php $this->end(); ?>
</head>

<body class="panel panel-default" class="bodyedit">
    <h1 class="h1edit" class="page-header">Editar Promoção</h1>
    <div class=" promocoes form large-9 medium-8 columns content">
        <?= $this->Form->create($promoco) ?>
        <fieldset class="fieldsetedit">
            <div class="switch__container divstatus">
                <?php
                $status = $_SESSION['status'];
                ?>
                <label>Status:</label>
                <input id="switch-shadow" class="switch switch--shadow statusinput" type="checkbox" name="status">
                <label for="switch-shadow" class="statuslabel"></label>
                <p class="pinativo">Inativo</p>
                <p class="pativo">Ativo</p>
            </div>
            <br />
            <br />
            <div>
                <?php echo $this->Form->control('categorias_produto_id', array('label' => 'Categoria do Produto:', 'class' => 'input1'), ['options' => $categoriasProdutos]); ?>
            </div>
            <div class="div1">
                <?php echo $this->Form->control('promocao', array('label' => 'Valor da Promoção:', 'class' => 'input2'));?>
            </div>
            <div class="div2 required div-form">
                <?php 
                $dataInicial = date('d/m/Y', strtotime($_SESSION['dataInicialPromo']));
                ?>
                <label class="label-form"">Data de Início: </label>
                <input type="text" name="data_inicio" value="<?php echo $dataInicial ?>" required="required" class="form-control-customizada datepicker">
            </div>
            <div class="div3 required div-form">
                <?php
                $dataFinal = date("d/m/Y", strtotime($_SESSION['dataFinalPromo'])); 
                ?>
                <label class="label-form">Data Final: </label>
                <input type="text" name="data_final" value="<?php echo $dataFinal ?>" required="required" class="form-control-customizada datepicker">
            </div>
            <?php 
            date_default_timezone_set('America/Fortaleza');
            $modified = date("Y-m-d H:i:s");
            echo '<input type="hidden" name="created" value="'.$promoco->created.'">';
            echo '<input type="hidden" name="modified" value="'.$modified.'">';
            ?>
        </fieldset>
        <br />
        <div class="buttomedit">
            <?= $this->Form->button(__('Editar')) ?>
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

    $.noConflict();
    jQuery( document ).ready(function($) {
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
    });
    
    var checkbox = "<?php echo $status;?>";
    if(checkbox == 1){
        document.getElementById("switch-shadow").checked = true;
    }else{
        document.getElementById("switch-shadow").checked = false;
    }
</script>