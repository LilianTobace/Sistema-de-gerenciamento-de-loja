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
        <h1 class='h1'>Relatório de Despesas</h1>
        <p>De $dateI a $dateF</p>
        <br />
        <table class='table' cellpadding='0' cellspacing='0'>
            <thead>
                <tr>
                    <th class='th-venda'>ID</th>
                    <th class='th-venda'>Tipo</th>
                    <th class='th-venda'>Valor</th>
                    <th class='th-venda'>Criado</th>
                </tr>
            </thead>

            <tbody>";

            if(isset($_SESSION['listaFiltrada'])){
                $listaFiltrada = $_SESSION['listaFiltrada'];
                for ($i=0; $i<count($listaFiltrada); $i++) {
                    $html .="<tr class='th-venda'><td>".$listaFiltrada[$i]['id'].'</td>';
                    $despesasTipo = TableRegistry::getTableLocator()->get('DespesasTipos');
                    $query = $despesasTipo
                                ->find()
                                ->where([
                                        'id' => $listaFiltrada[$i]['despesas_tipo_id']
                                ]);
                        $results = $query->toArray();
                        if(isset($results[0])){
                            $tipo = $results[0]["tipo"];
                        }
                    $html .="<td>".$tipo."</td>";    
                    $html .="<td>R$".$listaFiltrada[$i]['valor'].'</td>';
                    $html .="<td>".date('d/m/Y H:i:s', strtotime($listaFiltrada[$i]['created'])).'</td><br /><br /></tr>';
                }
            }
            $html .= 
            "</tbody>

            </table>
            <table class='table resultado_relatorio'>";
            $html .="<tr><th>Total de Despesas: ".$_SESSION['countTipo']."</th>";
            $html .="<th>Gasto Total:  R$".$_SESSION['sumValor']."</th></tr></table></fieldset>";




    $arquivo = "Relatório Despesa.pdf";
    $mpdf=new mPDF(); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($arquivo, 'I');
    exit;
    // I - Abre no navegador
    // F - Salva o arquivo no servido
    // D - Salva o arquivo no computador do usuário
?>