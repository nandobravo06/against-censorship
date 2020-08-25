<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	{{meta}}
	<?php
		include('./Template/Partial/meta.php');
	?>


</head>

<body>
	<div class="container">
		<div class="row">
			<h1>
				<a href="http://localhost/against-censorship/postagem">POSTAGEM</a>
			</h1>
			<div class="bloco_mensagem col-12">
				<h2>Minhas postagens com mais likes</h2>
				{{postagens_mais_likes}}
			</div>
			<div class="bloco_mensagem col-12">
				<h2>Minhas postagens com mais interações</h2>
				{{postagens_mais_interacoes}}
			</div>
			<div class="bloco_mensagem col-12">
				<h2>Minhas postagens com mais argumentos a favor</h2>
				{{postagens_mais_argumentos_favor}}
			</div>
			<div class="bloco_mensagem col-12">
				<h2>Minhas postagens com mais argumentos contra</h2>
				{{postagens_mais_argumentos_contra}}
			</div>
			<div class="bloco_mensagem col-12">
				<h2>Hashtags mais citadas nas respostas das minhas postagens </h2>
				{{hashtags_mais_citadas_respostas}}
			</div>
			
				
		</div>

	</div>
	
</body>
</html>