<?php 

require_once('ConexaoBD.php');
require_once('Postagem.php');

class Home{

    public function listar_postagens(){

        $pdo = ConexaoBD::get_conexao();

        if (!isset($_SESSION)){
            //echo('<br>entrou no isset <br>');
            session_start();
    
        }
    
        //require('like_postagem.php');
    
        $id_usuario = @$_SESSION['id_usuario'];
    
        //echo("<br>"."SELECT texto_conteudo, id_postagem, list_imagens FROM POSTAGENS WHERE ID_PAI is NULL and id_usuario !=".$_SESSION['id_usuario'].";");
    
        $consulta = $pdo->query("SELECT texto_conteudo, id_postagem, list_imagens, id_usuario FROM POSTAGENS WHERE ID_PAI is null;");  
        // and id_usuario !=".$_SESSION['id_usuario'].";");
    
        return $consulta->fetchAll();
        
    }

}