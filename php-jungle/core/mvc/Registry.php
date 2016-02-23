<?php
namespace core\mvc;

/**
 * Su funcionalidad es asegurar un patrón singleton de todas las instancias que le agregemos
 */
class Registry{
    private static  $_instance;
    private $_data;

    //al ser privado se asegura de que nos se pueda crear una instancia de esta clase
    private function __construct(){}

    /**
     * Asegura el patrón singleton de la instancia registry
     * @return Registry
     */
    public static function getInstance(){
        //si el atributo instance no tiene una insatncia del registry va a crear una, si no devuelve la ya existente
        if(!self::$_instance instanceof self){
            self::$_instance=new Registry();
        }
        return self::$_instance;
    }

    /**
     * Cuando seteamos un atributo, el método magico __set
     * se activara y buscara en el array _data
     * @param $name
     * @param $value
     */
    public function __set($name,$value){
        $this->_data[$name]=$value;
    }

    /**
     * Cuando recogamos un atributo el método magico __get
     * se activara y lo obtendremos del array _data
     * @param $name
     * @return bool
     */
    public function __get($name){
        if(isset($this->_data[$name])){
            return $this->_data[$name];
        }
        return false;
    }
   
}