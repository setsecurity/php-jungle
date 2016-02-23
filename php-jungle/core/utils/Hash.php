<?php
namespace core\utils;

/**
 * Clase que se encarga de gestionar los hash
 */
class Hash{
    
    const HASH_KEY='5278888e5ad1c';//será la llave para todos los hash que generemos
    
    /**
     * devuelve el hash de una cadena , hay que especificarle el HASH_KEY
     * @param type $algorithm
     * @param type $data
     * @param type $key
     * @return type
     * @throws Exception
     */
    public static function getHash($algorithm,$data,$key=Hash::HASH_KEY){
        if(!in_array($algorithm, hash_algos()))throw new Exception('Error en el hash, el algoritmo '.$algorithm.' no es un algortitmo valido');
        $hash=hash_init($algorithm,HASH_HMAC,$key);
        hash_update($hash,$data);
        return hash_final($hash);
    }

}