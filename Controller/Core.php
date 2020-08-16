<?php

require_once ('HomeController.php');
require_once ('ErroController.php');
require_once ('LoginController.php');

Class Core{

    public function start(){

        $url = @$_GET['url'];

        $parametros = explode('/',$url);

        //var_dump($parametros);

        if(!$parametros[0]){

            call_user_func_array(array("LoginController", 'index'),$parametros);
            
        }else{
            
            $controller = ucfirst(@$parametros[0]).'Controller';

            array_shift($parametros);

            $metodo = @$parametros[0];

            array_shift($parametros);

            if(class_exists($controller)){
                //echo("controller encontrada");

                if($metodo && method_exists($controller, $metodo)){
                    
                    call_user_func_array(array($controller, $metodo),array($parametros));

                }else{
                    call_user_func_array(array("ErroController", 'index'),$parametros);
                }
            }else{
                call_user_func_array(array("ErroController", 'index'),$parametros);
            }
        }
    }
}