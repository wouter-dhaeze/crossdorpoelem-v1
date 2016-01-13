<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SponsorFixture
 *
 */
class SponsorFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sponsor';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'code1' => ['type' => 'string', 'length' => 6, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'code2' => ['type' => 'string', 'length' => 6, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'contact_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'name_UNIQUE' => ['type' => 'unique', 'columns' => ['name'], 'length' => []],
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
            'created' => '2016-01-13 11:07:58',
            'name' => 'Lorem ipsum dolor sit amet',
            'code1' => 'Lore',
            'code2' => 'Lore',
            'email' => 'Lorem ipsum dolor sit amet',
            'contact_name' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
