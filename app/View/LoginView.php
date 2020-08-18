<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	{{meta}}
	<?php
		include('./Template/Partial/meta.php');
	?>


</head>

<body>
	<div class="container">

		<div class="row">
			<form class="col-12" action="login/logar" method="POST">
				<div class="row">
					<legend>Login</legend>
					<input type="text" name="login" class="form-control">
					<legend>Senha</legend>
					<input type="password" name="senha" class="form-control">
					<input type="submit" name="enviar" value="enviar">
				</div>
			</form>
		</div>
	</div>

</body>
</html>