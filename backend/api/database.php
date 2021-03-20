<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
//header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header("Content-Type: application/json");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mydb');

function connect()
{
  $connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

  if (mysqli_connect_errno($connect)) {
    die("Failed to connect:" . mysqli_connect_error());
  }

  mysqli_set_charset($connect, "utf8");

  return $connect;
}

$con = connect();

function getItem ($key, $return = false, $table = 'policies', $idKey = 'id')
{
    $con = connect();
    $sql = "SELECT * FROM $table WHERE $idKey = ".$key;
    $result = mysqli_query($con, $sql);
    if (!$return) {
        return mysqli_num_rows($result);
    }

    return mysqli_fetch_assoc($result);
}



