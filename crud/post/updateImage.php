<?php
include "../config.php";
// File name
$filename = $_FILES['file']['name'];
// Valid file extensions
$valid_extensions = array("jpg","jpeg","png","pdf");

// File extension
$extension = pathinfo($filename, PATHINFO_EXTENSION);

// Check extension
if(in_array(strtolower($extension),$valid_extensions) ) {
    // Upload file
    if(move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$filename)){
        $link_image = "uploads/".$filename;
        $post_id = $_POST['post_id'];

        mysqli_query($con, "UPDATE posts SET image = '" .mysqli_real_escape_string($con,$link_image). "' WHERE id = '" .(int)$post_id. "' ");
        exit;
    }else{
        echo 0;
    }
}else{
    echo 0;
}

exit;