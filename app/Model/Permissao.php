<?php

class Permissao{

    /*no banco o campo $id funcionará como nível de acesso.
    Quanto maior o id, maior o nível de acesso
    Exemplo: uma pessoa com permissão id 5, pode acessar todas as páginas cadastradas
    nos ids 1, 2, 3, 4 e 5.
    Se houver id 6, a pessoa do nível id 5 não consegue visualizar as páginas do nível 6.
    Mas a pessoa do nível 6 pode ver as suas privativas (nível 6) e todos os inferiores.
    */

    public function cadastrar($novo_id, $descricao, $paginas ){

        /*Devido à tendência de na maior parte da manipulação da tabela de permissão 
        ser para alterar registros existentes, nesta tabela o campo ID não é autoincrement.        
        
        O campo páginas deve ser um array.
        */

    }

    public function alterar($id, $descricao, $paginas){

        //-1 no campo ativo

    }
    public function acrescentar_paginas($paginas, $id_minimo){
        /*
        $paginas será um array
        
        $id_minimo será para que quando for incluir páginas no banco, 
        o sistema faça loop para inserir a página aos ids superiores,
        a partid do $id_minimo, inclusive.
        */

    }
    public function remover_paginas($paginas, $id_maximo){
        /*
        $paginas será um array
        
        $id_maximo será para que quando for remover páginas do banco, 
        o sistema faça loop para remover a página dos ids inferiores até
        o $id_maximo, inclusive;
        */

    }

    public function excluir($id){

    }

}