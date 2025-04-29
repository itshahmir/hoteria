<?php

$config = [
	'server_url' => 'http://sabeel-dev.tk/server.php',
	'sid' => 'almas',
	'key' => 'd23fca8ce340f929ebb32c4da9dc9e6c',
    'db' => [
        'dsn'      => 'mysql:dbname=hoteria;host=127.0.0.1;port=3306;charset=utf8',
        'user'     => 'root',
        'password' => '648',
    ],
	'table_list' => [
		['table' => 'checkin', 'type' => 'full',],
		['table' => 'checkout', 'type' => 'full',],

    ],
];

require 'sync.php';

Sync::client($config);
exit;