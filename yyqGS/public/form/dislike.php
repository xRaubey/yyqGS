<?php
require_once "../../private/initialize.php";
session_start();

if(is_post_request()){

    $id = isset($_POST['id'])?$_POST['id']:'';
    $req_user = "SELECT * FROM log_in WHERE id='".$id."'";
    $result_user = mysqli_query($db,$req_user);
    $subject_user = mysqli_fetch_assoc($result_user);


    $country = isset($_POST['country'])?$_POST['country']:'';
    $tid = isset($_POST['tid'])?$_POST['tid']:'';

    if($country!='' && $tid!='' && $id!=''){

        $req_row = "SELECT * FROM liked WHERE user_name='".$subject_user['user_name']."'AND country='".$country."' AND t_id='".$tid."'";
        $result_row = mysqli_query($db,$req_row);
        $row = mysqli_num_rows($result_row);
        $position = $row;

        $req = "DELETE FROM liked WHERE user_name='".$subject_user['user_name']."'AND country='".$country."' AND t_id='".$tid."'";
        mysqli_query($db,$req);



        /*$req_update = "UPDATE liked SET position='".$position."'" ;
        mysqli_query($db,$req_update);*/

        echo "The thread is removed.";

    }
    else{
        echo "Try again maybe.";
    }

}
