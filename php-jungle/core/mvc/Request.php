<?php
namespace core\mvc;

/**
 * La clase Request se encarga de recoger y tratar la petición de un usuario
 * evalua la url y determina los valores para el controlador,método y argumentos
 * también evalua si se está accediendo a un módulo.
 */
class Request{
    private $_controller;
    private $_method;
    private $_args;
    private $_module;

    public function __construct(){

        if(isset($_GET['url'])){
            $url=filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);//coge el parametro url via get y lo sanea para que sea una url
            $url=explode('/',$url);//parte la url por cada slash, crea un array
            $url=array_filter($url);//filtra los valores null,false,-1,...

            /* asignamos cada parte de la url con array_shift(recupera y quita el primer elemento)
             * transformaremos a lowercase las partes
             * hay 2 posibilidades:
             * 1.modulo/controlador/metodo/argumentos
             * 2.controlador/metodo/argumentos
            */      
            
            $module=strtolower(array_shift($url));
            global $modules;//accedemos a la variable global $modules(array) de init.php que contiene los modulos
            
            //si el array contiene algo y el primer paremtro de la url coincide con un modulo
            if(count($modules) && in_array($module, $modules)){       
                $this->_module=$module;
                $this->_controller=strtolower(array_shift($url));
            }else{
                $this->_module=false;
                $this->_controller=$module;
            }
            
            if($this->_controller=='index.php')$this->_controller=DEFAULT_CONTROLLER;
            
            $this->_method=strtolower(array_shift($url));
            
            if($url){//si queda algo en el array
                $url=array_map('strtolower',$url);//convertimos a lower todos los elementos del array
                $this->_args=$url;//le damos el resto de la url
            }
        }


        //comprueba que se an rellenado las propiedades, si no las inizializa de serie
        if(!$this->_controller) $this->_controller = DEFAULT_CONTROLLER;
        if(!$this->_method) $this->_method = 'index';
        if(!isset($this->_args)) $this->_args=array();
        
    }
    
    
    public function getModule(){
        return $this->_module;
    }

    public function getController(){
        return $this->_controller;
    }

    public function getMethod(){
        return $this->_method;
    }

    public function getArgs(){
        return $this->_args;
    }
}