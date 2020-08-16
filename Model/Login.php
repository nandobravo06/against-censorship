<?php

class Login{
    
    private $pdo = null; 

    function __construct(){

        $pdo = new PDO('mysql:host=localhost;dbname=vsm','root','');

    
    }

    function logar(){

        $login = @$_POST['login'];
        $senhacrua = @$_POST['senha'];

        if (!isset($_SESSION)){
            session_start();

        }

        $consulta = $pdo->prepare("SELECT hsenha, id FROM USUARIOS WHERE login=?;");
        $consulta -> execute(array($login));

        $logado = false;

        if ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

            $hsenha = "{$linha['hsenha']}";
            $id = "{$linha['id']}";

            //echo('ID: '.$id);
        
            if(password_verify($senhacrua, $hsenha)){
            
                $_SESSION['login'] = $login;
                $_SESSION['logado']=true;
                $_SESSION['id_usuario']=$id;

                //echo($_SESSION['id_usuario']);
                
                $logado=true;

                //header('location:home.php');
                return 1;
            }
            
        }
        if($logado==false){
            session_destroy();
            //header('location:index.php');
            return 0;
        }
    }

}