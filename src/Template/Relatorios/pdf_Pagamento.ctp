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
        <h1 class='h1'>Relatório de Pagamento</h1>
        <p>De $dateI a $dateF</p>
        <br />
        <table class='table' cellpadding='0' cellspacing='0'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendas ID</th>
                    <th>Forma de Pagamento</th>
                    <th>&nbsp;&nbsp;&nbsp;Parcelas</th>
                    <th>Valor Pagamentos</th>
                    <th>Data do Pagamento</th>
                </tr>
            </thead>

            <tbody>";

            if(isset($listaFiltrada)){    
                for ($i=0; $i<count($listaFiltrada); $i++) {
                    $html .= '<tr><td>'.$listaFiltrada[$i]['id'].'</td>';
                    $html .= '<td>'.$listaFiltrada[$i]['vendas_id'].'</td>';
                    $pagamentos = TableRegistry::getTableLocator()->get('Pagamentos');
                        $query = $pagamentos
                            ->find()
                            ->where([
                                    'id' => $listaFiltrada[$i]['pagamentos_id']
                            ]);
                        $results = $query->toArray();
                        if(isset($results[0])){                
                            $formaPag = $results[0]["name"];
                        }
                    $html .= '<td>'.$formaPag.'</td>';
                    $html .= '<td>'.$listaFiltrada[$i]['parcelas'].'</td>';
                    $html .= '<td>R$'.$listaFiltrada[$i]['valor_pago'].'</td>';
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
                $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
                $query = $vendasPagas->find()
                    ->select([
                            'pagamentos_id',
                            'count' => $query->func()->count('pagamentos_id')
                    ])
                    ->where([
                            'created >=' => $dataInicio, 
                            'created <=' => $dataFinal
                    ])
                    ->group('pagamentos_id')
                    ->order(['count' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['pagamentos'] = $results[0]['pagamentos_id'];
                    $_SESSION['pagTotal'] = $results[0]['count'];

                    $pagamentos = TableRegistry::getTableLocator()->get('Pagamentos');
                    $query = $pagamentos->find()
                            ->where([
                                    'id' => $_SESSION['pagamentos']
                            ]);
                    $results = $query->toArray();
                    if(isset($results[0])){                
                        $_SESSION['nome'] = $results[0]["name"];
                    }  
                }               
            $html .= '<th> Forma de Pagamento mais realizada: <br />'.$_SESSION['nome'].'</th>';
            $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
            $query = $vendasPagas->find()
                ->select([
                        'pagamentos_id',
                        'sum' => $query->func()->sum('valor_pago')
                ])
                ->where([
                        'created >=' => $dataInicio, 
                        'created <=' => $dataFinal
                ])
                ->group('pagamentos_id')
                ->order(['sum' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['valorPago'] = $results[0]['sum'];
            }
            $html .= '<th>Total Pago em '.$_SESSION['nome'].': R$'.$_SESSION['valorPago'].'</th>';
            $html .= "
                </tr>
            </table>        
    </fieldset>";




    $arquivo = "Relatório Pagamento.pdf";
    $mpdf = new mPDF(); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($arquivo, 'I');
    exit;
    // I - Abre no navegador
    // F - Salva o arquivo no servido
    // D- Salva o arquivo no computador do usuário
?> 