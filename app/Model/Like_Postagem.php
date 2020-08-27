<?php

require_once('ConexaoBD.php');



if (!isset($_SESSION)){
	//echo('<br>entrou no isset <br>');
	session_start();

}

function verificar_postagem($id_postagem){
	$pdo = ConexaoBD::get_conexao();

	$consulta = $pdo -> query("select * from like_postagem where id_postagem = ".$id_postagem." and id_usuario=".$_SESSION['id_usuario']);

	return $consulta -> rowCount();

}

function obter_likes_postagem($id_postagem){
	$pdo = ConexaoBD::get_conexao();

	$consulta = $pdo -> query("select * from like_postagem where id_postagem = ".$id_postagem);

	return $consulta -> rowCount();

}

function obter_imagem_like_postagem($id_postagem){

	$resultado = verificar_postagem($id_postagem);
	if($resultado==0){
		return "http://localhost/against-censorship/img/neutro.jpg";
	}
	else{
		return "http://localhost/against-censorship/img/like.jpg";
	}

}


$id_postagem = @$_POST['id_postagem'];

$sql="";

$pdo = ConexaoBD::get_conexao();

if(is_numeric($id_postagem)){

	
	$linha = verificar_postagem($id_postagem);
	//echo("linhas retornadas: ".$linha);

	if($linha>0){

		$sql = "delete from like_postagem where id_postagem = ".$id_postagem." and id_usuario=".$_SESSION['id_usuario'];
		$executar = $pdo -> prepare($sql);
		$executar ->execute();

		//$linha = $executar ->rowCount();
		//echo($sql);

		$likes = obter_likes_postagem($id_postagem);
		$resposta = array('likes'=>strval($likes), 'status'=>'0');

		die(json_encode($resposta));

	}
	else{

		$sql = "insert into like_postagem (id_postagem, id_usuario) values (".$id_postagem.", ".$_SESSION['id_usuario'].")";
		$executar = $pdo -> prepare($sql);
		$executar ->execute();

		//$linha = $executar ->rowCount();
		//echo($sql);

		$likes = obter_likes_postagem($id_postagem);
		$resposta = array('likes'=>strval($likes), 'status'=>'1');

		die(json_encode($resposta));

	}
}

?> 