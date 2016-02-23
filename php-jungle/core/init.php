<?php
//Aquí se inizializa toda la configuración

ini_set('allow_url_fopen', '0');//permite abrir ficheros de servidores remotos,po lo tanto off
ini_set('allow_url_include', '0');//permite incluir ficheros de servidores remotos,por lo tanto off
ini_set('date.timezone', 'Europe/Madrid');
ini_set('default_charset', 'UTF-8');
ini_set('disable_functions', 'system,readfile,passthru,exec,shell_exec,popen,telnet,friends');
ini_set('session.cookie_httponly', 1);//hace que las cookies no sean accesibles desde scripts del lado del cliente
ini_set('session.cookie_secure', 1);//hace que las cookies solo se envien al servidor si la conexión es https
session_name('php_session_00232_id');//nombre identificador de la cookie de la sesión

require_once ROOT.'core'.DS.'paths.php';//constantes de rutas
require_once ROOT.'core'.DS.'config.php';//configuración general
require_once ROOT.'core'.DS.'autoload.php';//directorios y ficheros a cargar con el autoload
require_once ROOT.'vendor'.DS.'autoload.php';


if(!PRODUCTION){//para que se muestren o no se muestren los errores
    ini_set('error_reporting', E_ALL | E_NOTICE | E_STRICT);
    ini_set('display_errors', '1');
}else{
    ini_set('display_errors', '0');
    error_reporting(-1);//para ponerlo al maximo  
}



// MODULOS, escaneara el directorio modules, todo directorio que se encuentre en está ruta se considerará un módulo
$scan=scandir(MODULES_PATH);
$modules=array();
foreach ($scan as $value){
    if(is_dir(MODULES_PATH.$value) && $value!='.' && $value!='..')$modules[]=$value;
}

core\utils\Session::start();

//require_once ROOT.'core'.DS.'language.php';