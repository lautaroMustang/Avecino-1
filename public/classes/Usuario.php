<?php
require_once 'DB.php';
require_once 'Model.php';

class Usuario extends Model {

  public $id;
  public $userName;
  public $email;
  public $password;
  public $name;
  public $image;

  public $fillable=['userName','email','password','name','image'];
  public static $table ='usuarios';

  public function setName($name)
  {
    $this->name=$name;
  }
  public function setImage($image)
  {
    $this->image=$image;
  }
  public function setPassword($value)
   {
     $this->password=password_hash($value,PASSWORD_DEFAULT);
   }
   public function setId($id)
   {
     $this->id=$id;
   }
   public function setUserName($userName)
   {
     $this->userName=$userName;
   }
   public function getUserName()
   {
     return $this->userName;
   }
}

 ?>
