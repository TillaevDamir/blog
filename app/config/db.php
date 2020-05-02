<?php 

return [
	'host' => 'localhost',
	'dbname' => 'rrr',
	'user' => 'root',
	'pass' => 'fabulous',
	'opt' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_ASSOC => PDO::FETCH_ASSOC,
			];
];