<?php

/*

Classes for database interaction

*/

class DB 
{

	/**
	 * Do we want to error_log() all SQL queries?
	 */
	const DEBUG_SQL_MODE = true;

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
	            printf("Connect failed: %s\n", mysqli_connect_error());
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
	    
	    //Final query	
	    $q = "INSERT INTO {$table} ($fields) VALUES ($values)";
		if (self::DEBUG_SQL_MODE == true) { error_log($q, E_NOTICE); }
	    return $this->mysqli->query($q);
	}


	public function __destruct()
	{
		$this->mysqli->close();
	}


}

?>