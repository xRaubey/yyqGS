<?php
require_once "../private/initialize.php";
session_start();

//$_SESSION['uploaded_image'] = isset($_FILES['profile']['tmp_name'])?$_FILES['profile']['tmp_name']:'';
//
////$type="image/png";
//$image_64=isset($_SESSION['uploaded_image'])?$_SESSION['uploaded_image']:null;
//
//$name = "";
//$image = "";
//$type = "";
//$size = "";
//
//
//if(is_post_request()){
//    $name = mysqli_real_escape_string($db,$_FILES['profile']['name']);
//    $image = mysqli_real_escape_string($db,$_FILES['profile']['tmp_name']);
//
//
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
//
////    $name = mysqli_real_escape_string($db,$_FILES['profile']['name']);
////    $image = mysqli_real_escape_string($db,$_FILES['profile']['tmp_name']);
////    $type = mysqli_real_escape_string($db,$_FILES['profile']['type']);
////    $size = mysqli_real_escape_string($db,$_FILES['profile']['size']);
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
    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/change_profile_picture.css') ?>">


</head>

<body>


<div class="container">
    <div class="row p-0 m-0 h-100 justify-content-center align-content-center">

        <div id="container" class="row col-10 col-md-8 col-lg-6 h-50 bg-light">

            <div id="title" class="col-12 p-0 m-0">Change Profile Image</div>
<!--            <img class="my-image col-12" src="--><?php //$path = 'uploaded_images/'; echo $path.$name ?><!--" />-->

            <img class="my-image col-12" src="" alt="Red dot"  />

            <form class="col-12" action="change_profile_picture.php" method="post" enctype="multipart/form-data" id="profile_form">
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
<script src="<?php echo url_for('/script/change_profile_picture.js')?>" type="text/javascript"></script>

<script>

    <?php

    if(isset($_SESSION['ID']) && $_SESSION['loggedIn']==true){
        echo "
    
        $('#gb').on(\"click\",function () {
            location.href = \"./personal_center.php?id=".$_SESSION['ID']."\";
        });
        
        
        
        
        $('#choose_profile').on(\"click\",function () {

            $('.my-image').croppie('result','base64').then(function (image) {
                $.ajax({
                    url:\"./form/profile.php\",
                    type:\"POST\",
                    data:{profile:image},
                    success:function (d) {
    
                        var data = JSON.parse(d);
    
                        console.log(data.id);
    
                        if(data.error1===''&& data.error2===''){
                            location.href=\"./personal_center.php?id=\"+data.id;
                        }
                        else{
    
                            $(\"#notice\").html(\"Try again\");
                        }
    
    
                    }
                })
            });
    });
        

        ";
    }
    else{
        session_destroy();
        echo "
    
        $('#gb').on(\"click\",function () {
            location.href = \"./index.php\"
        });
        
        $('#choose_profile').on(\"click\",function () {
            location.href = \"./index.php\"
        });
        
        ";
    }


    ?>

</script>

</body>

</html>