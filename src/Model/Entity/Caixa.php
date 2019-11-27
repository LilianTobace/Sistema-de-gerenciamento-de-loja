<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Caixa Entity
 *
 * @property int $id
 * @property bool $estado_caixa
 * @property int $users_id
 * @property float $saldo_inicial
 * @property string $hora_abertura
 * @property string $hora_fechamento
 * @property float $saldo_final
 * @property string|null $comentario_abertura
 * @property string|null $comentario_fechamento
 * @property \Cake\I18n\FrozenDate $created
 * @property \Cake\I18n\FrozenDate $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Caixa extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'estado_caixa' => true,
        'users_id' => true,
        'saldo_inicial' => true,
        'hora_abertura' => true,
        'hora_fechamento' => true,
        'saldo_final' => true,
        'comentario_abertura' => true,
        'comentario_fechamento' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
