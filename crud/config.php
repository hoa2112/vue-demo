<?php
header("Content-type: text/html; charset=utf-8");
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "demo_vue_js"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
mysqli_set_charset($con, 'UTF8');
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}