<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Produtos Controller
 *
 * @property \App\Model\Table\ProdutosTable $Produtos
 *
 * @method \App\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutosController extends AppController
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
        $this->paginate = [
            'contain' => ['CategoriasProdutos', 'Fornecedores'],
            'order' => array('Produtos.id' => 'Asc'),
            'limit' => 9
        ];
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));

        //Verifica se há produto sem desconto cadastrado
        $user = TableRegistry::getTableLocator()->get('Users');
        $query = $user
                    ->find()
                    ->where([
                            'username' => $_SESSION['usuarioLogado']
                    ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $role = $results[0]["role"];
            if($role == "gerente"){  
                $produto = TableRegistry::getTableLocator()->get('Produtos');
                $query = $produto
                            ->find()
                            ->where([
                                    'desconto' => 0
                            ]);
                $results = $query->toArray();
                if(isset($results[0])){
                    $this->Flash->error(__('Há produtos sem desconto cadastrado!'));
                }
            }
        }

        //Verifica se há produto com estoque baixo
        //Variável arquivo armazena o nome e extensão do arquivo.
        $arquivo = "D:/xampp/htdocs/projeto/src/Template/Produtos/configEstoque.txt";
        //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
        $fp = fopen($arquivo, "r");
        //Lê o conteúdo do arquivo aberto.
        $_SESSION['configEstoque'] = fread($fp, filesize($arquivo));
        //Fecha o arquivo.
        fclose($fp);
        
        $produtos = TableRegistry::getTableLocator()->get('Produtos');
        $query = $produtos
                ->find()
                ->where([
                        'estoque <=' => $_SESSION['configEstoque']
                ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $this->Flash->error(__('Há produtos com estoque baixo!'));
        }
    }


    /**
     * View method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
        $produto = $this->Produtos->get($id, [
            'contain' => ['CategoriasProdutos', 'Fornecedores']
        ]);

        $this->set('produto', $produto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
            
        $produto = $this->Produtos->newEntity();
        //Salvando o cadastro    
        if ($this->request->is('post')) {
            if($role == 'gerente'){
                if(isset($_POST['name'])){
                    $produtos = TableRegistry::getTableLocator()->get('Produtos');
                    $query = $produtos->query();
                    $query->insert(['name', 'codigo_barra', 'categorias_produto_id', 'fornecedore_id', 'cor', 'tecido', 'estoque', 'tamanho', 'custo_bruto', 'porcentagem', 'preco', 'desconto', 'descricao_tecido', 'descricao_produto', 'created', 'modified'])
                        ->values([
                            'name' => $_POST['name'],
                            'categorias_produto_id' => (int)($_POST['categorias_produto_id']),
                            'codigo_barra' => $_POST['codigo_barra'],
                            'fornecedore_id' => (int) $_POST['fornecedore_id'],
                            'cor' => $_POST['cor'],
                            'tecido' => $_POST['tecido'],
                            'estoque' => (int)$_POST['estoque'],
                            'tamanho' => $_POST['tamanho'],
                            'custo_bruto' => floatval($_POST['custo_bruto']),
                            'porcentagem' => (int)$_POST['porcentagem'],
                            'preco' => (floatval($_POST['preco2']) > 0) ? floatval($_POST['preco2']) : floatval($_POST['preco']),
                            'desconto' => (int)$_POST['desconto'],
                            'descricao_tecido' => $_POST['descricao_tecido'],
                            'descricao_produto' => $_POST['descricao_produto'],
                            'created' => $_POST['created'],
                            'modified' => $_POST['modified']
                        ])
                        ->execute();

                    $query = $produtos
                                ->find()
                                ->order(['id' => 'DESC'])
                                ->limit(1);

                    $results = $query->toArray();
                    $this->Flash->success(__('O produto foi salvo com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }else{
                    $this->Flash->error(__('O produto não foi salvo, por favor, tente novamente!'));
                }
            }else{
                if(isset($_POST['name'])){
                $produtos = TableRegistry::getTableLocator()->get('Produtos');
                $query = $produtos->query();
                $query->insert(['name', 'codigo_barra', 'categorias_produto_id', 'fornecedore_id', 'cor', 'tecido', 'estoque', 'tamanho', 'custo_bruto', 'porcentagem', 'preco', 'desconto', 'descricao_tecido', 'descricao_produto', 'created', 'modified'])
                    ->values([
                        'name' => $_POST['name'],
                        'categorias_produto_id' => (int)($_POST['categorias_produto_id']),
                        'codigo_barra' => $_POST['codigo_barra'],
                        'fornecedore_id' => (int) $_POST['fornecedore_id'],
                        'cor' => $_POST['cor'],
                        'tecido' => $_POST['tecido'],
                        'estoque' => (int)$_POST['estoque'],
                        'tamanho' => $_POST['tamanho'],
                        'custo_bruto' => floatval($_POST['custo_bruto']),
                        'porcentagem' => (int)$_POST['porcentagem'],
                        'preco' => (floatval($_POST['preco2']) > 0) ? floatval($_POST['preco2']) : floatval($_POST['preco']),
                        'desconto' => (int)$_POST['desconto2'],
                        'descricao_tecido' => $_POST['descricao_tecido'],
                        'descricao_produto' => $_POST['descricao_produto'],
                        'created' => $_POST['created'],
                        'modified' => $_POST['modified']
                    ])
                    ->execute();

                $query = $produtos
                            ->find()
                            ->order(['id' => 'DESC'])
                            ->limit(1);

                $results = $query->toArray();
                $this->Flash->success(__('O produto foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
                }else{
                    $this->Flash->error(__('O produto não foi salvo, por favor, tente novamente!'));
                }
            }
        }

        $categoriasProdutos = $this->Produtos->CategoriasProdutos->find('list', ['limit' => 200]);
        $fornecedores = $this->Produtos->Fornecedores->find('list', ['limit' => 200]);
        $this->set(compact('produto', 'categoriasProdutos', 'fornecedores'));
    }

    public function edit($id = null)
    {
        unset($_SESSION['prodPorcentagem']);
        unset($_SESSION['prodDesconto']);
        unset($_SESSION['prodPreco']);
        unset($_SESSION['prodForn']);

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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
        $produtos = TableRegistry::getTableLocator()->get('Produtos');
        $query = $produtos
                ->find()
                ->where([
                    'id' => $id
            ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $_SESSION['prodPorcentagem'] = $results[0]['porcentagem'];
            if($results[0]['porcentagem'] != 0){
                $_SESSION['porcentagemRadio'] = 1;
            }else{
                $_SESSION['porcentagemRadio'] = 2;                
            }
            $_SESSION['prodDesconto'] = $results[0]['desconto'];
            $_SESSION['prodPreco'] = $results[0]['preco'];
            $_SESSION['prodForn'] = $results[0]['fornecedore_id'];
        }
        $produto = $this->Produtos->get($id, [
            'contain' => []
        ]);
        $_SESSION['idEditadoProd'] = $id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if($role == 'gerente'){
                if(isset($_POST['desconto']) && $_POST['porcentagemRadio'] == 1){
                    //alterando estoque e salvando data da venda
                    $results[0]["name"] = $_POST['name']; 
                    $results[0]["codigo_barra"] = $_POST['codigo_barra']; 
                    $results[0]["categorias_produto_id"] = $_POST["categorias_produto_id"];
                    $results[0]["fornecedore_id"] = $_POST["fornecedore_id"];
                    $results[0]["cor"] = $_POST["cor"];
                    $results[0]["tecido"] = $_POST["tecido"];
                    $results[0]["tamanho"] = $_POST["tamanho"];
                    $results[0]["estoque"] = $_POST["estoque"];
                    $results[0]["custo_bruto"] = $_POST["custo_bruto"];
                    $results[0]["porcentagem"] = $_POST["porcentagem"];
                    $results[0]["preco"] = $_POST["preco"];
                    $results[0]["desconto"] = $_POST["desconto"];
                    $results[0]["descricao_tecido"] = $_POST["descricao_tecido"];
                    $results[0]["descricao_produto"] = $_POST["descricao_produto"];
                    $results[0]["modified"] = $_POST["modified"];
                    $results[0]["created"] = $_POST["created"];
                    $produtos->save($results[0]);
                    $this->Flash->success(__('O produto foi salvo com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }else{
                    //alterando estoque e salvando data da venda
                    $results[0]["name"] = $_POST['name']; 
                    $results[0]["codigo_barra"] = $_POST['codigo_barra']; 
                    $results[0]["categorias_produto_id"] = $_POST["categorias_produto_id"];
                    $results[0]["fornecedore_id"] = $_POST["fornecedore_id"];
                    $results[0]["cor"] = $_POST["cor"];
                    $results[0]["tecido"] = $_POST["tecido"];
                    $results[0]["tamanho"] = $_POST["tamanho"];
                    $results[0]["estoque"] = $_POST["estoque"];
                    $results[0]["custo_bruto"] = $_POST["custo_bruto"];
                    $results[0]["porcentagem"] = 00;
                    $results[0]["preco"] = $_POST["preco2"];
                    $results[0]["desconto"] = $_POST["desconto"];
                    $results[0]["descricao_tecido"] = $_POST["descricao_tecido"];
                    $results[0]["descricao_produto"] = $_POST["descricao_produto"];
                    $results[0]["modified"] = $_POST["modified"];
                    $results[0]["created"] = $_POST["created"];
                    $produtos->save($results[0]);
                    $this->Flash->success(__('O produto foi salvo com sucesso.'));
                    return $this->redirect(['action' => 'index']);

                } $this->Flash->error(__('O produto não foi salvo, por favor, tente novamente!'));
            }
            if($role == 'estoquista'){
                if(isset($_POST['desconto2']) && $_POST['porcentagemRadio'] == 1){
                    //alterando estoque e salvando data da venda
                    $results[0]["name"] = $_POST['name']; 
                    $results[0]["codigo_barra"] = $_POST['codigo_barra']; 
                    $results[0]["categorias_produto_id"] = $_POST["categorias_produto_id"];
                    $results[0]["fornecedore_id"] = $_POST["fornecedore_id"];
                    $results[0]["cor"] = $_POST["cor"];
                    $results[0]["tecido"] = $_POST["tecido"];
                    $results[0]["tamanho"] = $_POST["tamanho"];
                    $results[0]["estoque"] = $_POST["estoque"];
                    $results[0]["custo_bruto"] = $_POST["custo_bruto"];
                    $results[0]["porcentagem"] = $_POST["porcentagem"];
                    $results[0]["preco"] = $_POST["preco"];
                    $results[0]["desconto"] = $_POST["desconto2"];
                    $results[0]["descricao_tecido"] = $_POST["descricao_tecido"];
                    $results[0]["descricao_produto"] = $_POST["descricao_produto"];
                    $results[0]["modified"] = $_POST["modified"];
                    $results[0]["created"] = $_POST["created"];
                    $produtos->save($results[0]);
                    $this->Flash->success(__('O produto foi salvo com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }else{
                    //alterando estoque e salvando data da venda
                    $results[0]["name"] = $_POST['name']; 
                    $results[0]["codigo_barra"] = $_POST['codigo_barra']; 
                    $results[0]["categorias_produto_id"] = $_POST["categorias_produto_id"];
                    $results[0]["fornecedore_id"] = $_POST["fornecedore_id"];
                    $results[0]["cor"] = $_POST["cor"];
                    $results[0]["tecido"] = $_POST["tecido"];
                    $results[0]["tamanho"] = $_POST["tamanho"];
                    $results[0]["estoque"] = $_POST["estoque"];
                    $results[0]["custo_bruto"] = $_POST["custo_bruto"];
                    $results[0]["porcentagem"] = 00;
                    $results[0]["preco"] = $_POST["preco2"];
                    $results[0]["desconto"] = $_POST["desconto2"];
                    $results[0]["descricao_tecido"] = $_POST["descricao_tecido"];
                    $results[0]["descricao_produto"] = $_POST["descricao_produto"];
                    $results[0]["modified"] = $_POST["modified"];
                    $results[0]["created"] = $_POST["created"];
                    $produtos->save($results[0]);
                    $this->Flash->success(__('O produto foi salvo com sucesso.'));
                    return $this->redirect(['action' => 'index']);

                } $this->Flash->error(__('O produto não foi salvo, por favor, tente novamente!'));
            }
        }
        $categoriasProdutos = $this->Produtos->CategoriasProdutos->find('list', ['limit' => 200]);
        $fornecedores = $this->Produtos->Fornecedores->find('list', ['limit' => 200]);
        $this->set(compact('produto', 'categoriasProdutos', 'fornecedores'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
            
        $this->request->allowMethod(['post', 'delete']);
        $produto = $this->Produtos->get($id);
        if ($this->Produtos->deleteAll(['id' => $id])) {
            $this->Flash->success(__('O produto foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O produto não foi deletado, por favor, tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function desconto(){
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $this->paginate = [
            'contain' => ['CategoriasProdutos', 'Fornecedores'],
            'order' => array('Produtos.id' => 'Asc'),
            'limit' => 20
        ];
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));
    }

    public function addDesconto(){
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

            $this->paginate = [
        'contain' => ['CategoriasProdutos', 'Fornecedores']
        ];
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));
        
        //Salvando os produtos   
        if(isset($_POST['desconto'])){
            for($i=0; $i < count($_POST['desconto']); $i++){
                $produtos = TableRegistry::getTableLocator()->get('Produtos');
                $query = $produtos
                        ->find()
                        ->where([
                            'id' => (int) $_POST['id'][$i]
                    ]);
                $results = $query->toArray();
                if(isset($results[0])){
                    $desconto = $_POST['desconto'][$i]; 
                    $results[0]["desconto"] = $desconto; 
                    $produtos->save($results[0]);
                }
            } 
            $this->Flash->success(__('O produto foi editado com sucesso.'));
            return $this->redirect(['action' => 'desconto']);
        }
    } 

    public function estoque()
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $this->paginate = [
            'contain' => ['CategoriasProdutos', 'Fornecedores'],
            'order' => array('Produtos.id' => 'Asc'),
            'limit' => 20
        ];
        $produtos = $this->paginate($this->Produtos);
        $this->set(compact('produtos'));

        //Variável arquivo armazena o nome e extensão do arquivo.
        $arquivo = "D:/xampp/htdocs/projeto/src/Template/Produtos/configEstoque.txt";
        //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
        $fp = fopen($arquivo, "r");
        //Lê o conteúdo do arquivo aberto.
        $_SESSION['configEstoque'] = fread($fp, filesize($arquivo));
        //Fecha o arquivo.
        fclose($fp);
    }

    public function addEstoque(){
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

                if($role == "caixa"){   //nao permitir que caixa acesse
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

            $this->paginate = [
        'contain' => ['CategoriasProdutos', 'Fornecedores']
        ];
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));
        
        //Salvando os produtos   
        if(isset($_POST['estoque'])){
            for($i=0; $i < count($_POST['estoque']); $i++){
                $produtos = TableRegistry::getTableLocator()->get('Produtos');
                $query = $produtos
                        ->find()
                        ->where([
                            'id' => (int) $_POST['id'][$i]
                    ]);
                $results = $query->toArray();
                if(isset($results[0])){
                    $results[0]["estoque"] = $_POST['estoque'][$i];  
                    $produtos->save($results[0]);
                }
            } 
            $this->Flash->success(__('Os estoques foram editado com sucesso.'));
            return $this->redirect(['action' => 'estoque']);
        }
    } 

    public function configEstoque(){
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

            if($role == "caixa"){   //nao permitir que caixa acesse
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

            $this->paginate = [
        'contain' => ['CategoriasProdutos', 'Fornecedores']
        ];
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));
        
        //Salvando os produtos   
        if(isset($_POST['estoque'])){
            //Variável arquivo armazena o nome e extensão do arquivo.    
            $arquivo = fopen('D:\xampp\htdocs\projeto\src\Template\Produtos\configEstoque.txt','w+');
            //Escreve no arquivo aberto.
            $texto = $_POST['estoque'];
            fwrite($arquivo, $texto);    
            //Fecha o arquivo.
            fclose($arquivo);
            $this->Flash->success(__('Configuração de estoque foi salva com sucesso.'));
            return $this->redirect(['action' => 'index']);
        }
    } 
}