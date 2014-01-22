<?php



/*
                          /-------------------------------------------------------------------------\
                         |--------------------------- LIGHTMINE FRAMEWORK ---------------------------|
                          \-------------------------------------------------------------------------/ 
                          
                          Wiki and more informations at https://github.com/KeitIG/LightMine
*/



/*
|
| ------------------------- HEADERS
|
*/

define('WEBSITE', 'online'); // online/offline
define('ENVIRONMENT', 'development'); // development/test/released

$src_path = "src";
$plugins_path = "plugins";
$root = dirname(__FILE__);
$site_title = "";
$language = "";



/*
|
| ------------------------- ONLINE/OFFLINE
|
*/

if (!defined('WEBSITE'))
{
       exit('website error');
}
else
{
    switch (WEBSITE)
    {
        case 'online':
            break;
        case 'offline': 
            exit('website offline');
            break;
    }
}



/*
|
| ------------------------- ACTIVATED PLUGINS
|
*/

$activated_plugins = array('jquery', 'users', 'sql');

$script_plugins = array(); // DO NOT TOUCH THESE VARIABLES
$header_plugins = array();
$class_plugins = array();



/*
|
| ------------------------- PLUGINS ACTIVATION
|
*/

include($root."/".$src_path."/classes/plugin.php");
// make activated plugins integration

foreach ($activated_plugins as &$i) {
	include($root."/".$src_path."/plugins/".$i.".php");
}




/*
|
| ------------------------- ERROR REPORTING
|
*/

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit("the application is not corectly configured");
	}
}



/*
|
| ------------------------- PAGE GETTER
|
*/

if(isset($_GET['page'])){
	$page = filter_input(INPUT_GET, 'page');
}
else{
	$page = "index";
}



/*
|
| ------------------------- HEADER SETTER
|
*/
if (!empty($title)){
    $site_title = $site_title." - ".ucfirst($page);
}
else{
    $site_title = 'untitled page';
}



/*
|
| ------------------------- HTML BODY
|
*/
?>

<!DOCTYPE html>
<html<?php if (!empty($page)) echo ' lang="'.$language.'"'; ?>>
  <head>
    <meta charset="utf-8">
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="<?php echo "/".$src_path."/design/css/main.css"; ?>">
  </head>
  
  <body>
    <header>
        <?php           
            include($src_path."/parts/header.php");    
        ?>
    </header>
    
    <section id="main">
        <?php           
            include($src_path."/pages/".$page.".php");    
        ?>
    </section>
    
    <footer>
        <?php           
            include($src_path."/parts/footer.php");    
        ?>
    </footer>
    
    
    <!-- Scripts -->
    <?php
    	foreach ($script_plugins as $i=>&$plugin) {
            echo "<script>";
            include($root."/".$src_path."/librairies/".$plugin->getFilename());
            echo "</script>";
		}
    ?>
  </body>
</html>