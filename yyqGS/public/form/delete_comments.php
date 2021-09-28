<?php

/**
 * Delete comments from database based on the variables "cid", "tid", "page", "ID".
 */


require_once "../../private/initialize.php";
session_start();
//$id = $_SESSION['id'];
//$id = isset ($_SESSION['ID'])?$_SESSION['ID']:'';

$id = isset($_SESSION['ID'])?$_SESSION['ID']:null;

//$thread_clicked = isset($_POST['index4'])?$_POST['index4']:''; //cid
//$thread_clicked = mysqli_escape_string($db,$thread_clicked);


$cid = isset($_POST['cid'])?$_POST['cid']:null; //cid
$cid = mysqli_escape_string($db,$cid);


//$thread_clicked = $thread_clicked +1; //cid

$tid = isset($_SESSION['tid'])?$_SESSION['tid']:null;
$tid = mysqli_escape_string($db,$tid);

$country = isset($_SESSION['country'])?$_SESSION['country']:null;
$country = mysqli_escape_string($db,$country);

//$page = isset($_GET['page'])?$_GET['page']:1;

//$page = isset($_POST['page'])?$_POST['page']:"";
//$page = mysqli_escape_string($db,$page);


$page = isset($_POST['page'])?$_POST['page']:null;



//echo "cid=".$cid." tid=".$tid." rid=0"." page=".$page;


if($page!=null && $cid!=null && $tid!=null && $id!=null && $country!=null && isset($_SESSION['loggedIn'])){



//    $req_user = "SELECT * FROM log_in WHERE id='".$id."'";
//    $result_user = mysqli_query($db,$req_user);
//    $subject_user = mysqli_fetch_assoc($result_user);


//$req = "DELETE FROM comments WHERE country='".$country."' AND c_id='" .$thread_clicked. "' AND t_id='" .$tid. "' AND page ='".$page."'";

    $req = "UPDATE comments SET user='-', receiver='-' ,comment='Deleted', `user`='-', images='', image_name='' WHERE country='".$country."' AND r_id='0' AND c_id='" .$cid. "' AND t_id='" .$tid. "' AND page ='".$page."'";
    $result = mysqli_query($db,$req);

//$req_delete_noti = "DELETE FROM notification WHERE country='" .$country."' AND c_id='". $thread_clicked."' AND t_id='".$tid."' AND page='".$page."'";

    $req_delete_noti = "UPDATE notification SET reply='Deleted' WHERE country='" .$country."' AND c_id='". $cid."' AND t_id='".$tid."' AND page='".$page."'";
    mysqli_query($db,$req_delete_noti);


    echo "cid=".$cid." tid=".$tid." rid=0"." page=".$page;


//    echo ($page).' /'.($cid).' /'.($tid).' /'.($id).' /'.($country);

}

else{
    echo "Error";
}


//
//$array = [];
//
//$req_f = "SELECT * FROM comments WHERE r_id='0'";
//$result_f = mysqli_query($db,$req_f);
//$row = mysqli_num_rows($result_f);
//while($subject_f = mysqli_fetch_assoc($result_f)){
//    array_push($array,$subject_f);
//}
//
//
//$req_cn = "SELECT * FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND r_id='0'";
//$result_cn = mysqli_query($db,$req_cn);
//if(mysqli_num_rows($result_cn)>0){
//    $cn = mysqli_num_rows($result_cn)+1;
//}
//else{
//    $cn = 1;
//}


///*for($i=$clicked_page;$i<$page;$i++){
//    $index = 10*($i+1)+1;
//    $req_get_page = "SELECT * FROM comments WHERE country='"
//        .$country ."' AND t_id='"
//        .$tid . "' AND c_id='"
//        .$index . "' AND r_id='0'";
//    $result_get_page = mysqli_query($db,$req_get_page);
//    if($subject_get_page = mysqli_fetch_assoc($result_get_page)){
//        $new_page = $subject_get_page['page']-1;
//        $req_update2 = "UPDATE comments SET page='" .$new_page. "' WHERE c_id='" .$index. "'AND t_id='" .$tid. "' AND country='".$country. "'";
//        $result_update2 = mysqli_query($db,$req_update2);
//    }
//
//}*/


//for($i=$thread_clicked;$i<=$row ;$i++){
//    $cid = $array[$i-1]['c_id']-1;
//    $old_cid = $i+1;
//    $req_update = "UPDATE comments SET c_id='" .$cid. "' WHERE c_id='" .$old_cid. "'AND t_id='" .$tid. "' AND country='".$country. "'";
//    $result_update = mysqli_query($db,$req_update);
//}
//
//
//for($i=0;$i<$cn;$i++){
//    $p = floor(($i/10.001)+1);
//    $j = $i+1;
//    $req_update2 = "UPDATE comments SET page='" .$p. "' WHERE c_id='" .$j. "'AND t_id='" .$tid. "' AND country='".$country. "' AND r_id='0'";
//    $result_update2 = mysqli_query($db,$req_update2);
//}


//if ( !$req ) {
//    printf("Error: %s\n", $mysqli_error($db));
//}
//else{
//
//}
//?>