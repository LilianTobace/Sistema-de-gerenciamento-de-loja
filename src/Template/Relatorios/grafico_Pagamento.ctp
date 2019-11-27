<?php
use Cake\ORM\TableRegistry;
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/relatorio.css>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<link rel="stylesheet" type="text/css" href=/projeto/webroot/css/grafico.css>

<head>  
    <li><?= $this->Html->link(__('Relatórios de Pagamento'), ['action' => 'view_pagamento']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Venda'), ['action' => 'view_venda']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Caixa'), ['action' => 'view_caixa']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Estoque'), ['action' => 'view_estoque']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Cliente'), ['action' => 'view_cliente']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Produtos'), ['action' => 'view_produto']); ?></li>
    <li><?= $this->Html->link(__('Relatórios de Ticket Médio'), ['action' => 'view_ticket']);?></li>
    <li><?= $this->Html->link(__('Relatórios de Despesa'), ['action' => 'view_despesa']); ?></li>

    <?php $this->end();
    $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
</head>

<body class="relatorio-venda">
    <h2 class="page-header">Gráfico de Venda</h2>
    <?php 
    if(isset($_SESSION['listaFiltrada'])){
    ?>
    <br />
        <?php 
        if(isset($_SESSION['listaFiltrada'])){
       ?>
       <p class="p1">Forma de Pagamento mais realizada: <?php echo $_SESSION['nome']; ?></p>
       <p class="p2">Total Pago em <?php echo $_SESSION['nome']; ?>: R$<?php echo $_SESSION['valorPago']; ?></p>
            <div class="div1">
            <canvas id="myChart"></canvas>
            <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                options:{
                    maintainAspectRatio: false,
                },
                    labels: ["<?php $listaFiltrada = $_SESSION['listaFiltrada'];
                    for ($i=0; $i<count($listaFiltrada); $i++) {
                        $criado = date("d/m/Y", strtotime($listaFiltrada[$i]['created']));
                        $created = $criado;
                        if($created == $criado){
                            $created1 = $criado;
                        ?>",
                    "<?php 
                        }else{
                            echo $created; 
                        }
                    }
                    ?>"],
                    datasets: [{
                        label: 'Quantidade de Produtos Vendidos',
                        data: [0,<?php $listaFiltrada = $_SESSION['listaFiltrada'];
                        for ($i=0; $i<count($listaFiltrada); $i++) {
                            echo $listaFiltrada[$i]['total_produto']; ?>,
                        <?php 
                        }
                        ?>],
                        backgroundColor: [
                            'rgba(87, 190, 255, 0.2)',
                            'rgba(87, 190, 255, 0.2)',
                            'rgba(87, 190, 255, 0.2)',
                            'rgba(87, 190, 255, 0.2)',
                            'rgba(87, 190, 255, 0.2)',
                            'rgba(87, 190, 255, 0.2)'
                        ],
                        borderColor: [<?php $listaFiltrada = $_SESSION['listaFiltrada'];
                            for ($i=0; $i<count($listaFiltrada); $i++) { ?>
                                'rgba(87, 190, 255, 4)',
                        <?php                    
                        }
                        ?>
                        'rgba(87, 190, 255, 0.2)'
                        ],
                        borderWidth: 3
                    },
                    {
                        label: 'Valor dos Produtos Vendidos',
                        data: [0,<?php $listaFiltrada = $_SESSION['listaFiltrada'];
                        for ($i=0; $i<count($listaFiltrada); $i++) {
                            echo $listaFiltrada[$i]['total_venda']; ?>,
                        <?php 
                        }
                        ?>],
                        hidden: true,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [<?php $listaFiltrada = $_SESSION['listaFiltrada'];
                            for ($i=0; $i<count($listaFiltrada); $i++) { ?>
                                'rgba(255, 99, 132, 2)',
                        <?php                    
                        }
                        ?>
                        'rgba(255, 99, 132, 2)'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }    
                }   
            });
        <?php 
        }
        ?>
        </script>
    </div>
    <?php 
    }
    ?>
</body>