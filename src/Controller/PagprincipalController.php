<?php
 
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class PagprincipalController extends AppController
{
   
    public function index()
    {

        //verifica o ususario logado
        $user = TableRegistry::getTableLocator()->get('Users');
        $query = $user
                    ->find()
                    ->where([
                            'username' => $_SESSION['usuarioLogado']
                    ]);
            $results = $query->toArray();
            if(isset($results[0])){
                $role = $results[0]["role"];
                $name = $results[0]["name"];
                $_SESSION['nomeUsuario'] = $name;
                $this->set(compact('role'));
            }

        //verifica se há promoções que precisam ser desativados
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d");
        $promocoe = TableRegistry::getTableLocator()->get('Promocoes');
        $query = $promocoe
                ->find()
                ->where([
                        'status' => '1',
                        'data_final <' => $data
                ]);
        $results = $query->toArray();
        if(isset($results[0])){
            //alterando e salvando ediçao
            for ($i=0; $i < count($results); $i++) { 
                $results[$i]["status"] = 0; 
                $promocoe->save($results[$i]);
            }
        }

    	if($this->Auth->User() == false){
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
}

?>