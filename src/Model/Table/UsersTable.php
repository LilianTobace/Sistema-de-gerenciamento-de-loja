<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
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
            ->scalar('username')
            ->maxLength('username', 20)
            ->requirePresence('username', 'create')
            ->allowEmptyString('username', false);

        $validator
            ->scalar('data_nasc_user')
            ->maxLength('data_nasc_user', 10)
            ->requirePresence('data_nasc_user', 'create')
            ->allowEmptyString('data_nasc_user', false);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('cpf_user')
            ->maxLength('cpf_user', 11)
            ->requirePresence('cpf_user', 'create')
            ->allowEmptyString('cpf_user', false);

        $validator
            ->scalar('rg_user')
            ->maxLength('rg_user', 11)
            ->requirePresence('rg_user', 'create')
            ->allowEmptyString('rg_user', false);

        $validator
            ->scalar('telefone1_user')
            ->maxLength('telefone1_user', 15)
            ->requirePresence('telefone1_user', 'create')
            ->allowEmptyString('telefone1_user', false);

        $validator
            ->scalar('telefone2_user')
            ->maxLength('telefone2_user', 15)
            ->allowEmptyString('telefone2_user');

        $validator
            ->scalar('endereco_user')
            ->maxLength('endereco_user', 255)
            ->requirePresence('endereco_user', 'create')
            ->allowEmptyString('endereco_user', false);

        $validator
            ->scalar('numero_user')
            ->maxLength('numero_user', 5)
            ->requirePresence('numero_user', 'create')
            ->allowEmptyString('numero_user', false);

        $validator
            ->scalar('bairro_user')
            ->maxLength('bairro_user', 255)
            ->requirePresence('bairro_user', 'create')
            ->allowEmptyString('bairro_user', false);

        $validator
            ->scalar('cidade')
            ->maxLength('cidade', 255)
            ->requirePresence('cidade', 'create')
            ->allowEmptyString('cidade', false);

        $validator
            ->scalar('estado_user')
            ->maxLength('estado_user', 255)
            ->requirePresence('estado_user', 'create')
            ->allowEmptyString('estado_user', false);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->scalar('role')
            ->maxLength('role', 20)
            ->requirePresence('role', 'create')
            ->allowEmptyString('role', false);

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
