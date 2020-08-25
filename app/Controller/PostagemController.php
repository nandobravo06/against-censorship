<?php

include_once('app/Model/Postagem.php');
include_once('app/View/Renderizador.php');

class PostagemController{

    public function index($parametros){

        //echo ('homecontroller index');

        if (!isset($_SESSION)){
            
            session_start();
        }

        if (isset($_SESSION['logado']) && $_SESSION['logado'] ){
            
            PostagemController::listar_postagens();
            
        }

    }

    public static function publicar_postagem($parametros){

        $postagem = new Postagem;
        $retorno = $postagem ->publicar_postagem($parametros);

        if($retorno ==1){header(
            'location:'.$GLOBALS['url'].'postagem');
        }else{
            echo("erro ao postar");
        }

    }

    public static function excluir_postagem($parametros){

        $postagem = new Postagem;
        $retorno = $postagem ->excluir_postagem($parametros);

        if($retorno ==1){
            header('location:'.$GLOBALS['url'].'postagem');
        }else{
            echo("erro ao excluir postagem");
        }

    }

    public static function listar_postagens(){

        $postagem = new Postagem;
        $retorno = $postagem ->listar_postagens();

        //echo("entrou no listar postagem do postagemcontroller");

        //var_dump($retorno);

        $id_usuario = $_SESSION['id_usuario'];

        $html_postagens="";

        foreach ($retorno as $linha) {

            $texto = "{$linha['texto_conteudo']}";

            $id_postagem = "{$linha['id']}";
             
            $html_postagens.='<a class="col-11 postagens-publicadas" href="{{url}}postagem/ler/'.$id_postagem.'">
                <span class="col-11" name="publicacao'.$id_postagem.'">'.$texto.'</span></a>';
                
                if(strcmp($id_usuario,"{$linha['id_usuario']}")==0){
                    $html_postagens.='<div class="col-1 lixeira"><a href="{{url}}postagem/excluir_postagem/'.$id_postagem.'"><img src="/vsm/img/lixeira.png" class="lixeira"/></a></div>';
                }
                
                //echo('</span></a>');

                

            //$relacao_nomes_arquivos_imagens = json_decode("{$linha['list_imagens']}");

            //$quantidade_arquivos_imagens=0;

            /*

            if($relacao_nomes_arquivos_imagens!=[]){
                $quantidade_arquivos_imagens = count($relacao_nomes_arquivos_imagens);
                echo('<div class="col-12">');

                foreach($relacao_nomes_arquivos_imagens as $imagem){
                    //echo(strval($imagem)."<br>");
                    echo('<img width="200" height="200" class="imagem" src="/vsm/arquivos/imagens_postagens/'.$imagem.'"/>');
                    //print_r('aqui');
                }
                echo('</div>');
            }*/

            


            //echo('<img id="like_postagem'.$id_postagem.'" class="like" src="'.obter_imagem_like_postagem($id_postagem).'" onclick="like_postagem('.$id_postagem.')"/>');
            //echo('<div id="likes_postagem'.$id_postagem.'" class="col-11 quatidade_likes">'.obter_likes_postagem($id_postagem).'</div><hr>');
            $html_postagens.='<a href="#divconcordo"'.$id_postagem.'" class="form-control col-md-6 concordo"
            rel="modal:open">Concordo</a><br>';
            //echo('<a href="#ex1"  rel="modal:open">Open Modal</a></p>');
            //echo('<input type="button" value="concordo"  class="form-control col-md-6" onclick="concordo('.$id_postagem.')"/><br>');
            //echo('<input type="button" value="discordo" class="form-control col-md-6" onclick="discordo('.$id_postagem.')"/><br>');
            $html_postagens.='<div id="divconcordo"'.$id_postagem.' class="modal modal-concordo">';
            $html_postagens.='<form name="form'.$id_postagem.'" id="form'.$id_postagem.'" class="col-12" class="form-control" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem/'.$id_postagem.'" method="POST">';
            $html_postagens.='<input type="hidden" name="hidden'.$id_postagem.'" id="hidden'.$id_postagem.'" value="concordo">';
            $html_postagens.='<textarea name="concordo'.$id_postagem.'" id="concordo'.$id_postagem.'" placeholder="concordo" class="form-control modal-publicacao" rows="5"></textarea>';
            //echo('<input type="textarea" name="discordo'.$id_postagem.'" id="discordo'.$id_postagem.'" placeholder="discordo" class="form-control" rows="5"/>');
            $html_postagens.='<input type="file" id="imagem'.$id_postagem.'[]" name="imagem'.$id_postagem.'[]" multiple accept="image/*" alt="Selecione imagens">';
            $html_postagens.='<input type="submit" id="submit'.$id_postagem.'" value="enviar resposta" class="form-control">';
            $html_postagens.='</form>';
            $html_postagens.='</div>';

            $html_postagens.='<a href="#divdiscordo"'.$id_postagem.'" class="form-control col-md-6 discordo" 
            rel="modal:open">Discordo</a><br>';
            //echo('<a href="#ex1"  rel="modal:open">Open Modal</a></p>');
            //echo('<input type="button" value="concordo"  class="form-control col-md-6" onclick="concordo('.$id_postagem.')"/><br>');
            //echo('<input type="button" value="discordo" class="form-control col-md-6" onclick="discordo('.$id_postagem.')"/><br>');
            $html_postagens.='<div id="divdiscordo"'.$id_postagem.' class="modal modal-discordo">';
            $html_postagens.='<form name="form'.$id_postagem.'" id="form'.$id_postagem.'" class="col-12" class="form-control" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem/'.$id_postagem.'" method="POST">';
            $html_postagens.='<input type="hidden" name="hidden'.$id_postagem.'" id="hidden'.$id_postagem.'" value="discordo">';
            //echo('<input type="textarea" name="concordo'.$id_postagem.'" id="concordo'.$id_postagem.'" placeholder="concordo" class="form-control" rows="5"/>');
            $html_postagens.='<textarea name="discordo'.$id_postagem.'" id="discordo'.$id_postagem.'" placeholder="discordo" class="form-control modal-publicacao" rows="5"></textarea>';
            $html_postagens.='<input type="file" id="imagem'.$id_postagem.'[]" name="imagem'.$id_postagem.'[]" multiple accept="image/*" alt="Selecione imagens">';
            $html_postagens.='<input type="submit" id="submit'.$id_postagem.'" value="enviar resposta" class="form-control">';
            $html_postagens.='</form>';
            
            $html_postagens.='</div>';

        }

        $renderizador = new Renderizador();
        $renderizador ->montar('app/View/PostagemView.php',
        ['{{postagens}}'],
        [$html_postagens]);
/*
        $tela = file_get_contents('app/View/PostagemView.php');
        $meta = str_replace('{{url}}',$GLOBALS['url'],file_get_contents('app/View/Template/Partial/meta.php'));
        $tela = str_replace('{{meta}}',$meta,$tela);
        $tela = str_replace('{{postagens}}',$html_postagens,$tela);
        $tela = str_replace('{{url}}',$GLOBALS['url'],$tela);

        echo($tela);
*/

    }

