<?php

include "../config.php";

$data = json_decode(file_get_contents("php://input"));

if (!empty($data)) {
    $request = $data->request;
} else {
    $request = 1;
}

// Fetch All records
if($request == 1){
    $userData = mysqli_query($con,"select * from users order by id desc");

    $response = array();
    while($row = mysqli_fetch_assoc($userData)){
        $response[] = $row;
    }

    echo json_encode($response);
    exit;
}

// Add record
if($request == 2){
    $username = $data->username;
    $name = $data->name;
    $email = $data->email;
    $password = $data->password;

    $userData = mysqli_query($con,"SELECT * FROM users WHERE username='".mysqli_real_escape_string($con,$username)."'");

    if(mysqli_num_rows($userData) == 0){
        mysqli_query($con,"INSERT INTO users(username,name,email, password) VALUES('".mysqli_real_escape_string($con,$username)."','".mysqli_real_escape_string($con,$name)."','".mysqli_real_escape_string($con,$email)."' , '" .mysqli_real_escape_string($con,md5($password)). "' )");
        echo "Insert successfully";
    }else{
        echo "Username already exists.";
    }

    exit;
}

// Update record
if($request == 3){
    $id = $data->id;
    $username = $data->username;
    $name = $data->name;
    $email = $data->email;
    $password = $data->password;

    mysqli_query($con,"UPDATE users SET username = '".mysqli_real_escape_string($con,$username)."', name = '".mysqli_real_escape_string($con,$name)."', email = '".mysqli_real_escape_string($con,$email)."' , password = '" .mysqli_real_escape_string($con,md5($password)). "' WHERE id=".(int)$id);

    echo "Update successfully";
    exit;
}

// Delete record
if($request == 4){
    $id = $data->id;

    mysqli_query($con,"DELETE FROM users WHERE id=".(int)$id);

    echo "Delete successfully";
    exit;
}
