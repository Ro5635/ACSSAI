<?php

//Define the gogle recpacha API key:
define("googleRecapchaPrivKey", 'PrivKey');
define("googleRecapchaSiteKey", 'SiteKey');

//DB Connection:

class Db {
  private static $instance = NULL;

  private function __construct() {}

  private function __clone() {}

  public static function getInstance() {
    if (!isset(self::$instance)) {
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      self::$instance = new PDO('mysql:host=localhost;dbname=DBName', 'DBuser', 'password', $pdo_options);
    }
    return self::$instance;
  }
}
