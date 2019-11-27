<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Promocoes Model
 *
 * @property \App\Model\Table\CategoriasProdutosTable|\Cake\ORM\Association\BelongsTo $CategoriasProdutos
 *
 * @method \App\Model\Entity\Promoco get($primaryKey, $options = [])
 * @method \App\Model\Entity\Promoco newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Promoco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Promoco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Promoco saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Promoco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Promoco[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Promoco findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PromocoesTable extends Table
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

        $this->setTable('promocoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CategoriasProdutos', [
            'foreignKey' => 'categorias_produto_id',
            'joinType' => 'INNER'
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
            ->numeric('promocao')
            ->requirePresence('promocao', 'create')
            ->allowEmptyString('promocao', false);

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->allowEmptyString('status', false);

        $validator
            ->scalar('data_inicio')
            ->maxLength('data_inicio', 20)
            ->requirePresence('data_inicio', 'create')
            ->allowEmptyString('data_inicio', false);

        $validator
            ->scalar('data_final')
            ->maxLength('data_final', 20)
            ->requirePresence('data_final', 'create')
            ->allowEmptyString('data_final', false);

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

        return $rules;
    }
}
