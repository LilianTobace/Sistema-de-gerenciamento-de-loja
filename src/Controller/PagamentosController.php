<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Pagamentos Controller
 *
 * @property \App\Model\Table\PagamentosTable $Pagamentos
 *
 * @method \App\Model\Entity\Pagamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagamentosController extends AppController
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
        $pagamentos = $this->paginate($this->Pagamentos);

        $this->set(compact('pagamentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Pagamento id.
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

                if($role == "estoquista"){   //nao permitir que estoquista acesse
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $pagamento = $this->Pagamentos->get($id, [
            'contain' => []
        ]);

        $this->set('pagamento', $pagamento);
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

                if($role == "estoquista"){   //nao permitir que estoquista acesse
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $pagamento = $this->Pagamentos->newEntity();
        if ($this->request->is('post')) {
            $pagamento = $this->Pagamentos->patchEntity($pagamento, $this->request->getData());
            if ($this->Pagamentos->save($pagamento)) {
                $this->Flash->success(__('The pagamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pagamento could not be saved. Please, try again.'));
        }
        $this->set(compact('pagamento'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pagamento id.
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

                if($role == "estoquista"){   //nao permitir que estoquista acesse
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $pagamento = $this->Pagamentos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pagamento = $this->Pagamentos->patchEntity($pagamento, $this->request->getData());
            if ($this->Pagamentos->save($pagamento)) {
                $this->Flash->success(__('The pagamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pagamento could not be saved. Please, try again.'));
        }
        $this->set(compact('pagamento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pagamento id.
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

                if($role == "estoquista"){   //nao permitir que estoquista acesse
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $this->request->allowMethod(['post', 'delete']);
        $pagamento = $this->Pagamentos->get($id);
        if ($this->Pagamentos->delete($pagamento)) {
            $this->Flash->success(__('The pagamento has been deleted.'));
        } else {
            $this->Flash->error(__('The pagamento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
