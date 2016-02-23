<?php

namespace core\utils;

/** 
 * Clase modificada, Idea original de @cbertelegni
 * Esta clase imprime en la consola Javascript del browser
 * Tipos de log:
 * log
 * debug
 * info
 * warn
 * error
 * trace
 * group
 * dir
 */
class ConsoleLog{
    
    public $mensaje;
    public $loge;
    
    public function __construct($typeLog, $msj) {
        $this->loge= $typeLog;
        $this->mensaje= $msj;
        $this->display();
    }

  
    public function display(){
        $script= '<script type="text/javascript">';
        $script .= 'console.'.$this->loge.'("PHP menssage: '.$this->mensaje.'")';
        $script .= '</script>';
        echo $script;
    }
    
    
    public static function consolePrint($typeLog,$msj){
        $script= '<script type="text/javascript">';
        $script .= 'console.'.$typeLog.'("PHP menssage: '.$msj.'")';
        $script .= '</script>';
        echo $script;
    }
}

