<?
/**
 * MV - content management framework for developing internet sites and applications.
 * Released under the terms of BSD License.
 * http://mv-framework.com
 */
 
//Initial settings for setup of the project 
//Goes to Registry object to read the settings from any part of backend or frontend

$mvSetupSettings = array(

//Set 'production' - log all errors into /log/ folder, 
//'development' - display all possible errors on the screen
'Mode' => 'production',

//Database parameters
'DbEngine' => 'mysql', // mysql / sqlite
// 'DbMode' => 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION', //SQL mode for MySQL engine
// 'DbFile' => 'database.sqlite', //File of sqlite database if engine is 'sqlite' location 'userfiles/database/sqlite/'
'DbHost' => 'db', 
'DbUser' => 'root',
'DbPassword' => 'password',
'DbName' => 'videohosting',

 //Project server time zone in format for php like 'Europe/Moscow'
 //List of timezones http://php.net/manual/en/timezones.php
'TimeZone' => 'Europe/Moscow',

//Region for localization see folder ~/adminpanel/i18n/
'Region' => 'ru',

//Name of domain of the site must begin with 'http://' (and no '/' at the end!)
'DomainName' => 'http://localhost',

//Web site location path from root folder of domain(usually '/' on production server)
'MainPath' => '/',

//Name of folder with admin panel from the root of site. No '/' before or after.
'AdminFolder' => 'god-admin',

//If true will start the session the the frontend when any page runs
'SessionSupport' => true,

//Set HttpOnly mode for cookies
'HttpOnlyCookie' => true,

//Allows cache operations and turns on cache cleaning in models CRUD
'EnableCache' => false,

//File storage path from the root of site (the same one is used by WW editor). No '/' before or after.
'FilesPath' => 'userfiles',

//Special code for md5 url params, make it new when setup the project
'SecretCode' => 'dzWphUupHKiYfvjYWD7WrM8cMAsprUwz',

//Sender email address, set it like 'Name <email@domain.zone>'
'EmailFrom' => '',

//Type of email sending
'EmailMode' => 'mail', // mail / smtp

//SMTP setting for email sender
'SMTPHost' => '',
'SMTPPort' => '',
'SMTPAuth' => true,
'SMTPEncryption' => '',
'SMTPUsername' => '',
'SMTPPassword' => ''
);
?>