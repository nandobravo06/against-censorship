<?php

require_once ('HomeController.php');
require_once ('ErroController.php');
require_once ('LoginController.php');
require_once ('PostagemController.php');

Class Core{

    public function start(){

        $GLOBALS['url']='http://localhost/against-censorship/';

        $url = @$_GET['url'];

        $parametros = explode('/',$url);

        //var_dump($parametros);

        if(!$parametros[0]){
            //echo('aqui.......');
            call_user_func_array(array("LoginController", 'index'),array($parametros));
            
        }else{
            
            $controller = ucfirst(@$parametros[0]).'Controller';

            array_shift($parametros);
            //var_dump($parametros);

            $metodo = @$parametros[0];

            if(strcmp($metodo,"")==0){
                $metodo='index';
            }

            array_shift($parametros);
            //var_dump($parametros);

            if(class_exists($controller)){
                //echo("controller encontrada");

                if($metodo && method_exists($controller, $metodo)){
                    //echo("1");  
                    call_user_func_array(array($controller, $metodo),array($parametros));

                }else{
                    //echo("2"); 
                    all_user_func_array(array("ErroController", 'index'),array($parametros));
                }
            }else{
                //echo("3"); 
                call_user_func_array(array("ErroController", 'index'),array($parametros));
            }
        }
    }
}