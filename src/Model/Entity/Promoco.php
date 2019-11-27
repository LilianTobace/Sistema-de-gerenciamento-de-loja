<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Promoco Entity
 *
 * @property int $id
 * @property int $categorias_produto_id
 * @property float $promocao
 * @property bool|null $status
 * @property string $data_inicio
 * @property string $data_final
 *
 * @property \App\Model\Entity\CategoriasProduto $categorias_produto
 */
class Promoco extends Entity
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
        'categorias_produto_id' => true,
        'promocao' => true,
        'status' => true,
        'data_inicio' => true,
        'data_final' => true,
        'categorias_produto' => true
    ];
}
