<?php

/*
                          /-------------------------------------------------------------------------\
                         |--------------------------- LIGHTMINE FRAMEWORK ---------------------------|
                          \-------------------------------------------------------------------------/ 
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
$site_title = "";
$root = $_SERVER['DOCUMENT_ROOT'];



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
        case 'offline': 
            exit('website offline');
    }



/*
|
| ------------------------- ACTIVATED PLUGINS
|
*/

$activated_plugins = array('sql', 'user');



/*
|
| ------------------------- PLUGINS ACTIVATION
|
*/

// need test about $root output
foreach($activated_plugins as $i)
{
	$plugin_path = $root.$src_path.'/plugins/'.$activated_plugins[$i].'php';
	if(file_exists($plugin_path){
		include $plugin_path;
	}
	// make error here
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
			exit("L'application n'est pas correctement configurée.");
	}
}


/*
|
| ------------------------- PAGE GETTER
|
*/

if(isset($_GET["page"])){
	$page = $_GET["page"];
}
else{
	$page = "index";
}



/*
|
| ------------------------- HTML BODY
|
*/
?>

<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title." - ".ucfirst($page);?></title>
    <link rel="stylesheet" href="<?php echo "/".$src_path."/design/css/main.css"; ?>>
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
    
  </body>
</html>
