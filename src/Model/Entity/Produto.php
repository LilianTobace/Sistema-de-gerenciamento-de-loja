<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Produto Entity
 *
 * @property int $id
 * @property string $name
 * @property int $categorias_produto_id
 * @property int $fornecedore_id
 * @property string $cor
 * @property string $tecido
 * @property string $tamanho
 * @property int $estoque
 * @property float $custo_bruto
 * @property int $porcentagem
 * @property float $preco
 * @property float $desconto
 * @property string|null $descricao_tecido
 * @property string|null $descricao_produto
 * @property string|null $data_venda
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CategoriasProduto $categorias_produto
 * @property \App\Model\Entity\Fornecedore $fornecedore
 * @property \App\Model\Entity\Venda[] $vendas
 */
class Produto extends Entity
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
        'name' => true,
        'categorias_produto_id' => true,
        'fornecedore_id' => true,
        'cor' => true,
        'tecido' => true,
        'tamanho' => true,
        'estoque' => true,
        'custo_bruto' => true,
        'porcentagem' => true,
        'preco' => true,
        'desconto' => true,
        'descricao_tecido' => true,
        'descricao_produto' => true,
        'data_venda' => true,
        'created' => true,
        'modified' => true,
        'categorias_produto' => true,
        'fornecedore' => true,
        'vendas' => true
    ];
}
