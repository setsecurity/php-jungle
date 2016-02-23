<?php

namespace core\mvc\views;

use core\mvc\Request as Request;

class View{
    
    private $_layout;
    private $_module;
    private $_controller;
    
    public $js;
    public $css;
    
    public $data;
    
    public function __construct(Request $request){
        $this->_module=$request->getModule();
        $this->_controller=$request->getController();
        $this->setLayout(DEFAULT_LAYOUT);//inizializo el array layout
        $this->js=array();
        $this->css=array();
        $this->data=array();
    }   
    
    
    public function render($view){     
        if($this->_module) $body=MODULES_PATH.$this->_module.DS.'views'.DS.$view.'.php';
        else $body=VIEWS_PATH.$view.'.php';
        if(!is_readable($body)) throw new \Exception('Error renderizando vista , no se ha encontrado la vista definida ,ruta: '.$body);     
        
        if(is_null($this->_layout)){
            include_once $body;
        }else{
            $header=$this->_layout['layoutPath'].'header.php';
            $footer=$this->_layout['layoutPath'].'footer.php';
            include_once $header;
            include_once $body;
            include_once $footer;
        }        
    }
    
    
    public function showData($key){
        if(array_key_exists($key, $this->data)){
            echo $this->data[$key];
        }
    }
    
    
    /**
     * Define que layout se utilizará para renderizar la vista
     * 0-si el contexto es nulo, no se utilizará layouts
     * 1-el contexto es app , en ese caso usara el layout de la app general
     * 2-el contexto es ditinto de app, es un modulo, en ese caso cargara el layout del modulo especificado
     * 3-si estamos en un modulo y el contexto es false. layout del modulo en el que estamos
     * 4-si estamos en la app general y el contexto es fasle, el layout de la app general
     * por ultimo si la ruta del directorio que apunta al layout no es correcta lanzará una excepción
     * @param type $layout
     * @param string $context
     * @throws Exception
     */
    public function setLayout($layout,$context=false){
        if(is_null($layout)){          
            $this->_layout=null;
        }else if($context=='app'){
            $this->_layout=array(
                'layoutName'=>$layout,
                'layoutPath'=>VIEWS_PATH.'layout'.DS.$layout.DS,
                'layoutUrl'=>APP_URL.'views/layout/'.$layout.'/'
            );  
        }else if($context){
            $this->_layout=array(
                'layoutName'=>$layout,
                'layoutPath'=>MODULES_PATH.$context.DS.'views'.DS.'layout'.DS.$layout.DS,
                'layoutUrl'=>MODULES_URL.$context.'/views/layout/'.$layout.'/'
            ); 
        }else if($this->_module && !$context){
            $this->_layout=array(
                'layoutName'=>$layout,
                'layoutPath'=>MODULES_PATH.$this->_module.DS.'views'.DS.'layout'.DS.$layout.DS,
                'layoutUrl'=>MODULES_URL.$this->_module.'/views/layout/'.$layout.'/'
            );
        }else{
             $this->_layout=array(
                'layoutName'=>$layout,
                'layoutPath'=>VIEWS_PATH.'layout'.DS.$layout.DS,
                'layoutUrl'=>APP_URL.'views/layout/'.$layout.'/'
            );  
        }        
        if(!is_dir($this->_layout['layoutPath']))throw new \Exception('Error setLayout: el layout definido no existe, ruta: '.$this->_layout['layoutPath']);
    }
   
}