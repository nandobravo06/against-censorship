<?php

include_once('app/Model/Home.php');

class HomeController{

    public function index($parametros){

        //echo ('homecontroller index');

        if (!isset($_SESSION)){
            
            session_start();
        }

        if (isset($_SESSION['logado']) && $_SESSION['logado'] ){

            //echo("entrou no logado...");

            $tela = file_get_contents('app/View/HomeView.php');
            $meta = str_replace('{{url}}',$GLOBALS['url'],file_get_contents('app/View/Template/Partial/meta.php'));
            echo(str_replace('{{meta}}',$meta,$tela));
            
            //header('location:'.$GLOBALS['url'].'postagem/index');
            
        }else{
            header('location:'.$GLOBALS['url'].'login');
        }



        /*teste*/ 

        
        
    }

}