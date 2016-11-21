<?php

/*
 *
 * // acesso remoto
 * define("DB_HOSTI",""); // host
 * define("DB_USERNAMEI",""); // username
 * define("DB_PASSWORDI",""); // password
 * define("DB_DATABASEI",""); // db name
 */

// acesso local
define ( "DB_HOSTI", "localhost" ); // host
define ( "DB_USERNAMEI", "root" ); // username
define ( "DB_PASSWORDI", "" ); // password
define ( "DB_DATABASEI", "ictafast" ); // db name
class DB {
	private $dbi;
	private $query;
	function __construct() {
		$this->dbi;
		$this->query;
	}
	function __destruct() {
		$this->dbi;
		$this->query;
	}
	
	// starts MYSQL
	function open() {
		$this->dbi = new PDO ( 'mysql:host=' . DB_HOSTI . ';dbname=' . DB_DATABASEI . ';charset=utf8mb4', DB_USERNAMEI, DB_PASSWORDI );
		$this->dbi->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$this->dbi->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
	}
	
	// close connection
	function close() {
		$this->dbi = NULL;
	}
	
	// executes a SQL string
	function query($sql) {
		try {
			// connect as appropriate as above
			$this->dbi->query ( $sql );
		} catch ( PDOException $ex ) {
			// var_dump($ex);
		}
	}
	function trquery($sql1, $sql2) {
		$this->dbi->beginTransaction ();
		try {
			$this->dbi->query ( $sql1 );
			
			$lastid = $this->dbi->lastInsertId ();
			// var_dump($lastid);
			// var_dump($sql2);
			$sql2 = str_replace ( 'LASTID', $lastid, $sql2 );
			// var_dump($sql2);
			
			$this->dbi->query ( $sql2 );
			$this->dbi->commit ();
		} catch ( PDOException $ex ) {
			// var_dump($ex);
		}
	}
	function fetchData($sql) {
		$stmt = $this->dbi->query ( $sql );
		$results = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		return $results;
	}
}

?>