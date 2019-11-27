<?php
use Cake\ORM\TableRegistry;
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
echo $this->Html->css('formularios.css');
echo $this->Html->css('formProduto.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<head class="panel panel-default">
    <?php $this->end();
    $this->start('tb_sidebar'); ?>
    <ul class="nav nav-sidebar">
        <li style="text-align: center;"><?= $this->Html->link(__('Listar Produtos'), ['action' => 'index']) ?> 
        </li>
        <li style="text-align: center;"><?= $this->Html->link(__('Novo Produto'), ['action' => 'add']) ?> 
        </li>
        <li style="text-align: center;"><?= $this->Html->link(__('Listar Categoria de Produtos'), ['controller' => 'CategoriasProdutos', 'action' => 'index']) ?>
        </li>
        <li style="text-align: center;"><?= $this->Html->link(__('Nova Categoria de Produto'), ['controller' => 'CategoriasProdutos', 'action' => 'add']) ?> 
        </li>
    </ul>
    <?php $this->end(); ?>
</head>
<body class="panel panel-default body">
    <h1 class="page-header bodyDiv">Editar Cadastro de Produto</h1>
    <div class="body-div">
        <?= $this->Form->create($produto) ?>
        <fieldset class="fieldset-body">
            <div class="divCodigo">
                <?php echo $this->Form->control('codigo_barra', array('label' => 'Código de Barra: ', 'class' => 'codigo', 'id'=> 'codigo_barra')); ?>
            </div>
            <div class="divNome">
                <?php echo $this->Form->control('name', array('label' => 'Nome: ', 'class' => 'nome', 'placeholder' => 'Nome Sobrenome')); ?>   
            </div>
            <div class="divCategoria">
                <?php echo $this->Form->control('categorias_produto_id', array('label'=>'Categoria do produto:', 'class' => 'categoria'), ['options' => $categoriasProdutos]);?>
            </div>
            <br />
            <br />
            <br />
            <br />
            <?php 
            $fornecedores = TableRegistry::getTableLocator()->get('Fornecedores');
            $query = $fornecedores
                ->find()
                ->where([
                        'id >' => 0
                ]);
            $results = $query->toArray();
            if(isset($results[0])){
                for ($i=0; $i < count($results); $i++) {          
                    $nome[] = $results[$i]["name"];
                    $id[] = $results[$i]["id"];
                    $_SESSION['nomeFornecedores'] = $nome;
                    $_SESSION['idForn'] = $id;
                }
            }
            ?>
            <div class="divFornecedor">
                <label class="control-label" for="fornecedore_id">Fornecedor: </label>
                <select class="form-control fornecedor"  id="fornecedore_id" name="fornecedore_id">
                    <option value="">Selecionar um Fornecedeor</option>
                    <?php            
                    $nome = $_SESSION['nomeFornecedores'];
                    $id = $_SESSION['idForn'];
                    for ($i=0; $i < count($nome); $i++) { 
                        $valId = $id[$i]; 
                        echo '<option value="'.$valId.'" name="despesas_tipo_id">'.$nome[$i].'</option>'?>
                <?php   
                    }
                ?>
                </select>  
            </div>
            <div class="divCor">
                <?php echo $this->Form->control('cor', array('label' => 'Cor: ', 'class' => 'cor', 'placeholder' => 'Nome da Cor')); ?>
            </div>
            <div class="divTecido">
                <?php echo $this->Form->control('tecido', array('label' => 'Tecido: ', 'class' => 'tecido', 'placeholder' => 'Nome do Tecido')); ?>
            </div>
            <br />
            <br />
            <br />
            <br />
            <div class="divTamanho">
                <?php echo $this->Form->control('tamanho', array('label' => 'Tamanho: ', 'class' => 'tamanho', 'placeholder' => 'Tamanho do Produto')); ?>
            </div>
            <div class="divEstoque">
                <?php echo $this->Form->control('estoque', array('label' => 'Estoque: ', 'class' => 'estoque', 'placeholder' => 'Quantidade de Produtos')); ?>
            </div>
            <div class="divCustoBruto">
                <?php echo $this->Form->control('custo_bruto', array('label' => 'Custo Bruto: ', 'id' => 'custo_bruto', 'class' => 'custoBruto', 'placeholder' => 'R$00,00')); ?>
            </div>
            <br />
            <br />
            <br />
            <br />
            <div class="divRadio">
                <input type="radio" name="porcentagemRadio" id="1" class="pg porcentagemRadio" value="1"/> Porcentagem
                <br />
                <br />
                <input type="radio" name="porcentagemRadio" id="2" class="pg porcentagemRadio" value="2"/> Valor absoluto
            </div>
            <div class="divPorcentagem"  id="porcentagem2">
                <label class="control-label porcentagem" for="porcentagem">Porcentagem: </label>
                <select name="porcentagem" id="porcentagemSelect" class="form-control porcent">
                    <option value="">Selecione a Porcentagem</option>
                    <option value="20">20%</option>
                    <option value="10">10%</option>
                    <option value="15">15%</option>
                    <option value="30">30%</option>
                    <option value="35">35%</option>
                    <option value="40">40%</option>
                    <option value="45">45%</option>
                    <option value="50">50%</option>
                </select>
            </div>
            <div id="precoAbsoluto" class="divAbsoluto">
                <label for="preco2" class="control-label">Preço: </label>
                <input type="number" name="preco2" id="preco1" class="form-control absoluto" step="any">                
            </div>
            <div id="precoAbsoluto2" class="divAbsoluto2">
                <label for="preco" class="control-label">Preço: </label>
                <input type="number" name="preco" id="preco" readonly="true" class="form-control absoluto2" step="any">
            </div>

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
                <div id="gerente" class="divDesconto">
                    <label for="desconto" class="control-label">Desconto: </label>
                    <input type="number" name="desconto" id="desconto" value="" step="any" class="form-control desconto">
                </div>
            <?php 
            }else{ 
                $produto = TableRegistry::getTableLocator()->get('Produtos');
                $query = $produto
                        ->find()
                        ->where([
                                'id' => $_SESSION['idEditadoProd']
                        ]);
                $results = $query->toArray();
                if(isset($results[0])){
                    $desconto = $results[0]["desconto"];
                } ?>
                <div id="estoquista"  class="divDesconto">
                    <label for="desconto2" class="control-label">Desconto: </label>
                    <?php echo '<input type="number" name="desconto2" id="desconto2" readonly="true" class="form-control desconto" value="'.$desconto.'">'; ?>
                </div>
            <?php 
            }
            ?>
            <br />
            <br />
            <br />
            <br />
            <div class="divTecidoDesc">
                <?php echo $this->Form->control('descricao_tecido', array('label' => 'Descrição do Tecido: ', 'class' => 'tecidoDesc')); ?>
            </div>
            <div class="divProdutoDesc">
                <?php echo $this->Form->control('descricao_produto', array('label' => 'Descrição do Produto: ', 'class' => 'produtoDesc')); ?>
            </div>
        <?php
            date_default_timezone_set('America/Fortaleza');
            $modified = date("Y-m-d H:i:s");
            echo $this->Form->control('created', array('type' => 'hidden'));
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
                    <option value="7">Configurar estoque mínimo</option>
                    <option value="8">Entrar na listagem de estoque baixo</option>
                    <option value="9">Listar categoria de produto</option>
                    <option value="10">Entrar na listagem de desconto</option>
                    <option value="11">Voltar para menu principal</option>
                    <option value="12">Logout no sistema</option>
                </select> 
            </div>
            <br />
            <div id="manual1" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja ver detalhadamente as informações e clique no botão com imagem de um 'olho' do lado direito da listagem.<br /><img src="/projeto/gif/viewProd.gif" title="Vizualizar" class="gif"></div>
            <div id="manual2" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarProd.gif" title="Editar" class="gif"></div>
            <div id="manual3" style="text-align: center;"><br />Ao estar no módulo de produtos, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarProd.gif" title="Deletar" class="gif"></div>
            <div id="manual4" style="text-align: center;"><br />Ao estar no módulo de produtos, clique no 'Novo cadastro' localizado do lado esquerdo da tela, preencha todos os campos do cadastro e clique no botão 'Cadastrar'.<br /><img src="/projeto/gif/novoProd.gif" title="Novo" class="gif"></div>
            <div id="manual5" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarProd.gif" title="Voltar" class="gif"></div>
            <div id="manual6" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Listar Produtos' localizado no lado esquerdo da tela.<br /><img src="/projeto/gif/listarProd.gif" title="Listar" class="gif"></div>
            <div id="manual7" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Configurar Estoque Baixo' localizado do lado esquerdo da tela. Depois preencher o campos e clicar no botão 'Configurar'.<br /><img src="/projeto/gif/configEstoque.gif" title="Configurar" class="gif"></div>
            <div id="manual8" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Estoque Baixo' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/entrarEstoque.gif" title="Estoque" class="gif"></div>
            <div id="manual9" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Listar Categorias de Produtos' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/listarCategoria2.gif" title="Categoria" class="gif"></div>
            <div id="manual10" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Descontos' localizado do lado esquerdo da tela. <br /><img src="/projeto/gif/entrarDesconto.gif" title="Desconto" class="gif"></div>
            <div id="manual11" style="text-align: center;"><br />Ao estar no módulo de produtos, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarProd.gif" title="Voltar" class="gif"></div>
            <div id="manual12" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
        </div>
    </div> 
