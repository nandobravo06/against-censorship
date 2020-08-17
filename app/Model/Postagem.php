<?php

Class Postagem{

    private $pdo = null; 

    function __construct(){

        $pdo = new PDO('mysql:host=localhost;dbname=vsm','root','');
    
    }
    
    function publicar_postagem(){

        $id_postagem_pai = @$_GET['id_postagem_pai'];
       
        $tipo_postagem = @$_POST['hidden'.$id_postagem_pai];
        
        $texto_publicacao="";
        $tipo=null;
        
        //print_r($_POST);
        
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
        }
        
        $relacao_nomes_arquivos_imagens = salvar_imagens();
        
        if(strlen($texto_publicacao)>0){
            //echo('entrou no if');
        
            $now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
            //echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
            //echo('passo 1');
        
            $sth = $pdo ->prepare("INSERT into  postagens (id_usuario, id_pai, tipo, texto_conteudo, criacao, list_imagens) values(?,?,?,?,?,?) ;");
            //echo('passo 2');
            $sth ->execute(array($_SESSION['id_usuario'],$id_postagem_pai, $tipo, $texto_publicacao,$now->format('Y-m-d H:i:s'),$relacao_nomes_arquivos_imagens));
            //echo('passo 3');
            $resultado  = $sth -> fetch(PDO::FETCH_ASSOC);
            //echo('passo 4');
        }
    }

    function excluir_postagem(){

        $id_postagem = @$_GET['id_postagem'];

        $sql="";

        if(is_numeric($id_postagem) && @$_SESSION['id_usuario'] != null){

            $sql = "delete from postagens where id_postagem = ".$id_postagem." and id_usuario=".$_SESSION['id_usuario'];
            $executar = $pdo -> prepare($sql);
            $executar ->execute();

            $linha = $executar ->rowCount();

            if($linha > 0){

                return json_encode("ok");

            }else{
                return json_encode("falha");
            }
        }
    }

    function salvar_imagens(){

        $uploaddir = 'arquivos/imagens_postagens/';
        
        $min = 100000000000;
        $max = 900000000000;
        
        $imagem = 'imagem'.$id_postagem_pai;
        
        $countfiles = count($_FILES[$imagem]['name']);
        
        $relacao_nomes_arquivos_imagens = null;
        
        if($_FILES[$imagem]['name'][0]!=''){
            
            $relacao_nomes_arquivos_imagens = [];
            for ($i =0; $i<$countfiles; $i++) 
            {
                
                //echo("passou aqui - ".$i);
            
                $aleatorio = strval(rand ($min, $max));
                $horario = strval(time());
                
                $extensao = substr(strval($_FILES[$imagem]['name'][$i]),-4);
            
                $nome_arquivo = $horario."_".$i."_".$aleatorio.$extensao;
            
                array_push($relacao_nomes_arquivos_imagens, $nome_arquivo);
                    
                $uploadfile = $uploaddir. $nome_arquivo;
            
                
                
                if (move_uploaded_file($_FILES[$imagem]['tmp_name'][$i], $uploadfile)) {
                    //echo "Arquivo válido e enviado com sucesso.\n";
                } else {
                    //echo "Possível ataque de upload de arquivo!\n";
                }

            
            }
            
            return json_encode($relacao_nomes_arquivos_imagens);
                    
        }

    }
}

?>