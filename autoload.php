<?php
/**
 * Swift SQL
 *
 * Modified by https://github.com/mimidotsuser
 *
 * Distributed under the Open Source License
 * For instructions on how to use this library, open the 'readme.md' file in the root directory
 */

/**
 * This file registers multiple functions to be called when new class is instantiated
 * Do not modify the existing function (s)
 */

/**
 * @param $className
 */
function dbConn( $className ) {
	$filename = "./database/" . $className . ".php";
	if ( is_readable( $filename ) ) {
		require $filename;
	}
}


spl_autoload_register( 'dbConn' );