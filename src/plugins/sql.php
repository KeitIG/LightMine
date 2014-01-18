<?php

	// Operations on MYSQL databases
	
	
	class Sql{
		
	// Database config
		private $SQL_host = ''; // path of your SQL server
		private $SQL_port = '';
		private $SQL_database_name = ''; // your database name
		private $SQL_user_name = ''; // username used to connect to your database
		private $SQL_user_password = ''; // username password
		private $SQL; // undefined by default
		
		function connect(){
    			// Database Connection
			try{
				$SQL = new PDO('mysql:host='.$SQL_host.
					';port='.$SQL_port.
					';dbname='.$SQL_database_name,
					$SQL_user_name, 
					$SQL_password);
			}
			catch(Exception $e){
				echo 'database connection error';
				die();
			}
		}
		
		function close(){
    			// Close database connection
			$SQL = null;
		}
	
	}

?>