    public static function ler($parametros){

        $postagem = new Postagem;
        $retorno = $postagem ->ler($parametros);

        //echo("entrou no listar postagem do postagemcontroller");

        //var_dump($retorno);

        $id_usuario = $_SESSION['id_usuario'];

        $html_postagens="";

        foreach ($retorno as $linha) {

            $texto = "{$linha['texto_conteudo']}";

            $id_postagem = "{$linha['id']}";
             
            $html_postagens.='
                <span class="col-11 postagens-publicadas" name="publicacao'.$id_postagem.'">'.$texto.'</span>';
                
                if(strcmp($id_usuario,"{$linha['id_usuario']}")==0){
                    $html_postagens.='<div class="col-1 lixeira"><a href="{{url}}postagem/excluir_postagem/'.$id_postagem.'"><img src="/vsm/img/lixeira.png" class="lixeira"/></a></div>';
                }
                
                //echo('</span></a>');

                

            //$relacao_nomes_arquivos_imagens = json_decode("{$linha['list_imagens']}");

            //$quantidade_arquivos_imagens=0;

            /*

            if($relacao_nomes_arquivos_imagens!=[]){
                $quantidade_arquivos_imagens = count($relacao_nomes_arquivos_imagens);
                echo('<div class="col-12">');

                foreach($relacao_nomes_arquivos_imagens as $imagem){
                    //echo(strval($imagem)."<br>");
                    echo('<img width="200" height="200" class="imagem" src="/vsm/arquivos/imagens_postagens/'.$imagem.'"/>');
                    //print_r('aqui');
                }
                echo('</div>');
            }*/

            


            //echo('<img id="like_postagem'.$id_postagem.'" class="like" src="'.obter_imagem_like_postagem($id_postagem).'" onclick="like_postagem('.$id_postagem.')"/>');
            //echo('<div id="likes_postagem'.$id_postagem.'" class="col-11 quatidade_likes">'.obter_likes_postagem($id_postagem).'</div><hr>');
            $html_postagens.='<a href="#divconcordo"'.$id_postagem.'" class="form-control col-md-6 concordo"
            rel="modal:open">Concordo</a><br>';
            //echo('<a href="#ex1"  rel="modal:open">Open Modal</a></p>');
            //echo('<input type="button" value="concordo"  class="form-control col-md-6" onclick="concordo('.$id_postagem.')"/><br>');
            //echo('<input type="button" value="discordo" class="form-control col-md-6" onclick="discordo('.$id_postagem.')"/><br>');
            $html_postagens.='<div id="divconcordo"'.$id_postagem.' class="modal modal-concordo">';
            $html_postagens.='<form name="form'.$id_postagem.'" id="form'.$id_postagem.'" class="col-12" class="form-control" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem/'.$id_postagem.'" method="POST">';
            $html_postagens.='<input type="hidden" name="hidden'.$id_postagem.'" id="hidden'.$id_postagem.'" value="concordo">';
            $html_postagens.='<textarea name="concordo'.$id_postagem.'" id="concordo'.$id_postagem.'" placeholder="concordo" class="form-control modal-publicacao" rows="5"></textarea>';
            //echo('<input type="textarea" name="discordo'.$id_postagem.'" id="discordo'.$id_postagem.'" placeholder="discordo" class="form-control" rows="5"/>');
            $html_postagens.='<input type="file" id="imagem'.$id_postagem.'[]" name="imagem'.$id_postagem.'[]" multiple accept="image/*" alt="Selecione imagens">';
            $html_postagens.='<input type="submit" id="submit'.$id_postagem.'" value="enviar resposta" class="form-control">';
            $html_postagens.='</form>';
            $html_postagens.='</div>';

            $html_postagens.='<a href="#divdiscordo"'.$id_postagem.'" class="form-control col-md-6 discordo" 
            rel="modal:open">Discordo</a><br>';
            //echo('<a href="#ex1"  rel="modal:open">Open Modal</a></p>');
            //echo('<input type="button" value="concordo"  class="form-control col-md-6" onclick="concordo('.$id_postagem.')"/><br>');
            //echo('<input type="button" value="discordo" class="form-control col-md-6" onclick="discordo('.$id_postagem.')"/><br>');
            $html_postagens.='<div id="divdiscordo"'.$id_postagem.' class="modal modal-discordo">';
            $html_postagens.='<form name="form'.$id_postagem.'" id="form'.$id_postagem.'" class="col-12" class="form-control" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem/'.$id_postagem.'" method="POST">';
            $html_postagens.='<input type="hidden" name="hidden'.$id_postagem.'" id="hidden'.$id_postagem.'" value="discordo">';
            //echo('<input type="textarea" name="concordo'.$id_postagem.'" id="concordo'.$id_postagem.'" placeholder="concordo" class="form-control" rows="5"/>');
            $html_postagens.='<textarea name="discordo'.$id_postagem.'" id="discordo'.$id_postagem.'" placeholder="discordo" class="form-control modal-publicacao" rows="5"></textarea>';
            $html_postagens.='<input type="file" id="imagem'.$id_postagem.'[]" name="imagem'.$id_postagem.'[]" multiple accept="image/*" alt="Selecione imagens">';
            $html_postagens.='<input type="submit" id="submit'.$id_postagem.'" value="enviar resposta" class="form-control">';
            $html_postagens.='</form>';
            
            $html_postagens.='</div>';

        }

        
        $postagens_concordo = PostagemController::listar_respostas($parametros, 1);
        $respostas="";
        if(!strcmp($postagens_concordo,"")==0){
            $respostas = '<br><br><br><br><br><br><h1>RESPOSTAS CONCORDO</h1><br><br>';
            $respostas .=$postagens_concordo;
        }
        
        $postagens_discordo = PostagemController::listar_respostas($parametros, 0);

        if(!strcmp($postagens_discordo,"")==0){
            $respostas .= '<br><br><br><br><br><br><h1>RESPOSTAS DISCORDO</h1><br><br>';
            $respostas .=$postagens_discordo;
        }


        $renderizador = new Renderizador();
        $renderizador ->montar('app/View/PostagemView.php',
        ['{{postagens}}','{{nova_postagem}}','{{respostas}}'],
        [$html_postagens,'',$respostas]);

        /*$tela = file_get_contents('app/View/PostagemView.php');
        $meta = file_get_contents('app/View/Template/Partial/meta.php');


        $meta = str_replace('{{url}}',$GLOBALS['url'],file_get_contents('app/View/Template/Partial/meta.php'));
        $nova_postagem = str_replace('{{nova_postagem}}',$GLOBALS['url'],file_get_contents('app/View/Template/Partial/nova_postagem.php'));

        $tela = str_replace('{{nova_postagem}}',$nova_postagem,$tela);
        $tela = str_replace('{{meta}}',$meta,$tela);



        echo($tela);*/

    }

