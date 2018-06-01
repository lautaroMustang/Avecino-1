<?php

	include('funciones.php');

	session_start();

	if (!existeParametro('usuario',$_SESSION)) {
		header("Location: login.php");
		exit;
	}

	$usuario = $_SESSION['usuario'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Avecino - Perfil de usuario</title>

	<!-- Metas -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Scripts -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

	<!-- Styles -->
	<link rel="stylesheet" href="css/pruebaStyles.css">
</head>
<body>
	<div class="containerCity">
		<div class="transparent">
<!-- HEADER -->
			<header>
				<div class="logo">LOGO</div>
				<?php if (existeParametro('usuario',$_SESSION)): ?>
					<div class="usuarioHeader">
						<a href="perfil.php">
						<label>
							<img src="<?= $usuario['image']?>" > <br> <?= $usuario['userName']?>
						</label>
						</a>
					</div>
				<?php else: ?>
					<a href="login.php"><button id="login-btn">Ingresar</button></a>
				<?php endif; ?>

			</header>
<!-- HEADER END -->

<!-- CONTENT -->
			<div class="containerForm login">
				<form method="post" enctype="multipart/form-data">
					<h1>Bienvenido</h1>
					<p><?= $usuario['name']?></p>
					<br>
					<p>Usuario: <?= $usuario['userName']?></p>
					<p>Email: <?= $usuario['email']?></p>
					<br>
					<p>
						<img src="<?= $usuario['image']?>" style="max-width: 200px;">
					</p>
					<br>
					<p class="recordarme">
						<a href="./logout.php">Cerrar sesión</a>
						|
						<a href="./modificar.php">Modifica tu perfil</a>
					</p>
				</form>
			</div>

<!-- FOOTER -->
			<div id="footer">
				<div id="footer-board">
					<div class="logo">LOGO</div>
					<ul>
						<li><a href="login.php">Ingresar</a></li>
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
