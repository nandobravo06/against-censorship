<?php

include_once('app/Model/Login.php');

class LoginController{

    public function index($parametros){

        //header('location:'.$GLOBALS['url'].'login');

        if (!isset($_SESSION)){
            
            session_start();
            $tela = file_get_contents('app/View/LoginView.php');
            $meta = str_replace('{{url}}',$GLOBALS['url'],file_get_contents('app/View/Template/Partial/meta.php'));
            echo(str_replace('{{meta}}',$meta,$tela));
        
        }
        else if(isset($_SESSION['logado']) && $_SESSION['logado']){

            //echo("LC 19");
            header('location:'.$GLOBALS['url'].'home');

        }else{

            $tela = file_get_contents('app/View/LoginView.php');
            $meta = str_replace('{{url}}',$GLOBALS['url'],file_get_contents('app/View/Template/Partial/meta.php'));
            echo(str_replace('{{meta}}',$meta,$tela));
        }
    
    }

    public function logar(){

        //echo('entrou no logar...');
        $login = new Login;
        //$resultado = $login->logar();
        if(($login->logar())==1){
            echo("LC 37");
            //header_remove(); 
            
            header('location:'.$GLOBALS['url'].'home');
            //redirect('/login');
        }
        else{
            //echo("LC 41");
            header_remove();
            header('location:'.$GLOBALS['url'].'login');
        }
    }
    public function deslogar(){
        if (isset($_SESSION)){
            session_destroy();
        }
        //echo("LC 49");
        header('location:'.$GLOBALS['url'].'login');
    }

}