<?php
session_start();
include('funciones.php');


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="./css/styles.css"> -->
    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="css/pruebaStyles.css">
    <title>Avecino - FAQ</title>
  </head>
  <body>
    <div class="containerCity containerFaq">
      <div class="transparentFaq">

<!-- HEADER -->
    		<header class="headerFaq">
    			<div class="logo">LOGO</div>
    			<?php if (existeParametro('usuario',$_SESSION)): ?>
    				<?php $usuario = $_SESSION['usuario']; ?>
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

        <section class="preguntas">
          <h1>Preguntas Frecuentes</h1>
          <div class="pregunta">
            <h2>¿Qué puedo hacer en el sitio?</h2>
            <p>Es un sitio dedicado a la compra, venta, alquiler de inmuebles, administración de los servicios relacionados con el inmueble y antes de comprar o alquilar podés saber que opinan los vecinos sobre el barrio.</p>
          </div>
          <div class="pregunta">
            <h2>¿Qué servicios puedo administrar?</h2>
            <p>Se pueden administrar todos los servicios relacionados con los inmbuebles, por ej servicio de telefonía, internet, luz, agua, gas, etc.</p>
          </div>
          <div class="pregunta">
            <h2>¿Puedo realizar una reserva de un inmbueble por la página?</h2>
            <p>Sí, puedes realizar por medio de nuestra plataforma de pagos, pero antes debes de estar registrado.</p>
          </div>
          <div class="pregunta">
            <h2>¿Cómo tengo que hacer para publicar un inmueble?</h2>
            <p>Primero debes estar registrado en la plataforma y debes de completar todos los datos requeridos.
              Una vez verificados los datos, será habilitado el usuario.</p>
            </div>
            <div class="pregunta">
              <h2>Clase de Publicaciones</h2>
              <p>Contamos con 3 opciones de publicaciones: Gratuita, Oro y Platino.</p>
            </div>
            <div class="pregunta">
              <h2>Duración de las publicaciones</h2>
              <p>La publicacion Gratuita, tiene una duración de 30 días, la Oro de 60 días y la Platino de 90 días.</p>
            </div>
            <div class="pregunta">
              <h2>¿Qué diferencia hay entre las publicaciones</h2>
              <p>Publicaciones Platino tendrás máxima exposición y saldrás en las primeras páginas, podrás cargar 10 fotos y un video.</p><br>
              <p>Publicaciones Oro tu aviso será resaltado y el primer mes expuesto dentro de las 10 primeras páginas, podrás cargar 10 fotos.</p><br>
              <p>Publicacion Gratuita, tendrás la opción de cargar 6 fotos.</p>
            </div>
            <div class="pregunta">
              <h2>Costo de publicación</h2>
              <p>Publicación Gratuita 0 costo, publicación Oro $500 por los 60 días y publicación Platino $ 900 por los 90 días.</p>
            </div>
          </section>
          <!-- FOOTER -->
          <div id="footer" class="footerFaq">

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
