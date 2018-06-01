<?php
	include('funciones.php');
	require './classes/Usuario.php';

	session_start();

	if (existeParametro('usuario',$_SESSION)) {
		header("Location: perfil.php");
		exit;
	}

	$email = dameValorDeParametro('email',$_POST);
	$password = dameValorDeParametro('password',$_POST);
	$recordarme = dameValorDeParametro('recordarme',$_POST);

	$infoUsuario = [];

	$error = false;
	$passwordError = false;

	if (existeParametro('submit', $_POST)) {
		if($email && $password) {
			$infoUsuario = Usuario::find('email',$email);

			if ($infoUsuario) {
				if (password_verify($password,$infoUsuario->password)) {
					$_SESSION['usuario'] = (array)$infoUsuario;
					if ($recordarme) {
						setcookie("email",$email);
						setcookie("password",$password);
					}
					header("Location: perfil.php");
					exit;
				} else {
					$error = true;
					$passwordError = true;
				}
			} else {
				$error = true;
			}
		} else {
			$error = true;
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Avecino - Registro</title>

	<!-- Metas -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Scripts -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

	<!-- Styles -->
	<link rel="stylesheet" href="css/pruebaStyles.css">
</head>
<body>
	<div class="containerCity containerLog">
		<div class="transparent">
			<!-- HEADER -->
			<header>
				<div class="logo">LOGO</div>
				<a href="register.php"><button id="login-btn">Registrarse</button></a>
			</header>
			<!-- HEADER END -->

			<!-- CONTENT -->
			<div class="containerForm login">
				<form method="post">
					<h1>Login</h1>
			<!-- Email Input -->
					<?php if($error && !$email):?>
						<input style="background-color:red" type="email" name="email" placeholder="Ingrese su email" value="<?= $email ?>">
					<?php else: ?>
						<?php if($error && !$infoUsuario): ?>
							<input style="background-color:red" type="email" name="email" placeholder="Email incorrecto. Reingrese">
						<?php else: ?>
							<?php if (isset($_COOKIE["email"])): ?>
								<input type="email" name="email" placeholder="Email" value="<?= $_COOKIE["email"] ?>">
							<?php else: ?>
								<input type="email" name="email" placeholder="Email" value="<?= $email ?>">
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
			<!-- Password Input -->
					<?php if($error && !$password):?>
						<input style="background-color:red" type="password" placeholder="Ingrese su password" name="password">
					<?php else: ?>
						<?php if($error && $passwordError): ?>
							<input style="background-color:red" type="password" placeholder="Error: La clave es invalida" name="password">
						<?php else: ?>
							<?php if (isset($_COOKIE["password"])): ?>
								<input type="password" placeholder="Contraseña" name="password" value="<?= $_COOKIE["password"] ?>">
							<?php else: ?>
								<input type="password" placeholder="Contraseña" name="password">
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
			<!--  Recordarme  -->
					<br>
					<label class="recordarme"> <input type="checkbox" name="recordarme" value="recordarme" >Recordarme</label>
					<button type="submit" name="submit">Enviar</button>
				</form>
			</div>
			<p>
				No tenes un cuenta? <a href="register.php">Registrate acá</a>
			<br>
			<br>
				No recordás tu contraseña?<a href="renuevaPassword.php?">Click acá</a>
			</p>
		<!-- CONTENT END -->
		<!-- FOOTER -->
			<div id="footer">
				<div id="footer-board">
					<div class="logo">LOGO</div>
					<ul>
						<li><a href="register.php">Registrarse</a></li>
						<li><a href="index.php">Inicio</a></li>
						<li><a href="faq.php">FAQ</a></li>
						<li><a href="#">Contactar</a></li>
					</ul>
				</div>
			</div>
		<!-- FOOTER END -->


		</div>
	</div>

</body>
</html>
