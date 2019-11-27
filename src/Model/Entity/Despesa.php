<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Despesa Entity
 *
 * @property int $id
 * @property float $aluguel
 * @property float $agua
 * @property float $luz
 * @property float $funcionario
 * @property float $produto_limpeza
 * @property float $internet
 * @property float|null $outros
 * @property string|null $comentario
 * @property \Cake\I18n\FrozenDate $created
 * @property string $created_hora
 * @property \Cake\I18n\FrozenDate|null $modified
 * @property string|null $modified_hora
 */
class Despesa extends Entity
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
        'aluguel' => true,
        'agua' => true,
        'luz' => true,
        'funcionario' => true,
        'produto_limpeza' => true,
        'internet' => true,
        'outros' => true,
        'comentario' => true,
        'created' => true,
        'created_hora' => true,
        'modified' => true,
        'modified_hora' => true
    ];
}
