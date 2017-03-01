<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Member Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $created
 * @property string $fname
 * @property string $lname
 * @property string $gender
 * @property \Cake\I18n\Time $dob
 * @property string $email
 * @property string $pcode
 * @property string $code
 * @property bool $subscriber
 * @property bool $participant
 * @property bool $validated
 * @property bool $consent
 * @property bool $public_profile
 * @property bool $sponsor
 * @property string $number
 * @property string $wave
 * @property int $subscription_id
 * @property \App\Model\Entity\Subscription $subscription
 */
class Member extends Entity
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
