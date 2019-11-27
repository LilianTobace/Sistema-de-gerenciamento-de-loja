<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Clientes Controller
 *
 * @property \App\Model\Table\ClientesTable $Clientes
 *
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientesController extends AppController
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

        $options = array(
            'order' => array('Clientes.id' => 'Asc'),
            'limit' => 9
        );
        $this->paginate = $options;
        $clientes = $this->paginate($this->Clientes);
        $this->set(compact('clientes'));
    }
    
    public function addClienteNaVenda(){

        unset($_SESSION['selecionarCliente']);

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
        $clientes = $this->paginate($this->Clientes);
        $this->set(compact('clientes'));
    }


    public function selecionarCliente(){
        $id = $this->request->getData();
        $name = $this->request->getData();

        if ($id == null && $name == null) {
            //unset( $_SESSION['id_cart'] );  // irá remover apenas os dados de 'id_cart'
            return $this->redirect(['controller' => 'clientes', 'action' => 'addClienteNaVenda']);
        }else{

            unset($_SESSION['selecionarCliente']);
            $selecionarCliente = [];
            
            if(isset($_SESSION['selecionarCliente'])){
                $selecionarCliente = $_SESSION['selecionarCliente'];
            }

            for($i=0; $i < count($this->request->getData('id')); $i++){
                $selectCliente = [
                    "id" => $this->request->getData('id')[$i],
                    "name" => $this->request->getData('name')[$i]
                ];
                array_push($selecionarCliente, $selectCliente);
            }
            $_SESSION['selecionarCliente'] = $selecionarCliente;
            return $this->redirect(['controller' => 'vendas', 'action' => 'index']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Cliente id.
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


        $cliente = $this->Clientes->get($id, [
            'contain' => []
        ]);

        $this->set('cliente', $cliente);
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

        $cliente = $this->Clientes->newEntity();
        if ($this->request->is('post')) {
            $cpf = $_POST['cpf_cliente'];
            $cpfValido = 0;
            // Verifica se um número foi informado
            if(empty($cpf)) {
                $this->Flash->error(__('CPF inválido'));
                $cpfValido = 1;
            }
            // Elimina possivel mascara
            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
            // Verifica se o numero de digitos informados é igual a 11 
            if (strlen($cpf) != 11) {
                $this->Flash->error(__('CPF inválido'));
                $cpfValido = 1;
            }
            // Verifica se nenhuma das sequências invalidas abaixo 
            // foi digitada. Caso afirmativo, retorna falso
            else if ($cpf == '00000000000' || 
                $cpf == '11111111111' || 
                $cpf == '22222222222' || 
                $cpf == '33333333333' || 
                $cpf == '44444444444' || 
                $cpf == '55555555555' || 
                $cpf == '66666666666' || 
                $cpf == '77777777777' || 
                $cpf == '88888888888' || 
                $cpf == '99999999999') {
                $this->Flash->error(__('CPF inválido'));
                $cpfValido = 1;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
            }else{   
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf{$c} * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                } 
                if ($cpf{$c} != $d) {
                    $this->Flash->error(__('CPF inválido'));
                    $cpfValido = 1;
                }
                if ($this->request->is('post')) {
                    $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
                    if($cpfValido == 0){
                        if ($this->Clientes->save($cliente)) {
                            $this->Flash->success(__('O cadastro do cliente foi salvo com sucesso!'));
                            return $this->redirect(['action' => 'index']);
                        } 
                    }
                }
            }
        }  $this->set(compact('cliente'));
    }

    public function addCliente()
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

        $cliente = $this->Clientes->newEntity();
        if ($this->request->is('post')) {
            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
            if ($this->Clientes->save($cliente)) {
                $this->Flash->success(__('O cadastro do cliente foi salvo com sucesso!'));

                return $this->redirect(['action' => 'addClienteNaVenda']);
            }
            $this->Flash->error(__('O cadastro do cliente não foi salvo, por favor, tente novamente.'));
        }
        $this->set(compact('cliente'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        unset($_SESSION['clienteData']);
        unset($_SESSION['clienteEstado']);
        unset($_SESSION['clienteComentario']);
        unset($_SESSION['clienteCidade']);

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

        $clientes = TableRegistry::getTableLocator()->get('Clientes');
        $query = $clientes
                ->find()
                ->where([
                    'id' => $id
            ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $data = $results[0]['data_nasc_clientes'];
            $_SESSION['clienteData'] = date("Y-m-d", strtotime($data));
            $_SESSION['clienteEstado'] = $results[0]['estado_cliente'];
            $_SESSION['clienteComentario'] = $results[0]['comentario_cliente'];
            $_SESSION['clienteCidade'] = $results[0]['cidade_cliente'];
        }

        $cliente = $this->Clientes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cpf = $_POST['cpf_cliente'];
            $cpfValido = 0;
            // Verifica se um número foi informado
            if(empty($cpf)) {
                $this->Flash->error(__('CPF inválido'));
                $cpfValido = 1;
            }
            // Elimina possivel mascara
            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
            // Verifica se o numero de digitos informados é igual a 11 
            if (strlen($cpf) != 11) {
                $this->Flash->error(__('CPF inválido'));
                $cpfValido = 1;
            }
            // Verifica se nenhuma das sequências invalidas abaixo 
            // foi digitada. Caso afirmativo, retorna falso
            else if ($cpf == '00000000000' || 
                $cpf == '11111111111' || 
                $cpf == '22222222222' || 
                $cpf == '33333333333' || 
                $cpf == '44444444444' || 
                $cpf == '55555555555' || 
                $cpf == '66666666666' || 
                $cpf == '77777777777' || 
                $cpf == '88888888888' || 
                $cpf == '99999999999') {
                $this->Flash->error(__('CPF inválido'));
                $cpfValido = 1;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
            }else{   
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf{$c} * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                }  
                if ($cpf{$c} != $d) {
                    $this->Flash->error(__('CPF inválido'));
                    $cpfValido = 1;
                }
                if ($this->Clientes->save($cliente) && $cpfValido == 0) {
                    $this->Flash->success(__('O cadastro do cliente foi salvo com sucesso!'));
                    return $this->redirect(['action' => 'index']);
                } $this->Flash->error(__('O cadastro do cliente não foi salvo, por favor, tente novamente.'));
            }
        } $this->set(compact('cliente'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cliente id.
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
        $cliente = $this->Clientes->get($id);
        if ($this->Clientes->delete($cliente)) {
            $this->Flash->success(__('O cadastro do cliente foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O cadastro do cliente não foi deletado, por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
