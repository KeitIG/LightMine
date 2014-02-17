<?php

/*
	- class(pre<html>) 
	- header(pre</head>) 
	- script(pre</body>)
*/

	class Plugin{
		
		function __construct(){
		}
		
		function __destruct() {
		}
	}



/*
|
| ------------------------- SCRIPT PLUGIN
*/
	
	class PluginScript extends Plugin{
		
		private $_script_filename;
		private $_script_type;
		
		// By default, $_script_type is Javasvascript
		function __construct ($script_filename){
			$this->_script_filename = $script_filename;
			$this->_script_type = "text/javascript";
			global $script_plugins;
			array_push($script_plugins, $this);
		}
		
		function __construct ($script_filename, $script_type){
			$this->_script_filename = $script_filename;
			$this->_script_type = $script_type;
			global $script_plugins;
			array_push($script_plugins, $this);
		}
		
		function getFilename(){
			return $this->_script_filename;
		}
	}



/*
|
| ------------------------- CLASS PLUGIN
|
*/

	class PluginClass extends Plugin{
		
		private $_class_name;
		
		function __construct($script_name){
			$this->_class_name = $script_name;
			global $class_plugins;
			array_push($class_plugins, $this);
		}
	}
	
