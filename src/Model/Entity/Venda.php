<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Venda Entity
 *
 * @property int $id
 * @property int $clientes_id
 * @property int $caixas_id
 * @property int $parcelas
 * @property int $total_produto
 * @property string $total_venda
 * @property int $pagamentos_id
 * @property bool $venda_cancelada
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Pagamento $pagamento
 * @property \App\Model\Entity\Produto[] $produtos
 */
class Venda extends Entity
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
        'clientes_id' => true,
        'caixas_id' => true,
        'parcelas' => true,
        'total_produto' => true,
        'total_venda' => true,
        'pagamentos_id' => true,
        'venda_cancelada' => true,
        'created' => true,
        'cliente' => true,
        'pagamento' => true,
        'produtos' => true
    ];
}
