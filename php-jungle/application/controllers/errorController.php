<?php
use core\mvc\controllers\HttpController as HttpController;

class errorController extends HttpController{

    public function __construct() {
        parent::__construct();
    }
    
    public function index($code='default') {
        $data=array(
            'errorMsg'=> $this->_getError($code)
        );
        $this->view->data=$data;
        $this->view->render('error');
    }

    private function _getError($code){
        if($code!='default' && !$this->validateInt($code)){
            $code='default';
        }
        //creamos un array de errores
        $error['default']="Ha ocurrido un error y la página no puede mostrarse";
        $error['401']="Error 401: Acceso restringido";
        $error['404']="Error 404: Página no encontrada";
        $error['440']="Error 440: El tiempo de la sesión se ha agotado";
        
         if(array_key_exists($code,$error)){//si existe esa clave en el array
            return $error[$code];
        }else{
            return $error['default'];
        }
    }
}

