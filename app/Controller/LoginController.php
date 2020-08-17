<?php

include_once('app/Model/Login.php');

class LoginController{

    public function index($parametros){

        if (!isset($_SESSION)){
            //echo('<br>entrou no isset <br>');
            session_start();
        
        }
        if(isset($_SESSION['logado']) && $_SESSION['logado']){
            echo("logado");
            header('location:home');
            //call_user_func_array(array("HomeController", "index"),$parametros);
        }else{
            //header('location:app/View/LoginView.php');
            //readfile('app/View/LoginView.php');
            $tela = file_get_contents('app/View/LoginView.php');
            $meta = file_get_contents('app/View/Template/Partial/meta.php');
            echo(str_replace('{{meta}}',$meta,$tela));
        }
    
    }

    public function logar(){
        echo('entrou no logar...');
        $login = new Login;
        echo($login->logar());
    
    }

}