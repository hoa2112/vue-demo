<?php

    include "../config.php";

    $data = json_decode(file_get_contents("php://input"));
    $postData = mysqli_query($con, "select * from posts order by id desc");

    $response = array();

    $response = mysqli_fetch_all($postData, MYSQLI_ASSOC);

    foreach ($response as &$value) {
        $value['image'] = '../post/'.$value['image'];
    }

    echo json_encode($response);
    exit;

