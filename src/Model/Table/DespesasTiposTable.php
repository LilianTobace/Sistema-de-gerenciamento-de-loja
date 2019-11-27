<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DespesasTipos Model
 *
 * @property \App\Model\Table\DespesasTable|\Cake\ORM\Association\HasMany $Despesas
 *
 * @method \App\Model\Entity\DespesasTipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\DespesasTipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DespesasTipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DespesasTipo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DespesasTipo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DespesasTipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DespesasTipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DespesasTipo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DespesasTiposTable extends Table
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

        $this->setTable('despesas_tipos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Despesas', [
            'foreignKey' => 'despesas_tipo_id'
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
            ->scalar('tipo')
            ->maxLength('tipo', 255)
            ->requirePresence('tipo', 'create')
            ->allowEmptyString('tipo', false);

        return $validator;
    }
}
