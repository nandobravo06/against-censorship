<?php 

require_once('ConexaoBD.php');

class Login{

    public function logar(){

        $login = @$_POST['login'];
        $senhacrua = @$_POST['senha'];

        if (!isset($_SESSION)){
            session_start();

        }

        $pdo = ConexaoBD::get_conexao();

        $consulta = $pdo->prepare("SELECT hsenha, id FROM USUARIO WHERE login=?;");
        $consulta -> execute(array($login));

        $logado = false;

        

        if ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

            //var_dump($linha);

            $hsenha = "{$linha['hsenha']}";
            $id = "{$linha['id']}";
        
            if(password_verify($senhacrua, $hsenha)){
            
                $_SESSION['login'] = $login;
                $_SESSION['logado']=true;
                $_SESSION['id_usuario']=$id;

                $logado=true;

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