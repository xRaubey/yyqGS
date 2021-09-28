<?php

/**
 * Find the the "Marked" page of a user, and wrap the results in a json form, then return it.
 */

require_once "../../private/initialize.php";
//$position = $_POST['index'];


$id = isset($_POST['id'])?$_POST['id']:null;

if($id!=null){
    $req_user = "SELECT * FROM log_in WHERE id='" . $id ."'";
    $result_user = mysqli_query($db,$req_user);
    $subject_user = mysqli_fetch_assoc($result_user);


    $array = [];

    $req = "SELECT * FROM liked WHERE user_name='". $subject_user['user_name']."'";
    $result = mysqli_query($db,$req);
    while ($subject = mysqli_fetch_assoc($result)){
        array_push($array,['country'=>$subject['country'],'tid'=>$subject['t_id']]);
    }


    echo json_encode($array);
}
else{
    echo "Error";
}

//echo $id.",".$array[$position]['country'].",".$array[$position]['t_id'];
