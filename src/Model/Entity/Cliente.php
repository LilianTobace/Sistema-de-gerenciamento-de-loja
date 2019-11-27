<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $id
 * @property string $name
 * @property string $data_nasc_cliente
 * @property string $email
 * @property string $cpf_cliente
 * @property string $rg_cliente
 * @property string $telefone1_cliente
 * @property string|null $telefone2_cliente
 * @property string $endereco_cliente
 * @property string $numero_cliente
 * @property string $bairro_cliente
 * @property string $cidade_cliente
 * @property string $estado_cliente
 * @property string $cep_cliente
 * @property string|null $comentario_cliente
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Cliente extends Entity
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
        'data_nasc_cliente' => true,
        'email' => true,
        'cpf_cliente' => true,
        'rg_cliente' => true,
        'telefone1_cliente' => true,
        'telefone2_cliente' => true,
        'endereco_cliente' => true,
        'numero_cliente' => true,
        'bairro_cliente' => true,
        'cidade_cliente' => true,
        'estado_cliente' => true,
        'cep_cliente' => true,
        'comentario_cliente' => true,
        'created' => true,
        'modified' => true
    ];
}
