<?php 

class ConexaoBD{

    public static function get_conexao(){

        return new PDO('mysql:host=localhost;dbname=vsm','root','');

    }

    

}
