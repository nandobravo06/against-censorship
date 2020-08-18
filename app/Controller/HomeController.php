<?php

include_once('app/Model/Home.php');

class HomeController{

    public function index($parametros){

        //echo ('homecontroller index');

        if (!isset($_SESSION)){
            
            session_start();
        }

        if (isset($_SESSION['logado']) && $_SESSION['logado'] ){
            
            header('location:'.$GLOBALS['url'].'postagem/index');
            
        }
        
    }

}