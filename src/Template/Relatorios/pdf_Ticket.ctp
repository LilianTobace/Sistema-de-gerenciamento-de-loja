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
        <h1 class='h1'>Relatório de Ticket Médio</h1>
        <p>De $dateI a $dateF</p>
        <br />
        <table class='table' cellpadding='0' cellspacing='0'>
            <thead>
                <tr class='th-venda'>
                    <th class='th-venda'>ID</th>
                    <th class='th-venda'>Cliente</th>
                    <th class='th-venda'>Cidade</th>
                    <th class='th-venda'>Quantidade de Produtos</th>
                    <th class='th-venda'>Total da Venda</th>
                    <th class='th-venda'>Pagamentos</th>
                    <th class='th-venda'>Data da venda</th>
                </tr>
            </thead>

            <tbody>";

            if(isset($_SESSION['listaFiltrada'])){
                $listaFiltrada = $_SESSION['listaFiltrada'];
                for ($i=0; $i<count($listaFiltrada); $i++) { 
                    $html .="<tr class='th-venda'><td class='th-venda'>".$listaFiltrada[$i]['id'].'&nbsp;&nbsp;&nbsp;</td>';      
                    $cliente = TableRegistry::getTableLocator()->get('Clientes');
                    $query = $cliente
                        ->find()
                        ->where([
                                'id' => $listaFiltrada[$i]['clientes_id']
                        ]);
                    $results = $query->toArray();
                    if(isset($results[0])){                
                        $nome = $results[0]["name"];
                    }
                    $html .="<td class='th-venda'>&nbsp;&nbsp;".$nome.'</td>';     
                    $cliente = TableRegistry::getTableLocator()->get('Clientes');
                    $query = $cliente
                        ->find()
                        ->where([
                                'id' => $listaFiltrada[$i]['clientes_id']
                        ]);
                    $results = $query->toArray();
                    if(isset($results[0])){                
                        $cidadeCliente = $results[0]["cidade_cliente"];
                    }
                    $html .="<td class='th-venda'>&nbsp;&nbsp;".$cidadeCliente.'</td>'; 
                    $html .="<td class='th-venda'>".$listaFiltrada[$i]['total_produto'].'</td>';
                    $html .="<td class='th-venda'>".$listaFiltrada[$i]['total_venda'].'</td>';
                    $html .="<td class='th-venda'>".$listaFiltrada[$i]['total_pagamentos'].'&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $created =  date("d/m/Y H:m:s", strtotime($listaFiltrada[$i]['created']));
                    $html .="<td class='th-venda'>".$created.'</td>';
                    $html .="</tr>";
                }
            }

            $html .= 
            "</tbody>

            </table>
            <table class='table resultado_relatorio'>";
                $listaFiltrada = $_SESSION['listaFiltrada'];
                $totalCliente = count($listaFiltrada);
                $totalGasto = $_SESSION['totalGasto'];  
                $media = ($totalGasto/$totalCliente);  

                $html .="<tr><th>Gastos Total: R$".round($_SESSION['totalGasto'], 2)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
                $html .="<th>Total de Clientes: ".$totalCliente."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
                $html .="<th>Média de Gasto: ".round($media, 2)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th></tr></table></fieldset>";

    $arquivo = "Relatório Ticket Médio.pdf";
    $mpdf=new mPDF(); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($arquivo, 'I');
    exit;
    // I - Abre no navegador
    // F - Salva o arquivo no servido
    // D - Salva o arquivo no computador do usuário
?>