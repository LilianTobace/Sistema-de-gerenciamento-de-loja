<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientes Model
 *
 * @method \App\Model\Entity\Cliente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cliente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cliente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cliente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientesTable extends Table
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

        $this->setTable('clientes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('data_nasc_cliente')
            ->maxLength('data_nasc_cliente', 10)
            ->requirePresence('data_nasc_cliente', 'create')
            ->allowEmptyString('data_nasc_cliente', false);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('cpf_cliente')
            ->maxLength('cpf_cliente', 11)
            ->requirePresence('cpf_cliente', 'create')
            ->allowEmptyString('cpf_cliente', false);

        $validator
            ->scalar('rg_cliente')
            ->maxLength('rg_cliente', 11)
            ->requirePresence('rg_cliente', 'create')
            ->allowEmptyString('rg_cliente', false);

        $validator
            ->scalar('telefone1_cliente')
            ->maxLength('telefone1_cliente', 15)
            ->requirePresence('telefone1_cliente', 'create')
            ->allowEmptyString('telefone1_cliente', false);

        $validator
            ->scalar('telefone2_cliente')
            ->maxLength('telefone2_cliente', 15)
            ->allowEmptyString('telefone2_cliente');

        $validator
            ->scalar('endereco_cliente')
            ->maxLength('endereco_cliente', 255)
            ->requirePresence('endereco_cliente', 'create')
            ->allowEmptyString('endereco_cliente', false);

        $validator
            ->scalar('numero_cliente')
            ->maxLength('numero_cliente', 5)
            ->requirePresence('numero_cliente', 'create')
            ->allowEmptyString('numero_cliente', false);

        $validator
            ->scalar('bairro_cliente')
            ->maxLength('bairro_cliente', 255)
            ->requirePresence('bairro_cliente', 'create')
            ->allowEmptyString('bairro_cliente', false);

        $validator
            ->scalar('cidade_cliente')
            ->maxLength('cidade_cliente', 255)
            ->requirePresence('cidade_cliente', 'create')
            ->allowEmptyString('cidade_cliente', false);

        $validator
            ->scalar('estado_cliente')
            ->maxLength('estado_cliente', 255)
            ->requirePresence('estado_cliente', 'create')
            ->allowEmptyString('estado_cliente', false);

        $validator
            ->scalar('cep_cliente')
            ->maxLength('cep_cliente', 9)
            ->requirePresence('cep_cliente', 'create')
            ->allowEmptyString('cep_cliente', false);

        $validator
            ->scalar('comentario_cliente')
            ->maxLength('comentario_cliente', 400)
            ->allowEmptyString('comentario_cliente');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
