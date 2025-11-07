<?php

return $config = [
	'db' => [
		'dsn' => 'mysql:host=localhost;dbname=app;charset=utf8mb4',
		'user' => 'root',
		'pass' => 'password',
		'options' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		],
	],
	'app' => [
		'default_controller' => 'Home',
		'default_action' => 'index',
	],
];