<?php
require_once("config.php");

$db_connection = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['dbname']);
$dbh = new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbname'], $GLOBALS['user'], $GLOBALS['password']);

if($db_connection->connect_errno) {
	die("There are some problems regarding our database. We are currently working on it. Don't forget visit us later!");
}
