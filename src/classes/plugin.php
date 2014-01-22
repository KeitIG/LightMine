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
		
		function __construct ($script_filename){
			$this->_script_filename = $script_filename;
			global $script_plugins;
			array_push($script_plugins, $this);
		}
		
		function getFilename(){
			return $this->_script_filename;
		}
	}
	


/*
|
| ------------------------- HEADER PLUGIN
|
*/
	
	class PluginHeader extends Plugin{
		
		function __construct(){
			global $header_plugins;
			array_push($header_plugins, $this);
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
	
