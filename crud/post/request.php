<?php

    include "../config.php";

    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data)) {
        $request = $data->request;
    } else if(!empty($_POST['request']))  {
        $request = $_POST['request'];
    } else {
        $request = 1;
    }

    // Fetch All records
    if ($request == 1) {
        $postData = mysqli_query($con, "select * from posts order by id desc");
        $response = array();
        $response = mysqli_fetch_all($postData, MYSQLI_ASSOC);

        echo json_encode($response);
        exit;
    }

    if ($request == 2) {
        if ($_FILES) {
            $filename = $_FILES['file']['name'];

            $valid_extensions = array("jpg","jpeg","png","pdf");

            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            if(in_array(strtolower($extension),$valid_extensions) ) {
                if(move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$filename)){
                    $link_image = "uploads/".$filename;
                }else{
                    $link_image = '';
                }
            } else{
                $link_image = '';
            }
        } else{
            $link_image = '';
        }

        $title = $_POST['title_post'];
        $description = $_POST['description'];
        $content = $_POST['content'];
        $author = $_POST['author'];

        mysqli_query($con, "INSERT INTO posts(title_post , description , content , author , image , date_added ) VALUES('" . mysqli_real_escape_string($con, $title) . "', '" . mysqli_real_escape_string($con, $description) . "' , '" . mysqli_real_escape_string($con, $content) . "' , '" . mysqli_real_escape_string($con, $author) . "', '" . mysqli_real_escape_string($con, $link_image) . "' , NOW()) ");
        exit;
    }

    if ($request == 3) {
        if ($_FILES) {
            $filename = $_FILES['file']['name'];

            $valid_extensions = array("jpg","jpeg","png","pdf");

            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            if(in_array(strtolower($extension),$valid_extensions) ) {
                if(move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$filename)){
                    $link_image = "uploads/".$filename;
                }else{
                    $link_image = '';
                }
            }else{
                $link_image = '';
            }
        } else {
            $link_image = $_POST['image'];
        }

        $post_id = $_POST['post_id'];
        $title = $_POST['title_post'];
        $description = $_POST['description'];
        $content = $_POST['content'];
        $author = $_POST['author'];

        mysqli_query($con, "UPDATE posts SET title_post = '" . mysqli_real_escape_string($con, $title) . "' , description = '" . mysqli_real_escape_string($con, $description) . "' , content = '" . mysqli_real_escape_string($con, $content) . "' , author = '" . mysqli_real_escape_string($con, $author) . "' , image = '" .mysqli_real_escape_string($con,$link_image). "'  WHERE id = '" .(int)$post_id. "' ");
        exit;
    }

    if ($request == 4) {
        $post_id = $data->post_id;

        mysqli_query($con, "DELETE FROM posts WHERE id = '" .(int)$post_id. "'  ");
    }
