<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Vendas Controller
 *
 * @property \App\Model\Table\VendasTable $Vendas
 *
 * @method \App\Model\Entity\Venda[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VendasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //permissao de nivel de usuário
        $user = TableRegistry::getTableLocator()->get('Users');
        $query = $user
                ->find()
                ->where([
                        'username' => $_SESSION['usuarioLogado']
                ]);
        $results = $query->toArray();
        if(isset($results[0])){
            
            $role = $results[0]["role"];

            if($role == "estoquista"){   //nao permitir que estoquista acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        //pegar usuario que abriu o caixa
        $caixa = TableRegistry::getTableLocator()->get('Caixas');
        $query = $caixa
                    ->find()
                    ->where([
                            'estado_caixa' => 1
                    ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $id_usuario_caixa = $results[0]["users_id"];
                $_SESSION['id_usuario_caixa'] = $id_usuario_caixa;
            }

        $user = TableRegistry::getTableLocator()->get('Users');
        $query = $user
                    ->find()
                    ->where([
                            'id' => $_SESSION['id_usuario_caixa']
                    ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $iduser = $results[0]["id"];
                $nomeuser = $results[0]["name"];
                $_SESSION['nomecaixa'] = $nomeuser;
            }


        $this->paginate = [
            'contain' => ['Clientes']
        ];
        $venda = $this->paginate($this->Vendas);

        $this->set(compact('venda'));

        $produto = TableRegistry::get('Produtos');
        $produtos = $produto->find();
        $this->set(compact('produtos'));

        $produtosVenda = TableRegistry::get('ProdutosVendas');
        $produtosVenda = $produtosVenda->find();
        $this->set(compact('produtosvendas'));   

        $venda = $this->Vendas->newEntity();

        $clientes = $this->Vendas->Clientes->find('list', ['limit' => 200]);
        $produtos = $this->Vendas->Produtos->find('list', ['limit' => 200]);
        $this->set(compact('venda', 'clientes', 'produtos'));


        //remover o produto do carrinho    
        if(isset($_GET['deletar'])){

            $i=0;
            foreach ($_SESSION['carrinho'] as $value) {
                if($_GET['deletar'] == $value['id']) {
                    unset($_SESSION['carrinho'][$i]);
                }
                $i++;
            } 

            $carrinho = [];

        
            foreach ($_SESSION['carrinho'] as $value) {
                $value['promocao'] = 0;
                $cart = [
                    "id" => $value['id'],
                    "nome" => $value['nome'],
                    "promocao" => $value['promocao'],
                    "quantidade" => $value['quantidade'],
                    "preco" => $value['preco'],
                    "desconto" => $value['desconto']
                ];
                array_push($carrinho, $cart);
            }


            $_SESSION['carrinho'] = $carrinho;

            return $this->redirect(['controller' => 'vendas', 'action' => 'index']);

        }

        //Salvando a venda    
        if(isset($_POST['produto'])){
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->query();
            $query->insert(['total_produto', 'total_venda', 'total_pagamentos', 'clientes_id', 'caixas_id', 'created'])
                ->values([
                    'total_produto' => (int) $_POST['total_produto'],
                    'total_venda' => floatval($_POST['total_venda']),
                    'total_pagamentos' => (int) $_POST['total_pagamentos'],
                    'clientes_id' => (int) $_POST['clientes_id'],
                    'caixas_id' => (int) $_POST['caixas_id'],
                    'created' => $_POST['created']
                ])
                ->execute();

            $query = $vendas
                        ->find()
                        ->order(['id' => 'DESC'])
                        ->limit(1);

            $results = $query->toArray();
                    
            if(isset($_POST['desconto'])){

                for($i=0; $i < count($_POST['produto']); $i++){

                    $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                    $query = $produtosVendas->query();
                    $query->insert(['vendas_id', 'produtos_id', 'quantidade', 'desconto', 'preco', 'subtotal', 'name', 'created'])
                        ->values([
                            'vendas_id' => (int) $results[0]['id'],
                            'produtos_id' => (int) $_POST['produto'][$i],
                            'quantidade' => (int) $_POST['quantidade'][$i],
                            'desconto' => (int)$_POST['desconto'][$i],
                            'preco' => floatval($_POST['preco'][$i]),
                            'subtotal' => floatval($_POST['total'][$i]),
                            'name' => $_POST['nome'][$i],
                            'created' => $_POST['created'][$i]
                        ])
                        ->execute();
                    unset($_SESSION['selecionarCliente']); //limpa a session do cliente selecionado na compra realizada
                }
            }
            if(isset($_POST['desconto2'])){
                for($i=0; $i < count($_POST['produto']); $i++){

                    $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                    $query = $produtosVendas->query();
                    $query->insert(['vendas_id', 'produtos_id', 'quantidade', 'desconto', 'preco', 'subtotal', 'name', 'created'])
                        ->values([
                            'vendas_id' => (int) $results[0]['id'],
                            'produtos_id' => (int) $_POST['produto'][$i],
                            'quantidade' => (int) $_POST['quantidade'][$i],
                            'desconto' => (int)$_POST['desconto2'][$i],
                            'preco' => floatval($_POST['preco'][$i]),
                            'subtotal' => floatval($_POST['total'][$i]),
                            'name' => $_POST['nome'][$i],
                            'created' => $_POST['created']
                        ])
                        ->execute();
                    unset($_SESSION['selecionarCliente']); //limpa a session do cliente selecionado na compra realizada
                }
            }

            if(isset($_POST['tipoPag'])){
                for($i=0; $i < count($_POST['tipoPag']); $i++){
                    $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
                    $query = $vendasPagas->query();
                    $query->insert(['vendas_id', 'pagamentos_id', 'parcelas', 'valor_pago', 'created'])
                        ->values([
                            'vendas_id' => (int) $results[0]['id'],
                            'pagamentos_id' => (int) $_POST['tipoPag'][$i],
                            'parcelas' => (int) $_POST['totalParcelas'][$i],
                            'valor_pago' => (int)$_POST['totalPago'][$i],
                            'created' => $_POST['created']
                        ])
                        ->execute();
                    unset($_SESSION['selecionarCliente']); //limpa a session do cliente selecionado na compra realizada
                }
            }

            //Alterando o estoque do produto
            for($i=0; $i < count($_POST['produto']); $i++){
                $produtos = TableRegistry::getTableLocator()->get('Produtos');
                $query = $produtos
                        ->find()
                        ->where([
                            'id' => (int) $_POST['produto'][$i]
                    ]);
                    
                $results = $query->toArray();
                if(isset($results[0])){
                    //alterando estoque e salvando data da venda
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataVenda = date("d/m/Y H:i:s");
                    $quantidade = $_POST['quantidade'][$i]; 
                    $estoque = $results[0]["estoque"];
                    $novoestoque = $estoque - $quantidade;
                    $results[0]["estoque"] = $novoestoque; 
                    $results[0]["data_venda"] = $dataVenda; 
                    $produtos->save($results[0]);
                }
            }
            $_SESSION['carrinho'] = [];
            $this->Flash->success(__('A venda foi salva com sucesso.'));         
        }

    }

    public function cancelar(){
        $this->paginate = [
        'contain' => ['Clientes'],
        'order' => ['id' => 'asc'],
        'limit' => '50'
        ];
        $vendas = $this->paginate($this->Vendas);
        $this->set(compact('vendas'));

        //Cancelando venda 
        if(isset($_POST['venda'])){

            $venda = TableRegistry::getTableLocator()->get('Vendas');
            $query = $venda
                    ->find()
                    ->where([
                            'id' => $_POST['venda']
                    ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $results[0]["venda_cancelada"] = 1; 
                $results[0]["observacao_venda_cancelada"] = $_POST['observacao_venda_cancelada']; 
                $results[0]["data_cancelamento"] = $_POST['data_cancelamento']; 
                $venda->save($results[0]);
                $this->Flash->success(__('A venda foi cancelada com sucesso!'));
                return $this->redirect(['action' => 'cancelar']);
            }else{
            $this->Flash->error(__('A venda não pode ser salva, por favor, tente novamente!'));
            }
        }
    }

    public function codigoBarra(){
        $this->autoRender = false;
        
        if(isset($_GET['codigoBarra'])){
            $produtos = TableRegistry::getTableLocator()->get('Produtos');
            $query = $produtos
                        ->find()
                        ->where([
                                'codigo_barra' => $_GET['codigoBarra']
                        ]);
                $results = $query->toArray();
                if(isset($results[0])){
                    $carrinho['id'] = $results[0]["id"];
                    $carrinho['nome'] = $results[0]["name"];
                    $carrinho['categoria'] = $results[0]["categorias_produto_id"];
                    $carrinho['quantidade'] = $results[0]["estoque"];
                    $carrinho['desconto'] = $results[0]["desconto"];
                    $carrinho['preco'] = $results[0]["preco"];
                    $carrinho['promocao'] = false;
                    
                    //verificar se há promoção
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = date("Y-m-d");

                    $promocoes = TableRegistry::getTableLocator()->get('Promocoes');
                    $query = $promocoes
                                ->find()
                                ->where([
                                        'status' => 1,
                                        'categorias_produto_id' => $carrinho['categoria'],
                                        'data_inicio <=' => $dataAtual, 
                                        'data_final >=' => $dataAtual
                                ]);
                        $results = $query->toArray();
                        if(isset($results[0])){
                            $promocaoPreco = $results[0]["promocao"];
                            $novoPreco = $carrinho['preco'] - ($carrinho['preco'] * ($promocaoPreco/100));
                            $carrinho['preco'] = $novoPreco;
                            $carrinho['promocao'] = true;
                        }

                    array_push($_SESSION['carrinho'], $carrinho);
                }

            echo json_encode($carrinho);

        }
    }
}