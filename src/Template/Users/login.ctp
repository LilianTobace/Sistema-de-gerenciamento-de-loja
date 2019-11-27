<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/style.css">
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/manual.css">
<head <?= $this->fetch('tb_body_attrs') ?>>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #0080FF;">
        <div class="container-fluid">
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li style="margin-left: -30%;"><a data-toggle="modal" data-target=".bd-example-modal-xl"><img src="/projeto/img/help.png" title="Manual" id="Manual" class="manual manulPagPrincipal" style="margin-left: -150%;"></a></li>
                </ul>
            </div>
        </div>
    </div>
</head>
<body class="login">
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
                    <label class="label-form" for="tipo">Como realizar o login</label>
                    <br />
                    <br />
                    <p style="text-align: center;">Ao estar na tela de login é necessário preencher os campos de 'usuário' e 'senha', depois clicar no botão 'entrar'.</p>
                    <img src="/projeto/gif/login.gif" title="login" id="login" class="gif">
                
                    <br />
                </div>
                <!-- Modal footer 
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
            </div>
        </div> 
    </div>
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>

    <?php 

    if(isset($_POST['username']) && isset($_POST['password'])){

        if($usuario == false){
            echo "<div style='padding:10px;text-align:center;'><b>Usuário ou senhas inválidos!</b></div>";
        } 

    }
    ?>

    <div class="logindiv">
        <form>
        <?php
            //echo $this->Form->control('Username:', ['type'=>'username']);
            echo $this->Form->control('username', array('label' => 'Usuário: '));
            echo $this->Form->control('password', array('label' => 'Senha: '));
        ?>
            <!-- <p>
                <input type="checkbox" name="remember" id="remember" 
                <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                <label for="remember-me">Lembrar</label>
            </p> -->
        </form>
        <button class="loginbuttom" type="Submit">Entrar</button>
    </div>
</body>