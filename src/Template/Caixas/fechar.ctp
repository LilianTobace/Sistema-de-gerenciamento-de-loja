<?php
echo $this->Html->css('fecharCaixa.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/style.css">
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual2.css>
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/fecharCaixa.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

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
                    <li><a class="logout" href=/projeto/users/login?logout>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</head>

<!--Modal de alerta para o usuário-->

<div class="container">
    <div class="modal" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Há um caixa aberto!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    Já há um caixa aberto, deseja continuar realizando vendas neste caixa ou deseja fecha-lo?
                </div>
                <!-- Modal footer -->
                <div class="modal-footer" style="margin-right: 25%;">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location.href='/projeto/vendas'">Continuar vendendo</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar caixa</button>
                </div>
            </div>
        </div>
    </div> 
</div>



<body style="width: 50%; padding: 8% 0 0; margin: auto; text-align: center; ">
    <h2 class="h2-caixa"><?= ('Fechamento de Caixa') ?></h2>
    <div class="div-fecharCaixa">

        <div class="div2-fecharCaixa">
            <fieldset>
                <?= $this->Flash->render('auth') ?>
                <?= $this->Form->create() ?>
                <p class="p-fecharCaixa">
                <?php
                    date_default_timezone_set('America/Fortaleza');
                    $hora_fechamento = date("H:i:s"); 
                    echo ('Fechamento do caixa: ');
                    echo date("d/m/Y H:i");
                    //echo '<input type="hidden" name="data_fechamento" value="${requestScope.data_fechamento}">'
                    ?>
                    <br />
                    <?php 
                    echo ('Abertura realizada pelo usuário ');
                    echo ($_SESSION['nomeUsuarioCaixa']);


                ?><br /><?php
                $this->Form->control('data_abertura');
                $this->Form->control('comentario_abertura');
                $this->Form->control('saldo_inicial');
                $this->Form->control('users_id');
                ?>
                </p>
                <br />
                <label for="saldo_final">Saldo Final:</label>
                <input type="text" class="form-control" name="saldo_final" id="saldo_final">
                <br />
                <label for="comentario_fechamento">Comentário: </label>
                <textarea class="form-control" rows="5" name="comentario_fechamento" id="comentario_fechamento" value=""></textarea>

                <?php echo '<input type="hidden" id="hora_fechamento" name="hora_fechamento" value="'.$hora_fechamento.'">' ?>
                <input type="hidden" id="estado_caixa" name="estado_caixa" value="0">
            </fieldset>
            <div>
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location.href='/projeto/vendas'">Continuar vendendo</button>
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Fechar caixa</button>
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
        $('#modal').modal('show');
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