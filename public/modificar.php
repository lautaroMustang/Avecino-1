<?php
	include('funciones.php');
	require './classes/Usuario.php';

  session_start();
  if (!existeParametro('usuario',$_SESSION)) {
		header("Location: login.php");
		exit;
	}
  $usuario = $_SESSION['usuario'];

	$existeFile = existeFileSinError('image');
	$name =array_key_exists('name',$_POST)&&$_POST['name']?$_POST['name']: $usuario['userName'];
	$email = array_key_exists('email',$_POST)&&$_POST['email']?$_POST['email']:$usuario['email'];
	$password = dameValorDeParametro('password',$_POST);

	$infoUsuario = [];
	$usuarioModificado=[];
	$errorMailExiste=false;

	$error = false;
	$passwordError = false;
	$infoUsuario=Usuario::find('id',$usuario['id']);
	if (existeParametro('submit',$_POST)) {
		if ($email&&$password&&$name&&$existeFile) {
			if (password_verify($password,$usuario['password'])) {
				if ($infoUsuario) {
					if ($infoUsuario->esMailUnico($email,$_SESSION['usuario']['id'])) {
						$arrayAGuardar=$_POST; //prepara el el array a guardar
						$user=new Usuario($arrayAGuardar); //crea objeto usuario
						$user->setImage(guardarArchivoSubido('image'));// guarda archivo y carga la dir en objeto usuario
						$user->setPassword($password);
						$user->setUserName($_SESSION['usuario']['userName']);
						$user->setId($_SESSION['usuario']['id']);
						$user->save(); //guarda usuario
						$_SESSION['usuario'] = (array)$user;//guardar en sesión
					}else {
						$error=true;
						$errorMailExiste=true;
					}

				}else {
					$error=true;
				}
			}
			else {
				$error=true;
				$passwordError=true;
			}
		}
		else {
			$error=true;
		}
	}
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Avecino - Modificar Perfil</title>

 	<!-- Metas -->
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<!-- Scripts -->
 	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

 	<!-- Styles -->
 	<link rel="stylesheet" href="css/pruebaStyles.css">
 </head>
 <body>
 	<div class="containerCity containerReg">
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

<div class="containerForm registro">

	 <form method="post" enctype="multipart/form-data">

	 <h1>Modificar datos</h1>

		<?php if($error && !$infoUsuario): ?>
			<p>
				<span>Error: el usuario no existe en la base de datos</span>
			</p>

		<?php endif; ?>
		<?php if($error && $errorMailExiste): ?>
			<p>
				<span>Error: el usuario/mail ya existe en la base de datos</span>
			</p>

		<?php endif; ?>

		<input type="text" name="name" placeholder="Nombre" value="<?= $name?>" alt="Usuario">
		<?php if($error && !$name):?>
			<span>Ingrese su nombre</span>
		<?php endif; ?>

		<input type="email" name="email" placeholder="Email" value="<?= $email?>">
		<?php if($error && !$email):?>
			<span>Cambie su email</span>
		<?php endif; ?>

		<input type="password" placeholder="Contraseña" name="password">
		<?php if($error && !$password):?>
			<span>Ingrese su password</span>
		<?php endif; ?>
		<?php if ($error && $passwordError): ?>
			<span>Password erronea. Reingrese</span>
		<?php endif; ?>

		<label for="image" >Insertar imagen:</label>
		<input type="file" name="image">
		<?php if($error && !$existeFile):?>
			<span>Cambie su imagen</span>
		<?php endif; ?>

		<button type="submit" name="submit">Enviar</button>

 	</form>
</div>
<!-- CONTENT END -->
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