    public static function listar_respostas($params, $tipo){

        $postagem = new Postagem;
        $retorno = $postagem ->listar_respostas($params, $tipo);

        //echo("entrou no listar postagem do postagemcontroller");

        //var_dump($retorno);

        $id_usuario = $_SESSION['id_usuario'];

        $html_postagens="";

        foreach ($retorno as $linha) {

            $texto = "{$linha['texto_conteudo']}";

            $id_postagem = "{$linha['id']}";
             
            $html_postagens.='<a class="col-11 postagens-publicadas" href="{{url}}postagem/ler/'.$id_postagem.'">
                <span class="col-11" name="publicacao'.$id_postagem.'">'.$texto.'</span></a>';
                
                if(strcmp($id_usuario,"{$linha['id_usuario']}")==0){
                    $html_postagens.='<div class="col-1 lixeira"><a href="{{url}}postagem/excluir_postagem/'.$id_postagem.'"><img src="/vsm/img/lixeira.png" class="lixeira"/></a></div>';
                }
                
                //echo('</span></a>');

                

            //$relacao_nomes_arquivos_imagens = json_decode("{$linha['list_imagens']}");

            //$quantidade_arquivos_imagens=0;

            /*

            if($relacao_nomes_arquivos_imagens!=[]){
                $quantidade_arquivos_imagens = count($relacao_nomes_arquivos_imagens);
                echo('<div class="col-12">');

                foreach($relacao_nomes_arquivos_imagens as $imagem){
                    //echo(strval($imagem)."<br>");
                    echo('<img width="200" height="200" class="imagem" src="/vsm/arquivos/imagens_postagens/'.$imagem.'"/>');
                    //print_r('aqui');
                }
                echo('</div>');
            }*/

            
            /*

            //echo('<img id="like_postagem'.$id_postagem.'" class="like" src="'.obter_imagem_like_postagem($id_postagem).'" onclick="like_postagem('.$id_postagem.')"/>');
            //echo('<div id="likes_postagem'.$id_postagem.'" class="col-11 quatidade_likes">'.obter_likes_postagem($id_postagem).'</div><hr>');
            $html_postagens.='<a href="#divconcordo"'.$id_postagem.'" class="form-control col-md-6 concordo"
            rel="modal:open">Concordo</a><br>';
            //echo('<a href="#ex1"  rel="modal:open">Open Modal</a></p>');
            //echo('<input type="button" value="concordo"  class="form-control col-md-6" onclick="concordo('.$id_postagem.')"/><br>');
            //echo('<input type="button" value="discordo" class="form-control col-md-6" onclick="discordo('.$id_postagem.')"/><br>');
            $html_postagens.='<div id="divconcordo"'.$id_postagem.' class="modal modal-concordo">';
            $html_postagens.='<form name="form'.$id_postagem.'" id="form'.$id_postagem.'" class="col-12" class="form-control" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem/'.$id_postagem.'" method="POST">';
            $html_postagens.='<input type="hidden" name="hidden'.$id_postagem.'" id="hidden'.$id_postagem.'" value="concordo">';
            $html_postagens.='<textarea name="concordo'.$id_postagem.'" id="concordo'.$id_postagem.'" placeholder="concordo" class="form-control modal-publicacao" rows="5"></textarea>';
            //echo('<input type="textarea" name="discordo'.$id_postagem.'" id="discordo'.$id_postagem.'" placeholder="discordo" class="form-control" rows="5"/>');
            $html_postagens.='<input type="file" id="imagem'.$id_postagem.'[]" name="imagem'.$id_postagem.'[]" multiple accept="image/*" alt="Selecione imagens">';
            $html_postagens.='<input type="submit" id="submit'.$id_postagem.'" value="enviar resposta" class="form-control">';
            $html_postagens.='</form>';
            $html_postagens.='</div>';

            $html_postagens.='<a href="#divdiscordo"'.$id_postagem.'" class="form-control col-md-6 discordo" 
            rel="modal:open">Discordo</a><br>';
            //echo('<a href="#ex1"  rel="modal:open">Open Modal</a></p>');
            //echo('<input type="button" value="concordo"  class="form-control col-md-6" onclick="concordo('.$id_postagem.')"/><br>');
            //echo('<input type="button" value="discordo" class="form-control col-md-6" onclick="discordo('.$id_postagem.')"/><br>');
            $html_postagens.='<div id="divdiscordo"'.$id_postagem.' class="modal modal-discordo">';
            $html_postagens.='<form name="form'.$id_postagem.'" id="form'.$id_postagem.'" class="col-12" class="form-control" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem/'.$id_postagem.'" method="POST">';
            $html_postagens.='<input type="hidden" name="hidden'.$id_postagem.'" id="hidden'.$id_postagem.'" value="discordo">';
            //echo('<input type="textarea" name="concordo'.$id_postagem.'" id="concordo'.$id_postagem.'" placeholder="concordo" class="form-control" rows="5"/>');
            $html_postagens.='<textarea name="discordo'.$id_postagem.'" id="discordo'.$id_postagem.'" placeholder="discordo" class="form-control modal-publicacao" rows="5"></textarea>';
            $html_postagens.='<input type="file" id="imagem'.$id_postagem.'[]" name="imagem'.$id_postagem.'[]" multiple accept="image/*" alt="Selecione imagens">';
            $html_postagens.='<input type="submit" id="submit'.$id_postagem.'" value="enviar resposta" class="form-control">';
            $html_postagens.='</form>';
            
            $html_postagens.='</div>';
            */

        }

        return $html_postagens;
/*
        $tela = file_get_contents('app/View/PostagemView.php');
        $meta = str_replace('{{url}}',$GLOBALS['url'],file_get_contents('app/View/Template/Partial/meta.php'));
        $tela = str_replace('{{meta}}',$meta,$tela);
        $tela = str_replace('{{postagens}}',$html_postagens,$tela);
        $tela = str_replace('{{url}}',$GLOBALS['url'],$tela);

        echo($tela);
*/

    }

}