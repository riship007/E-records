<?php
$servername = "mysql8";
$username = "devuser";
$password = "devpass";
$dbname = "test_db";

$con = new mysqli($servername, $username, $password, $dbname);


if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}?>