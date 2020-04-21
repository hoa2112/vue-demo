<?php

    include "../config.php";

    $data = json_decode(file_get_contents("php://input"));
    $postData = mysqli_query($con, "select * from posts order by id desc");
    $response = mysqli_fetch_all($postData, MYSQLI_ASSOC);

    $result = [];

    foreach ($response as $value) {
        $result[] = [
            'id'          => $value['id'],
            'image'       => '../post/'.$value['image'],
            'title_post'  => mb_convert_encoding($value['title_post'], 'UTF-8', 'UTF-8'),
            'description' => mb_convert_encoding($value['description'], 'UTF-8', 'UTF-8'),
            'content'     => mb_convert_encoding($value['content'], 'UTF-8', 'UTF-8'),
        ];
    }

    echo json_encode($result);
    // print_r($response);
    // print_r(json_last_error_msg());
    exit;

