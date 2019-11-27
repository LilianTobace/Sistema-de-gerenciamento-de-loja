<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class RelatoriosController extends AppController
{
    public function viewCaixa()
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

            if($role != "gerente"){   //nao permitir que outros usuários acessem
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        unset($_SESSION['listaFiltrada']);
        unset($_SESSION['dataInicio']);
        unset($_SESSION['dataFinal']);


        $caixa = TableRegistry::get('Caixas');
        $caixas = $caixa->find();
        $this->set(compact('caixas'));

        //filtragem
        if(isset($_POST['data_inicio']) && $_POST['data_final'] != false) {
            $caixas = TableRegistry::getTableLocator()->get('Caixas');
            $query = $caixas
                    ->find()
                     ->where([
                                'created >=' => $_POST['data_inicio'],
                                'modified <=' => $_POST['data_final']
                         ]);                            
            $results = $query->toArray();
            if(isset($results[0])){ 
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];

                //ID do caixa que é houve mais venda
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                            'caixas_id',
                            'sum' => $query->func()->sum('total_venda')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['idCaixa'] = $results[0]['caixas_id'];
                }
                //Contando a quantidade de vendas no caixa
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                        'caixas_id',
                        'count' => $query->func()->count('caixas_id')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['count' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['valorProduto'] = $results[0]['count'];   
                }     
                //caixa que é houve mais venda
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                            'caixas_id',
                            'sum' => $query->func()->sum('total_venda')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['maisVendas'] = $results[0]['sum'];
                }
            }                
        }

        if(isset($_POST['data_inicio']) && $_POST['data_final'] == false){
            $_POST['data_final'] = ("2020-01-01");
            $caixas = TableRegistry::getTableLocator()->get('Caixas');
            $query = $caixas
                    ->find()
                    ->where([
                                'created >=' => $_POST['data_inicio'],
                                'modified <=' => $_POST['data_final'] 
                            ]);                            
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];               
                //ID do caixa que é houve mais venda
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                            'caixas_id',
                            'sum' => $query->func()->sum('total_venda')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['idCaixa'] = $results[0]['caixas_id'];
                }
                //Contando a quantidade de vendas no caixa
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                        'caixas_id',
                        'count' => $query->func()->count('caixas_id')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['count' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['valorProduto'] = $results[0]['count'];   
                }     
                //caixa que é houve mais venda
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                            'caixas_id',
                            'sum' => $query->func()->sum('total_venda')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['maisVendas'] = $results[0]['sum'];
                }
            }                
        }
        
        if(isset($_POST['data_final']) && $_POST['data_inicio'] == false){
            $_POST['data_inicio'] = ("2019-07-01");
            $caixas = TableRegistry::getTableLocator()->get('Caixas');
            $query = $caixas
                    ->find()
                     ->where([
                                'created >=' => $_POST['data_inicio'],
                                'modified <=' => $_POST['data_final'] 
                         ]);              
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];               
                //ID do caixa que é houve mais venda
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                            'caixas_id',
                            'sum' => $query->func()->sum('total_venda')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['idCaixa'] = $results[0]['caixas_id'];
                }
                //Contando a quantidade de vendas no caixa
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                        'caixas_id',
                        'count' => $query->func()->count('caixas_id')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['count' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['valorProduto'] = $results[0]['count'];   
                }     
                //caixa que é houve mais venda
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                    ->select([
                            'caixas_id',
                            'sum' => $query->func()->sum('total_venda')
                    ])
                    ->where([
                            'created >=' => $_SESSION['dataInicio'], 
                            'created <=' => $_SESSION['dataFinal']
                    ])
                    ->group('caixas_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['maisVendas'] = $results[0]['sum'];
                }
            }                
        }
    }

    public function pdfCaixa(){
        //Gera o PDF
        $caixa = TableRegistry::get('Caixas');
        $caixas = $caixa->find();
        $this->set(compact('caixas'));
    }
    
    public function viewEstoque()
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

        unset($_SESSION['listaFiltrada']);
        unset($_SESSION['estoque_min']);
        unset($_SESSION['estoque_max']);
        $produto = TableRegistry::get('Produtos');
        $produtos = $produto->find();
        $this->set(compact('produtos'));
        
        //filtragem
        if(isset($_POST['estoque_min'])){
            $produtos = TableRegistry::getTableLocator()->get('Produtos');
            $query = $produtos->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('estoque', $_POST['estoque_min'], $_POST['estoque_max']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['estoque_min'] = $_POST['estoque_min'];
               $_SESSION['estoque_max'] = $_POST['estoque_max'];               
            }
        }else{
            unset($_SESSION['listaFiltrada']);
        }
    }

    public function pdfEstoque(){
        //Gera o PDF
        $produto = TableRegistry::get('Produtos');
        $produtos = $produto->find();
        $this->set(compact('produtos'));
    }

    public function viewVenda()
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        unset($_SESSION['listaFiltrada']);
        unset($_SESSION['data_inicio']);
        unset($_SESSION['data_final']);
        $venda = TableRegistry::get('Vendas');
        $vendas = $venda->find();
        $this->set(compact('vendas'));


        //filtragem
        if(isset($_POST['data_inicio']) && $_POST['data_final'] != null){ 
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
        }
        if(isset($_POST['data_inicio']) && $_POST['data_final'] == null){ 
            $_POST['data_final'] = ("2020-01-01");
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
        }
        if(isset($_POST['data_final']) && $_POST['data_inicio'] == null){ 
            $_POST['data_inicio'] = ("2019-07-01");
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
        }
    }

    public function pdfVenda(){
        //Gera o PDF
        $venda = TableRegistry::get('Vendas');
        $vendas = $venda->find();
        $this->set(compact('vendas'));
    }

    public function viewCliente()
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

        unset($_SESSION['listaFiltrada']);
        unset($_SESSION['dataInicio']);
        unset($_SESSION['dataFinal']);
        $venda = TableRegistry::get('Vendas');
        $vendas = $venda->find();
        $this->set(compact('vendas'));


        //filtragem
        // if(isset($_POST['estado'])){
        //     $clientes = TableRegistry::getTableLocator()->get('Clientes');
        //     $query = $clientes->find()
        //     ->where([
        //             'cidade_cliente' => $_POST['cidade']
        //         ]);                            
        //     $results = $query->toArray();
        //     if(isset($results[0])){
        //         $idDoCliente = $results[0]['id'];  

        //         $vendas = TableRegistry::getTableLocator()->get('Vendas');
        //         $query = $vendas->find()
        //         ->where([
        //             'clientes_id' => $idDoCliente
        //         ]);
                                    
        //         $results = $query->toArray();
        //         if(isset($results[0])){ 
        //             $_SESSION['idDoCliente'] = $results[0]['id'];  
        //         }
        //     }           

            if(isset($_POST['data_inicio']) && $_POST['data_final'] != null){ 
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                ->andWhere(function($exp, $q) {
                    return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
                });
                                
                $results = $query->toArray();
                if(isset($results[0])){
                   $_SESSION['listaFiltrada'] = $results;
                   $_SESSION['dataInicio'] = $_POST['data_inicio'];
                       $_SESSION['dataFinal'] = $_POST['data_final'];               
                }
            }
            if(isset($_POST['data_inicio']) && $_POST['data_final'] == null){ 
                $_POST['data_final'] = ("2020-01-01");
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                ->andWhere(function($exp, $q) {
                    return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
                });
                                
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['listaFiltrada'] = $results;
                    $_SESSION['dataInicio'] = $_POST['data_inicio'];
                    $_SESSION['dataFinal'] = $_POST['data_final'];               
                }
            }
            if(isset($_POST['data_final']) && $_POST['data_inicio'] == null){ 
                $_POST['data_inicio'] = ("2019-07-01");
                $vendas = TableRegistry::getTableLocator()->get('Vendas');
                $query = $vendas->find()
                ->andWhere(function($exp, $q) {
                    return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
                });
                                
                $results = $query->toArray();
                if(isset($results[0])){
                   $_SESSION['listaFiltrada'] = $results;
                   $_SESSION['dataInicio'] = $_POST['data_inicio'];
                   $_SESSION['dataFinal'] = $_POST['data_final'];               
                }
            }
        }
    //}

    public function pdfCliente(){
        //Gera o PDF
        $cliente = TableRegistry::get('Clientes');
        $clientes = $cliente->find();
        $this->set(compact('clientes'));
    }

    public function viewTicket()
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

        unset($_SESSION['listaFiltrada']);
        unset($_SESSION['dataInicio']);
        unset($_SESSION['dataFinal']);
        $venda = TableRegistry::get('Vendas');
        $vendas = $venda->find();
        $this->set(compact('vendas'));


        //filtragem             
        if(isset($_POST['data_inicio']) && $_POST['data_final'] != null){ 
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                            
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];               
            }

            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'sumGasto' => $query->func()->sum('total_venda')
                ])
                ->where([
                        'created >=' => $_SESSION['dataInicio'], 
                        'created <=' => $_SESSION['dataFinal']
                ])
                ->order(['sumGasto' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['totalGasto'] = $results[0]['sumGasto'];
            }  
        }
        if(isset($_POST['data_inicio']) && $_POST['data_final'] == null){ 
            $_POST['data_final'] = ("2020-01-01");
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                            
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'sumGasto' => $query->func()->sum('total_venda')
                ])
                ->where([
                        'created >=' => $_SESSION['dataInicio'], 
                        'created <=' => $_SESSION['dataFinal']
                ])
                ->order(['sumGasto' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['totalGasto'] = $results[0]['sumGasto'];
            }  
        }
        if(isset($_POST['data_final']) && $_POST['data_inicio'] == null){ 
            $_POST['data_inicio'] = ("2019-07-01");
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                            
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
            $vendas = TableRegistry::getTableLocator()->get('Vendas');
            $query = $vendas->find()
                ->select([
                        'sumGasto' => $query->func()->sum('total_venda')
                ])
                ->where([
                        'created >=' => $_SESSION['dataInicio'], 
                        'created <=' => $_SESSION['dataFinal']
                ])
                ->order(['sumGasto' => 'DESC']);
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['totalGasto'] = $results[0]['sumGasto'];
            }  
        }
    }

    public function pdfTicket(){
        //Gera o PDF
        $cliente = TableRegistry::get('Clientes');
        $clientes = $cliente->find();
        $this->set(compact('clientes'));
    }

    public function viewProduto()
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }

            }

        unset($_SESSION['listaFiltrada']);
        $produtosVenda = TableRegistry::get('produtosVendas');
        $produtosVendas = $produtosVenda->find();
        $this->set(compact('produtosVendas'));


        //filtragem
        if(isset($_POST['data_inicio']) && $_POST['data_final'] == true){
            $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
            $query = $produtosVendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                            
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];               

                //produto que é mais vendido
                $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                $query = $produtosVendas->find()
                    ->select([
                        'produtos_id',
                        'sum' => $query->func()->sum('quantidade')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->group('produtos_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['produtoVendido'] = $results[0]['produtos_id'];
                    $_SESSION['quantidadeProduto'] = $results[0]['sum'];
                }
                $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                $query = $produtosVendas->find()
                    ->select([
                        'produtos_id',
                        'sum' => $query->func()->sum('subtotal')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->group('produtos_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['valorTotalProduto'] = $results[0]['sum'];
                }
            }
        }

        if(isset($_POST['data_inicio']) && $_POST['data_final'] == false){
            $_POST['data_final'] = ("2020-01-01");
            $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
            $query = $produtosVendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                            
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];    

                //produto que é mais vendido
                $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                $query = $produtosVendas->find()
                    ->select([
                        'produtos_id',
                        'sum' => $query->func()->sum('quantidade')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->group('produtos_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['produtoVendido'] = $results[0]['produtos_id'];
                    $_SESSION['quantidadeProduto'] = $results[0]['sum'];
                }
                $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                $query = $produtosVendas->find()
                    ->select([
                        'produtos_id',
                        'sum' => $query->func()->sum('subtotal')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->group('produtos_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['valorTotalProduto'] = $results[0]['sum'];
                }           
            }

        }

        if(isset($_POST['data_final']) && $_POST['data_inicio'] == false){ 
            $_POST['data_inicio'] = ("2019-07-01");
            $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
            $query = $produtosVendas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];        

                //produto que é mais vendido
                $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                $query = $produtosVendas->find()
                    ->select([
                        'produtos_id',
                        'sum' => $query->func()->sum('quantidade')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->group('produtos_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['produtoVendido'] = $results[0]['produtos_id'];
                    $_SESSION['quantidadeProduto'] = $results[0]['sum'];
                }
                $produtosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas');
                $query = $produtosVendas->find()
                    ->select([
                        'produtos_id',
                        'sum' => $query->func()->sum('subtotal')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->group('produtos_id')
                    ->order(['sum' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['valorTotalProduto'] = $results[0]['sum'];
                }       
            }
        }
    }

    public function pdfProduto(){
        //Gera o PDF
        $produtosVenda = TableRegistry::get('ProdutosVendas');
        $produtosVendas = $produtosVenda->find();
        $this->set(compact('produtosVendas'));
    }

    public function viewDespesa()
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }

            }

        unset($_SESSION['listaFiltrada']);
        $despesa = TableRegistry::get('despesas');
        $despesas = $despesa->find();
        $this->set(compact('despesas'));

        //filtragem
        if(isset($_POST['data_inicio']) && $_POST['data_final'] != false){
            $despesas = TableRegistry::getTableLocator()->get('Despesas');
            $query = $despesas->find()
                ->where([
                        'created >=' => $_POST['data_inicio'], 
                        'created <=' => $_POST['data_final']
                ]);
            $results = $query->toArray();
            if(isset($results[0])){  
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];

                $despesas = TableRegistry::getTableLocator()->get('Despesas');
                $query = $despesas->find()
                    ->select([
                        'sumValor' => $query->func()->sum('valor')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->order(['sumValor' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['sumValor'] = $results[0]['sumValor'];
                }                

                $despesas = TableRegistry::getTableLocator()->get('Despesas');
                $query = $despesas->find()
                    ->select([
                        'counTipo' => $query->func()->count('despesas_tipo_id'),
                        'sumValor' => $query->func()->sum('valor')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->order(['sumValor' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['sumValor'] = $results[0]['sumValor'];
                    $_SESSION['countTipo'] = $results[0]['counTipo'];
                }
            }
        }

        if(isset($_POST['data_inicio']) && $_POST['data_final'] == false){
            $_POST['data_final'] = ("2020-01-01");
            $despesas = TableRegistry::getTableLocator()->get('Despesas');
            $query = $despesas->find()
                ->where([
                        'created >=' => $_POST['data_inicio'], 
                        'created <=' => $_POST['data_final']
                ]);
            $results = $query->toArray();
            if(isset($results[0])){  
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];

                $despesas = TableRegistry::getTableLocator()->get('Despesas');
                $query = $despesas->find()
                    ->select([
                        'sumValor' => $query->func()->sum('valor')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->order(['sumValor' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['sumValor'] = $results[0]['sumValor'];
                }                

                $despesas = TableRegistry::getTableLocator()->get('Despesas');
                $query = $despesas->find()
                    ->select([
                        'counTipo' => $query->func()->count('despesas_tipo_id'),
                        'sumValor' => $query->func()->sum('valor')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->order(['sumValor' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['sumValor'] = $results[0]['sumValor'];
                    $_SESSION['countTipo'] = $results[0]['counTipo'];
                }
            }
        }

        if(isset($_POST['data_final']) && $_POST['data_inicio'] == false){ 
            $_POST['data_inicio'] = ("2019-07-01");
            $despesas = TableRegistry::getTableLocator()->get('Despesas');
            $query = $despesas->find()
                ->where([
                        'created >=' => $_POST['data_inicio'], 
                        'created <=' => $_POST['data_final']
                ]);
            $results = $query->toArray();
            if(isset($results[0])){  
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];

                $despesas = TableRegistry::getTableLocator()->get('Despesas');
                $query = $despesas->find()
                    ->select([
                        'sumValor' => $query->func()->sum('valor')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->order(['sumValor' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['sumValor'] = $results[0]['sumValor'];
                }                

                $despesas = TableRegistry::getTableLocator()->get('Despesas');
                $query = $despesas->find()
                    ->select([
                        'counTipo' => $query->func()->count('despesas_tipo_id'),
                        'sumValor' => $query->func()->sum('valor')
                    ])
                    ->where([
                            'created >=' => $_POST['data_inicio'], 
                            'created <=' => $_POST['data_final']
                    ])
                    ->order(['sumValor' => 'DESC']);
                $results = $query->toArray();
                if(isset($results[0])){
                    $_SESSION['sumValor'] = $results[0]['sumValor'];
                    $_SESSION['countTipo'] = $results[0]['counTipo'];
                }
            }
        }
    }

    public function pdfDespesas(){
        //Gera o PDF
        $despesa = TableRegistry::get('despesas');
        $despesas = $despesa->find();
        $this->set(compact('despesas'));
    }


    public function graficoVenda(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $venda = TableRegistry::get('Vendas');
        $vendas = $venda->find();
        $this->set(compact('vendas'));
    }
       

    public function graficoCaixa(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $caixa = TableRegistry::get('Caixas');
        $caixas = $caixa->find();
        $this->set(compact('caixas'));
    }

    public function graficoEstoque(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $produto = TableRegistry::get('Produtos');
        $produtos = $produto->find();
        $this->set(compact('produtos'));
    }    

    public function graficoCliente(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $cliente = TableRegistry::get('Clientes');
        $clientes = $cliente->find();
        $this->set(compact('clientes'));
    }    

    public function graficoProduto(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $produto = TableRegistry::get('Produtos');
        $produtos = $produto->find();
        $this->set(compact('produtos'));
    }    

    public function graficoTicket(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        $venda = TableRegistry::get('Vendas');
        $vendas = $venda->find();
        $this->set(compact('vendas'));
    }    

    public function graficoDespesa(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

        $despesa = TableRegistry::get('Despesas');
        $despesas = $despesa->find();
        $this->set(compact('despesas'));
    }

    public function viewPagamento()
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        unset($_SESSION['listaFiltrada']);
        unset($_SESSION['data_inicio']);
        unset($_SESSION['data_final']);
        $vendasPaga = TableRegistry::get('VendasPagas');
        $vendasPagas = $vendasPaga->find();
        $this->set(compact('vendasPagas'));


        //filtragem
        if(isset($_POST['data_inicio']) && $_POST['data_final'] != null){ 
            $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
            $query = $vendasPagas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
                $_SESSION['listaFiltrada'] = $results;
                $_SESSION['dataInicio'] = $_POST['data_inicio'];
                $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
        }
        if(isset($_POST['data_inicio']) && $_POST['data_final'] == null){ 
            $_POST['data_final'] = ("2020-01-01");
            $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
            $query = $vendasPagas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
        }
        if(isset($_POST['data_final']) && $_POST['data_inicio'] == null){ 
            $_POST['data_inicio'] = ("2019-07-01");
            $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
            $query = $vendasPagas->find()
            ->andWhere(function($exp, $q) {
                return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
            });
                        
            $results = $query->toArray();
            if(isset($results[0])){
                
               $_SESSION['listaFiltrada'] = $results;
               $_SESSION['dataInicio'] = $_POST['data_inicio'];
               $_SESSION['dataFinal'] = $_POST['data_final'];               
            }
        }
    }

    public function pdfPagamento(){
        //Gera o PDF
        $vendasPaga = TableRegistry::get('vendasPagas');
        $vendasPagas = $vendasPaga->find();
        $this->set(compact('vendasPagas'));
    }

    public function graficoPagamento(){
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

                if($role != "gerente"){   //nao permitir que outros usuários acessem
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }

        $vendasPaga = TableRegistry::get('VendasPagas');
        $vendasPagas = $vendasPaga->find();
        $this->set(compact('vendasPaga'));
    }
    
    // public function viewPromocao()
    // {
    //     //permissao de nivel de usuário
    //     $user = TableRegistry::getTableLocator()->get('Users');
    //     $query = $user
    //                 ->find()
    //                 ->where([
    //                         'username' => $_SESSION['usuarioLogado']
    //                 ]);
    //         $results = $query->toArray();
    //         if(isset($results[0])){
                
    //             $role = $results[0]["role"];

    //             if($role != "gerente"){   //nao permitir que outros usuários acessem
    //                 return $this->redirect($this->Auth->redirectUrl());
    //             }
    //         }
    //     unset($_SESSION['listaFiltrada']);
    //     unset($_SESSION['data_inicio']);
    //     unset($_SESSION['data_final']);
    //     $promocoes = TableRegistry::get('Promocoes');
    //     $promocoes = $promocoes->find();
    //     $this->set(compact('promocoes'));


    //     //filtragem
    //     if(isset($_POST['data_inicio']) && $_POST['data_final'] != null){ 
    //         $promocoes = TableRegistry::getTableLocator()->get('Promocoes');
    //         $query = $promocoes->find()
    //         ->andWhere(function($exp, $q) {
    //             return $exp->between('data_inicio', $_POST['data_inicio'], $_POST['data_final']);
    //         });
                        
    //         $results = $query->toArray();
    //         if(isset($results[0])){
    //             print_r($results);
    //             exit();
    //             $_SESSION['listaFiltrada'] = $results;
    //             $_SESSION['dataInicio'] = $_POST['data_inicio'];
    //             $_SESSION['dataFinal'] = $_POST['data_final'];               
    //         }
    //     }
    //     // if(isset($_POST['data_inicio']) && $_POST['data_final'] == null){ 
    //     //     $_POST['data_final'] = ("2020-01-01");
    //     //     $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
    //     //     $query = $vendasPagas->find()
    //     //     ->andWhere(function($exp, $q) {
    //     //         return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
    //     //     });
                        
    //     //     $results = $query->toArray();
    //     //     if(isset($results[0])){
    //     //         var_dump("foi2");
    //     //        $_SESSION['listaFiltrada'] = $results;
    //     //        $_SESSION['dataInicio'] = $_POST['data_inicio'];
    //     //        $_SESSION['dataFinal'] = $_POST['data_final'];               
    //     //     }
    //     // }
    //     // if(isset($_POST['data_final']) && $_POST['data_inicio'] == null){ 
    //     //     $_POST['data_inicio'] = ("2019-07-01");
    //     //     $vendasPagas = TableRegistry::getTableLocator()->get('VendasPagas');
    //     //     $query = $vendasPagas->find()
    //     //     ->andWhere(function($exp, $q) {
    //     //         return $exp->between('created', $_POST['data_inicio'], $_POST['data_final']);
    //     //     });
                        
    //     //     $results = $query->toArray();
    //     //     if(isset($results[0])){
                
    //     //        $_SESSION['listaFiltrada'] = $results;
    //     //        $_SESSION['dataInicio'] = $_POST['data_inicio'];
    //     //        $_SESSION['dataFinal'] = $_POST['data_final'];               
    //     //     }
    //     //}
    // }
    
}