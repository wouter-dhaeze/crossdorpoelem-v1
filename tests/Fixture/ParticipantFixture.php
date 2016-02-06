<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParticipantFixture
 *
 */
class ParticipantFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'participant';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'gender' => ['type' => 'string', 'length' => 1, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'fname' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'lname' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'dob' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'number' => ['type' => 'string', 'length' => 4, 'null' => true, 'default' => '000', 'comment' => '', 'precision' => null, 'fixed' => null],
        'start_order' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'subscription_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'participants_ibfk_1' => ['type' => 'index', 'columns' => ['subscription_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'participants_ibfk_1' => ['type' => 'foreign', 'columns' => ['subscription_id'], 'references' => ['subscription', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'gender' => 'Lorem ipsum dolor sit ame',
            'fname' => 'Lorem ipsum dolor sit amet',
            'lname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'dob' => '2016-01-30 17:53:46',
            'number' => 'Lo',
            'start_order' => 1,
            'subscription_id' => 1
        ],
    ];
}
