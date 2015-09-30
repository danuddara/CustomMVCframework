<?php
/*
 *
 *  @project = "iOnexa";
 * @author = "Four Corners Lanka(Pvt) Ltd";
 * @version = 0.1;
 * @date  = "13/06/2013";
 * @class = "global initial setup";
 * 
 * 
 */



  
/*** error reporting on ***/
 error_reporting(E_ALL);


 
 /*****default time zone****/
 date_default_timezone_set("Europe/London");
 
 /*****base url for the site*****/
 $temp_url =  'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/';
 
 if($temp_url=='http://localhost/ionexa/')
     {$temp_url=$temp_url;}
 else if($temp_url=='http://www.demo123.info/ionexa/' || $temp_url=='http://demo123.info/ionexa/' )
 {
     $temp_url=$temp_url;
 }
 else
 {
     $temp_url =  'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
 }
 define ('__BASE_URL',$temp_url);
 

 
 
/*include registry and create the instance*/
include_once  'registry/registry.php';
include_once 'functions.php';
/*recaptcha lib for sign in*/
include_once 'libs/recaptcha/recaptchalib.php';

    // Fix magic quotes
    if(get_magic_quotes_gpc())
    {
        $_POST    = fix_slashes($_POST);
        $_GET     = fix_slashes($_GET);
        $_REQUEST = fix_slashes($_REQUEST);
        $_COOKIE  = fix_slashes($_COOKIE);
    }

/*
 * captcha keys for google API
 * Pasindudanuddara@gmail.com for testing please use a google account
 */
 $publickey= "6LdiJOMSAAAAAIOD6S3M0c9Y8t_S3jolOWqcJ__-"; 
 $privatekey = "6LdiJOMSAAAAAM7egJYaMVA1PapGDBce9T7mKtV6";


$registry = Registry::getRegistry();

/*load core objects 
 * 
 * dbclass.class
 * template.class
 * router.class
 * baseController.class
 * 
 */
$registry->storeCoreObjects();

/* setting the view main template settings
 *  the default is the folder name and the skin is the key
 * 
 * the template folder
 * 
 * (@param = the folder name,
 * @param = the key (don't change this// template->loadtemplatebit())
 */
$registry->storeSetting( 'default', 'skin' );

/*** auto load model classes 
 * it was changed to support the i18n lib as well
 * ***/
function __autoload($class_name)
{  
    $filename = strtolower($class_name) . '.class.php';
    
    $file = 'models/' . $filename;
    $i18n = 'includes/libs/i18n/class.' . $class_name . '.inc.php';

    if (file_exists($file) ==true)
    {
        include ($file);
       
    }
    else if(file_exists($i18n) )
    {
        include ($i18n);
    }
     return false;
   
}

/****set up of the route controllers path*****/
$route=$registry->getObject('router');

$route->setPath('contollers');

$route->loader();


?>
