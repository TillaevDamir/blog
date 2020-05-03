<?php 

return [
	'host' => 'localhost',
	'dbname' => 'kg',
	'user' => 'root',
	'pass' => 'fabulous',
	'opt' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			],
];