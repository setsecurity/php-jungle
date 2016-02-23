<?php
class Autoloader{

    private $_dirPath;
    
    public function __construct($dirPath){
        if(!is_dir($dirPath)){
            throw new Exception('Error en el Autoload , el directo no existe , ruta: '.$dirPath);
        }
        $this->_dirPath=$dirPath;
    }
    
    public function autoload($class){
        $parts=explode('\\', $class);
        $class=end($parts);
        $file=$this->_dirPath.$class.'.php';
        if(file_exists($file)) include_once $file;
    }
}

$autoloadedDirs=array(
    ROOT.'core'.DS.'mvc'.DS,
    ROOT.'core'.DS.'mvc'.DS.'controllers'.DS,
    ROOT.'core'.DS.'mvc'.DS.'views'.DS,
    ROOT.'core'.DS.'mvc'.DS.'models'.DS,
    ROOT.'core'.DS.'databaseConnectors'.DS,
    ROOT.'core'.DS.'exceptions'.DS,
    ROOT.'core'.DS.'utils'.DS
);

foreach ($autoloadedDirs as $value) {
    $autoloader=new Autoloader($value);
    spl_autoload_register(array($autoloader,'autoload'));
}

$autoloadedFiles=array(
    
);
foreach ($autoloadedFiles as $value) {
    if(file_exists($value)) include_once $value;
}