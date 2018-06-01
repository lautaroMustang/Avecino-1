<?php
require '../classes/Usuario.php';

  $registros = json_decode(file_get_contents('../usuarios.json'),true);
  if (is_null($registros)) {
    $registros = ['usuarios' => []];
    }

  $contador=0;

      DBFactory::$db_type = 'MySQLDB';
      foreach ($registros['usuarios'] as $indice => $registro) {

        $user=new Usuario($registro); //crea objeto usuario
        $user->setId(null);
        $user->save(); //guarda usuario

        echo "Migrado campo :".$contador.' '.$user->getUserName();
        echo "<br>";
        $contador++;
      }


 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Migrar de JSon a MySQLDB</title>
   </head>
   <body>
       <a href="peparacionDeDb.php">Volver</a>
   </body>
 </html>
