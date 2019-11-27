<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fornecedores Model
 *
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\HasMany $Produtos
 *
 * @method \App\Model\Entity\Fornecedore get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fornecedore newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fornecedore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fornecedore|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fornecedore saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fornecedore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fornecedore[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fornecedore findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FornecedoresTable extends Table
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

        $this->setTable('fornecedores');
        $this->setDisplayField('nome_forn');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Produtos', [
            'foreignKey' => 'fornecedore_id'
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
            ->scalar('cnpj')
            ->maxLength('cnpj', 18)
            ->requirePresence('cnpj', 'create')
            ->allowEmptyString('cnpj', false);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->integer('telefone1_forn')
            ->requirePresence('telefone1_forn', 'create')
            ->allowEmptyString('telefone1_forn', false);

        $validator
            ->integer('telefone2_forn')
            ->allowEmptyString('telefone2_forn');

        $validator
            ->scalar('endereco_forn')
            ->maxLength('endereco_forn', 255)
            ->requirePresence('endereco_forn', 'create')
            ->allowEmptyString('endereco_forn', false);

        $validator
            ->scalar('numero_forn')
            ->maxLength('numero_forn', 5)
            ->requirePresence('numero_forn', 'create')
            ->allowEmptyString('numero_forn', false);

        $validator
            ->scalar('bairro_forn')
            ->maxLength('bairro_forn', 255)
            ->requirePresence('bairro_forn', 'create')
            ->allowEmptyString('bairro_forn', false);

        $validator
            ->scalar('cidade_forn')
            ->maxLength('cidade_forn', 255)
            ->requirePresence('cidade_forn', 'create')
            ->allowEmptyString('cidade_forn', false);

        $validator
            ->scalar('estado_forn')
            ->maxLength('estado_forn', 100)
            ->requirePresence('estado_forn', 'create')
            ->allowEmptyString('estado_forn', false);

        $validator
            ->integer('cep_forn')
            ->requirePresence('cep_forn', 'create')
            ->allowEmptyString('cep_forn', false);

        $validator
            ->scalar('comentario_forn')
            ->maxLength('comentario_forn', 400)
            ->allowEmptyString('comentario_forn');

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
