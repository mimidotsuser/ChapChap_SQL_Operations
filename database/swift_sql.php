<?php

/**
 * Swift SQL
 * Created by Kelvin Kamau
 *
 * Modified by https://github.com/mimidotsuser
 *
 * Distributed under the Open Source License
 * For instructions on how to use this library, open the 'readme.md' file in the root directory
 */

require_once "autoload.php";

/**
 * Class swift_sql
 */
class swift_sql {
	
	/**
	 * @var
	 */
	private static $dbConnection;
	
	/**
	 * swift_sql constructor.
	 */
	public function __construct() {
		$dbConnection = new db_connect();
		
	}
	
	
	/**
	 * Adds new column to an existing table
	 *
	 * @param $table_name :the name of the table
	 * @param $column_name :the name of the column to add
	 * @param $type :data type held by the column table
	 * @param int $length :the length of the values. Default is ten
	 */
	public static function alter( $table_name, $column_name, $type, $length = 10 ) {
		
		try {
			// use a prepared statement to add column to table
			$stmt = self::getConn()->prepare( "ALTER TABLE `{$table_name}` ADD `{$column_name}` {$type}{($length)}" );
			$stmt->execute();
		} catch ( PDOException $e ) {
			// return error if operation failed
			echo "Error: " . $e->getMessage();
		}
	}
	
	/**
	 * Selects one or multiple rows from a certain table matching a certain criteria
	 * Note:
	 *    - Use this function only when doing simple selects like "SELECT column_name WHERE id = 1"
	 *  - For advanced selections like "Right Join" or "LIKE", use the function after this i.e select2
	 *
	 * @param $table_name :name of the table to select the data from
	 * @param $select_data :array containing the data to be selected from the table
	 * @param $select_queries :array containing the criteria with which to select data from the table. Can be empty e.g when selecting an entire table
	 * @param string $order_column : used if the data should be returned in a specific order e.g "ORDER by column_name ($order_column). Default is null;
	 * @param string $order_query :
	 *
	 * @return array
	 */
	public static function select( $table_name, $select_data, $select_queries, $order_column = "", $order_query = "" ) {
		
		// initiliaze a 2D array with the name of 'data' which will hold the results of the query
		$data = [];
		// escape data to ensure it is safe/clean
		foreach ( $select_data as $key => $value ) {
			addslashes( $value );
		}
		foreach ( $select_queries as $key => $value ) {
			addslashes( $value );
		}
		// convert $select_data to a simple string for execution
		if ( strstr( $select_data[0], "(" ) ) {
			$select_data = implode( ", ", $select_data );
		} else {
			$select_data = "`" . implode( "`, `", $select_data ) . "`";
		}
		// convert $select_query to a simple string for execution
		if ( ! empty( $select_queries ) ) {
			foreach ( $select_queries as $fields => $dataX ) {
				$select_queries2[] = '`' . $fields . '` = \'' . $dataX . '\'';
			}
			
			$select_queries3 = implode( " && ", $select_queries2 );
			$select_query    = "WHERE {$select_queries3}";
		} else {
			$select_query = "";
		}
		// prints string if you need the data to be returned in a specific order e.g by column_name ascending
		if ( ! empty( $order_column ) ) {
			$order = "ORDER BY `{$order_column}` {$order_query}";
		} else {
			$order = "";
		}
		try {
			// use a prepared statement to select the data from the table
			$stmt = self::getConn()->prepare( "SELECT {$select_data} FROM `{$table_name}` {$select_query} {$order}" );
			$stmt->execute();
			// set the resulting data to an associative array
			$result = $stmt->setFetchMode( PDO::FETCH_ASSOC );
			foreach ( new RecursiveArrayIterator( $stmt->fetchAll() ) as $k => $v ) {
				$data[] = $v;
			}
			
			// return the data
			return $data;
		} catch ( PDOException $e ) {
			
			return $data; //return an empty array if an error occur
		}
	}
	
	
	/**
	 * - This function selects one or multiple rows from a certain table matching a certain criteria which is left to
	 *          the user's discretion
	 *
	 * @param $table_name :name of the table to select the data from
	 * @param $select_data :array containing the data to be selected from the table
	 * @param string $clause :criteria to be met when selecting data.
	 *              Set to null; the user can use any clause e.g "WHERE column_name LIKE %el% ORDER BY column_name ASC"
	 *
	 * @return array
	 */
	public static function select2( $table_name, $select_data, $clause = "" ) {
		
		// initiliaze a 2D array with the name of 'data' which will hold the results of the query
		$data = [];
		// escape data to ensure it is safe/clean
		foreach ( $select_data as $key => $value ) {
			addslashes( $value );
		}
		// Convert $select_data to a simple string for execution
		if ( strstr( $select_data[0], "(" ) ) {
			$select_data = implode( ", ", $select_data );
		} else {
			$select_data = "`" . implode( "`, `", $select_data ) . "`";
		}
		// Create the statement to be used for matching the criteria during execution. If no clause is set by the user, it is left null
		$clause = ! empty( $clause ) ? "WHERE " . $clause : "";
		try {
			// use a prepared statement to select the data from the table
			$stmt = self::getConn()->prepare( "SELECT {$select_data} FROM `{$table_name}` {$clause}" );
			$stmt->execute();
			
			foreach ( new RecursiveArrayIterator( $stmt->fetchAll() ) as $k => $v ) {
				$data[] = $v;
			}
			
			// return the data
			return $data;
		} catch ( PDOException $e ) {
			return $data;//return an empty array if an error occur
		}
	}
	
