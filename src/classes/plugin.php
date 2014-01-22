<?php

/*
	-
*/

	class Plugin{
		private $_type; 
			// class(pre<html>) 
			// header(pre</head>) 
			// script(pre</body>)
		private $_name; 
			// name of the class used by the plugin
		
		function __construct ($name, $type){
			$this->_name = $name;
			$this->_type = $type;
		}
		
		function __destruct() {
		}
	}

/*

	parent::__construct("class");

	$exemple_plugin = new Plugin("script");

*/
