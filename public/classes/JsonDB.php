<?php

class JsonDB {

    public function find($row, $value, $table, $class){
      $registros = json_decode(file_get_contents($table.'.json'),true);
  		if (is_null($registros)) {
  			$registros = [$table => []];
  		}
      foreach ($registros[$table] as $indice => $registro) {
  			if ($registro[$row] == $value) {
          $model = new $class ([]);
          $model->toModel($registro);
          return $model;
  			}
      }
    }
    public function save($table, $model){//model para no poner this y que choque
      ($model->id)?$this->update($table, $model):$this->insert($table, $model);
    }
    private function insert($table, $model){
      $registros = json_decode(file_get_contents('./'.$table.'.json'),true);
      if (is_null($registros)) {
        $registros = [$table => []];
      }
      $registro=[];
      foreach ($model->fillable as $column) { //hidrato el registo
        $registro[$column]=$model->$column;
      }
      $lastId=0;
      foreach ($registros[$table] as $indice => $objeto) {  // Chequeo la id max
    	 		$lastId = $lastId < $objeto['id'] ? $objeto['id']: $lastId;
    	 }
      $newId=$lastId+1;
      $registro['id']=($newId); //preparo el registro con id nuevo
      $registros[$table][] = $registro; // Cargo el nuevo registro en la tabla
      file_put_contents('./'.$table.'.json', json_encode($registros,JSON_PRETTY_PRINT));
    }
    private function update($table, $model){
      $registros = json_decode(file_get_contents('./'.$table.'.json'),true);
      if (is_null($registros)) {
        $registros = [$table => []];
      }
      $registro=[];
      foreach ($model->fillable as $column) { //hidrato el registo
        $registro[$column]=$model->$column;
      }
      $indexInJson=-1;
      foreach ($registros[$table] as $indice => $objeto) {  // Consigo el nro de indice en el json
        $indexInJson++;
        if ($objeto['id'] == $model->id) {
          break;
        }
    	 }
      $registro['id']=$model->id; //cargo el id, ya que no viene fillable

      $registros[$table][$indexInJson] = $registro; // Cargo el nuevo registro en la tabla
      file_put_contents('./'.$table.'.json', json_encode($registros,JSON_PRETTY_PRINT));
    }

    public function esMailUnico($email,$id){
      $aux=true;
      $usuarios = json_decode(file_get_contents('./usuarios.json'),true);
      if (is_null($usuarios)) {
        $usuarios = ['usuarios' => []];
      }
      foreach ($usuarios['usuarios'] as $indice => $usuario) {
        if ($usuario['email']==$email&&$usuario['id']!=$id) {
          return $aux=false;
        }
      }
      return $aux;
    }
  }





 ?>
