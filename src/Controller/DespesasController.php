<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Despesas Controller
 *
 * @property \App\Model\Table\DespesasTable $Despesas
 *
 * @method \App\Model\Entity\Despesa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DespesasController extends AppController
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

            if($role != "gerente"){   //nao permitir que outros usuarios acessam
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $options = array(
            'order' => array('Despesas.id' => 'Asc'),
            'limit' => 9
        );
        $this->paginate = $options;
        $despesas = $this->paginate($this->Despesas);
        $this->set(compact('despesas'));
    }

    /**
     * View method
     *
     * @param string|null $id Despesa id.
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

            if($role != "gerente"){   //nao permitir que outros usuarios acessam
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $despesa = $this->Despesas->get($id, [
            'contain' => []
        ]);

        $this->set('despesa', $despesa);
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
            $id = $results[0]['id'];
            $role = $results[0]["role"];
            if($role != "gerente"){   //nao permitir que outros usuarios acessam
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $despesa = TableRegistry::get('despesas');
        $despesa = $despesa->find();
        $this->set(compact('despesa'));     

        $despesasTipo = TableRegistry::get('despesasTipos');
        $despesasTipo = $despesasTipo->find();
        $this->set(compact('despesasTipo'));   

        if(isset($_POST['valor'])){
            $despesas = TableRegistry::getTableLocator()->get('Despesas');
            $query = $despesas->query();
            $query->insert(['valor', 'observacao', 'created', 'modified','despesas_tipo_id'])
                ->values([
                    'despesas_tipo_id' => (int) $_POST['despesas_tipo_id'],
                    'valor' => floatval($_POST['valor']),
                    'observacao' => $_POST['observacao'],
                    'created' => $_POST['created'],
                    'modified' => $_POST['modified']
                ])
                ->execute();

            $query = $despesas
                        ->find()
                        ->order(['id' => 'DESC'])
                        ->limit(1);

            $results = $query->toArray();
            $this->Flash->success(__('A despesa foi salva com sucesso.')); 
            return $this->redirect(['controller' => 'Despesas', 'action' => 'index']); 
        }        
        
        if(isset($_POST['tipo'])){
            $despesasTipos = TableRegistry::getTableLocator()->get('DespesasTipos');
            $query = $despesasTipos->query();
            $query->insert(['tipo', 'created'])
                ->values([
                    'tipo' => ($_POST['tipo']),
                    'created' => ($_POST['created'])
                ])
                ->execute();

            $query = $despesasTipos
                        ->find()
                        ->order(['id' => 'DESC'])
                        ->limit(1);

            $results = $query->toArray();
            $this->Flash->success(__('A nova descrição foi salva com sucesso.'));  
        }

    }    


    /**
     * Edit method
     *
     * @param string|null $id Despesa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        unset($_SESSION['despesaValor']);
        unset($_SESSION['despesaObs']);
        unset($_SESSION['despesaTipo']);

        //permissao de nivel de usuário
        $user = TableRegistry::getTableLocator()->get('Users');
        $query = $user
                ->find()
                ->where([
                        'username' => $_SESSION['usuarioLogado']
                ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $idUsers = $results[0]['id'];
            $role = $results[0]["role"];
            if($role != "gerente"){   //nao permitir que outros usuarios acessam
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $despesas = TableRegistry::getTableLocator()->get('Despesas');
        $query = $despesas
                ->find()
                ->where([
                    'id' => $id
            ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $_SESSION['despesaValor'] = $results[0]['valor'];
            $_SESSION['despesaObs'] = $results[0]['observacao'];
            $_SESSION['despesaTipo'] = $results[0]['despesas_tipo_id'];
        }

        $despesa = $this->Despesas->get($id, [
            'contain' => []
        ]);
        if (isset($_POST['despesas_tipo_id'])) {
            $despesas = TableRegistry::getTableLocator()->get('Despesas');
            $query = $despesas
                    ->find()
                    ->where([
                        'id' => $id
                ]);
                
            $results = $query->toArray();
            if(isset($results[0])){
                $results[0]["despesas_tipo_id"] = $_POST['despesas_tipo_id']; 
                $results[0]["users_id"] = $idUsers; 
                $results[0]["valor"] = $_POST["valor"];
                $results[0]["observacao"] = $_POST["observacao"];
                $results[0]["created"] = $_POST["created"];
                $results[0]["modified"] = $_POST["modified"];
                $despesas->save($results[0]);
                $this->Flash->success(__('A despesa foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } $this->Flash->error(__('A despesa não foi salva com sucesso, por favor, tente novamente!'));
        }
        $this->set(compact('despesa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Despesa id.
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

                if($role != "gerente"){   //nao permitir que outros usuarios acessam
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

        $this->request->allowMethod(['post', 'delete']);
        $despesa = $this->Despesas->get($id);
        if ($this->Despesas->delete($despesa)) {
            $this->Flash->success(__('A despesa foi deletada com sucesso.'));
        } else {
            $this->Flash->error(__('A despesa não pode ser deletada, por favor, tente novamente!'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
