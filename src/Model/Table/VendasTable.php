<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vendas Model
 *
 * @property \App\Model\Table\ClientesTable|\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\CaixasTable|\Cake\ORM\Association\BelongsTo $Caixas
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsToMany $Produtos
 *
 * @method \App\Model\Entity\Venda get($primaryKey, $options = [])
 * @method \App\Model\Entity\Venda newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Venda[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Venda|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Venda saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Venda patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Venda[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Venda findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendasTable extends Table
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

        $this->setTable('vendas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'clientes_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Caixas', [
            'foreignKey' => 'caixas_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Produtos', [
            'foreignKey' => 'venda_id',
            'targetForeignKey' => 'produto_id',
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
            ->integer('total_produto')
            ->requirePresence('total_produto', 'create')
            ->allowEmptyString('total_produto', false);

        $validator
            ->scalar('total_venda')
            ->maxLength('total_venda', 255)
            ->requirePresence('total_venda', 'create')
            ->allowEmptyString('total_venda', false);

        $validator
            ->integer('total_pagamentos')
            ->requirePresence('total_pagamentos', 'create')
            ->allowEmptyString('total_pagamentos', false);

        $validator
            ->boolean('venda_cancelada')
            ->requirePresence('venda_cancelada', 'create')
            ->allowEmptyString('venda_cancelada', false);

        $validator
            ->scalar('observacao_venda_cancelada')
            ->maxLength('observacao_venda_cancelada', 500)
            ->allowEmptyString('observacao_venda_cancelada');

        $validator
            ->scalar('data_cancelamento')
            ->maxLength('data_cancelamento', 20)
            ->allowEmptyString('data_cancelamento');

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
        $rules->add($rules->existsIn(['clientes_id'], 'Clientes'));
        $rules->add($rules->existsIn(['caixas_id'], 'Caixas'));

        return $rules;
    }
}
