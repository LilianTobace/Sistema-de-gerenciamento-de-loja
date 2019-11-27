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
    </style>

    <fieldset>
        <p class='pPdf'>Página 1 de 1</p>
        <p class='pPdf2'>Nome da Empresa
        _______________________________________________________________________________________________________</p>
        <h1 class='h1'>Relatório de Vendas</h1>
        <p>De $dateI a $dateF</p>
        <br />
        <table class='table' cellpadding='0' cellspacing='0'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Pagamentos</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>";

            if(isset($listaFiltrada)){    
                for ($i=0; $i<count($listaFiltrada); $i++) {
                    $html .= '<tr><td>'.$listaFiltrada[$i]['id'].'</td>';
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
                    $html .= '<td>'.$nome.'</td>';
                    $html .= '<td>'.$listaFiltrada[$i]['total_produto'].'</td>';
                    $html .= '<td>R$'.$listaFiltrada[$i]['total_venda'].'</td>';
                    $html .= '<td>'.$listaFiltrada[$i]['total_pagamentos'].'</td>';
                    $created =  date("d/m/Y H:m:s", strtotime($listaFiltrada[$i]['created']));
                    $html .= '<td>'.$created.'</td>';
                    $html .= '</tr>';
                }
            }

            $html .= 
            "</tbody>
            </table>
            <table class='table resultado_relatorio'>
                <tr>";
                if(isset($listaFiltrada)){    
                    for ($i=0; $i<count($listaFiltrada); $i++) {
                        $quantidadeProduto = $listaFiltrada[$i]['total_produto'] + $quantidadeProduto;
                        $valorTotal = $listaFiltrada[$i]['total_venda'] + $valorTotal;
                    }
                }               
            $html .= '<th> Quantidade de produto: '.$quantidadeProduto.'</th>';
            $html .= '<th>Valor Total:  R$'.$valorTotal.'</th>';
            $html .= "
                </tr>
            </table>        
    </fieldset>";




    $arquivo = "Relatório Venda.pdf";
    $mpdf = new mPDF(); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($arquivo, 'I');
    exit;
    // I - Abre no navegador
    // F - Salva o arquivo no servido
    // D- Salva o arquivo no computador do usuário
?> 