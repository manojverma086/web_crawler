<?php 
session_start();
$servername = 'localhost';
$username = 'root';
$password = 'manoj';
$dbname = 'operations';
// Create connection
$connection = mysql_connect($servername, $username, $password, $dbname);
if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('operations');

//$email_id = 'manojkv@flaberry.com';
$email_id = $_SESSION['username'];
$date = date("Y-m-d");
//mysql_close($connection);
?>
