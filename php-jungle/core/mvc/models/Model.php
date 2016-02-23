<?php
namespace core\mvc\models;

use core\mvc\Registry as Registry;

/**
 * Es el modelo base de todos los modelos
 */
abstract class Model{
    
    protected $pdoDB1;
    

    public function __construct(){
        $registry=Registry::getInstance();
        
        if(!$registry->_pdoDB1){
            $registry->_pdoDB1=new \core\databaseConnectors\PDOconnectorExtended(DB_HOST,DB_NAME,DB_USER,DB_PASS,DB_TYPE);  
        }
        $this->pdoDB1=$registry->_pdoDB1;
    }
   
}