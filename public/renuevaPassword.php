<?php
	include('funciones.php');
	require './classes/Usuario.php';

	session_start();

	if (existeParametro('usuario',$_SESSION)) {
		header("Location: perfil.php");
		exit;
	}

	$email = dameValorDeParametro('email',$_POST);
	$codigo= dameValorDeParametro('codigo',$_POST,rand(1,50000));
	$password = dameValorDeParametro('password',$_POST);
	$password2 = dameValorDeParametro('password2',$_POST);
	$codigoIngresadoPorUsuario= dameValorDeParametro('codigoIngresadoPorUsuario',$_POST);
	echo 'El codigo a ingresar es: '.($codigo);

	$infoUsuario;

	$error = false;
	$errorReingresoPassword=false;

	if (existeParametro('submit', $_POST)) {
		if($email) {
			$infoUsuario = Usuario::find('email',$email);
			if ($infoUsuario) {
				if (!$codigo) {
					mail($email, 'Codigo', $codigo);
				}
				if ($codigo!=null && $password!==null && $password2!=null && $codigoIngresadoPorUsuario==$codigo && $password==$password2) {
					// $nuevaPassword=password_hash($password,PASSWORD_DEFAULT);
					// modificarCampoUsuario($nuevaPassword,$infoUsuario['posicion'],'password');
					$infoUsuario->setPassword($password);
					$infoUsuario->save();
					header("Location: login.php");
					exit;
				}else {
					$errorReingresoPassword=true;
					$error = true;
				}


			} else {
				$error = true;
			}
		} else {
			$error = true;
		}
	}
//echo "$codigo";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Avecino - Renová tu contraseña</title>

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
							<h1>Password</h1>

								<!-- Email Input -->
							<?php if($error && !$email):?>
								<input style="background-color:red" type="email" name="email" placeholder="Ingrese su email" value="<?= $email ?>">
								<?php else: ?>
									<?php if($error && !$infoUsuario): ?>
										<input style="background-color:red" type="email" name="email" placeholder="Email incorrecto. Reingrese">
									<?php else: ?>
										<?php if ($email&&!$codigoIngresadoPorUsuario): ?>
											<input type="text" name="codigoIngresadoPorUsuario" placeholder="Código Recibido">
											<input type="hidden" name="codigo" value="<?=$codigo?>">
											<input type="email" hidden="true" name="email" value="<?=$email?>">
											<?php else: ?>
												<?php if ($email&&$codigoIngresadoPorUsuario==$codigo): ?>
													<input type="email" hidden="true" name="email" value="<?=$email?>">
													<input type="hidden" name="codigo" value="<?=$codigo?>">
													<input type="hidden" name="codigoIngresadoPorUsuario" value="<?=$codigoIngresadoPorUsuario?>">
													<?php else: ?>
														<span>Código incorrecto, Reingrese mail</span>
														<input type="email" name="email" placeholder="Email">
														<input type="hidden" name="codigo" value="<?=$codigo?>">
												<?php endif; ?>
											<?php endif; ?>
									<?php endif; ?>
							<?php endif; ?>

							<?php if (!$email): ?>
								<label>Ingrese su mail y reciba el código</label>
							<?php endif; ?>

<!-- Campos ingreso Password Input -->
							<?php if ($codigoIngresadoPorUsuario==$codigo): ?>
								<!-- Password Input -->
								<?php if($error && !$password):?>
									<input type="password" placeholder="* Ingrese su contraseña" name="password">
								<?php else: ?>
									<input type="password" placeholder="Nueva Contraseña" name="password">
								<?php endif; ?>

								<!-- Password Input 2 -->

								<?php if($error && !$password2):?> <!--validacion de password2-->
									<input type="password" placeholder="* Confirme su password" name="password2">
								<?php else: ?>
									<?php if ($error && $errorReingresoPassword) :?>
										<input style="background-color:red" type="password" placeholder="Las contraseñas no coinciden" name="password2">
									<?php else: ?>
										<input type="password" placeholder="Repetir contraseña" name="password2">
									<?php endif;  ?>
								<?php endif; ?>
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
