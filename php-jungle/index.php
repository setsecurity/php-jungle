<?php

/* Medida de Seuridad open_basedir() 
 * restringe el acceso a php en arbol de directorios hasta la ruta indicada
 * si se pone una / al final se restringe al accesso a ese directorio concreto
 * http://php.net/manual/es/ini.core.php#ini.open-basedir
 */
ini_set('open_basedir',realpath(dirname(__FILE__)));

define('DS',DIRECTORY_SEPARATOR);//separador de directorios, para que no haya problemas (/ o \) en windows y linux
define('ROOT',realpath(dirname(__FILE__)).DS);//ruta absoluta de donde se encuentra este fichero index.php


//convierte los errores runtime en excepciones
function exceptionErrorHandler($errno,$errstr,$errfile,$errline){
    throw new ErrorException($errstr,0,$errno,$errfile,$errline);
}
set_error_handler('exceptionErrorHandler');


try{    
    require_once ROOT.'core'.DS.'init.php';//inizializar la app
    $registry= core\mvc\Registry::getInstance();//obtener instacia del Registry
    $registry->_request=new core\mvc\Request();//instanciar un Request y almacenarla en el Registry

    core\mvc\Bootstrap::run($registry->_request);//lanzar el Bootstrap pasandole el Request, que llamara a un método de X controlador
     
}catch(core\exceptions\PageNotFoundException $e){
    header('Location:'.BASE_URL.'error/index/404');
}catch (Exception $e) {   
    
    if(PRODUCTION){
        $message='Exception: '.$e->getMessage().' ,'.$e->getFile().' ,'.$e->getLine();
        error_log($message,0);        
        header('Location:'.BASE_URL.'error'); 
    }else{
        echo 'Exception: ';
        echo $e->getMessage().' ,';
        echo 'File: '.$e->getFile().' ,';
        echo 'Line: '.$e->getLine();
    }
        
}

?>
