<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Fornecedores Controller
 *
 * @property \App\Model\Table\FornecedoresTable $Fornecedores
 *
 * @method \App\Model\Entity\Fornecedore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FornecedoresController extends AppController
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
        $options = array(
            'order' => array('Fornecedores.id' => 'Asc'),
            'limit' => 9
        );
        $this->paginate = $options;
        $fornecedores = $this->paginate($this->Fornecedores);
        $this->set(compact('fornecedores'));
    }

    /**
     * View method
     *
     * @param string|null $id Fornecedore id.
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
        $fornecedore = $this->Fornecedores->get($id, [
            'contain' => ['Produtos']
        ]);

        $this->set('fornecedore', $fornecedore);
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
        $fornecedore = $this->Fornecedores->newEntity();
        if ($this->request->is('post')) {
            $fornecedore = $this->Fornecedores->patchEntity($fornecedore, $this->request->getData());
            if ($this->Fornecedores->save($fornecedore)) {
                $this->Flash->success(__('O cadastro do fornecedor foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O cadastro do fornecedor não foi salvo, por favor, tente novamente.'));
        }
        $this->set(compact('fornecedore'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fornecedore id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        unset($_SESSION['fornEstado']);
        
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
        $fornecedores = TableRegistry::getTableLocator()->get('Fornecedores');
        $query = $fornecedores
                ->find()
                ->where([
                    'id' => $id
            ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $_SESSION['fornEstado'] = $results[0]['estado_forn'];
        }
        $fornecedore = $this->Fornecedores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fornecedore = $this->Fornecedores->patchEntity($fornecedore, $this->request->getData());
            if ($this->Fornecedores->save($fornecedore)) {
                $this->Flash->success(__('O cadastro do fornecedor foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O cadastro do fornecedor não foi salvo, por favor, tente novamente.'));
        }
        $this->set(compact('fornecedore'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fornecedore id.
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
        $fornecedore = $this->Fornecedores->get($id);
        if ($this->Fornecedores->delete($fornecedore)) {
            $this->Flash->success(__('O cadastro do forncedor foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O cadastro do fornecedor não foi deletado, por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
