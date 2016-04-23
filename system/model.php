<?php

class Model {

	private $connection;
	public $controller;

	public function __construct()
	{
		global $config;
		
		if (!empty($config['db_host']))
		{
			$this->connection = mysqli_connect($config['db_host'], $config['db_username'], $config['db_password']) or die('MySQL Error: '. mysql_error());
			mysqli_select_db($this->connection, $config['db_name']);
		}
	}

	public function configure($config) {
		foreach ( $config as $key => $value ) {
			$this->$key = $value;
		}
	}

	public function escapeString($string)
	{
		return mysqli_real_escape_string($this->connection, $string);
	}

	public function escapeArray($array)
	{
	    array_walk_recursive($array, create_function('&$v', '$v = mysql_real_escape_string($v);'));
		return $array;
	}
	
	public function to_bool($val)
	{
	    return !!$val;
	}
	
	public function to_date($val)
	{
	    return date('Y-m-d', $val);
	}
	
	public function to_time($val)
	{
	    return date('H:i:s', $val);
	}
	
	public function to_datetime($val)
	{
	    return date('Y-m-d H:i:s', $val);
	}
	
	public function query($qry)
	{
		$result = mysql_query($qry) or die('MySQL Error: '. mysql_error());
		$resultObjects = array();

		while($row = mysql_fetch_object($result)) $resultObjects[] = $row;

		return $resultObjects;
	}

	public function execute($qry)
	{
		$exec = mysql_query($qry) or die('MySQL Error: '. mysql_error());
		return $exec;
	}
    
}
?>
