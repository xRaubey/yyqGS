<?php

/**
 * Get variables "rid", "cid", "page", "tid" from pose method, delete comments from table "comment" and "notification".
 */

require_once "../../private/initialize.php";
session_start();
//$id = $_SESSION['id'];
$id = isset($_SESSION['ID'])?$_SESSION['ID']:null;
$country = isset($_SESSION['country'])?$_SESSION['country']:null;

//$reply_clicked = isset($_POST['index'])?$_POST['index']:'';
//$rid = $reply_clicked+1;
//$_SESSION['rid']=$rid;
//$sr_clicked = isset($_POST['index_sr'])?$_POST['index_sr']:'';
//$cid = $sr_clicked+1;
//$page = isset($_GET['page'])?$_GET['page']:'1';

$rid = isset($_POST['rid'])?$_POST['rid']:null;

$cid = isset($_POST['cid'])?$_POST['cid']:null;

$page = isset($_POST['page'])?$_POST['page']:null;

$tid = isset($_SESSION['tid'])?$_SESSION['tid']:null;



//echo "cid=".$cid." tid=".$tid." rid=".$rid." page=".$page;

if($cid!=null && $page!=null && $country!=null && $tid!=null && $id!=null && isset($_SESSION['loggedIn'])){

    $req = "UPDATE comments SET user='-', receiver='-', comment ='Deleted', image_name ='' , images='' WHERE country='".$country."' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='" .$rid. "' AND page='".$page."'";
    $result = mysqli_query($db,$req);


    $req_delete_noti = "UPDATE notification SET reply='Deleted' WHERE country='" .$country."' AND c_id='". $cid."' AND t_id='".$tid."' AND page='".$page."'";
    mysqli_query($db,$req_delete_noti);

    if ( !$req ) {
        echo"1";
//    printf("Error: %s\n", mysqli_error($db));
    }
    else{

        echo "cid=".$cid." tid=".$tid." rid=".$rid." page=".$page;

    }

}


//$_SESSION['REPLY_CLICKED'] = $cid;

//
//$req = "DELETE FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='" .$rid. "' AND page='".$page."'";
//$result = mysqli_query($db,$req);



//$req = "UPDATE comments SET `user`='-',`receiver`='-',`comment`='Deleted', `image_name`='', `images`='' WHERE country='".$country."' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='" .$rid. "' AND page='".$page."'";
//$result = mysqli_query($db,$req);

//$req_delete_noti = "DELETE FROM notification WHERE country='" .$country."' AND c_id='". $cid."' AND t_id='".$tid."' AND r_id='".$rid."' AND page='".$page."'";
//mysqli_query($db,$req_delete_noti);


//echo $_POST['index'].'+'.$_POST['index_sr'];


//$array = [];
//
//$req_f = "SELECT * FROM comments WHERE country='".$country."' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id>'" .$rid. "'";
//$result_f = mysqli_query($db,$req_f);
//$row = mysqli_num_rows($result_f);
//while($subject_f = mysqli_fetch_assoc($result_f)){
//    array_push($array,$subject_f);
//}
//
//
//for($i=0;$i<$row ;$i++){
//    $rid = $array[$i]['r_id']-1;
//    $old_rid = $rid+1;
//    $req_update = "UPDATE comments SET r_id='" .$rid. "' WHERE country='".$country."' AND r_id='" .$old_rid. "' AND c_id='" .$cid. "'";
//    $result_update = mysqli_query($db,$req_update);
//}



//$req_n = "SELECT * FROM notification WHERE "


//if ( !$req ) {
//    printf("Error: %s\n", mysqli_error($db));
//}
//else{
//
//}
?>