<?php
/*
  /-------------------------------------------------------------------------\
  |--------------------------- LIGHTMINE FRAMEWORK ---------------------------|
  \-------------------------------------------------------------------------/

  Wiki and more informations at https://github.com/KeitIG/LightMine
 */



/*
  |
  | ------------------------- HEADERS -- You should only modify THESE variables
  |
 */

define('WEBSITE', 'online'); // online/offline
define('ENVIRONMENT', 'development'); // development/test/released

$src_path = "src";
$root = dirname(__FILE__);
$lightmine_version = "LightMine alpha-1";

$activated_plugins = array('jquery', 'users', 'sql'); // List here your plugins
// Meta <head>
$site_title = "";
$language = "";
$meta_application_name = ''; // your site name
$meta_description = '';
$meta_keywords = ''; // tag1, tag2, tag3
$meta_author = ''; // your name, or the one of your organization



/*
  |
  | ------------------------- ONLINE/OFFLINE
  |
 */

if (!defined('WEBSITE')) {
    exit('website error');
} else {
    switch (WEBSITE) {
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

$script_plugins = array(); // DO NOT TOUCH THESE VARIABLES
$header_plugins = array();
$class_plugins = array();



/*
  |
  | ------------------------- PLUGINS ACTIVATION -- CLASS PLUGIN
  |
 */

require_once($root . "/" . $src_path . "/classes/plugin.php");

foreach ($activated_plugins as &$i) {
    require_once($root . "/" . $src_path . "/plugins/" . $i . ".php");
}



/*
  |
  | ------------------------- ERROR REPORTING
  |
 */

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
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

if (isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page');
} else {
    $page = "index";
}



/*
  |
  | ------------------------- HEADER SETTER
  |
 */
 
if (!empty($title)) {
    $site_title = $site_title . " - " . ucfirst($page);
} else {
    $site_title = 'untitled page';
}



/*
  |
  | ------------------------- HTML BODY
  |
 */
?>

<!DOCTYPE html>
<html<?php if (!empty($page)) echo ' lang="' . $language . '"'; ?>>
    <head>
        <meta charset="utf-8">
        <title><?php echo $site_title; ?></title>
        <link rel="stylesheet" href="<?php echo "/" . $src_path . "/design/css/main.css"; ?>">
        <meta name="application-name" content="<?php echo $meta_application_name; ?>">
        <meta name="description" content="<?php echo $meta_description; ?>">
        <meta name="keywords" content="<?php echo $meta_keywords; ?>">
        <meta name="author" content="<?php echo $meta_author; ?>">
        <meta name="generator" content="<?php echo $lightmine_version; ?>">
    </head>

    <body>
        <div id="all">
            <header>
                <?php
                    require_once($src_path . "/parts/header.php");
                ?>
            </header>

            <section id="main">
                <?php
                    require_once($src_path . "/pages/" . $page . ".php");
                ?>
            </section>

            <footer>
                <?php
                    require_once($src_path . "/parts/footer.php");
                ?>
            </footer>
        </div>

        <!-- Scripts -->
        <?php
            foreach ($script_plugins as $i => &$plugin) {
                echo '<script type="'.$plugin->get_filename().'" src="' . dirname($_SERVER['SCRIPT_NAME']) . '/' . $src_path . '/librairies/' . $plugin->get_filename() . '"></script>';
            }
        ?>     
    </body>
</html>
