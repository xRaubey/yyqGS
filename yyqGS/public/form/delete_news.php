<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/21/21
 * Time: 11:27 PM
 */


/**
 * Delete outdated news from database.
 */

require_once '../../private/initialize.php';


    $currentTime = isset($_POST['currentTime'])? $_POST['currentTime'] : '';

    $req = "SELECT * FROM comment WHERE  user = 'GN'";
    $result = mysqli_query($db,$req);

    while($row=mysqli_fetch_assoc($result)){

        $d_req = "DELETE FROM `comments` WHERE `tid` = '".$row['t_id']."'";
        $r1 = mysqli_query($db,$d_req);

    }

//    $d_req = "DELETE FROM `comments` WHERE `user` = 'GN'";
//    $r1 = mysqli_query($db,$d_req);


    $d_req2 = "DELETE FROM `new_thread` WHERE `author` = 'GN'";
    $r2 = mysqli_query($db,$d_req2);

    $req3 = "DELETE FROM liked WHERE auto_delete = 'T'";
    mysqli_query($db,$req3);




    $req_update = "UPDATE timer SET last_update = '" . $currentTime . "' LIMIT 1";
    $result_update = mysqli_query($db,$req_update);




    if($result_update){

        echo "success";

    }

    else{
        echo "Error";
    }