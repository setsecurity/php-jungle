<?php
namespace core\mvc;

/**
 * Esta Clase se encarga de dar servicio a las peticiones de los clientes en base una petición
 * hace una llamada al método de un controlador(epecificados en el request)
 */
class Bootstrap{
    
    public static function run(Request $request){
        global $controllers;//de /core/config.php
        
        if(!in_array($request->getController(),$controllers)) throw new \core\exceptions\PageNotFoundException();
        
        //obtenemos las partes del request
        $module=$request->getModule();
        $controller=$request->getController().'Controller';//concatenamos controller
        $method=$request->getMethod();
        $args=$request->getArgs();
        
        
        //creamos la ruta al controlador
        if($module)$pathController=MODULES_PATH.$module.DS.'controllers'.DS.$controller.'.php';
        else $pathController=CONTROLLERS_PATH.$controller.'.php';  
        
        if(is_readable($pathController)){//si ese controlador existe y es legible
            require_once $pathController;//incluimos el controlador ejemplo: indexController
            
            $controller=new $controller;//instanciamos la clase, ahora $controller es un objeto

            //comprobamos que el método se puede llamar en esa instancia del controlador
            if(!is_callable(array($controller,$method))){
                /*si no es callable, es decir no exite el método se asignara el de por defecto index que siempre existirá
                debido a que es un método abstracto de la clase padre Controller*/
                $method='index';
            }

            //comprobamos que hayan argumentos
            if(isset($args) && !empty($args)){
                //llamamos al método pasandole los argumentos
                call_user_func_array(array($controller, $method), $args);
            }else{
                //llamamos al método sin pasarle argumentos
                call_user_func(array($controller,$method));
            }
        }else{           
            throw new \core\exceptions\PageNotFoundException();
        }
    }
    
}