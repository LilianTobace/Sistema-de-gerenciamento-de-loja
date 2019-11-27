<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendasPagas Model
 *
 * @property \App\Model\Table\VendasTable|\Cake\ORM\Association\BelongsTo $Vendas
 * @property \App\Model\Table\PagamentosTable|\Cake\ORM\Association\BelongsTo $Pagamentos
 *
 * @method \App\Model\Entity\VendasPaga get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendasPaga newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendasPaga[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendasPaga|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendasPaga saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendasPaga patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendasPaga[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendasPaga findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendasPagasTable extends Table
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

        $this->setTable('vendas_pagas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Vendas', [
            'foreignKey' => 'vendas_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Pagamentos', [
            'foreignKey' => 'pagamentos_id',
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
            ->integer('parcelas')
            ->requirePresence('parcelas', 'create')
            ->allowEmptyString('parcelas', false);

        $validator
            ->numeric('valor_pago')
            ->requirePresence('valor_pago', 'create')
            ->allowEmptyString('valor_pago', false);

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
        $rules->add($rules->existsIn(['vendas_id'], 'Vendas'));
        $rules->add($rules->existsIn(['pagamentos_id'], 'Pagamentos'));

        return $rules;
    }
}
