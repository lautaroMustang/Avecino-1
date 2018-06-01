<?php

/**
 *
 */
class DBFactory
{

  public static $db_type; //MySQLDB , jsondb, mongodb

  public static function getDB()
  {
    return new self::$db_type;
  }
}










 ?>
