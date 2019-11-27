<?php
use Cake\ORM\TableRegistry;
echo $this->Html->css(array('pagevenda'));
echo $this->Html->css('style.css');
echo $this->Html->css('pagamento.css');
echo $this->Html->css('venda.css');
echo $this->Html->css('formularios.css');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/pagevenda.css">
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/bootstrap/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/projeto/webroot/css/bootstrap/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/venda.css>
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

<body style="background-color: #0080FF; margin-top: 3%"> 
    <div class="div-venda2 venda container">
        <h1 class="page-header carrinho_interno"> Menu </h1> 
        <br /> 
        <p class="p-venda">Caixa: <?php echo $_SESSION['nomecaixa']?></p>
        <label class="label-form" for="name">Código de Barra: </label>
        <input autofocus type="text" name="codigo" required="required" id="codigo" class="form-control-customizada form-name" style="width:100%;">
        <br />
        <?php 
        if(isset($_SESSION['selecionarCliente'])){
             $selecionarCliente = $_SESSION['selecionarCliente'];
            for ($i=0; $i < count($selecionarCliente) ; $i++) { ?>
                        <p class="p-venda">Cliente: <?= $selecionarCliente[$i]['name']; ?></p>
            <?php
            }
        }
        ?>
        <button type="button" class="button-venda btn btn-primary" onclick="addicliente()">Cliente</button>
        <script>
            function addicliente() {
              location.replace("/projeto/clientes/addClienteNaVenda/")
            }
        </script>
        <br />
        <br />
        <button type="button" class="button-venda btn btn-primary" onclick="cancelarVenda()">Cancelar Venda</button>
        <script>
            function cancelarVenda() {
              location.replace("/projeto/vendas/cancelar/")
            }
        </script>
        <br />
        <br />        
        <button type="button" class="button-venda btn btn-primary" onclick="additens()">Adicionar Item</button>
        <script>
            function additens() {
              location.replace("/projeto/ProdutosVendas/")
            }
        </script>
        <br />
        <br />
        <button type="button" class="button-venda btn btn-primary" onclick="fecharCaixa()">Fechar Caixa</button>
        <script>
            function fecharCaixa() {
              location.replace("/projeto/Caixas/fechar/")
            }
        </script>
        <br />
        <br />

        <?= $this->Form->create($venda) ?>

        <!-- Button to Open the Modal -->
        <form action="/projeto/vendas/" method="post" id="Form">
        <button type="button" class="button-modal btn btn-primary" data-toggle="modal" data-target=".pagar">Pagar Venda</button>

        <!-- The Modal -->
        <div class="modal fade pagar" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="div-modal modal-dialog modal-lg">
                <div class="modal-content">

                <!-- Modal Header -->
                    <div class="modal-header">
                        <h2 class="h2-modal modal-title">Formas de Pagamento</h2>                        
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <br />
                        <table class="payment-methods">
                            <tr>
                                <td class="td-modal"> 
                                    <input type="radio" name="pagamentos_id" id="dinheiro" class="pg pagamentos_id" value="1"/>
                                    <label for="dinheiro" class="labelpag"  style="margin-top: -10%;">
                                        <img src="/projeto/img/cash.png" class="imgpag" alt="" >
                                    </label>
                                    <br />
                                </td>

                                <td class="td-modal2">
                                    <input type="radio" name="pagamentos_id" id="credito" class="pg pagamentos_id" value="2"/>
                                    <label for="credito" class="labelpag2"  style="margin-top: -10%;">
                                        <img src="/projeto/img/card2.png" class="imgpag2">
                                    </label>
                                </td>
                                <br />
                                <td>
                                    <input type="radio" name="pagamentos_id" id="debito" class="pg pagamentos_id" value="3"/>
                                    <label for="debito" class="labelpag2"  style="margin-top: -10%;">
                                        <img src="/projeto/img/card.png" class="imgpag2">
                                    </label>
                                </td>
                            </tr>
                        </table>
                        
                        <table>
                            <tr>
                                <td>
                                    <p class="p_pagamento totalpago" style="font-size: 160%;">
                                        <label>Total de Itens:
                                            <?php 
                                            if(isset($_SESSION['carrinho'])){
                                                echo count($_SESSION['carrinho']);
                                            ?>
                                        </label>
                                        <input type="hidden" name="total_produto" id="total_produto" value="<?php echo count($_SESSION['carrinho']); ?>">
                                        <?php
                                        } 
                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="p_pagamento" style="font-size: 160%; margin-left: -35%;">
                                        <label>Total da Venda: R$ <span class="total_venda"></span></label>
                                    </p>
                                </td>
                                <!-- <td id="pagamento_dinheiro1">  -->
                                <td> 
                                    <p class="p_pagamento" id="InputPagamento1" style="font-size: 160%; margin-left: -20%;">
                                        <label for="total_pago">Total Pago: R$ </label>
                                        <input name="total_pago" value="" class="input_pagamento" id="total_pago" style="width: 35%;"> 
                                    </p>
                                </td>
                                <!-- Pagamento no dinheiro -->
                                <td id="pagamento_dinheiro2">
                                    <p class="p_pagamento trocopagamento" id="pagamento_dinheiro2" style="font-size: 160%;">
                                        <label>Troco: R$ <span id="troco"></span></label>                                              
                                        <input name="parcelas" type="hidden" value="1" class="input_pagamento" id="parcelasDinheiro">            
                                    </p>
                                </td>

                                <!-- Cartão de crédito -->    
                                <td id="td-cartao1"> 
                                    <p class="p_pagamento" id="pagamento_cartao1" style="margin-left: -10%; font-size: 160%;">
                                        <label for="parcelas">Parcelas: </label>
                                        <select name="parcelas" id="parcelasCartao1" class="input_pagamento" style="width: 60%;">
                                            <option>Secione a parcela</option>
                                            <option value="1">À vista</option>
                                            <option value="2">2x</option>
                                            <option value="3">3x</option>
                                            <option value="4">4x</option>
                                            <option value="5">5x</option>
                                            <option value="6">6x</option>
                                            <option value="7">7x</option>
                                            <option value="8">8x</option>
                                            <option value="9">9x</option>
                                            <option value="10">10x</option>
                                            <option value="11">11x</option>
                                            <option value="12">12x</option>
                                        </select>
                                    </p>
                                </td>
                                <!-- Cartão de débito -->
                                <td id="td-cartao2">
                                    <p class="p_pagamento" id="pagamento_cartao1" style="margin-left: -10%; font-size: 160%;">
                                        <label for="parcelas">Parcelas: </label>
                                        <select name="parcelas" id="parcelasCartao2" class="input_pagamento" style="width: 60%;">
                                            <option value="1">À vista</option>
                                        </select>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1%;">
                                    <button type="button" class="btn btn-primary" style="margin-left: 190%;" onclick="realizarPag()">Realizar Pagamento</button>
                                </td>
                            </tr>
                        </table>
                        <table id="pagamentos">
                            <thead>
                                <tr>
                                    <th class="carrinhoth" style="font-size: 140%;">Tipo de Pagamento</th>
                                    <th class="carrinhoth" style="font-size: 140%;">Parcelas</th>
                                    <th class="carrinhoth" style="font-size: 140%; text-align: left;">Valor Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <table>
                            <tr>
                                <td style="font-size: 160%; font-weight: bold;">Total Pago: R$<span id="total_pago2"></span></td>
                                <td style="font-size: 160%; font-weight: bold;">Pagamento Pendente: R$<span id="pagamento_pendente"></td>
                            </tr>
                        </table>
                            <br />
                            <?php 
                            if(isset($_SESSION['selecionarCliente'])) {
                                $selecionarCliente = $_SESSION['selecionarCliente'];
                                for ($i=0; $i < count($selecionarCliente) ; $i++) {
                                    $Cliente_id = $selecionarCliente[$i]['id'];
                                } 
                                echo ('<input type="hidden" name="clientes_id" value="'.$Cliente_id.'">');
                            }else{
                                echo ('<input type="hidden" name="clientes_id" value="1">');
                            }

                            if(isset($_SESSION['CaixaAtual'])) {
                                $CaixaAtual = $_SESSION['CaixaAtual'];
                                echo ('<input type="hidden" name="caixas_id" value="'.$CaixaAtual.'">');
                            }
                            

                            ?>

                            <input type="hidden" name="total_pagamentos" id="total_pagamentos" value="">
                            <input type="hidden" name="venda_cancelada" id="venda_cancelada" value="0">
                            <input type="hidden" name="total_venda" class="total_venda" id="total_venda" value="1">
                            <?php
                            date_default_timezone_set('America/Sao_Paulo');
                            $created = date("Y-m-d H:i:s");
                            echo '<input type="hidden" name="created" value="'.$created.'">';
                            ?>

                            <button type="submit" class="btn btn-success" id="click">Fechar Venda</button>
                    </div>

                    <!-- Modal footer 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
                </div>
            </div> 
        </div>
    </div>
    
    <!--Listagem do carrinho-->
    <div class="div-venda3 carrinho">
        <h1 class="page-header carrinho_interno"> Carrinho </h1>   
        <br />
            <table class="table">
                <thead>
                    <tr>
                        <th class="carrinhoth"><?= $this->Paginator->sort('ID'); ?></th>
                        <th class="carrinhoth"><?= $this->Paginator->sort('Nome'); ?></th>
                        <th class="carrinhoth"><?= $this->Paginator->sort('Quantidade'); ?></th>
                        <th class="carrinhoth"><?= $this->Paginator->sort('Desconto'); ?></th>
                        <th class="carrinhoth"><?= $this->Paginator->sort('Preço Uni.'); ?></th>
                        <th class="carrinhoth"><?= $this->Paginator->sort('Total'); ?></th>
                    </tr>
                </thead>

                <tbody id="tbody">
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

                if(isset($_SESSION['carrinho']))
                {
                    $carrinho = $_SESSION['carrinho'];
                    for ($i=0; $i < count($carrinho) ; $i++) { ?>
                        <tr>
                            <td><?= $carrinho[$i]['id']; ?></td>
                            <input type="hidden" name="produto[]" value="<?= $carrinho[$i]['id']; ?>">
                            <td class="td-venda"><?= $carrinho[$i]['nome']; ?></td>
                            <input type="hidden" name="nome[]" value="<?= $carrinho[$i]['nome']; ?>">
                            <td><input style="width: 30%;" type="number"  name="quantidade[]" class="quant" value="<?= $carrinho[$i]['quantidade']; ?>" min="1" max="<?= $carrinho[$i]['quantidade']; ?>">
                            <?php 
                            if($role == "gerente"){ 
                                if(isset($carrinho[$i]['promocao']) && $carrinho[$i]['promocao'] == true){ ?>
                                    <td><input style="width: 30%;" type="number" min="0" disabled="disabled" class="desconto">%</td>
                            <?php 
                                }else{ ?>
                                <td><input style="width: 30%;" type="number" min="0" name="desconto2[]" class="desconto">%</td>
                            <?php
                                }
                            }else{ 
                                if(isset($carrinho[$i]['promocao']) && $carrinho[$i]['promocao'] == true){ ?>
                                <td><input style="width: 30%;" type="number" min="0" disabled="disabled" class="desconto">%</td>
                            <?php
                                }else{
                                    $desconto = $carrinho[$i]['desconto'];
                            ?>
                                <td><input style="width: 30%;" type="number" min="0" max="<?= $desconto; ?>" name="desconto[]" class="desconto">%</td>                                
                            <?php
                                }
                            }
                            ?>
                            <td>R$ <span class="preco_uni"><?= number_format($carrinho[$i]['preco'],2); ?></span></td>
                            <input type="hidden" name="preco[]" value="<?= $carrinho[$i]['preco']; ?>">
                            <td>R$ <span class="total_unitario">00.00</span></td>
                            <input type="hidden" name="total[]" class="total_unitario">
                            <td><a href="?deletar=<?php echo $carrinho[$i]['id']; ?>"><button type="button" class="btn btn-danger">x</button></a></td>
                        </tr>
                        <?php 
                    } 
                }?>
        
                </tbody>
            </table>
        </form>
        <?= $this->Form->end() ?>
    </div>

    <div class="total_cart">
        <table>
            <tr>
                <td class="carttable">Itens <span id="total_itens"></span>
                <?php 
                // if(isset($_SESSION['carrinho'])){
                //     echo count($_SESSION['carrinho']);
                // } ?>
                </td>
                <td class="carttable"> Total R$ <span class="total_venda">00.00</span></td>
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
                    <option value="1">Adicionar cliente na venda</option>
                    <option value="2">Adicionar produto na venda</option>
                    <option value="3">Adicionar produto na venda pelo código de barra</option>
                    <option value="4">Cancelar venda</option>
                    <option value="5">Pagar com cartão de crédito</option>
                    <option value="6">Pagar com cartão de débito</option>
                    <option value="7">Pagar com cartão dinheiro</option>
                    <option value="8">Pagar venda com várias formas de pagamento</option>
                    <option value="9">Inserir desconto na venda</option>
                    <option value="10">Realizar venda</option>
                    <option value="11">Logout no sistema</option>

                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar na tela de venda, deve-se clicar no botão 'Adicionar Cliente'. Depois é só procurar o nome do cliente que deseja adicionar na venda e clicar no botão '+'.<img src="/projeto/gif/addClienteVenda.gif" title="Adicionar Cliente" class="gif"><br /></div>
            <div id="2" style="text-align: center;"><br /> Ao estar na tela de venda, deve-se clicar no botão 'Adicionar Item'. Depois só clicar no botão 'Adicionar' do(s) item(s) que deseja inserir no carrinho e depois clicar em 'carrinho'.<br /><img src="/projeto/gif/addItem.gif" title="Adicionar Produto" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar na tela de venda, deve-se clicar no campo 'Código de Barra', passar o leitor no código do produto desejado.<br /><img src="/projeto/gif/codigoBarra.gif" title="Adicionar Produto" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar na tela de venda, deve-se clilcar no botão 'Cancelar Venda'. Depois procure pela venda que deseja cancelar e clicar no botão 'Cancelar' e preencher todos os campos e clicar novamente em 'Cancelar'.<br /><img src="/projeto/gif/cancelarVenda.gif" title="Cancelar" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar forma de pagamento cartão de crédito, inserir o valor e selecionar as parcelas. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/credito.gif" title="Crédito" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar forma de pagamento cartão de débito, inserir o valor. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/debito.gif" title="Débito" class="gif"></div>
            <div id="7" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar forma de pagamento em dinheiro, inserir o valor. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/dinheiro.gif" title="Dinheiro" class="gif"></div>
            <div id="8" style="text-align: center;"><br />Ao estar na tela de venda com produtos inseridos no carrinho, clique no botão 'Pagar Venda', selecionar a(s) forma(s) de pagamento cartão de crédito, débito ou dinheiro, inserir o valor. Depois clicar em 'Realizar pagamento' e por ultimo 'Fechar venda'.<br /><img src="/projeto/gif/variosPag.gif" title="Vários pagamentos" class="gif"></div>
            <div id="9" style="text-align: center;"><br />Ao estar na tela de venda com produto(s) inserido no carrinho, adicionar o valor do desconto no campo 'desconto'.<br /><img src="/projeto/gif/descontoVenda.gif" title="Desconto" class="gif"></div>
            <div id="10" style="text-align: center;"><br />Ao estar na tela de venda, deve-se inserir produtos pelo código de barra ou adicionar itens manualmente. Após itens estarem inseridos no carrinho, altere a quantidade e desconto conforme necessário, após isso clique em 'Pagar Venda', insira a(s) forma(s) de pagamento desejado e clique em 'Realizar pagamento' e por ultimo 'Fechar Venda'.<br /><img src="/projeto/gif/venda.gif" title="Realizar Venda" class="gif"></div>
            <div id="11" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
        </div>
    </div> 
