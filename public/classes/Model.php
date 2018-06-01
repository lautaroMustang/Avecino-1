<?php

require_once 'DBFactory.php';
require_once 'MySQLDB.php';
require_once 'JsonDB.php';

	DBFactory::$db_type = 'JsonDB'; //ELEGIR DB MySQLDB JsonDB
/**
 *
 */
class Model{

  public function __construct($data)
  {
    $this->toModel($data);
  }
  public static function find($row, $value){
    return DBFactory::getDB()->find($row, $value, static::$table, get_called_class());
  }

  public function toModel($data)
  {
    if (isset($data['id'])) {
      $this->id = $data['id'];
    }
      foreach ($data as $key => $value) {
      if (in_array($key, $this->fillable)) {
        $this->$key = $value;
      }
    }
  }
  public function save()
  {
    return DBFactory::getDB()->save(static::$table, $this);//$this refiere al objeto que est'a llamando a este metodo
  }
	public function esMailUnico($email,$id)
  {
    return DBFactory::getDB()->esMailUnico($email, $id);
  }


}

 ?>
