<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VendasPaga Entity
 *
 * @property int $id
 * @property int $vendas_id
 * @property int $pagamentos_id
 * @property int $parcelas
 * @property float $valor_pago
 *
 * @property \App\Model\Entity\Venda $venda
 * @property \App\Model\Entity\Pagamento $pagamento
 */
class VendasPaga extends Entity
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
        'pagamentos_id' => true,
        'parcelas' => true,
        'valor_pago' => true,
        'venda' => true,
        'pagamento' => true
    ];
}
