<?php

class Usuario{
    public function cadastrar($login, $email, $hsenha, $id_pais, $id_estado, $id_cidade, $foto_perfil){

        /*
        parâmetro ativo: 
        0 ao cadastrar.
        1 quando confirmado o e-mail
        -1 quando inativo

        parâmetro id_permissao:
        1 nível de usuário
        2 administrador*/


    }

    public function alterar($id, $login, $email, $hsenha, $id_pais, $id_estado, $id_cidade, $foto_perfil){

        /*
        A alteração deve ser feita com base no parâmetro id no where
        */

    }

    public function inativar($id){

        /*
        A alteração deve ser feita com base no parâmetro id no where
        */

    }

    public function alterar_senha($id, $hsenha){

        /*
        A alteração deve ser feita com base no parâmetro id no where
        */

    }
    public function recuperar_senha($id){

        /*
            Deve ser solicitado que o usuário confirme o e-mail cadastrado, apresentando parcialmente o e-mail cadastrado.
            Sendo informado corretamente o e-mail cadastrado, informar que se foi informado o e-mail corretamente, foi enviado e-mail para recuperar senha.
        */

    }
    public function reativar($id){

        /*
        A alteração deve ser feita com base no parâmetro id no where
        */

    }
   
}