</div>
<script>
$("#custo_bruto").on("keyup", function(){
    var textoDigitado = $(this).val();
    if (textoDigitado == ""){
        $("#preco").val("00");
        return 0;
    }
    var selecionado = $("input[name='porcentagemRadio']:checked").val();
    if (selecionado == 1){
        selecionado = $("#porcentagemSelect").val();
    }
    novoPreco = selecionado * textoDigitado;
    novoPreco = novoPreco/100;
    novoPreco = (parseFloat(novoPreco) + parseFloat(textoDigitado));
    var inputCusto = $(this).attr("custo");
    $("#preco").val(novoPreco);
});

$("#porcentagemSelect").on("change", function(){
    var textoDigitado = $("#custo_bruto").val();
    if (textoDigitado == ""){
        $("#preco").val("00");
        return 0;
    }
    var selecionado = $("input[name='porcentagemRadio']:checked").val();
    if (selecionado == 1){
        selecionado = $("#porcentagemSelect").val();
    }
    novoPreco = selecionado * textoDigitado;
    novoPreco = novoPreco/100;
    novoPreco = (parseFloat(novoPreco) + parseFloat(textoDigitado));
    var inputCusto = $(this).attr("custo");
    $("#preco").val(novoPreco);
});

$(document).ready(function () {    
    $("#manual1").hide();
    $("#manual2").hide();
    $("#manual3").hide();
    $("#manual4").hide();
    $("#manual5").hide();
    $("#manual6").hide();
    $("#manual7").hide();
    $("#manual8").hide();
    $("#manual9").hide();
    $("#manual10").hide();
    $("#manual11").hide();
    $("#manual12").hide();
    $('#manual').on('change',function () {
        if($(this).val() === '1'){
            $("#manual1").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '2'){
            $("#manual2").show();
            $("#manual1").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '3'){
            $("#manual3").show();
            $("#manual2").hide();
            $("#manual1").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '4'){
            $("#manual4").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual1").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '5'){
            $("#manual5").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual1").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '6'){
            $("#manual6").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual1").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '7'){
            $("#manual7").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual1").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '8'){
            $("#manual8").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual1").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '9'){
            $("#manual9").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual1").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '10'){
            $("#manual10").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual1").hide();
            $("#manual11").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '11'){
            $("#manual11").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual1").hide();
            $("#manual12").hide();
        }
        if($(this).val() === '12'){
            $("#manual12").show();
            $("#manual2").hide();
            $("#manual3").hide();
            $("#manual4").hide();
            $("#manual5").hide();
            $("#manual6").hide();
            $("#manual7").hide();
            $("#manual8").hide();
            $("#manual9").hide();
            $("#manual10").hide();
            $("#manual11").hide();
            $("#manual1").hide();
        }
    });

    $("#porcentagem2").hide();
    $("#precoAbsoluto").hide();    
    $("#precoAbsoluto2").hide();    
    $('.porcentagemRadio').on('change',function () {
        $("#preco1").val("");
        $("#preco").val("");
        if($(this).val() === '1'){
            $("#porcentagem2").show();
            $("#precoAbsoluto").hide();
            $("#precoAbsoluto2").show();
        }
        if($(this).val() === '2'){
            $("#porcentagem2").hide();
            $("#precoAbsoluto").show();
            $("#precoAbsoluto2").hide();
        }
    });
    //Não permite o leitor de código de barra dar enter ao finalizar a leitura
    $('#codigo_barra').keypress(function(e) {
        if(e.which == 13) { // se pressionar enter
            e.preventDefault();
        }
    });
    //Inserindo valores
    document.getElementById("<?php echo $_SESSION['porcentagemRadio']; ?>").checked =  true;
    $(".porcentagemRadio:checked").trigger("change");
    var porcentagem = $('#porcentagemSelect').val("<?php echo $_SESSION['prodPorcentagem']; ?>");
    $('#porcentagemSelect option[value="' + porcentagem + '"]').attr({ selected : "selected" });
    if(porcentagem != 0 && porcentagem != NaN){
        var textoDigitado = $("#custo_bruto").val();
        novoPreco = "<?php echo $_SESSION['prodPorcentagem']; ?>" * textoDigitado;
        novoPreco = novoPreco/100;
        novoPreco = (parseFloat(novoPreco) + parseFloat(textoDigitado));
        var inputCusto = $(this).attr("custo");
        $("#preco").val(novoPreco);
    }
    $("input[id='desconto']").val("<?php echo $_SESSION['prodDesconto']; ?>");
    $("input[id='preco1']").val("<?php echo $_SESSION['prodPreco']; ?>");
    var fornecedor = $('#fornecedore_id').val("<?php echo $_SESSION['prodForn']; ?>");
    $('#fornecedore_id option[value="' + fornecedor + '"]').attr({ selected : "selected" });
    
});
</script>