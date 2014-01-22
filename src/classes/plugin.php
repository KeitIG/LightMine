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
		
		private $_script_name;
		
		function __construct ($script_name){
			$this->_script_name = $script_name;
		}
	}
	


/*
|
| ------------------------- HEADER PLUGIN
|
*/
	
	class PluginHeader extends Plugin{
		
		function __construct(){
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
		}
	}
	
