<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class PromocoesController extends AppController
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
        'contain' => ['CategoriasProdutos'],
        'order' => array('Promocoes.id' => 'Asc'),
        'limit' => 9
        ];

        $promocoes = $this->paginate($this->Promocoes);

        $this->set(compact('promocoes'));
        
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

        $promoco = $this->Promocoes->newEntity();
        $categoriasProdutos = $this->Promocoes->CategoriasProdutos->find('list', ['limit' => 200]);
        $this->set(compact('promoco', 'categoriasProdutos'));

        if ($this->request->is('post')) {
            if(isset($_POST['categorias_produto_id'])){
                if(isset($_POST['status'])){
                    $_POST['status'] = 1;
                }else{
                    $_POST['status'] = 0;
                }
                $dataInicial = str_replace('/', '-', $_POST['data_inicio'] );
                $dataInicial = date("Y-m-d", strtotime($dataInicial));

                $dataFinal = str_replace('/', '-', $_POST['data_final'] );
                $dataFinal = date("Y-m-d", strtotime($dataFinal));
                $promocoes = TableRegistry::getTableLocator()->get('Promocoes');
                $query = $promocoes->query();
                $query->insert(['status', 'categorias_produto_id', 'promocao', 'data_inicio', 'data_final', 'created', 'modified'])
                    ->values([
                        'status' => (int) $_POST['status'],
                        'categorias_produto_id' => (int) ($_POST['categorias_produto_id']),
                        'promocao' => (int) $_POST['promocao'],
                        'data_inicio' => $dataInicial,
                        'data_final' => $dataFinal,
                        'created' => $_POST['created'],
                        'modified' => $_POST['modified']
                    ])
                    ->execute();

                $query = $promocoes
                            ->find()
                            ->order(['id' => 'DESC'])
                            ->limit(1);

                $results = $query->toArray();

                $this->Flash->success(__('A promoção foi salva com sucesso!'));
                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('A promoção não foi salva, por favor, tente novamente.'));
            }
        }
    }


    /**
     * Edit method
     *
     * @param string|null $id Promoco id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
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

        $promoco = $this->Promocoes->get($id, [
            'contain' => []
        ]);

        $categoriasProdutos = $this->Promocoes->CategoriasProdutos->find('list', ['limit' => 200]);
        $this->set(compact('promoco', 'categoriasProdutos'));

        //Pegar os valores do banco
        $promocoes = TableRegistry::getTableLocator()->get('Promocoes');
        $query = $promocoes
                    ->find()
                    ->where([
                            'id' => $id
                    ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['status'] = $results[0]["status"];
                $_SESSION['dataInicialPromo'] = $results[0]["data_inicio"];
                $_SESSION['dataFinalPromo'] = $results[0]["data_final"];
            }

        if(isset($_POST['categorias_produto_id'])){
            $promocoes = TableRegistry::getTableLocator()->get('Promocoes');
            $query = $promocoes
                    ->find()
                    ->where([
                        'id' => $id
                ]);
            $results = $query->toArray();
            if(isset($results[0])){
                //alterando e salvando ediçao
                if(isset($_POST['status'])){
                    $_POST['status'] = 1;
                }else{
                    $_POST['status'] = 0;
                }
                $dataInicial = str_replace('/', '-', $_POST['data_inicio'] );
                $dataInicial = date("Y-m-d", strtotime($dataInicial));                
                $dataFinal = str_replace('/', '-', $_POST['data_final'] );
                $dataFinal = date("Y-m-d", strtotime($dataFinal));

                $results[0]["categorias_produto_id"] = $_POST['categorias_produto_id']; 
                $results[0]["promocao"] = $_POST['promocao']; 
                $results[0]["status"] = $_POST['status']; 
                $results[0]["data_inicio"] = $dataInicial; 
                $results[0]["data_final"] = $dataFinal; 
                $results[0]["created"] = $_POST['created']; 
                $results[0]["modified"] = $_POST['modified']; 
                $promocoes->save($results[0]);

                unset($_SESSION['status']);
                unset($_SESSION['dataInicialPromo']);
                unset($_SESSION['dataFinalPromo']);
                $this->Flash->success(__('A edição do registro da promoção foi salva com sucesso.'));
                return $this->redirect(['action' => 'index']);
            }
        } 
    }

    /**
     * Delete method
     *
     * @param string|null $id Promoco id.
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
        $promoco = $this->Promocoes->get($id);
        if ($this->Promocoes->delete($promoco)) {
            $this->Flash->success(__('O registro da promoção foi deletada com sucesso.'));
        } else {
            $this->Flash->error(__('O registro da promoção não foi deletada com sucesso, por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
