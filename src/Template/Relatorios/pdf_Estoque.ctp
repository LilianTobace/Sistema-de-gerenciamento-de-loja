<?php 
    namespace Mpdf;
    use Cake\ORM\TableRegistry;
    error_reporting(0);
    ini_set('display_errors', 0);

    //estoque min e max do filtro
    $estoque_min = $_SESSION['estoque_min'];
    $estoque_max = $_SESSION['estoque_max'];
    $totalProduto = count($_SESSION['listaFiltrada']);
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
        <h1 class='h1'>Relatório de Estoque</h1>
        <p>Estoque de $estoque_min a $estoque_max</p>
        <br />
        <table class='table' cellpadding='0' cellspacing='0'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Cor</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                </tr>
            </thead>

            <tbody>";

            if(isset($listaFiltrada)){  
                $listaFiltrada = $_SESSION['listaFiltrada'];                    
                for ($i=0; $i<count($listaFiltrada); $i++) {
                    $html .= '<tr><td>'.$listaFiltrada[$i]['id'].'</td>';
                    $html .= '<td>'.$listaFiltrada[$i]['name'].'</td>';
                    $categorias_produto = TableRegistry::getTableLocator()->get('Categorias_Produtos');
                    $query = $categorias_produto
                        ->find()
                        ->where([
                                'id' => $listaFiltrada[$i]['categorias_produto_id']
                        ]);
                    $results = $query->toArray();
                    if(isset($results[0])){             
                        $categoria = $results[0]["nome_categoria"];
                    }
                    $html .= '<td>'.$categoria.'</td>';
                    $html .= '<td>'.$listaFiltrada[$i]['cor'].'</td>';
                    $html .= '<td>'.$listaFiltrada[$i]['estoque'].'</td>';
                    $html .= '<td>R$'.$listaFiltrada[$i]['preco'].'</td></tr>';
                }
            }

            $html .= 
            "</tbody>
            </table>
            <table class='table resultado_relatorio'>
                <tr>";
                if(isset($listaFiltrada)){    
                    for ($i=0; $i<count($listaFiltrada); $i++) {
                        $quantidadeProduto = $listaFiltrada[$i]['estoque'] + $quantidadeProduto;
                    }
                }            
            $html .= '<th> Total de Produto:  '.$totalProduto.'</th>';
            $html .= '<th>Total do Estoque:  '.$quantidadeProduto.'</th>';
            $html .= "
                </tr>
            </table>        
    </fieldset>";




    $arquivo = "Relatório Estoque.pdf";
    $mpdf = new mPDF(); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output($arquivo, 'I');
    exit;
    // I - Abre no navegador
    // F - Salva o arquivo no servido
    // D - Salva o arquivo no computador do usuário
?>