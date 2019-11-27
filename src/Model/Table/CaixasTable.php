<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Caixas Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Caixa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Caixa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Caixa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Caixa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Caixa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Caixa findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CaixasTable extends Table
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

        $this->setTable('caixas');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
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
            ->boolean('estado_caixa')
            ->requirePresence('estado_caixa', 'create')
            ->allowEmptyString('estado_caixa', false);

        $validator
            ->numeric('saldo_inicial')
            ->requirePresence('saldo_inicial', 'create')
            ->allowEmptyString('saldo_inicial', false);

        $validator
            ->scalar('hora_abertura')
            ->maxLength('hora_abertura', 20)
            ->requirePresence('hora_abertura', 'create')
            ->allowEmptyString('hora_abertura', false);

        $validator
            ->scalar('hora_fechamento')
            ->maxLength('hora_fechamento', 20)
            ->requirePresence('hora_fechamento', 'create')
            ->allowEmptyString('hora_fechamento', false);

        $validator
            ->numeric('saldo_final')
            ->requirePresence('saldo_final', 'create')
            ->allowEmptyString('saldo_final', false);

        $validator
            ->scalar('comentario_abertura')
            ->maxLength('comentario_abertura', 255)
            ->allowEmptyString('comentario_abertura');

        $validator
            ->scalar('comentario_fechamento')
            ->maxLength('comentario_fechamento', 255)
            ->allowEmptyString('comentario_fechamento');

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
        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }
}
