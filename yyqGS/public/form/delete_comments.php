<?php
require_once "../../private/initialize.php";
session_start();
$id = $_SESSION['id'];
$thread_clicked = isset($_POST['index4'])?$_POST['index4']:''; //cid
$thread_clicked = $thread_clicked +1; //cid
$tid = $_SESSION['tid'];
$country = $_SESSION['country'];
$page = isset($_GET['page'])?$_GET['page']:'1';

$req_user = "SELECT * FROM log_in WHERE id='".$id."'";
$result_user = mysqli_query($db,$req_user);
$subject_user = mysqli_fetch_assoc($result_user);


$req = "DELETE FROM comments WHERE country='".$country."' AND c_id='" .$thread_clicked. "' AND t_id='" .$tid. "' AND page ='".$page."'";
$result = mysqli_query($db,$req);

$req_delete_noti = "DELETE FROM notification WHERE country='" .$country."' AND c_id='". $thread_clicked."' AND t_id='".$tid."' AND page='".$page."'";
mysqli_query($db,$req_delete_noti);


$array = [];

$req_f = "SELECT * FROM comments WHERE r_id='0'";
$result_f = mysqli_query($db,$req_f);
$row = mysqli_num_rows($result_f);
while($subject_f = mysqli_fetch_assoc($result_f)){
    array_push($array,$subject_f);
}


$req_cn = "SELECT * FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND r_id='0'";
$result_cn = mysqli_query($db,$req_cn);
if(mysqli_num_rows($result_cn)>0){
    $cn = mysqli_num_rows($result_cn)+1;
}
else{
    $cn = 1;
}


/*for($i=$clicked_page;$i<$page;$i++){
    $index = 10*($i+1)+1;
    $req_get_page = "SELECT * FROM comments WHERE country='"
        .$country ."' AND t_id='"
        .$tid . "' AND c_id='"
        .$index . "' AND r_id='0'";
    $result_get_page = mysqli_query($db,$req_get_page);
    if($subject_get_page = mysqli_fetch_assoc($result_get_page)){
        $new_page = $subject_get_page['page']-1;
        $req_update2 = "UPDATE comments SET page='" .$new_page. "' WHERE c_id='" .$index. "'AND t_id='" .$tid. "' AND country='".$country. "'";
        $result_update2 = mysqli_query($db,$req_update2);
    }

}*/


for($i=$thread_clicked;$i<=$row ;$i++){
    $cid = $array[$i-1]['c_id']-1;
    $old_cid = $i+1;
    $req_update = "UPDATE comments SET c_id='" .$cid. "' WHERE c_id='" .$old_cid. "'AND t_id='" .$tid. "' AND country='".$country. "'";
    $result_update = mysqli_query($db,$req_update);
}


for($i=0;$i<$cn;$i++){
    $p = floor(($i/10.001)+1);
    $j = $i+1;
    $req_update2 = "UPDATE comments SET page='" .$p. "' WHERE c_id='" .$j. "'AND t_id='" .$tid. "' AND country='".$country. "' AND r_id='0'";
    $result_update2 = mysqli_query($db,$req_update2);
}


if ( !$req ) {
    printf("Error: %s\n", $mysqli_error($db));
}
else{

}
?>