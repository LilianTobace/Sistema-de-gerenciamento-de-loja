<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
use Cake\ORM\TableRegistry;
echo $this->Html->css('despesa1.css');
?>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/manual.css>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/despesas.css>
<head>
    <?php $this->end();
    $this->start('tb_sidebar'); ?>

    <ul class="nav nav-sidebar th1">
        <li><?= $this->Html->link(__('Listar Despesa'), ['action' => 'index']) ?> 
        <li><?= $this->Html->link(__('Editar Despesa'), ['action' => 'edit', $despesa->id]) ?> </li> 
        <li><?= $this->Html->link(__('Novo Cadastro'), ['action' => 'add']) ?> 
        </li>
    </ul>
    <?php $this->end(); ?>
</head>


<body class="panel panel-default bodyView">
    <div class="panel-heading">
        <?php
        $despesasTipo = TableRegistry::getTableLocator()->get('DespesasTipos');
        $query = $despesasTipo
                    ->find()
                    ->where([
                            'id' => $despesa->despesas_tipo_id
                    ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $nomeDespesa = $results[0]["tipo"];
            }
        ?>
        <h3 class="panel-title h3View"><?php echo "Despesa de "; echo ($nomeDespesa); ?></h3>
    </div>

    <table class="table table-striped tableView">
        <tr>
            <td><?= __('ID') ?></td>
            <td><?= $this->Number->format($despesa->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Tipo') ?></td>
            <td><?php echo $nomeDespesa ?></td>
        </tr>
        <tr>
            <td><?= __('Valor') ?></td>
            <td>R$<?php echo $despesa->valor; ?></td>
        </tr>
        <tr>
            <td><?= __('Observação') ?></td>
            <td><?php echo $despesa->observacao ?></td>
        </tr>
        <tr>
            <td><?= __('Criado') ?></td>
            <td><?php echo date('d/m/Y H:i:s', strtotime($despesa->created)); ?></td>
        </tr>
        <tr>
            <td><?= __('Modificado') ?></td>
            <td><?php echo date('d/m/Y H:i:s', strtotime($despesa->modified)); ?></td>
        </tr>
    </table>
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
                    <option value="8">Inserir descrição de despesa</option>
                </select> 
            </div>
            <br />
            <div id="1" style="text-align: center;"><br />Ao estar no módulo de despesas, procure o cadastro que deseja ver detalhadamente as informações e clique no botão com imagem de um 'olho' do lado direito da listagem.<br /><img src="/projeto/gif/viewDespesa.gif" title="Vizualizar" class="gif"></div>
            <div id="2" style="text-align: center;"><br />Ao estar no módulo de despesas, procure o cadastro que deseja e clique no botão com imagem de um 'lápis' do lado direito da listagem.<br /><img src="/projeto/gif/editarDespesa2.gif" title="Editar" class="gif"></div>
            <div id="3" style="text-align: center;"><br />Ao estar no módulo de despesas, procure o cadastro que deseja e clique no botão com imagem de uma 'lixeira' do lado direito da listagem.<br /><img src="/projeto/gif/deletarDespesa.gif" title="Deletar" class="gif"></div>
            <div id="4" style="text-align: center;"><br />Ao estar no módulo de despesas, clique no 'Novo cadastro' localizado do lado esquerdo da tela, preencha todos os campos do cadastro e clique no botão 'Cadastrar'.<br /><img src="/projeto/gif/novaDespesa.gif" title="Novo" class="gif"></div>
            <div id="5" style="text-align: center;"><br />Ao estar no módulo de despesas, clicar no botão 'Página Principal' localizado do lado direito no topo da tela.<br /><img src="/projeto/gif/voltarPagPrincipal.gif" title="Voltar" class="gif"></div>
            <div id="6" style="text-align: center;"><br />Ao estar no módulo de despesas, clicar no botão 'Listar Despesas' localizado no lado esquerdo da tela.<br /><img src="/projeto/gif/listarDespesa.gif" title="Listar" class="gif"></div>
            <div id="7" style="text-align: center;"><br />Para sair basta clicar no botão 'Logout' localizado no canto direito em cima na tela.<br /><img src="/projeto/gif/logout.gif" title="Logout" class="gif"></div>
            <div id="8" style="text-align: center;"><br />Ao estar no módulo de despesas, clique no 'Novo cadastro' localizado do lado esquerdo da tela, clique em '+ Adicionar Nova Descrição', preencha os campos e clique no botão 'Cadastrar'.<br /><img src="/projeto/gif/novaDescricaoDespesa.gif" title="Novo" class="gif"></div>
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
            }
        });
    });
</script>