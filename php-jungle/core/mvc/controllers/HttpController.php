<?php
namespace core\mvc\controllers;

use core\mvc\controllers\Controller as Controller;

use core\utils\FilterValidationTrait as FilterValidationTrait;

abstract class HttpController extends Controller{
          
    use FilterValidationTrait;
    
    public function __construct($view=DEFAULT_VIEW){
        parent::__construct($view);
    }  
    
    
    /**
     * Recoge una parametro indicado por post
     * evalua si este parametro está seteado y no está vacio
     * @param type $key
     * @return boolean
     */
    protected function getPost($key){
        if(isset($_POST[$key]) && !empty($_POST[$key])){
            return $_POST[$key];
        }
        return false;
    }
    
    /**
     * Recoge una parametro indicado via post o get
     * evalua si este parametro está seteado y no está vacio
     * @param type $key
     * @return boolean
     */
    protected function getRequest($key){
        if(isset($_REQUEST[$key]) && !empty($_REQUEST[$key])){
            return $_REQUEST[$key];
        }
        return false;
    }
}