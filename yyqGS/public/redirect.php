<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/27/21
 * Time: 5:08 PM
 */

require_once '../private/initialize.php';
session_start();

$login = isset($_SESSION['loggedIn'])?$_SESSION['loggedIn']:null;

$id = null;
$country = null;
$tid = null;
$url = null;

$url = isset($_POST['url'])?$_POST['url']:null;



//if($login!=null && $login==true){
//
//    if(is_post_request()){
//
//        $id = isset($_SESSION['ID'])?$_SESSION['ID']:null;
//        $tid = isset($_SESSION['t_id'])?$_SESSION['t_id']:null;
//        $country = isset($_SESSION['country'])?$_SESSION['country']:null;
//
//        if($id!=null && $tid!=null && $country!=null){
//
//            $url = isset($_POST['url'])?$_POST['url']:null;
//
//        }
//        else{
//            session_destroy();
//            redirect_to(url_for("./index.php"));
//        }
//
//    }
//
//
//}
//else{
//    session_destroy();
//    redirect_to(url_for("./index.php"));
//}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="yyq">
    <meta name="description" content="LikeCenter">
    <title>Global News</title>

    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/redirect.css') ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/bootstrap.css') ?>">


</head>

<body>

    <div class="container">
        <div class="row p-0 m-0">
            <div class="col-12">
                You're being redirected to
            </div>
            <?php

            echo "<a class='col-12' target='_blank' href='$url'>$url</a>";

            ?>
            <button id="gb" class="tb_button btn btn-danger">Go Back</button>
        </div>
    </div>


    <script src="script/jquery-3.1.1.js"></script>
    <script src="<?php echo url_for('/script/bootstrap.min.js')?>" type="text/javascript"></script>

    <script>

        $("#gb").on("click",function () {
            var self = $(this);
            $(".tb_button").each(function () {
                $(this).attr("disabled","true");

            });

            history.back();
        });

    </script>

</body>


</html>