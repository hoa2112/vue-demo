<?php

include "config.php";

$data = json_decode(file_get_contents("php://input"));

$userData = mysqli_query($con,"select password from users WHERE email = '"  .$data->email. "' ");

$row = mysqli_fetch_assoc($userData);

if (md5($data->password) == $row['password']) {
    echo 'ok';
} else {
    echo 'fail';
}

exit;