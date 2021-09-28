<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/21/21
 * Time: 12:43 AM
 */

/**
 * If the user has marked the page, return '1', otherwise, return '0'.
 */

if(is_post_request()){


    $id = isset($_POST['id'])?$_POST['id']:null;
    $req_user = "SELECT * FROM log_in WHERE id='".$id."'";
    $result_user = mysqli_query($db,$req_user);
    $subject_user = mysqli_fetch_assoc($result_user);


    $country = isset($_POST['country'])?$_POST['country']:null;
    $tid = isset($_POST['tid'])?$_POST['tid']:null;

    if($country!=null && $tid!=null && $id!=null){

//        $req = "INSERT INTO liked (user_name,country,t_id) VALUES('".$subject_user['user_name']."','".$country."','".$tid."')";

        $req = "SELECT * FROM liked WHERE user_name='". $subject_user['user_name'] ."' AND t_id='".$tid."'";

        mysqli_query($db,$req);
        echo "1";

    }
    else{
        echo "0";
    }

}