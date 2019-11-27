<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fornecedore Entity
 *
 * @property int $id
 * @property string $name
 * @property string $cnpj
 * @property string $email
 * @property int $telefone1_forn
 * @property int|null $telefone2_forn
 * @property string $endereco_forn
 * @property string $numero_forn
 * @property string $bairro_forn
 * @property string $cidade_forn
 * @property string $estado_forn
 * @property int $cep_forn
 * @property string|null $comentario_forn
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Produto[] $produtos
 */
class Fornecedore extends Entity
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
        'cnpj' => true,
        'email' => true,
        'telefone1_forn' => true,
        'telefone2_forn' => true,
        'endereco_forn' => true,
        'numero_forn' => true,
        'bairro_forn' => true,
        'cidade_forn' => true,
        'estado_forn' => true,
        'cep_forn' => true,
        'comentario_forn' => true,
        'created' => true,
        'modified' => true,
        'produtos' => true
    ];
}
