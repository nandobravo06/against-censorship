<?php 

require_once('ConexaoBD.php');

Class Postagem{
 
    public function publicar_postagem($params){

        if (!isset($_SESSION)){
            
            session_start();
        }
        
        echo('<br>$params: <br>');
        var_dump($params);
        echo("<br><br>");
        
        $pdo = ConexaoBD::get_conexao();

        $id_postagem_pai = @$params[0];

        if(strcmp($id_postagem_pai,"")==0){
            echo('realocou para null');
            $id_postagem_pai = null;
        }
       
        echo('id_postagem_pai: '.$id_postagem_pai."<br>");

        $tipo_postagem = @$_POST['hidden'.$id_postagem_pai];

        echo('tipo_postagem: '.$tipo_postagem."<br>");
        
        $texto_publicacao="";
        $tipo=null;
        
        echo('_POST: <br>');
        print_r($_POST);
        
        if(strcmp($tipo_postagem,'concordo')==0){
            $texto_publicacao = @$_POST[$tipo_postagem.$id_postagem_pai];
            $tipo=1;
        }
        else if(strcmp($tipo_postagem,'discordo')==0){
            $texto_publicacao = @$_POST[$tipo_postagem.$id_postagem_pai];
            $tipo=0;
        }
        else{ 
            $tipo=null;
            $texto_publicacao = @$_POST['publicacao'];
        }

        echo('tipo: '.$tipo."<br>");

        echo('texto_publicacao: '.$texto_publicacao."<br>");
        
        echo("_SESSION['id_usuario']: ".$_SESSION['id_usuario']);


        //$relacao_nomes_arquivos_imagens = this ->salvar_imagens();
        $relacao_nomes_arquivos_imagens = Postagem::salvar_imagens($id_postagem_pai);

        $retorno="";
        
        if(strlen($texto_publicacao)>0){
            echo('entrou no if');
        
            $now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
            echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
            echo('passo 1');
        
            //$sth = $pdo ->prepare("INSERT into  postagens (id_usuario, id_postagem_pai, tipo, texto_conteudo, criacao, list_imagens) values(?,?,?,?,?,?) ;");
            //$sth ->execute(array($_SESSION['id_usuario'],$id_postagem_pai, $tipo, $texto_publicacao,$now->format('Y-m-d H:i:s'),$relacao_nomes_arquivos_imagens));
            

            $sth = $pdo ->prepare("INSERT into  postagem (id_usuario, id_postagem_pai, tipo, texto_conteudo, list_imagens) values(?,?,?,?,?) ;");
            //echo('passo 2');
            $sth ->execute(array($_SESSION['id_usuario'],$id_postagem_pai, $tipo, $texto_publicacao, $relacao_nomes_arquivos_imagens));
            //echo('passo 3');

            echo('<br>dump da $pdo <br>');

            var_dump($pdo);

            echo('<br>dump da $sth <br>');

            var_dump($sth);

            $retorno = $sth -> rowCount();

            echo('<br>Retorno da execução do banco: $sth -> fetch(PDO::FETCH_ASSOC) <br>');

            var_dump($retorno);

            
            //echo('passo 4');
        }
        return $retorno;
    }

    public function excluir_postagem($params){

        if (!isset($_SESSION)){
            //echo('<br>entrou no isset <br>');
            session_start();
    
        }

        $pdo = ConexaoBD::get_conexao();

        $id_postagem = @$params[0];

        $sql="";

        if(is_numeric($id_postagem) && @$_SESSION['id_usuario'] != null){

            $sql = "delete from postagem where id = ".$id_postagem." and id_usuario=".$_SESSION['id_usuario'];
            $executar = $pdo -> prepare($sql);
            $executar ->execute();

            $linha = $executar ->rowCount();

            if($linha > 0){

                return 1;

            }else{
                return 0;
            }
        }
    }

    public static function salvar_imagens($id_postagem_pai=""){

        $uploaddir = 'arquivos/imagens_postagens/';
        
        $imagem = 'imagem'.$id_postagem_pai;
        
        $countfiles = count($_FILES[$imagem]['name']);
        
        $relacao_nomes_arquivos_imagens = null;
        
        if($_FILES[$imagem]['name'][0]!=''){
            
            $relacao_nomes_arquivos_imagens = [];
            for ($i =0; $i<$countfiles; $i++) 
            {

                $aleatorio = md5(uniqid(rand(), true));
                
                $extensao = substr(strval($_FILES[$imagem]['name'][$i]),-4);
            
                $nome_arquivo = $aleatorio.$extensao;
            
                array_push($relacao_nomes_arquivos_imagens, $nome_arquivo);
                    
                $uploadfile = $uploaddir. $nome_arquivo;
                
                if (move_uploaded_file($_FILES[$imagem]['tmp_name'][$i], $uploadfile)) {
                    echo "Arquivo válido e enviado com sucesso.\n";
                } else {
                    echo "Possível ataque de upload de arquivo!\n";
                }

            
            }
            
            return json_encode($relacao_nomes_arquivos_imagens);
                    
        }
        return null;

    }
    public function listar_postagens(){

        $pdo = ConexaoBD::get_conexao();

        if (!isset($_SESSION)){
            //echo('<br>entrou no isset <br>');
            session_start();
    
        }
    
        //require('like_postagem.php');
    
        $id_usuario = @$_SESSION['id_usuario'];
    
        //echo("<br>"."SELECT texto_conteudo, id_postagem, list_imagens FROM POSTAGENS WHERE ID_PAI is NULL and id_usuario !=".$_SESSION['id_usuario'].";");
    
        $consulta = $pdo->query("SELECT texto_conteudo, id, id_usuario, list_imagens FROM POSTAGEM WHERE ID_POSTAGEM_PAI is null;");  
        // and id_usuario !=".$_SESSION['id_usuario'].";");
    
        //var_dump($consulta->fetchAll());
        return $consulta->fetchAll();
        
    }
    
    public function ler($params){

        $pdo = ConexaoBD::get_conexao();

        if (!isset($_SESSION)){
            //echo('<br>entrou no isset <br>');
            session_start();
    
        }

        $id_postagem = @$params[0];
   
        //require('like_postagem.php');
    
        //$id_usuario = @$_SESSION['id_usuario'];
    
        //echo("<br>"."SELECT texto_conteudo, id_postagem, list_imagens FROM POSTAGENS WHERE ID_PAI is NULL and id_usuario !=".$_SESSION['id_usuario'].";");
    
        //$consulta = $pdo->query("SELECT texto_conteudo, id, id_usuario FROM POSTAGEM WHERE ID_POSTAGEM_PAI is null;");  
        

        $consulta = $pdo ->prepare("SELECT texto_conteudo, id, id_usuario, list_imagens FROM POSTAGEM WHERE ID = ? ;");
            //echo('passo 2');
        $consulta ->execute(array($id_postagem));
            //echo('passo 3');

        
        // and id_usuario !=".$_SESSION['id_usuario'].";");

        return($consulta ->fetchAll());
        
    }

    public function listar_respostas($params, $tipo){

        $pdo = ConexaoBD::get_conexao();

        /*if (!isset($_SESSION)){
            //echo('<br>entrou no isset <br>');
            session_start();
    
        }*/

        $id_postagem = @$params[0];
    
        //require('like_postagem.php');
    
        //$id_usuario = @$_SESSION['id_usuario'];
    
        //echo("<br>"."SELECT texto_conteudo, id_postagem, list_imagens FROM POSTAGENS WHERE ID_PAI is NULL and id_usuario !=".$_SESSION['id_usuario'].";");
    
        $consulta = $pdo ->prepare("SELECT texto_conteudo, id, id_usuario, list_imagens FROM POSTAGEM WHERE id_postagem_pai  = ? and tipo = ? ;");
            //echo('passo 2');
        $consulta ->execute(array($id_postagem, $tipo));
            //echo('passo 3');

        
        // and id_usuario !=".$_SESSION['id_usuario'].";");

        return($consulta ->fetchAll());
        
    }
    
}

?>