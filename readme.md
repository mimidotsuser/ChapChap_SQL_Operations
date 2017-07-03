# ChapChap_SQL-Operations
A light weight PHP library for performing brisk SQL operations
-------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------
Swift_SQL v0.02                                                                                              
-------------------------------------------------------------------------------------------------------------------
* Created by Kelvin Kamau (www.kelvinkamau.com)     
* Modified by mimidotsuser (www.mimidots.com)
* Distributed under the Open Source License                                                            
-------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------

0. Foreword:
  -  This library is created with the objective of reducing the amount of code one has to write in order to connect to and perform operations on a database.
      e.g. to select data from a database in a specific format or update the data in a database table.
  - To achieve this, the library uses the PDO approach and an object-oriented approach in the PHP Language.
  - Security is a major concern, and thus major steps are taken to achieve this;
      e.g. use of Prepared Statements, and escaping data before each database operation is executed.
  - Note that in functions which return data from the database, the data is returned in a 2D array. Do a loop to get individual data (examples are given).
      e.g. in 'select()' && 'select2()' functions.

1. USE:
 1.1 Getting Started - Setting up a sample environment
  - To use this library, you need a sample database. An example has been provided in the root directory (sample_db.sql)
  - Simply create a new database in your server, and import the file 'sample_db.sql'. Note that for my environment, am using PHP Version: 7.0.8
  - The 'database' folder contains database configuration and connection files, and a file with functions for executing swift database functions.
  - Update the credentials in the 'config.php' to match the ones in your server so as to allow a successful database connection.

  1.2 Using & Reusing The code
  - In the root folder, the file 'index.php' contains sample code that illustrate the using of this library.
  - To illustrate a function's usage, simply uncomment the lines of code which follow the line commented out as /* .. */ 
  e.g
  1.  /* SELECT column_names FROM table_name */
  2.  // $query = $db::select("hello_world", ['id', 'name', 'random'], []);
  3.  // $db::print_results($query);
  
  Here, simply uncomment the second & third lines (the lines commented out with a '//')
  - To reuse the code, all you need is to copy the database folder and its files to your project. Also, do not forget to include the autoloader.php file
  in your root directory. Keen should be taken to ensure the project hierarchy is maintained for easy use.

2. HELP & CONTRIBUTIONS:
  - This repository have been forked from https://github.com/kelvinkamau/ChapChap_SQL_Operations/
  - This is an open source project; as such, contributions are highly appreciated and welcome.
  - If you need to make a contribution to this project, simply make a pull request.
  - The main library will be updated to reflect all helpful contributions, and the contributors will be duly recognized.
  
