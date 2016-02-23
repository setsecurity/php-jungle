<?php
namespace core\mvc\controllers;

use core\mvc\Registry as Registry;
use core\mvc\views\View as View;

/**
 * Es el controlador padre de todos los controladores
 */
abstract class Controller{
    
    protected $view;
    
    public function __construct($view=DEFAULT_VIEW){//si no le pasamos nada utilizara la vista por defecto
        $resgistry=Registry::getInstance();
        $request=$resgistry->_request;//recogemos el request desde el registry
        if(is_null($view)) $this->view=null;//si es nulo este controlador no manejara vistas
        else if($view=='View') $this->view=new View($request);
        else throw new Exception('Error cargando la vista, la vista '.$view.' no existe');
    }
    
    abstract public function index();//obliga a los hijos a que contengan el método index
    
   
    protected function loadModel($model,$context=false){
        $model=$model.'Model';
        $resgistry=Registry::getInstance();
        $request=$resgistry->_request;//recogemos el request desde el registry
        $module=$request->getModule();
        if(!$context && $module){
            $pathModel=MODULES_PATH.$module.DS.'models'.DS.$model.'.php';
        }else if($context=='app'){
            $pathModel=MODELS_PATH.$model.'.php';
        }else if($context){
            $pathModel=MODULES_PATH.$context.DS.'models'.DS.$model.'.php';
        }else{
            $pathModel=MODELS_PATH.$model.'.php';
        }
        
        if(is_readable($pathModel)){
            require_once $pathModel;
            $model = new $model();
            return $model;//y devuelve la instancia del modelo
        }else{
            throw new Exception('Error cargando el modelo, el modelo no ha sido encontrado , ruta: '.$pathModel);
        }        
    }
    
}