</div>
<script>
    function changeInput(e) {
        var targ;
        if (!e) {
            quantDesconto();
            $(".quant").show(); 
            $(".quantZerado").hide(); 
        }
        if (e.target) {
            targ=e.target;
            quantDesconto();
            $(".quant").show(); 
            $(".quantZerado").hide(); 
        } else if (e.srcElement) {
            targ=e.srcElement;
            $(".quant").hide();
        }
    }

    function TotalUnitario() {
        $(".quant, .desconto").on("input", function(){   
            var linha = $(this).closest("tr"); // busca a linha o elemento alterado
            var subtotal_txt = linha.find(".total_unitario").eq(0); // busca a span do total
            var subtotal_val = linha.find(".total_unitario").eq(1); // busca o hidden do total

            var quant = linha.find(".quant").val() || 0; // busca a quantidade
            var desconto = linha.find(".desconto").val() || 0; // busca o desconto
            var preco = parseFloat(linha.find("[name='preco[]']").val()) || 0; // busca o preço

            var subtt = (quant*preco) - ((desconto/100)*(quant*preco)); // faz o cálculo
            subtt = subtt.toFixed(2); // aplica o toFixed
        
            subtotal_txt.text(subtt); // coloca o resultado na span
            subtotal_val.val(subtt); // coloca o resultado no input

            soma_total();
        });

        $(".quant, .desconto").trigger("input");  
        
    }

    TotalUnitario();       

    function soma_total(){
        total= 0;
        $(".total_unitario").each(function(){
            total += +($(this).val());
        }); 

        $(".total_venda").text((total).toFixed(2));
        $(".total_venda").val((total).toFixed(2));
        total_venda = $(".total_venda").text((total).toFixed(2));
    };

    $("#total_pago").keyup(function(){
        var pago = $(this).val().replace(",",".");
        var pagRestante = $("#pagamento_pendente").text();
        if(pagRestante != 0){
            var troco =  parseFloat(pago) - parseFloat(pagRestante);
        }else{
            var troco =  parseFloat(pago) - parseFloat(total);  
        }     
        $("#troco").text((troco).toFixed(2));  
        if(troco < 0){
            $("#troco").text("00");
        }
        if(isNaN(troco)){
            $("#troco").text("00");
        }         
    })    
    	
    $("#click").attr("disabled", true);
    var totalPag = 0;
    var totalPago = 0;
    var totalParcelas = 0;
    function realizarPag() {
        var pago2 = $("#total_pago").val().replace(",",".");
        totalPag = parseFloat(pago2) + parseFloat(totalPag);
        totalPago = parseFloat(pago2);
        var troco = $("#troco").text();
        if(troco > 0){
            totalPag = parseFloat(totalPag) - parseFloat(troco);
            totalPago = parseFloat(totalPago) - parseFloat(troco);

        }
        $("#total_pago2").text((totalPag).toFixed(2));  
 
        var total_venda = $(".total_venda").val().replace(",",".");
        pagRestante = parseFloat(total_venda) - parseFloat(totalPag); 
        if(pagRestante < 0){
            pagRestante = 0;
        }
        $("#pagamento_pendente").text((pagRestante).toFixed(2)); 

        var tipoPag = $('.pagamentos_id:checked').val();
        if(tipoPag === '1'){
            tipoPag2 = 'Dinheiro';
            totalParcelas = $("#parcelasDinheiro").val();
        }
        if(tipoPag === '2'){
            tipoPag2 = 'Crédito';
            totalParcelas = $("#parcelasCartao1").val();
        }
        if(tipoPag === '3'){
            tipoPag2 = 'Débito';
            totalParcelas = $("#parcelasCartao2").val();
        }
        $('#pagamentos tbody').append("<tr><td style='font-size: 120%'>"+tipoPag2+"</td><input type='hidden'  name='tipoPag[]' value="+tipoPag+"><td style='font-size: 120%'>"+totalParcelas+"x</td><input type='hidden'  name='totalParcelas[]' value="+totalParcelas+"><td style='font-size: 120%' name='totalPago[]'>R$ "+(totalPago).toFixed(2)+"<input type='hidden' class='totalPago' name='totalPago[]';   value="+(totalPago).toFixed(2)+"><button type='button' class='btn btn-danger excluir' style='margin-left: 50%;'>x</button></td></tr>");
        var totalTr = $('#pagamentos tbody tr').length;
        $('#total_pagamentos').val(totalTr);
        $('#total_pago').val(""); 

        var pagPendente = $('#pagamento_pendente').text();
        if(pagPendente == 0 || pagPendente == null){
            $("#click").attr("disabled", false);
        }else{
            $("#click").attr("disabled", true);
        }
        
        var i = 0;
        //botao apagar pagamento
        $(".excluir").click(function() {
                var pagamentoTotal = $(this).parent().find(".totalPago").val();
                var totalPagAux = $('#total_pago2').text();
                var total = parseFloat(totalPagAux) -  parseFloat(pagamentoTotal);
                $("#total_pago2").text((total).toFixed(2));   
                $(this).parent().parent().remove(); 
        });
    }


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
        $("#10").hide();
        $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
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
                $("#10").hide();
                $("#11").hide();
            }
            if($(this).val() === '10'){
                $("#10").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#7").hide();
                $("#11").hide();
            }
            if($(this).val() ==='11' ){
                $("#11").show();
                $("#1").hide();
                $("#2").hide();
                $("#3").hide();
                $("#4").hide();
                $("#5").hide();
                $("#6").hide();
                $("#8").hide();
                $("#9").hide();
                $("#10").hide();
                $("#7").hide();
            }
        });
        var itens = $('#tbody').find('tr').length;
        $("#total_itens").text(itens);  
        
        $("#td-cartao1").hide();
        $("#td-cartao2").hide();
        $('.pagamentos_id').on('change',function () {
            if($(this).val() === '1'){
                $("#pagamento_dinheiro1").show();
                $("#pagamento_dinheiro2").show();
                $("#td-cartao1").hide();
                $("#td-cartao2").hide();
            }
            if($(this).val() === '2'){
                $("#pagamento_dinheiro1").hide();
                $("#pagamento_dinheiro2").hide();
                $("#td-cartao1").show();
                $("#td-cartao2").hide();
            }
            if($(this).val() === '3'){
                $("#pagamento_dinheiro1").hide();
                $("#pagamento_dinheiro2").hide();
                $("#td-cartao1").hide();
                $("#td-cartao2").show();
            }
        });
    });



    //Pegando valor do Código de Barra
    var input = document.getElementById("codigo");
    var role = "<?php echo $role; ?>";
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var codigoBarra = $(this).val();
            $.ajax({
                url: "./vendas/codigoBarra",
                type: "GET",
                data: {"codigoBarra" : codigoBarra},
                dataType: "json"

            }).done(function(resposta) {
                
                var respostaPreco = resposta['preco'].toFixed(2)
                
                if(role == "gerente"){ 
                    if(resposta['promocao'] == true){
                        $("#tbody").append(
                        '<tr>\
                            <td>' + resposta['id'] +'</td>\
                            <input type="hidden" name="produto[]" value="' + resposta['id'] +'">\
                            <td class="td-venda">' + resposta['nome'] +'</td>\
                            <input type="hidden" name="nome[]" value="' + resposta['nome'] +'">\
                            <td><input style="width: 30%;" type="number" name="quantidade[]" class="quant" value="' + resposta['quantidade'] +'" min="1" max="' + resposta['quantidade'] +'">\
                            <td><input style="width: 30%;" type="number" min="0" disabled="disabled" class="desconto">%</td>\
                            <td>R$ <span class="preco_uni">' + respostaPreco +'</span></td>\
                            <input type="hidden" name="preco[]" value="' + respostaPreco +'">\
                            <td>R$ <span class="total_unitario"></span></td>\
                            <input type="hidden" name="total[]" class="total_unitario">\
                            <td><a href="?deletar=' + resposta['id'] +'"><button type="button" class="btn btn-danger">x</button></a></td>\
                        </tr>')
                    }else{ 
                        $("#tbody").append(
                        '<tr>\
                            <td>' + resposta['id'] +'</td>\
                            <input type="hidden" name="produto[]" value="' + resposta['id'] +'">\
                            <td class="td-venda">' + resposta['nome'] +'</td>\
                            <input type="hidden" name="nome[]" value="' + resposta['nome'] +'">\
                            <td><input style="width: 30%;" type="number" name="quantidade[]" class="quant" value="' + resposta['quantidade'] +'" min="1" max="' + resposta['quantidade'] +'">\
                            <td><input style="width: 30%;" type="number" min="0" name="desconto2[]" class="desconto">%</td>\
                            <td>R$ <span class="preco_uni">' + respostaPreco +'</span></td>\
                            <input type="hidden" name="preco[]" value="' + respostaPreco +'">\
                            <td>R$ <span class="total_unitario"></span></td>\
                            <input type="hidden" name="total[]" class="total_unitario">\
                            <td><a href="?deletar=' + resposta['id'] +'"><button type="button" class="btn btn-danger">x</button></a></td>\
                        </tr>')
                    }
                }else{ 
                    if(resposta['promocao'] == true){
                        $("#tbody").append(
                        '<tr>\
                            <td>' + resposta['id'] +'</td>\
                            <input type="hidden" name="produto[]" value="' + resposta['id'] +'">\
                            <td class="td-venda">' + resposta['nome'] +'</td>\
                            <input type="hidden" name="nome[]" value="' + resposta['nome'] +'">\
                            <td><input style="width: 30%;" type="number" name="quantidade[]" class="quant" value="' + resposta['quantidade'] +'" min="1" max="' + resposta['quantidade'] +'">\
                            <td><input style="width: 30%;" type="number" min="0" disabled="disabled" class="desconto">%</td>\
                            <td>R$ <span class="preco_uni">' + respostaPreco +'</span></td>\
                            <input type="hidden" name="preco[]" value="' + respostaPreco +'">\
                            <td>R$ <span class="total_unitario"></span></td>\
                            <input type="hidden" name="total[]" class="total_unitario">\
                            <td><a href="?deletar=' + resposta['id'] +'"><button type="button" class="btn btn-danger">x</button></a></td>\
                        </tr>')
                        
                    }else{ 
                        $("#tbody").append(
                        '<tr>\
                            <td>' + resposta['id'] +'</td>\
                            <input type="hidden" name="produto[]" value="' + resposta['id'] +'">\
                            <td class="td-venda">' + resposta['nome'] +'</td>\
                            <input type="hidden" name="nome[]" value="' + resposta['nome'] +'">\
                            <td><input style="width: 30%;" type="number" name="quantidade[]" class="quant" value="' + resposta['quantidade'] +'" min="1" max="' + resposta['quantidade'] +'">\
                            <td><input style="width: 30%;" type="number" min="0" max="'+ resposta['desconto'] +'" name="desconto[]" class="desconto">%<td>\
                            <td>R$ <span class="preco_uni">' + respostaPreco +'</span></td>\
                            <input type="hidden" name="preco[]" value="' + respostaPreco +'">\
                            <td>R$ <span class="total_unitario"></span></td>\
                            <input type="hidden" name="total[]" class="total_unitario">\
                            <td><a href="?deletar=' + resposta['id'] +'"><button type="button" class="btn btn-danger">x</button></a></td>\
                        </tr>')
                    }
                }            
                TotalUnitario();
                var itens = $('#tbody').find('tr').length;
                $("#total_itens").text(itens);  
            });
            $(this).val("");
        }
    });
</script>
