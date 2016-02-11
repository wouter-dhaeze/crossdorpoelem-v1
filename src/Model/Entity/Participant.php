<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Participant Entity.
 *
 * @property int $id
 * @property string $gender
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property \Cake\I18n\Time $dob
 * @property string $number
 * @property int $start_order
 * @property int $subscription_id
 * @property \App\Model\Entity\Subscription $subscription
 */
class Participant extends Entity
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
