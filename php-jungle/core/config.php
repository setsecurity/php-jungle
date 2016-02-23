<?php
//Configuración GENERAL de la aplicación

define('PRODUCTION',false);

define('DEFAULT_CONTROLLER','index');//controlador por defecto
define('DEFAULT_LAYOUT', 'default');//el layout que se escogera por defecto
define('DEFAULT_VIEW','View');

define('DB_HOST','localhost');
define('DB_NAME','php-jungle');
define('DB_USER','root');
define('DB_PASS','');
define('DB_TYPE','mysql');

$controllers=array(
    'index','error'
);