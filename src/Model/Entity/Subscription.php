<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $created
 * @property int $price
 * @property bool $validated
 * @property bool $payed
 * @property string $code
 * @property \App\Model\Entity\Member[] $member
 */
class Subscription extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
