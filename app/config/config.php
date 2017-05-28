<?php

define("VIEW_PATH", getcwd() . "/../app/Views/");
define('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_METHOD', 'default');
define('ERROR_CONTROLLER', 'Error'/*Controller*/);

//@TODO add some reflection possibilities class/namespace options
$configureServices = [
  "database" => array(
      "options" => array(
          "db_name" => "mvc",
          "db_user" => "root",
          "db_password" => "",
          "db_host" => "localhost",
          "db_driver" => "pdo_mysql"
      )
  )
];
