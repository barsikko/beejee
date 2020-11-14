<?php 

namespace BeeJee\Core;

use BeeJee\Models\Config;

abstract class Model
{
	protected static $instance = null;
	private $_db;

	public function __construct()
	{
		try{
				$dsn = 'mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=UTF8'; 
				$this->_db = new \PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

				$this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			} catch (\PDOException $e){
				echo $e->getMessage();
			}
	}

	private function __clone()
	{

	}

	private function __wakeup()
	{

	}

	public static function getInstance()
	{

		return static::$instance ?? (static::$instance = new static());
	}

	public function query($sql) {
   		 return $this->_db->query($sql);
	}

	public function prepare($sql){
		return $this->_db->prepare($sql);
	}

}