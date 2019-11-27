<?php
echo $this->Html->css('style.css');
echo $this->Html->css('caixa.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/style.css">
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/caixa.css">
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual2.css>


<head <?= $this->fetch('tb_body_attrs') ?>>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #0080FF;">
        <div class="container-fluid">
            <div class="navbar-header">
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right visible-xs">
                    <?= $this->fetch('tb_actions') ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a data-toggle="modal" data-target=".bd-example-modal-xl"><img src="/projeto/img/help.png" title="Manual" id="Manual" alt="" class="manual" style="margin-left: -120%;"></a></li>
                    <li><p style="margin-top: 19%; white-space: nowrap; margin-left: -20%; color:black; font-weight: bold;"><?php echo $_SESSION['nomeUsuario'] ?></p></li>
                    <li><a href="/projeto/pagprincipal">Página Principal</a></li>
                    <li><a class="logout" href="/projeto/users/login?logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</head>

<body style="width: 70%; padding: 8% 0 0; margin: auto; text-align: center; margin-top: auto;">
    <h2><?= ('Abertura de Caixa') ?></h2>
    <div class="caixa-div">
        <div style="" class="div-aberturaCaixa">
            <fieldset>
                <?= $this->Flash->render('auth') ?>
                <?= $this->Form->create() ?>
                <p style="font-weight: bold; margin-top: 8%; font-size: 150%;">
                <?php
                    date_default_timezone_set('America/Fortaleza');
                    $hora_abertura = date("H:i:s");
                    echo ('Data e hora da aberetura do novo caixa: '); 
                ?>
                <br />
                <?php
                    echo date("m/d/Y H:i");
                    echo '<input type="hidden" name="hora_abertura" value="'.$hora_abertura.'">'
                ?>
                </p>
                <br />
                <label for="saldo_inicial">Saldo Inicial:</label>
                <input type="text" class="form-control" name="saldo_inicial" id="saldo_inicial" value="">
                <br />
                <label for="comentario_abertura">Comentário: </label>
                <textarea class="form-control" rows="5" name="comentario_abertura" id="comentario_abertura" value=""></textarea>

                <input type="hidden" id="estado_caixa" name="estado_caixa" value="1">
                <input type="hidden" id="users_id" name="users_id" value="1">
                <input type="hidden" id="hora_fechamento" name="hora_fechamento" value=" ">
                <input type="hidden" id="saldo_final" name="saldo_final" value="0">
                <input type="hidden" id="comentario_fechamento" name="comentario_fechamento" value=" ">
            </fieldset>
            <div>
                <?= $this->Form->button(__('Abrir Novo Caixa')) ?>
                <?= $this->Form->end() ?>
            </div>
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
                    <option value="1">Abrir Caixa</option>
                    <option value="2">Fechar Caixa</option>
                    <option value="3">Logout no sistema</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao entrar no módulo Vendas, deve-se preencher o campos de 'Saldo Inicial' e clicar em 'Abrir Caixa'.<br /><img src="/projeto/gif/abrirCaixa.gif" title="Abrir" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao entrar no módulo Vendas, deve-se preencher o campos de 'Saldo Final' e clicar em 'Fechar Caixa'.<br /><img src="/projeto/gif/fecharCaixa.gif" title="Fechar" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
        </div>
    </div> 
</div>

<script>
    $(document).ready(function () {
        $("#1").hide();
        $("#2").hide();
        $("#3").hide();
        $('#manual').on('change',function () {
            if($(this).val() === '1'){
                $("#1").show();
                $("#2").hide();
                $("#3").hide();
            }
            if($(this).val() === '2'){
                $("#2").show();
                $("#1").hide();
                $("#3").hide();
            }
            if($(this).val() === '3'){
                $("#3").show();
                $("#1").hide();
                $("#2").hide();
            }
        });
    });
</script>