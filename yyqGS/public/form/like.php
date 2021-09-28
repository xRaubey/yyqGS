<?php

/**
 * "Mark" a page, manipulate the database.
 */

require_once "../../private/initialize.php";
session_start();

if(is_post_request()){


    $id = isset($_POST['id'])?$_POST['id']:'';

    $auto = isset($_POST['auto'])?$_POST['auto']:null;

    $req_user = "SELECT * FROM log_in WHERE id='".$id."'";
    $result_user = mysqli_query($db,$req_user);
    $subject_user = mysqli_fetch_assoc($result_user);



    $country = isset($_POST['country'])?$_POST['country']:'';
    $tid = isset($_POST['tid'])?$_POST['tid']:'';

    if($country!='' && $tid!='' && $id!=''){

        $req = "INSERT INTO liked (user_name,country,t_id,auto_delete) VALUES('".$subject_user['user_name']."','".$country."','".$tid."','".$auto."')";
        mysqli_query($db,$req);
        echo "You liked the thread.";

    }
    else{
        echo "Try again maybe.";
    }

}
