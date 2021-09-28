<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/25/21
 * Time: 11:02 PM
 */

/**
 * Find the comments of a specific user, and wrap the results in a json form.
 */

require_once "../../private/initialize.php";
session_start();

$id = isset($_POST['id'])?$_POST['id']:null;

if($id!=null){

    $req_user = "SELECT * FROM log_in WHERE id='" .$id ."'";
    $result_user = mysqli_query($db,$req_user);
    $subject_user = mysqli_fetch_assoc($result_user);
    $receiver = $subject_user['user_name'];

    $req = "SELECT * FROM notification WHERE receiver='" .$receiver."' AND replier!='".$receiver."' ORDER BY id DESC";
    $result = mysqli_query($db,$req);

    $info=[];

    if(mysqli_num_rows($result)>0){
        while($subject = mysqli_fetch_assoc($result)){

            array_push($info,["tid"=>$subject['t_id'],"country"=>$subject['country'],"cid"=>$subject['c_id'],"rid"=>$subject['r_id'],"page"=>$subject['page'],"new"=>$subject['new'],"reply"=>$subject['reply']]);

        }
    }



    echo json_encode($info);

}

else{

    echo $info=[];
}
