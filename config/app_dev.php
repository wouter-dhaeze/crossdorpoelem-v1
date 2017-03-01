<?php
return [
		
	'debug' => false,

    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            /**
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            'port' => '3307',
            'username' => 'root',
            'password' => '',
            'database' => 'cdo',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'log' => false,

            /**
             * Set identifier quoting to true if you are using reserved words or
             * special characters in your table or column names. Enabling this
             * setting will result in queries built using the Query Builder having
             * identifiers quoted when creating SQL. It should be noted that this
             * decreases performance because each query needs to be traversed and
             * manipulated before being executed.
             */
            'quoteIdentifiers' => false,

            /**
             * During development, if using MySQL < 5.6, uncommenting the
             * following line could boost the speed at which schema metadata is
             * fetched from the database. It can also be set directly with the
             * mysql configuration directive 'innodb_stats_on_metadata = 0'
             * which is the recommended value in production environments
             */
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ],
    ],
		
	'EmailTransport' => [
			'default' => [
					'className' => 'Smtp',
					//'className' => 'Mail',
					// The following keys are used in SMTP transports
					//'host' => 'ssl://send.one.com',
					'host' => 'ssl://smtp.gmail.com',
					'port' => 465,
					'timeout' => 30,
					//'username' => 'inschrijving@crossdorpoelem.be',
					//'password' => 'L8P3PmKd',
					'username' => 'vzwfeles@gmail.com',
					'password' => 'lYThBfZ8',
					'client' => null,
					'tls' => false,
			],
	],
];
