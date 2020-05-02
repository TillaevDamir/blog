<?php 

use PDO;

class DB
{
	protected $db;

	public function __construct()
	{
		$config = require 'app/config/db.php';
		$this->db = new PDO("mysql: host=$this->config['host']; dbname=$this->config['dbname']", $this->config['user'], $this->config['pass'], $this->config['opt']);
	}

	public function query($sql, $params = [])
	{
		$stmt = $this->db->prepare($sql);
		if(!empty($params))
		{
			foreach($params as $k=>$val)
			{
				if(is_int($val))
				{
					$type = PDO::PARAM_INT;
				}
				else
				{
					$type = PDO::PARAM_STR;
				}
				$stmt = bindValue(':'.$key, $val, $type);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchAll();
	}

	public function column($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

	public function lastInsertId()
	{
		return $this->db->lastInsertId();
	}
}