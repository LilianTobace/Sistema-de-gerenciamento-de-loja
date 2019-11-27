<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function login()
    {

        $usuario = null;
        if(isset($_POST['username']) && isset($_POST['password'])){

            $username = addslashes($_POST['username']);
            $password = addslashes($_POST['password']);

            $user = TableRegistry::getTableLocator()->get('Users');
            $query = $user
                        ->find()
                        ->where([
                            'username' => $username,
                            'password' => $password
                        ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $name = $results[0]["name"];
                $idUsuario = $results[0]["id"];
                $this->Auth->setUser($results[0]);
                $_SESSION['usuarioLogado'] = $username;
                $_SESSION['nomeUsuario'] = $name;
                $_SESSION['idUsuarioLogado'] = $idUsuario;

                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        if($this->Auth->User){
            return $this->redirect($this->Auth->redirectUrl());
        }

        if(isset($_GET['logout'])){
            $this->Auth->logout();
        }
        $this->set('usuario', $usuario);
    }

    public function index()
    {
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
            'order' => array('Users.id' => 'Asc'),
            'limit' => 9
        );
        $this->paginate = $options;
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if($id != 1){
            $this->set('user', $user);
        }else{
            return $this->redirect(['action' => 'view2']);
        }

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
    }    

    public function view2($id = 1)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);

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
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $cpf = $_POST['cpf_user'];
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
                    $this->Flash->error(__('CPF inválido!'));
                    $cpfValido = 1;
                }
                if ($this->request->is('post')) {
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    if ($cpfValido == 0) {
                        if ($this->Users->save($user)){
                            $this->Flash->success(__('O cadastro foi salvo!'));
                            return $this->redirect(['action' => 'index']);
                        }
                    }
                }
            } 
        }
        $this->set(compact('user'));

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
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {   
        unset($_SESSION['userData']);
        unset($_SESSION['userEstado']);
        unset($_SESSION['userRole']);

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

        $users = TableRegistry::getTableLocator()->get('Users');
        $query = $users
                ->find()
                ->where([
                    'id' => $id
            ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $data = $results[0]['data_nasc_user'];
            $_SESSION['userData'] = date("Y-m-d", strtotime($data));
            $_SESSION['userEstado'] = $results[0]['estado_user'];
            $_SESSION['userRole'] = $results[0]['role'];
        }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $user = $this->Users->patchEntity($user, $this->request->getData());

        //salvando edição
        if($id != 1){
            if ($this->request->is(['patch', 'post', 'put'])) {
                $cpf = $_POST['cpf_user'];
                $cpfValido = 0;
                // Verifica se um número foi informado
                if(empty($cpf)) {
                    $this->Flash->error(__('CPF inválido'));
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
                        $this->Flash->error(__('CPF inválido!'));
                        $cpfValido = 1;
                    }
                    if ($this->Users->save($user) && $cpfValido == 0) {
                        $this->Flash->success(__('O cadastro foi salvo com sucesso.'));
                        return $this->redirect(['action' => 'index']);
                    } $this->Flash->error(__('O cadastro não foi salvo, por favor, tente novamente!'));
                }
            }
            $this->set(compact('user'));
        }else{
            return $this->redirect(['action' => 'edit2']);
        }   
    } 

    public function edit2($id = 1)
    {
        unset($_SESSION['userData']);
        unset($_SESSION['userEstado']);
        unset($_SESSION['userRole']);
        
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

        $users = TableRegistry::getTableLocator()->get('Users');
        $query = $users
                ->find()
                ->where([
                    'id' => $id
            ]);
        $results = $query->toArray();
        if(isset($results[0])){
            $data = $results[0]['data_nasc_user'];
            $_SESSION['userData'] = date("Y-m-d", strtotime($data));
            $_SESSION['userEstado'] = $results[0]['estado_user'];
            $_SESSION['userRole'] = $results[0]['role'];
        }
        
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cpf = $_POST['cpf_user'];
            $cpfValido = 0;
            // Verifica se um número foi informado
            if(empty($cpf)) {
                $this->Flash->error(__('CPF inválido'));
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
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user) && $cpfValido == 0) {
                    $this->Flash->success(__('O cadastro foi salvo com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                } $this->Flash->error(__('O cadastro não foi salvo, por favor, tente novamente!'));
            }
        }
        $this->set(compact('user'));   
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('O cadastro do funcionário foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O cadastro do funcionário não foi deletado, tente novamente'));
        }

        return $this->redirect(['action' => 'index']);

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
    }
}
