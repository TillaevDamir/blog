<?php 

session_start();

function debug($str)
{
	echo "<pre>";
	var_dump($str);
	echo "</pre>";
	exit;
}