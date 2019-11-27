<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $data_nasc_user
 * @property string $email
 * @property string $cpf_user
 * @property string $rg_user
 * @property string $telefone1_user
 * @property string|null $telefone2_user
 * @property string $endereco_user
 * @property string $numero_user
 * @property string $bairro_user
 * @property string $cidade
 * @property string $estado_user
 * @property string $password
 * @property string $role
 * @property string $created
 * @property string $modified
 */
class User extends Entity
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
        'username' => true,
        'data_nasc_user' => true,
        'email' => true,
        'cpf_user' => true,
        'rg_user' => true,
        'telefone1_user' => true,
        'telefone2_user' => true,
        'endereco_user' => true,
        'numero_user' => true,
        'bairro_user' => true,
        'cidade' => true,
        'estado_user' => true,
        'password' => true,
        'role' => true,
        'created' => true,
        'modified' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
