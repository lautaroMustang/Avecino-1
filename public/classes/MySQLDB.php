<?php

/**
 *
 */
class MySQLDB {

  public function find($row, $value, $table, $class){
    $sql = "SELECT * FROM ".$table." WHERE ".$row." = '". $value. "'";

    $stmt= DB::getConn()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $model = new $class ([]);
      $model->toModel($result);
      return $model;
    }
  }

  public function save($table, $model)//model para no poner this y que choque
  {
    $sql = ($model->id)?$this->update($table, $model):$this->insert($table, $model);
    $stmt = DB::getConn()->prepare($sql);

    foreach ($model->fillable as $column) {
      $stmt->bindValue(":$column",$model->$column);
    }
    $stmt->execute();

  }
  private function insert($table, $model)
  {
    $columns = implode(', ',$model->fillable);
    $placeholders = ':'. implode(', :',$model->fillable);
    return "INSERT INTO ".$table." ($columns) VALUES ($placeholders)";
  }
  private function update($table, $model)
  {
    $set='';
    foreach ($model->fillable as $column) {
      $set .= $column."=:".$column.",";
    }
    $set = trim($set, ",");
    return "UPDATE ".$table." SET $set WHERE id = " .$model->id;
  }

  function esMailUnico($email,$id){
    $aux=true;
    $sql = "SELECT * FROM usuarios WHERE email = '".$email."' and id != ".$id;
    $stmt= DB::getConn()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      return $aux=false;
      }
    return $aux;
}



  //{

  //   $usuarios = json_decode(file_get_contents('usuarios.json'),true);
  //   if (is_null($usuarios)) {
  //     $usuarios = ['usuarios' => []];
  //   }
  //   foreach ($usuarios['usuarios'] as $indice => $usuario) {
  //     if ($usuario['email']==$email&&$usuario['id']!=$id) {
  //       return $aux=false;
  //     }
  //   }
  //   return $aux;
  // }
  //

}


 ?>
