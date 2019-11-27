<?php 
    namespace Mpdf;
    use Cake\ORM\TableRegistry;
    error_reporting(0);
    ini_set('display_errors', 0);

    //Data do relatório
    $dateI =  date("d/m/Y", strtotime($_SESSION['dataInicio']));
    $dateF =  date("d/m/Y", strtotime($_SESSION['dataFinal']));
    //lista da filtragem
    $listaFiltrada = $_SESSION['listaFiltrada'];



    $html = "
    <style>
    .pPdf{
        margin-left: 89%;
        font-size: 80%;
        white-space: nowrap;
    }

    .pPdf2{
        text-align: center;
    }

    .h1{
        text-align: center;
    }

    .p1{
        font-size: 110%;
    }

    .table{
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        text-align:center;
    }

    .resultado_relatorio{
        background-color: #BEBEBE; 
    }
    .resultado_relatorio1{
       font-size: 130%;
       white-space: nowrap;
    }

    .th-venda{
        text-align: center;
        white-space: break-word;
    }

    </style>

    <fieldset>
        <p class='pPdf'>Página 1 de 1</p>
        <p class='pPdf2'>Nome da Empresa
        _______________________________________________________________________________________________________</p>
        <h1 class='h1'>Relatório de Caixa</h1>
        <p>De $dateI a $dateF</p>
        <br />
        <table class='table' cellpadding='0' cellspacing='0'>
            <thead>
                <tr class='th-venda'>
                    <th class='th-venda'>ID &nbsp;&nbsp;&nbsp;</th>
                    <th class='th-venda'>Usuário</th>
                    <th class='th-venda'>Data da Abertura</th>
                    <th class='th-venda'>Saldo de Abertura</th>
                    <th class='th-venda'>Data de fechamento</th>
                    <th class='th-venda'>Saldo de fechamento</th>
                    <th class='th-venda'>Total de Vendas</th>
                    <th class='th-venda'>Valor<br /> Total</th>
                </tr>
            </thead>

            <tbody>";

            if(isset($_SESSION['listaFiltrada'])){
                $listaFiltrada = $_SESSION['listaFiltrada'];
                for ($i=0; $i<count($listaFiltrada); $i++) { 
                    if ($listaFiltrada[$i]['estado_caixa'] != 1){
                        $html .="<tr class='th-venda'><td class='th-venda'>".$listaFiltrada[$i]['id'].'</td><br />';
                        $user = TableRegistry::getTableLocator()->get('Users');
                            $query = $user
                                ->find()
                                ->where([
                                       'id' => $listaFiltrada[$i]['users_id']
                                ]);
                            $results = $query->toArray();
                            if(isset($results[0])){                
                                $nome = $results[0]["name"];
                            }
                        $html .="<td class='th-venda'>".$nome.'</td>';
                        $html .="<td class='th-venda'>".$listaFiltrada[$i]['created'].'</td><br />';
                        $html .="<td class='th-venda'>R$".$listaFiltrada[$i]['saldo_inicial'].'</td><br />';
                        $html .="<td class='th-venda'>".$listaFiltrada[$i]['modified'].'</td><br />';
                        $html .="<td class='th-venda'>R$".$listaFiltrada[$i]['saldo_final'].'</td><br />';
                        $vendas = TableRegistry::getTableLocator()->get('Vendas');
                        $query = $vendas->find()
                            ->select([
                                    'caixas_id',
                                    'count' => $query->func()->count('caixas_id')
                            ])
                            ->where([
                                    'caixas_id' => $listaFiltrada[$i]['id'],
                                    'created >=' => $_SESSION['dataInicio'], 
                                    'created <=' => $_SESSION['dataFinal']
                            ])
                            ->group('caixas_id')
                            ->order(['count' => 'DESC']);
                            $results = $query->toArray();
                            if(isset($results[0])){
                                $_SESSION['valorTotalProduto'] = $results[0]['count'];
                                $html .="<td class='th-venda'>".$_SESSION['valorTotalProduto'].'</td><br />';
                            }
                        $vendas = TableRegistry::getTableLocator()->get('Vendas');
                        $query = $vendas->find()
                            ->select([
                                    'caixas_id',
                                    'sum' => $query->func()->sum('total_venda')
                            ])
                            ->where([
                                    'caixas_id' => $listaFiltrada[$i]['id'],
                                    'created >=' => $_SESSION['dataInicio'], 
                                    'created <=' => $_SESSION['dataFinal']
                                ])
                            ->group('caixas_id')
                            ->order(['sum' => 'DESC']);
                        $results = $query->toArray();
                        if(isset($results[0])){
                            $_SESSION['totalVenda'] = $results[0]['sum'];
                            $html .="<td class='th-venda'>R$".$_SESSION['totalVenda'].'</td><br />';
                        }
                        $html .="</tr>";
                    }
                }
            }

            $html .= 
            "</tbody>

            </table>
            <table class='table resultado_relatorio'>";
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'caixas_id',
                        'sum' => $query->func()->sum('total_venda')
                ])
                ->where([
                        'created >=' => $_SESSION['dataInicio'], 
                        'created <=' => $_SESSION['dataFinal']
                ])
                ->group('caixas_id')
                ->order(['sum' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['idCaixa'] = $results[0]['caixas_id'];
            }
            $html .="<tr><th>Caixa Com Mais Vendas: ".$_SESSION['idCaixa']."</th>";
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                    'caixas_id',
                    'count' => $query->func()->count('caixas_id')
                ])
                ->where([
                        'created >=' => $_SESSION['dataInicio'], 
                        'created <=' => $_SESSION['dataFinal']
                ])
                ->group('caixas_id')
                ->order(['count' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['valorProduto'] = $results[0]['count'];
            }
            $html .="<th class='thRodape'>Total de Vendas:  ".$_SESSION['valorProduto']."</th>";
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'caixas_id',
                        'sum' => $query->func()->sum('total_venda')
                ])
                ->where([
                        'created >=' => $_SESSION['dataInicio'], 
                        'created <=' => $_SESSION['dataFinal']
                ])
                ->group('caixas_id')
                ->order(['sum' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['maisVendas'] = $results[0]['sum'];
            }
            $html .="<th class='thRodape'>Valor Total:  R$".$_SESSION['maisVendas']."</th></tr></table></fieldset>";

    $arquivo = "Relatório Caixa.pdf";
    $mpdf=new mPDF(); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($arquivo, 'I');
    exit;
    // I - Abre no navegador
    // F - Salva o arquivo no servido
    // D - Salva o arquivo no computador do usuário
?>