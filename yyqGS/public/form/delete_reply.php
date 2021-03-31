<?php
require_once "../../private/initialize.php";
session_start();
$id = $_SESSION['id'];
$country = $_SESSION['country'];
$reply_clicked = isset($_POST['index'])?$_POST['index']:'';
$rid = $reply_clicked+1;
$_SESSION['rid']=$rid;
$sr_clicked = isset($_POST['index_sr'])?$_POST['index_sr']:'';
$cid = $sr_clicked+1;
$page = isset($_GET['page'])?$_GET['page']:'1';


$tid = isset($_SESSION['tid'])?$_SESSION['tid']:'';



$_SESSION['REPLY_CLICKED'] = $cid;


$req = "DELETE FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='" .$rid. "' AND page='".$page."'";
$result = mysqli_query($db,$req);

$req_delete_noti = "DELETE FROM notification WHERE country='" .$country."' AND c_id='". $cid."' AND t_id='".$tid."' AND r_id='".$rid."' AND page='".$page."'";
mysqli_query($db,$req_delete_noti);


$array = [];

$req_f = "SELECT * FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id>'" .$rid. "'";
$result_f = mysqli_query($db,$req_f);
$row = mysqli_num_rows($result_f);
while($subject_f = mysqli_fetch_assoc($result_f)){
    array_push($array,$subject_f);
}


for($i=0;$i<$row ;$i++){
    $rid = $array[$i]['r_id']-1;
    $old_rid = $rid+1;
    $req_update = "UPDATE comments SET r_id='" .$rid. "' WHERE country='".$country."' AND r_id='" .$old_rid. "' AND c_id='" .$cid. "'";
    $result_update = mysqli_query($db,$req_update);
}



//$req_n = "SELECT * FROM notification WHERE "


if ( !$req ) {
    printf("Error: %s\n", $mysqli_error($db));
}
else{

}
?>