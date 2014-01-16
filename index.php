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

$resources_path = "src";
$plugins_path = "plugins";
$site_title = "";



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

$activated_plugins = array('sql', 'users');



/*
|
| ------------------------- PLUGINS ACTIVATION
|
*/

// Update Architecture



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
    <link rel="stylesheet" href="<?php echo "/".$resources_path."/design/css/main.css"; ?>>
  </head>
  
  <body>
  
    <header>
        <?php           
            include($resources_path."/parts/header.php");    
        ?>
    </header>
    
    <section>
        <?php           
            include($resources_path."/pages/".$page."php");    
        ?>
    </section>
    
    <footer>
        <?php           
            include($resources_path."/parts/footer.php");    
        ?>
    </footer>
    
  </body>
</html>