	/**
	 * Deletes data from a given table
	 *
	 * @param $table_name :name of the table to delete the data from
	 * @param $column_name :name of the column to delete the data from
	 * @param $id_name :row id to delete the data from
	 */
	public static function delete( $table_name, $column_name, $id_name ) {
		
		
		// make sure the ID is in integer
		$id_name = (int) $id_name;
		try {
			// delete the data from the table
			$sql = "DELETE FROM `{$table_name}` WHERE `{$column_name}` = '{$id_name}'";
			self::getConn()->exec( $sql ); // use exec() because no results are returned
			// echo "Record deleted successfully";
		} catch ( PDOException $e ) {
			// return error message if operation failed
			echo "Error: " . $e->getMessage();
		}
	}
	
	/**
	 * Updates data records in a table
	 *
	 * @param $table_name :name of the table to update the data
	 * @param $update_data :array containing the data to be updated in the table
	 * @param $update_queries :array containing the rows to which to apply the update changes
	 */
	public static function update( $table_name, $update_data, $update_queries ) {
		
		// escape data to ensure it is safe/clean
		foreach ( $update_data as $key => $value ) {
			addslashes( $value );
		}
		foreach ( $update_queries as $key => $value ) {
			addslashes( $value );
		}
		// Convert $update_data to a simple string for execution
		foreach ( $update_data as $fields => $data ) {
			$update_data2[] = '`' . $fields . '` = \'' . $data . '\'';
		}
		$update_data3 = implode( ", ", $update_data2 );
		// Convert $update_queries to a simple string for execution
		foreach ( $update_queries as $fields => $dataX ) {
			$update_queries2[] = '`' . $fields . '` = \'' . $dataX . '\'';
		}
		$update_queries3 = implode( " && ", $update_queries2 );
		$update_query    = "WHERE {$update_queries3}";
		try {
			// use a prepared statement to select the data from the table
			$sql  = "UPDATE `{$table_name}` SET {$update_data3} {$update_query}";
			$stmt = self::getConn()->prepare( $sql );
			$stmt->execute();
			// echo $stmt->rowCount() . " records UPDATED successfully";
		} catch ( PDOException $e ) {
			// return error message if operation failed
			echo "Error: " . $e->getMessage();
		}
	}
	
	
	/**
	 * Inserts data records into a table
	 *
	 * @param $table_name = name of the table to inserted into the data
	 * @param $insert_data = array containing the data to be inserted into the table
	 *Note:
	 *    - It is not imperative to include the value for the primary column, you can just exclude it or leave it
	 *         empty/null e.g id = ''
	 *
	 * @return string
	 */
	public static function insert( $table_name, $insert_data ) {
		
		// escape data to ensure it is safe/clean
		foreach ( $insert_data as $key => $value ) {
			addslashes( $value );
		}
		// convert the array into a single line for execution
		foreach ( $insert_data as $fields => $data ) {
			$insert_keys[]   = '`' . $fields . '`';
			$insert_values[] = '\'' . $data . '\'';
			$insert_params[] = ':' . $fields;
			$insert_query1[] = $fields;
			$insert_query2[] = $data;
		}
		$insert_keys   = implode( ", ", $insert_keys );
		$insert_values = implode( ", ", $insert_values );
		$insert_params = implode( ", ", $insert_params );
		try {
			// prepare statement for execution
			$stmt = self::getConn()->prepare( "INSERT INTO `{$table_name}` ({$insert_keys}) VALUES ({$insert_params})" );
			for ( $i = 0; $i < count( $insert_query1 ); $i ++ ) {
				$stmt->bindParam( $insert_query1[ $i ], $insert_query2[ $i ] );
			}
			// insert a row
			$stmt->execute();
			
			// return the id of the row inserted
			return self::getConn()->lastInsertId();
		} catch ( PDOException $e ) {
			// return error message if operation failed
			echo "Error: " . $e->getMessage();
		}
		
		return "Error while processing your request";
	}
	
	
	/**
	 * Prints the data received from an execution in a neat way
	 *
	 * @param $data
	 */
	public static function print_results( $data ) {
		
		echo "<pre>";
		print_r( $data );
		echo "</pre>";
	}
	
	
	/**
	 * @return mixed
	 */
	public static function getConn() {
		
		return db_connect::getConnection();
	}
	
	
	/**
	 *Closes the database connection
	 */
	public static function closeConnection() {
		db_connect::closeConn();
	}
	
	
}

?>
