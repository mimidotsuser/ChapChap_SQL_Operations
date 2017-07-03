<?php
/*
---------------------------------------------------------------------------------------------------------------------
|-------------------------------------------------------------------------------------------------------------------|
|      Swift SQL                                                                                                    |
|-------------------------------------------------------------------------------------------------------------------|
|            * Created by Kelvin Kamau (www.kelvinkamau.com)                                                                |
|            * Distributed under the Open Source License                                                            |
|            * For instructions on how to use this library, open the 'readme.md' file in the root directory         |
|-------------------------------------------------------------------------------------------------------------------|
---------------------------------------------------------------------------------------------------------------------
*/
/*-------------------------------------------------------------------------------------------------------------
	ABOUT
	- This file sets up the database connection
-------------------------------------------------------------------------------------------------------------*/
require_once "config.php";

class db_connect {
	
	private static $conn;
	
	/**
	 * function that initialize database connection
	 * @return mixed : database connection object if successful; or an error message
	 */
	public static function getConnection() {
		
		try {
			// connect to database
			self::setConn( new PDO( "mysql:host=" . db_server . ";dbname=" . db_name, db_user, db_password ) );
			
			// set the PDO error mode to exception
			self::getConn()->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
			return self::getConn();
		} catch ( PDOException $e ) {
			// return error message if connection failed
			die( "Sorry we're experiencing connection problems: " . $e->getMessage() );
		}
		
	}
	
	
	//getter and setter to connection variable ($conn)
	
	/**
	 * @return mixed
	 */
	private static function getConn() {
		return self::$conn;
	}
	
	/**
	 * @param mixed $conn
	 */
	private static function setConn( $conn ) {
		self::$conn = $conn;
	}
	
	public static function closeConn() {
		self::$conn = null;
	}
	
}

?>
