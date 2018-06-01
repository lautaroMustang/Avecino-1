<?php
include('../funciones.php');
$host="localhost";

$root="root";
$root_password=dameValorDeParametro('password',$_POST); //ingresar su password de db

$db="newdb";
$passwordError=dameValorDeParametro('errorPassword', $_POST);


if (existeParametro('submit', $_POST)) {
  try {

      $dbh = new PDO("mysql:host=$host", $root, $root_password);

      $dbh->exec("
      DROP DATABASE IF EXISTS avecino;
      CREATE SCHEMA avecino ;
      USE avecino;
      DROP TABLE IF EXISTS usuarios;
      CREATE TABLE usuarios (
      `id` INT NOT NULL AUTO_INCREMENT,
      `userName` VARCHAR(50) NULL,
      `email` VARCHAR(50) NULL,
      `password` VARCHAR(255) NULL,
      `name` VARCHAR(50) NULL,
      `image` VARCHAR(120) NULL,
      PRIMARY KEY (`id`));
      INSERT INTO `avecino`.`usuarios` (`userName`, `email`, `password`, `name`,`image`) VALUES ('a', 'a@a.com', 'a', 'a','a');
        ");
      echo "Base creada satisfactoriamente";
      
  } catch (PDOException $e) {
    header("Location: creaDbMYSQL.php?errorPassword=1");
      die("DB ERROR: ". $e->getMessage());

  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crear base de datos MySQL</title>
  </head>
  <body>
    <form method="post">
      <?php if ($passwordError): ?>
        <label for="password">PASSWORD INCORRECTA Ingrese la password del user ROOT de su conexión a bd (si no usa password haga clic directamente)</label>
        <input type="text" name="password" value="">
        <?php else: ?>
          <label for="password">Ingrese la password del user ROOT de su conexión a bd (si no usa password haga clic directamente)</label>
          <input type="text" name="password" value="">
      <?php endif; ?>

      <button type="submit" name="submit">Enviar</button>
    </form>

    <a href="peparacionDeDb.php">Volver</a>
  </body>
</html>
