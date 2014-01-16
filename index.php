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
| ------------------------- CORPS HTML
|
*/
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
            include($resources_path."/parts/main.php");    
        ?>
    </section>
    
    <footer>
        <?php           
            include($resources_path."/parts/footer.php");    
        ?>
    </footer>
    
  </body>
</html>
