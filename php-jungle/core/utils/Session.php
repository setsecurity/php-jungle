<?php
namespace core\utils;

/**
 * Se encarga de gestionar las sesiones
 */
class Session{
   
    /**
     * Se encarga se iniciar la sesión
     */
    public static function start(){      
        session_start();
        session_regenerate_id();/*Para prevenir sesion hijacking resetea el sesion id cada vez*/                 
    }
    
    /**
     * Destruye una o varias sesión en concreto o todas en caso de no especificar key
     * @param type $key
     */
    public static function destroy($key=false){
        if($key){
            if(is_array($key)){
                foreach($key as $k){
                    if(isset($_SESSION[$k]))unset($_SESSION[$k]);
                }
            }else{
                if(isset($_SESSION[$key]))unset($_SESSION[$key]);                
            }
        }else{
            //unset toda $_SESSION data
            $_SESSION=array();
            //expira la cookie de la sesión
            if(ini_get("session.use_cookie")){
                $params=session_get_cookie_params();
                setcookie(session_name(),'',
                time()-3600,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
                );
            }
            //destroy session
            session_destroy();
        }
    }

    public static function get($key){
        if(isset($_SESSION[$key])) return $_SESSION[$key];
        else return false;
    }    
    
    public static function set($key,$value){
        if(!empty($key))$_SESSION[$key]=$value;
    }
    
    public static function display(){
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
    }
}
