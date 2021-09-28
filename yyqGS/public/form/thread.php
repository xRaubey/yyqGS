<?php

/**
 * Create a new record to store news or a thread in the database.
 */


require_once '../../private/initialize.php';
session_start();
$reply = isset($_POST['comment'])?$_POST['comment']:'';
$reply = mysqli_real_escape_string($db,$reply);
$country = isset($_SESSION['country'])?$_SESSION['country']:'';
$tid = isset($_SESSION['tid'])?$_SESSION['tid']:'';
//$id = isset($_SESSION['id'])?$_SESSION['id']:'';
$id = isset($_SESSION['ID'])?$_SESSION['ID']:'';

$cn = 0;
unset($_SESSION['IMAGE_SIZE_ERROR']);
unset($_SESSION['WRONG_IMAGE_TYPE']);

$error1 = '';
$error2 = '';
$error3 = '';

if(is_post_request()){

    $req_u = "SELECT * FROM log_in WHERE id='" .$id. "'";
    $result_u = mysqli_query($db,$req_u);
    $subject_u = mysqli_fetch_assoc($result_u);
    $user_name = $subject_u['user_name'];
    $replier = $user_name;

//    $req_cn = "SELECT * FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND r_id='0'";
    $req_cn = "SELECT MAX(c_id) FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND r_id='0'";

    $result_cn = mysqli_query($db,$req_cn);

    $cn = mysqli_fetch_assoc($result_cn)['MAX(c_id)']+1;

//    if(mysqli_num_rows($result_cn)>0){
//        $cn = mysqli_num_rows($result_cn)+1;
//    }
//    else{
//        $cn = 1;
//    }

//    $page = floor(($cn/10.001)+1);
    $page = ceil($cn/10);


    date_default_timezone_set("America/Chicago");
    $date = date("Y/m/d H:i:s");


//    $name = mysqli_real_escape_string($db,$_FILES['upi']['name']);
    $image = mysqli_real_escape_string($db,$_FILES['upi']['tmp_name']);
    $type = mysqli_real_escape_string($db,$_FILES['upi']['type']);
    $size = mysqli_real_escape_string($db,$_FILES['upi']['size']);


    $name = mysqli_real_escape_string($db,pathinfo($_FILES['upi']['name'],PATHINFO_FILENAME));

    if($name==null){
        $name='';
    }
    else{
        $name = $name."GN".time().rand(1,20)."GN";
    }

    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $extension_array = array('image/jpg','image/jpeg','image/png','image/pdf','image/gif');


    if(in_array($type,$extension_array)){
        if($size < 5000000){
            $location = "../uploaded_images/";
            move_uploaded_file($image,$location.$name);

        }
        else{
            $error1 = 'The file is bigger then 5m bytes!';
        }

    }
    elseif(empty($type) && empty($image) && empty($name)){

    }
    else{
        $error2 = 'Incorrect file type!';
    }

    if((!empty($reply)||!empty($name)) && (in_array($type,$extension_array) || empty($type))){
        $req = "INSERT INTO comments (user,receiver,comment,country,t_id, c_id, r_id,time,image_name,images,page) VALUES ('"
            .h($user_name). "','-','"
            .h($reply)."','"
            .h($country)."','"
            .$tid."','".$cn."','0','"
            .$date."','"
            .$name."','"
            .$image."','"
            .$page."')";
        mysqli_query($db,$req);
    }
    else{
        $error3 = "Say something.";
    }


    $_SESSION['PAGES'] = $page;


    $req_receiver = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND c_id='1' AND r_id='0'";
    $result_receiver = mysqli_query($db,$req_receiver);
    $subject_receiver = mysqli_fetch_assoc($result_receiver);
    $receiver = $subject_receiver['user'];
    $comment = $subject_receiver['comment'];

    $req_row = "SELECT * FROM notification WHERE receiver='" .$receiver. "' AND replier!='" .$receiver."'";
    $result_row = mysqli_query($db,$req_row);
    $position = mysqli_num_rows($result_row); // ???


    if($receiver!=$replier && !empty($receiver) && $receiver!="GN"){
        $req_n = "INSERT INTO notification (receiver, replier, comment, reply, position ,new,country,t_id,c_id,r_id,page) VALUES ('"
            .$receiver."','"
            .$replier."','"
            .$comment. "','"
            .$reply."','"
            .$position."','1','"
            .$country."','"
            .$tid."','"
            .$cn."','0','"
            .$page."')";
        mysqli_query($db,$req_n);
    }

    //echo $image;
    /*(if($page == 1){
        redirect_to(url_for("thread.php?id=" .$id. "&country=" .$country. "&tid=" .$tid));
    }
    else{
        redirect_to(url_for("thread.php?id=" .$id. "&country=" .$country. "&tid=" .$tid . "&page=".$page));
    }*/

    echo $error1.",".$error2.",".$error3;

}

else{
    echo "Error";
}