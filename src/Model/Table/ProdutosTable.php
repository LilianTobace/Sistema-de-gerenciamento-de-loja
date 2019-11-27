<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Produtos Model
 *
 * @property \App\Model\Table\CategoriasProdutosTable|\Cake\ORM\Association\BelongsTo $CategoriasProdutos
 * @property \App\Model\Table\FornecedoresTable|\Cake\ORM\Association\BelongsTo $Fornecedores
 * @property \App\Model\Table\VendasTable|\Cake\ORM\Association\BelongsToMany $Vendas
 *
 * @method \App\Model\Entity\Produto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Produto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Produto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Produto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Produto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Produto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Produto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Produto findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProdutosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('produtos');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CategoriasProdutos', [
            'foreignKey' => 'categorias_produto_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Fornecedores', [
            'foreignKey' => 'fornecedore_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Vendas', [
            'foreignKey' => 'produto_id',
            'targetForeignKey' => 'venda_id',
            'joinTable' => 'produtos_vendas'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('codigo_barra')
            ->maxLength('codigo_barra', 300)
            ->allowEmptyString('codigo_barra');

        $validator
            ->scalar('cor')
            ->maxLength('cor', 200)
            ->requirePresence('cor', 'create')
            ->allowEmptyString('cor', false);

        $validator
            ->scalar('tecido')
            ->maxLength('tecido', 255)
            ->requirePresence('tecido', 'create')
            ->allowEmptyString('tecido', false);

        $validator
            ->scalar('tamanho')
            ->maxLength('tamanho', 255)
            ->requirePresence('tamanho', 'create')
            ->allowEmptyString('tamanho', false);

        $validator
            ->integer('estoque')
            ->requirePresence('estoque', 'create')
            ->allowEmptyString('estoque', false);

        $validator
            ->numeric('custo_bruto')
            ->requirePresence('custo_bruto', 'create')
            ->allowEmptyString('custo_bruto', false);

        $validator
            ->integer('porcentagem')
            ->requirePresence('porcentagem', 'create')
            ->allowEmptyString('porcentagem', false);

        $validator
            ->numeric('preco')
            ->requirePresence('preco', 'create')
            ->allowEmptyString('preco', false);

        $validator
            ->numeric('desconto')
            ->requirePresence('desconto', 'create')
            ->allowEmptyString('desconto', false);

        $validator
            ->scalar('descricao_tecido')
            ->maxLength('descricao_tecido', 400)
            ->allowEmptyString('descricao_tecido');

        $validator
            ->scalar('descricao_produto')
            ->maxLength('descricao_produto', 400)
            ->allowEmptyString('descricao_produto');

        $validator
            ->scalar('data_venda')
            ->maxLength('data_venda', 255)
            ->allowEmptyString('data_venda');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['categorias_produto_id'], 'CategoriasProdutos'));
        $rules->add($rules->existsIn(['fornecedore_id'], 'Fornecedores'));

        return $rules;
    }
}
