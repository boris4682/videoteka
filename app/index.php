<?
/**
 * MV - content management framework for developing internet sites and applications.
 * Released under the terms of BSD License.
 * http://mv-framework.com
 */
// phpinfo();
//Main config file with all settings and autoloads
require_once "config/autoload.php";
error_reporting(0);
ini_set('display_errors', 0);
//Set 1 to see the work time and sql queries
$debug = new Debug(0);

//Main object of site also contains all modules objects
$mv = new Builder();
include_once $mv->views_path . "/includes/main-index-include.php";
$url_parts = $mv->router->getUrlParts();

if(!(count($url_parts) == 1 && $url_parts[0] == 'login')){
    if(!$account)
        $mv -> redirect('login/');
}
//Router refers to include needed view to display the page
include_once $mv->router->defineRoute();

//If 1 was passed above, displays the data
$debug->displayInfo($mv->router);
