<?php
//site name
define('SITE_NAME', 'Projeto EngSoft 2');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', 'http://localhost/');
define('URL_SUBFOLDER', 'EngSoft2');
define('HEADER', APP_ROOT.'/public/header.php');
define('FOOTER', APP_ROOT.'/public/footer.php');
define('RESOUCES', URL_ROOT.URL_SUBFOLDER.'/public/resources/');
define('SITE_URL', URL_ROOT.URL_SUBFOLDER);


//DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'engsoft2');
define('DB_TYPE', 'mysql');