<?php

// Operations on MYSQL databases -- ONLY MYSQL IS SUPPORTED

class Sql {

    // Database config
    private $_SQL_host = ''; // path of your SQL server
    private $_SQL_port = '';
    private $_SQL_database_name = ''; // your database name
    private $_SQL_user_name = ''; // username used to connect to your database
    private $_SQL_user_password = ''; // username password

    function __construct() {
    }
    
    function connect() {
        // Database Connection
        try {
            $_SQL = new PDO('mysql:host=' . $this->_SQL_host .
                    ';port=' . $this->_SQL_port .
                    ';dbname=' . $this->_SQL_database_name, 
                    $this->_SQL_user_name, 
                    $this->_SQL_password);
        } catch (Exception $e) {
            echo 'database connection error: '.$e->getMessage();
            die();
        }
    }

    function close() {
        // Close database connection
        $this->_SQL = null;
    }
    
    function add() {
        // Add entries in a table  
    }
    
    function remove() {
        // Remove entries in a table
    }
    
    function set() {
        // Rename entries in a table
    }

}


// STARTING PLUGIN

$SQL = new Sql();
