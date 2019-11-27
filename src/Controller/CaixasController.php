<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Caixas Controller
 *
 * @property \App\Model\Table\CaixasTable $Caixas
 *
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index(){

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


        $_SESSION['usuarioLogado'];
        $usuarioLogado = $_SESSION['usuarioLogado'];
        
    
        $caixa = TableRegistry::getTableLocator()->get('Caixas');
        $query = $caixa
                    ->find()
                    ->where([
                        'estado_caixa' => true
                    ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $caixaAberto =  $results[0]['id'];
            $_SESSION['CaixaAtual'] = $caixaAberto;
            return $this->redirect(['controller' => 'Caixas', 'action' => 'fechar']);
        }else{      
            $this->paginate = [
                'contain' => ['Users']
            ];
            $caixas = $this->paginate($this->Caixas);
            $this->set(compact('caixas'));


            $caixa = $this->Caixas->newEntity();
            if ($this->request->is('post')) {
                $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
                if ($this->Caixas->save($caixa)) {
                    //pegar id do caixa que esta sendo aberto
                    $caixa = TableRegistry::getTableLocator()->get('Caixas');
                    $query = $caixa
                                ->find()
                                ->where([
                                    'estado_caixa' => true
                                ]);
                    $results = $query->toArray();
                    if(isset($results[0])){
                        $caixaNovo =  $results[0]['id'];
                        $_SESSION['CaixaAtual'] = $caixaNovo;
                        $this->Flash->success(__('Novo caixa foi aberto.'));           
                        return $this->redirect(['controller' => 'Vendas', 'action' => 'index']);
                    }
                }
                $this->Flash->error(__('O caixa não foi aberto, tente novamente.'));
            }    
        }
    }


    public function fechar(){
        //permissao de nivel de usuário
        $user = TableRegistry::getTableLocator()->get('Users');
        $query = $user
                    ->find()
                    ->where([
                            'username' => $_SESSION['usuarioLogado'],
                            'name' => $_SESSION['nomeUsuario']
                    ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $role = $results[0]["role"];
                if($role == "estoquista"){   //nao permitir que estoquista acesse
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

            //pegar dados do caixa que ainda esta aberto
            $caixa = TableRegistry::getTableLocator()->get('Caixas');
            $query = $caixa
                        ->find()
                        ->where([
                            'estado_caixa' => 1
                        ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $id = $results[0]["id"];
                $usuarioId = $results[0]["users_id"];
                $caixa = $this->Caixas->get($id, [
                    'contain' => []
                ]);

                //pegar users_id e ver o nome do usuario que abriu o caixa
                $user = TableRegistry::getTableLocator()->get('Users');
                $query = $user
                            ->find()
                            ->where([
                                'id' => $usuarioId
                            ]);
                $results = $query->toArray();
                if(isset($results[0])){
                    $nomeUsuarioCaixa = $results[0]["name"];
                    $_SESSION['nomeUsuarioCaixa'] = $nomeUsuarioCaixa;

                    //salvar caixa que será fechado
                    if ($this->request->is(['patch', 'post', 'put'])) {
                        $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
                        if ($this->Caixas->save($caixa)) {
                            unset($_SESSION['CaixaAtual']);
                            $this->Flash->success(__('O caixa foi fechado com sucesso'));
                            return $this->redirect(['controller' => 'Pagprincipal', 'action' => 'index']);
                        }
                        $this->Flash->error(__('O caixa não pode ser fechado, tente novamente.'));
                    }
                    $this->set(compact('caixa'));
                }
            }
    }


    /**
     * View method
     *
     * @param string|null $id Caixa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

/*
    public function view($id = null)
    {

        $caixa = $this->Caixas->get($id, [
            'contain' => []
        ]);

        $this->set('caixa', $caixa);
    }


    public function add()
    {
        $caixa = $this->Caixas->newEntity();
        if ($this->request->is('post')) {
            $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
            if ($this->Caixas->save($caixa)) {
                $this->Flash->success(__('The caixa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The caixa could not be saved. Please, try again.'));
        }
        $this->set(compact('caixa'));
    }

*/
    public function edit($id = null)
    {
        $caixa = $this->Caixas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
            if ($this->Caixas->save($caixa)) {
                $this->Flash->success(__('The caixa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The caixa could not be saved. Please, try again.'));
        }
        $this->set(compact('caixa'));
    }

/*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $caixa = $this->Caixas->get($id);
        if ($this->Caixas->delete($caixa)) {
            $this->Flash->success(__('The caixa has been deleted.'));
        } else {
            $this->Flash->error(__('The caixa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */
}
