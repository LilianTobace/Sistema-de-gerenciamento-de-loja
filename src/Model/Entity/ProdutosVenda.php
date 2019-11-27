<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProdutosVenda Entity
 *
 * @property int $id
 * @property int $vendas_id
 * @property int $produtos_id
 * @property string $name
 * @property int $quantidade
 * @property float $preco
 * @property float $subtotal
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Produto $produto
 * @property \App\Model\Entity\Venda $venda
 */
class ProdutosVenda extends Entity
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
        'vendas_id' => true,
        'produtos_id' => true,
        'name' => true,
        'quantidade' => true,
        'preco' => true,
        'subtotal' => true,
        'created' => true,
        'modified' => true,
        'produto' => true,
        'venda' => true
    ];
}
