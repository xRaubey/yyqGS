<?php
require_once "../private/initialize.php";
session_start();

////$type="image/png";
//$image_64=isset($_FILES['profile']['tmp_name'])?$_FILES['profile']['tmp_name']:'';
//
//if(is_post_request()){
//
//
//    $name = mysqli_real_escape_string($db,$_FILES['profile']['name']);
//    $image = mysqli_real_escape_string($db,$_FILES['profile']['tmp_name']);
//    $type = mysqli_real_escape_string($db,$_FILES['profile']['type']);
//    $size = mysqli_real_escape_string($db,$_FILES['profile']['size']);
//
//    if(empty($name) || $name==null){
//        $name = 'icon.png';
//    }
//
//
//}
//else{
//    $name = "icon.png";
//}
//
//if(empty($name)){
//    $name = "icon.png";
//}



?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="author" content="yyq">
    <meta name="description" content="LikeCenter">
    <title>Global News</title>

    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/croppie.css') ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/bootstrap.css') ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/profile_picture.css') ?>">


</head>

<body>


    <div class="container">
        <div class="row p-0 m-0 h-100 justify-content-center align-content-center">

            <div id="container" class="row col-10 col-md-8 col-lg-6 h-50 bg-light">

                <div id="title" class="col-12 p-0 m-0">Profile Image</div>
<!--                <img class="my-image col-12" src="--><?php //$path = 'uploaded_images/'; echo $path.$name ?><!--" />-->

                <img class="my-image" src="" alt="Profile Image" />

                <!--                <img class="my-image col-12" src="data:;base64," />-->


                <form class="col-12" action="profile_picture.php" method="post" enctype="multipart/form-data" id="profile_form">
                    <input class="form-control" type="file" id="profile" name="profile">
                </form>

                <div id="notice" class="col-12">

                </div>

            </div>

        </div>

    </div>




<script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/croppie.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/bootstrap.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/profile_picture.js')?>" type="text/javascript"></script>
</body>

</html>