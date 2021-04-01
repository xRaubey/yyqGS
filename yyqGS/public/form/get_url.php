<?php
require_once "../../private/initialize.php";
    session_start();
    $tid = $_SESSION['tid'];
//    $id = $_SESSION['id'];
    $id = $_SESSION['ID'];

$country = $_SESSION['country'];
    $rid = $_SESSION['REPLY_INDEX'];
    $cid = $_SESSION['COMMENT_INDEX'];

    $req = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND c_id='" .$cid. "' AND r_id='".$rid."'";
    $result = mysqli_query($db,$req);
    $subject = mysqli_fetch_assoc($result);
    $comment_user = $subject['user'];

    $req_page = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "' AND r_id='0'";
    $result_page = mysqli_query($db,$req_page);
    $page = floor(mysqli_num_rows($result_page)/10+1);

    echo $id.",".$country.",".$tid.",".$cid.",".$rid.",".$comment_user,",",$page;