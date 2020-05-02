<?php 

namespace app\core;

use app\lib\DB;

abstract class Model
{
	protected $db;

	public function __construct()
	{
		$this->db = new DB;
	}
}