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

$db = new swift_sql();

/* SELECT column_names FROM table_name */
//$query = $db:: select( "hello_world", [ "name" ], [] );
//$db::print_results( $query );

/* SELECT column_names FROM table_name; Using a for loop */
//$query = $db::select( "hello_world", [ 'id', 'name', 'random' ], [] );
//for ( $i = 0; $i < count( $query ); $i ++ ) {
//	$db::print_results( $query[ $i ] );
//}
//for ( $i = 0; $i < count( $query ); $i ++ ) {
//	echo $query[ $i ]['name'] . "<br />";
//}

/* SELECT column_name FROM table_name */
//$query = $db::select( "hello_world", [ 'name' ], [] )[0]['name'];
//echo $query;

/* SELECT column_name(s) FROM table_name WHERE column_name = some_value */
//$query = $db::select( "hello_world", [ 'id', 'name', 'random' ], [ 'id' => '1' ] );
//$db::print_results( $query );

/* SELECT column_name(s) FROM table_name WHERE column_name = some_value ORDER BY ASC */
//$query = $db::select( "hello_world", [ 'id', 'name', 'random' ], [], 'name', 'ASC' );
//$db::print_results( $query );

/* SELECT column_name(s) FROM table_name WHERE column_name LIKE %some_value% && column_name == even number ORDER BY `column_name` DESC */
//$query = $db::select2( "hello_world", [
//	'id',
//	'name',
//	'random'
//], "`name` LIKE '%o%' && `id` %2 = 0 ORDER BY `id` DESC" );
//$db::print_results( $query );

/* DELETE column_name(s) FROM table_name WHERE some_column = some_value */
//$db::delete( "hello_world", "id", "3" );

/* UPDATE table_name SET column1 = value WHERE some_column = some_value */
//$db::update( "hello_world", [ 'name' => 'Hello' ], [ "id" => "1" ] );

/* UPDATE table_name SET column1 = value, column2 = value2,... WHERE some_column = some_value */
//$db::update( "hello_world", [ 'name' => 'Hello', 'random' => 'uirdfx' ], [ "id" => "1" ] );

/* INSERT column_name(s) INTO table_name WHERE column_name = xx; */
//$db::insert( "hello_world", [ "name" => "Olla" ] );

/* INSERT column_names INTO table_name WHERE column_name = xx; Return id of the last inserted row */
//echo $db::insert( "hello_world", [ "name" => "Olla", "random" => "dsxuifjk" ] );

?>
