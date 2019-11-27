<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ProdutosVendas Controller
 *
 * @property \App\Model\Table\ProdutosVendasTable $ProdutosVendas
 *
 * @method \App\Model\Entity\ProdutosVenda[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class ProdutosVendasController extends AppController
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

        // $options = array(
        //     'order' => array('Produtos.id' => 'Asc'),
        //     'limit' => 1
        // );

        // $this->paginate = $options;
        
        // $this->paginate = [
        //     'contain' => ['Produtos', 'Vendas', 'ProdutosVendas'],
        //     'order' => array('Produtos.id' => 'Asc'),
        //     'limit' => 1
        // ];
        // $paginate = array(
        //     'limit' => 2,
        //     'order' => array(
        //         'Produtos.id' => 'asc'
        //     )
        // );
        
        // $produtos = $this->paginate($this->Produtos);

        // $this->set(compact('produtos', 'ProdutosVendas'));
        //$produtosVendas = $this->paginate($this->$paginate);
        $produtosVendas = $this->paginate($this->ProdutosVendas);
        $this->set(compact('produtosVendas'));

        $produto = TableRegistry::get('Produtos');
        $produtos = $produto->find();

        $this->set(compact('produtos'));
    }

    public function carrinho(){
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
            
        $id = $this->request->getData();
        $nome = $this->request->getData();
        $quantidade = $this->request->getData();
        $promocao = $this->request->getData();
        $preco = $this->request->getData();
        $desconto = $this->request->getData();

        if ($id == null && $nome == null && $quantidade == null && $preco == null && $desconto == null && $promocao == null) {
            //unset( $_SESSION['id_cart'] );  // irá remover apenas os dados de 'id_cart'
            return $this->redirect(['action' => 'index']);
        }else{

            $carrinho = [];

            if(isset($_SESSION['carrinho'])){
                $carrinho = $_SESSION['carrinho'];
            }

            for($i=0; $i < count($this->request->getData('id')); $i++){
                $cart = [
                    "id" => $this->request->getData('id')[$i],
                    "nome" => $this->request->getData('nome')[$i],
                    "quantidade" => $this->request->getData('quantidade')[$i],
                    "promocao" => $this->request->getData('promocao')[$i],
                    "preco" => $this->request->getData('preco')[$i],
                    "desconto" => $this->request->getData('desconto')[$i],
                ];
                array_push($carrinho, $cart);
            }

            $_SESSION['carrinho'] = $carrinho;
            return $this->redirect(['controller' => 'vendas', 'action' => 'index']);
        }
    }
}
