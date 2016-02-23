<?php
use core\mvc\controllers\HttpController as HttpController;

class indexController extends HttpController{
    
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        
        $this->view->render('index');
    }
}