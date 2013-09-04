<?php

/*

Classes for database interaction

*/

class DB 
{

	private $host;
	private $username;
	private $password;
	private $database;

	public function  __construct() 
	{

		$this->host 	= 'localhost';
		$this->username = 'username';
		$this->password = 'password';
		$this->database = 'the_database';

	    $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
	
	    if (mysqli_connect_errno()) {
	    		error_log("DB connection failed: " . mysqli_connect_error());
	    		exit();
	    }
	}


	/**
	 * INSERT a new record into a given table.
	 * Fields are given in a key => value syntax via a field array.
	 * e.g.: To set column named JIM to 3 then you would pass an array that
	 * looked like this:
	 * Array("`Jim`" => "3");
	 *
	 * @param string $table
	 * @param array $fields
	 * @return int
	 */
	public function write($table, $data) 
	{
		# syntax: $table name, $fields - an array with keys as fields and values as field data
	    foreach($data as $key => $value)
	    {
	        $data[$key] = $this->mysqli->real_escape_string($value);
	    }
			
	    $fields = implode(',' , array_keys($data));
	    $values = "'" . implode("','" , array_values($data)) . "'";
	    $q = "INSERT INTO {$table} ($fields) VALUES ($values)";
		if (!$this->mysqli->query($q)) error_log("Error: " . $this->mysqli->error);
		else return true;
	}


	public function __destruct()
	{
		$this->mysqli->close();
	}


}

?>