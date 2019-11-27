<?= $this->Html->css('style.css');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual2.css>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>

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
                    <li><a data-toggle="modal" data-target=".bd-example-modal-xl"><img src="/projeto/img/help.png" title="Manual" id="Manual" alt="" class="manual manulPagPrincipal" style="margin-left: -150%;"></a></li>
                    <li><p style="margin-top: 19%; white-space: nowrap; margin-left: -20%; color:black; font-weight: bold;"><?php echo $_SESSION['nomeUsuario'] ?></p></li>
                    <li><a class="logout" href="/projeto/users/login?logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</head>

<body style="background: white; margin-top: 7%; padding: 5%;">	
<?php if($role == "gerente"){ ?>
  <main class="inline-block-centralizado">
      <div class="zoom">
        <a href="users" action="users">
          <img src="/projeto/img/funcionarios2.png" title="Funcionários" id="funcionarios" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Cadastrar  Funcionários</p>
        </a>
      </div>
      <div class="zoom">
        <a href="clientes">
          <img src="/projeto/img/cliente.png" title="Clientes" id="clientes" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Cadastrar  Clientes</p>
        </a>
      </div> 
      <div class="zoom">
        <a href="fornecedores">
          <img src="/projeto/img/fornecedor.png" title="Fornecedores" id="fornecedores" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Cadastrar  Fornecedores</p>
        </a>
      </div>
      <div class="zoom">
        <a href="produtos">
          <img src="/projeto/img/produtos.png" title="Produtos" id="produtos" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Cadastrar  Produtos</p>
        </a>
      </div>
  </main>

  <main class="inline-block-centralizado">
      <div class="zoom">
        <a href="despesas">
          <img src="/projeto/img/expenses.png" title="Despesas" id="despesas" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Despesas</p>
        </a>
      </div>
      <div class="zoom">
        <a href="promocoes">
          <img src="/projeto/img/promocao.png" title="Promoção" id="Promocao" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Promoção</p>
        </a>
      </div>
      <div class="zoom">
        <a href="caixas">
          <img src="/projeto/img/vender.png" title="Vender" id="vender" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Vender</p>
        </a>
      </div>
      <div class="zoom">
        <a href="relatorios/view_venda">
          <img src="/projeto/img/relatorios1.png" title="Relatórios" id="relatorios" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Relatórios</p>
        </a>
      </div>
  </main>

<?php } ?>

<?php if($role == "estoquista"){ ?>

  <main class="inline-block-centralizado">
      <div class="zoom">
        <a href="fornecedores">
          <img src="/projeto/img/fornecedor.png" title="Fornecedores" id="fornecedores" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Cadastrar  Fornecedores</p>
        </a>
      </div>

      <div class="zoom">
        <a href="produtos">
          <img src="/projeto/img/produtos.png" title="Produtos" id="produtos" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Cadastrar  Produtos</p>
        </a>
      </div>
  </main>

<?php } ?>

<?php if($role == "caixa"){ ?>

  <main class="inline-block-centralizado">
      <div class="zoom">
        <a href="clientes">
          <img src="/projeto/img/cliente.png" title="Clientes" id="clientes" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Cadastrar  Clientes</p>
        </a>
      </div> 
      <div class="zoom">
        <a href="caixas">
          <img src="/projeto/img/vender.png" title="Vender" id="vender" alt="" class="icone"> 
          <p style="text-align: center; color: black;"> Vender</p>
        </a>
      </div>
  </main>

<?php } ?>

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
                    <option value="1">Como entrar no módulo cadastro de funcionários</option>
                    <option value="2">Como entrar no módulo cadastro de clientes</option>
                    <option value="3">Como entrar no módulo cadastro de funcionários</option>
                    <option value="4">Como entrar no módulo cadastro de produtos</option>
                    <option value="5">Como entrar no módulo de despesa</option>
                    <option value="6">Como entrar no módulo de promoção</option>
                    <option value="7">Como entrar no módulo de venda</option>
                    <option value="8">Como entrar no módulo de relatório</option>
                    <option value="9">Logout do sistema</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Cadastrar Funcionários'.<br /><img src="/projeto/gif/moduloUser.gif" title="User" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Cadastrar Clientes'.<br /><img src="/projeto/gif/moduloClientes.gif" title="Cliente" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Cadastrar Fornecedores'.<br /><img src="/projeto/gif/moduloForn.gif" title="Fornecedor" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Cadastrar Produtos'.<br /><img src="/projeto/gif/moduloProdutos.gif" title="Produtos" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Despesas'.<br /><img src="/projeto/gif/moduloDespesa.gif" title="Despesas" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Promoção'.<br /><img src="/projeto/gif/moduloPromocao.gif" title="Promoção" class="gif"></div>
            <div id="7" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Vender'.<br /><img src="/projeto/gif/moduloVendas.gif" title="Vendas" class="gif"></div>
            <div id="8" style="text-align: center;"><br />Ao estar no menu principal, deve-se clicar no módulo de 'Relatórios'.<br /><img src="/projeto/gif/moduloRelatorio.gif" title="Relatórios" class="gif"></div>
            <div id="9" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
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
        $("#8").hide();
        $("#9").hide();
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
            }
        });
    });
</script>