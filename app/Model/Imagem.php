<?php

class Imagem{

    public function publicar($nome, $extensao, $id_postagem, $conteudo, $miniatura=null){

        $pdo = ConexaoBD::get_conexao();


        /*
        o parâmetro ativo é setado como 1 para ativo;
        -1 para inativo
        
        */

    }

    public function ler($id_postagem){

        //deve ser retornado um objeto ou array com todas as imagens de determinada postagem

    }

    public function inativar($id_postagem){

        //-1 no campo ativo

    }
    public function reativar($id_postagem){

        //1 no campo ativo

    }


}