<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubscriptionFixture
 *
 */
class SubscriptionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'subscription';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'code' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'wave' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => 'ADULT', 'comment' => '', 'precision' => null, 'fixed' => null],
        'payed' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'code_UNIQUE' => ['type' => 'unique', 'columns' => ['code'], 'length' => []],
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
            'created' => '2016-01-13 20:52:43',
            'code' => 'Lorem ',
            'wave' => 'Lorem ipsum dolor sit amet',
            'payed' => 1
        ],
    ];
}
