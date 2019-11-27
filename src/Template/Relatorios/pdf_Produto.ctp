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
        <h1 class='h1'>Relatório de Produtos</h1>
        <p>De $dateI a $dateF</p>
        <br />
        <table class='table' cellpadding='0' cellspacing='0'>
            <thead>
                <tr>
                    <th class='th-venda'>ID Venda</th>
                    <th class='th-venda'>ID Produto</th>
                    <th class='th-venda'>Nome</th>
                    <th class='th-venda'>Quantidade</th>
                    <th class='th-venda'>Preço Unitário</th>
                    <th class='th-venda'>Total</th>
                    <th class='th-venda'>Data</th>
                </tr>
            </thead>

            <tbody>";

            if(isset($_SESSION['listaFiltrada'])){
                $listaFiltrada = $_SESSION['listaFiltrada'];
                for ($i=0; $i<count($listaFiltrada); $i++) {
                    $html .="<tr class='th-venda'><td>".$listaFiltrada[$i]['vendas_id'].'</td><br /><br />';
                    $html .='<td>'.$listaFiltrada[$i]['produtos_id'].'</td><br /><br />';
                    $html .='<td>'.$listaFiltrada[$i]['name'].'</td><br /><br />';
                    $html .='<td>'.$listaFiltrada[$i]['quantidade'].'</td><br /><br />';
                    $html .='<td>R$'.$listaFiltrada[$i]['preco'].'</td><br /><br />';
                    $html .="<td class='th-venda'>R$".$listaFiltrada[$i]['subtotal'].'&nbsp;</td><br /><br />';
                    $created =  date("d/m/Y H:m:s", strtotime($listaFiltrada[$i]['created']));
                    $html .="<td class='th-venda'>&nbsp;&nbsp;&nbsp;&nbsp;".$created.'</td><br /><br /></tr>';
                }
            }

            $html .= 
            "</tbody>

            </table>
            <table class='table resultado_relatorio'>";
            $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
            $query = $produtosVendas
                        ->find()
                        ->where([
                                'id' => $_SESSION['produtoVendido']
                        ]);
                $results = $query->toArray();
            if(isset($results[0])){   
                $nomeProduto =  $results[0]['name'];          
            }
            $html .="<tr><td></td><th>Produto mais vendido: ".$nomeProduto."</th></tr>";
            $html .="<tr><th class='thRodape'>ID Produto:  ".$_SESSION['produtoVendido']."</th>";
            $html .="<th class='thRodape'>Quantidade:  ".$_SESSION['quantidadeProduto']."</th>";    
            $html .="<th class='thRodape'>Valor Total:  R$".$_SESSION['valorTotalProduto']."</th></tr></table></fieldset>";




    $arquivo = "Relatório Produto.pdf";
    $mpdf=new mPDF(); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($arquivo, 'I');
    exit;
    // I - Abre no navegador
    // F - Salva o arquivo no servido
    // D - Salva o arquivo no computador do usuário
?>