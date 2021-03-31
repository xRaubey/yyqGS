<?php
require_once "../../private/initialize.php";
session_start();
$id = $_SESSION['id'];
$country = $_SESSION['country'];
$tid = $_SESSION['tid'];
$cid = isset($_GET['cid'])?$_GET['cid']:'';
$cid = $cid+1;
$reply = isset($_POST['reply_area'])?$_POST['reply_area']:'';
$page = isset($_GET['page'])?$_GET['page']:'1';



$req_replier = "SELECT * FROM log_in WHERE id='" .$id. "'";
$result_replier = mysqli_query($db,$req_replier);
$subject_replier = mysqli_fetch_assoc($result_replier);
$replier = $subject_replier['user_name'];


$req_row = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id!='0'";
$result_row = mysqli_query($db,$req_row);
if(mysqli_num_rows($result_row) ==0) {
    $rn = 1;
}
else{
    $rn = mysqli_num_rows($result_row)+1;
}


date_default_timezone_set("America/Chicago");
$ri = date("Y/m/d H:i:s");


$req_receiver = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='0'";
$result_receiver = mysqli_query($db,$req_receiver);
$subject_receiver = mysqli_fetch_assoc($result_receiver);
$receiver = mysqli_real_escape_string($db,$subject_receiver['user']);
$comment = mysqli_real_escape_string($db,$subject_receiver['comment']);


if(!empty($reply)){
    $req = "INSERT INTO comments (user,receiver,comment,country,t_id,c_id,r_id,time,page) VALUES ('"
        .$replier. "','"
        .$receiver."','"
        .$reply."','"
        .$country."','"
        .$tid."','"
        .$cid."','"
        .$rn."','"
        .$ri."','"
        .$page."')";
    mysqli_query($db,$req);


}




$req_row = "SELECT * FROM notification WHERE receiver='" .$receiver. "' AND replier!='" .$receiver ."'";
$result_row = mysqli_query($db,$req_row);
$position = mysqli_num_rows($result_row);


if($receiver!=$replier && $receiver!=''){
    $req_n = "INSERT INTO notification (receiver, replier, comment, reply, position ,new,country,t_id,c_id,r_id,page) VALUES ('"
        .$receiver."','"
        .$replier."','"
        .$comment. "','"
        .$reply."','"
        .$position."','1','"
        .$country."','"
        .$tid."','"
        .$cid ."','0','"
        .$page."')";
    mysqli_query($db,$req_n);
}





redirect_to(url_for("thread.php?id=" .$id. "&country=" .$country. "&tid=" .$tid));

if ( !$req ) {
    printf("Error: %s\n", $mysqli_error($db));
}
else{
}
?>