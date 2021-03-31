<?php
require_once "../../private/initialize.php";
session_start();

if(is_post_request()){
    $id = $_SESSION['profile_id'];
    $profile_picture = $_POST['profile'];

    $image = base64_decode(substr($profile_picture,strpos($profile_picture,",")));

    $image_name = $id."profile_image";

    $image_path = "../uploaded_images/" . $image_name . ".png";

    file_put_contents($image_path, $image);

    $req = "UPDATE log_in SET image_name ='".$image_name."' WHERE id='" . $id ."'";
    mysqli_query($db,$req);

    echo $id;

}

