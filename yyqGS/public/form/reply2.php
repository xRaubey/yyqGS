<?php

/**
 * Get reply from the website, and update the database.
 */


require_once "../../private/initialize.php";
session_start();
//$id = $_SESSION['id'];
$id = $_SESSION['ID'];

$reply = isset($_POST['r_content'])?$_POST['r_content']:'';
$reply = mysqli_real_escape_string($db,$reply);
$country = $_SESSION['country'];
$tid = $_SESSION['tid'];
//$cid = isset($_GET['cid'])?$_GET['cid']:'';
$cid = isset($_POST['cid'])?$_POST['cid']:null;

//$rid = isset($_GET['rid'])?$_GET['rid']:'';
$rid = isset($_POST['rid'])?$_POST['rid']:null;


//$page = isset($_GET['page'])?$_GET['page']:'';
$page = isset($_POST['page'])?$_POST['page']:null;

if($cid!=null && $rid!=null && $page!=null){




    $req_replier = "SELECT * FROM log_in WHERE id='" .$id. "'";
    $result_replier = mysqli_query($db,$req_replier);
    $subject_replier = mysqli_fetch_assoc($result_replier);
    $replier = $subject_replier['user_name'];


    $req_rid = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id!='0'";
    $result_rid = mysqli_query($db,$req_rid);
    $subject_rid = mysqli_fetch_assoc($result_rid);
    if(mysqli_num_rows($result_rid) ==0) {
        $rn = 1;
    }
    else{
        $rn = mysqli_num_rows($result_rid)+1;
    }


    date_default_timezone_set("America/Chicago");
    $ri = date("Y/m/d H:i:s");



    $req_getr = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='".$rid."'";
    $result_getr = mysqli_query($db,$req_getr);
    $subject_getr = mysqli_fetch_assoc($result_getr);
    $receiver = $subject_getr['user'];

    $comment =  $subject_getr['comment'];




    if(!empty($reply)){
        $req = "INSERT INTO comments (user,receiver,comment,country,t_id,c_id,r_id,time,images,image_name,page) VALUES ('"
            .$replier. "','"
            .$receiver."','"
            .$reply."','"
            .$country."','"
            .$tid."','"
            .$cid."','"
            .$rn."','"
            .$ri."','','','"
            .$page."')";
        mysqli_query($db,$req);




        $req_row = "SELECT * FROM notification WHERE receiver='" .$receiver. "' AND replier!='" .$receiver."'";
        $result_row = mysqli_query($db,$req_row);
        $position = mysqli_num_rows($result_row);


        if($receiver!=$replier && $receiver!='' && $receiver!='-' && $receiver!='GN'){
            $req_n = "INSERT INTO notification (receiver, replier, comment, reply, position ,new,country,t_id,c_id,r_id,page) VALUES ('"
                .$receiver."','"
                .$replier."','"
                .$comment. "','"
                .$reply."','"
                .$position."','1','"
                .$country."','"
                .$tid."','"
                .$cid ."','"
                .$rid."','"
                .$page."')";
            mysqli_query($db,$req_n);
        }



        redirect_to(url_for("thread.php?id=" .$id. "&country=" .$country. "&tid=" .$tid));

        if ( !$req ) {
            printf("Error: %s\n", mysqli_error($db));
        }
        else{
        }


    }



//    $req_receiver = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='" .$rid. "'";
//    $result_receiver = mysqli_query($db,$req_receiver);
//    $subject_receiver = mysqli_fetch_assoc($result_receiver);
//    $receiver = $subject_receiver['user'];
//    $comment = $subject_receiver['comment'];






    //    echo "tid=".$tid."cid=".$cid."rid=".$rid."page=".$page."replier=".$replier."row=".$rn."receiver=".$subject_getr['user']."reply=".$reply;



}

?>