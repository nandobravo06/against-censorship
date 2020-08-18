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
			
				<?php

					include('partial/cabecalho.php');

				?>
		
				<form class="col-12" enctype="multipart/form-data" action="publicar.php" method="POST">
					<legend>Em que você acredita?</legend>
					<div class="row">
						<input type="textarea" name="publicacao" class="form-control publicacao" rows="5">
						
						<input type="file" id="imagem" name="imagem[]"  multiple="multiple" accept="image/*" alt="Selecione imagens">

						<div id="dvPreview">
						</div>
						
						<input type="submit" name="publicar" value="publicar" class="form-control">
						
					</div>

				</form>
				

				<div class="col-12">

				<hr>

				<?php

				include('lista_publicacoes.php');

				?>

			</div>
		</div>

	</div>
	
</body>
</html>