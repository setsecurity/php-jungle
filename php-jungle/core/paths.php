<?php

define('APP_PATH',ROOT.'application'.DS);//ruta que apunta a la aplicación

define('MODULES_PATH',APP_PATH.'modules'.DS);//ruta que apunta a los modulos

//rutas que apuntan a los controladores vistas y modelos de nuestra aplicación
define('CONTROLLERS_PATH', APP_PATH.'controllers'.DS);
define('MODELS_PATH', APP_PATH.'models'.DS);
define('VIEWS_PATH', APP_PATH.'views'.DS);


define('BASE_URL', 'http://localhost/php-jungle/');//la url de nuestro dominio
define('APP_URL',BASE_URL.'application/');
define('MODULES_URL', BASE_URL.'application/modules/');

define('LIBS_PATH',ROOT.'libs'.DS);//ruta que apunta a las librerias

define('LANG_PATH',ROOT.'language'.DS);//ruta que apunta a los ficheros de traducciones