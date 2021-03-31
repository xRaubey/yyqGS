<?php
require_once "../private/initialize.php";
session_start();
if(!$_SESSION['loggedIn']){
    redirect_to(url_for("index.php"));
}

if(is_post_request()){
    $name = mysqli_real_escape_string($db,$_FILES['profile']['name']);
    $image = mysqli_real_escape_string($db,$_FILES['profile']['tmp_name']);
    $type = mysqli_real_escape_string($db,$_FILES['profile']['type']);
    $size = mysqli_real_escape_string($db,$_FILES['profile']['size']);

    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $extension_array = array('image/jpg','image/jpeg','image/png');

    $error1 = '';
    $error2 = '';

    if(in_array($type,$extension_array)){
        if($size < 5000000){
            $location = "uploaded_images/";
            move_uploaded_file($image,$location.$name);
        }
        else{
            $error1=  'The file is bigger then 5m bytes!';
        }

    }
    elseif(empty($type) && empty($image) && empty($name)){

    }
    else{
        $error2= 'Incorrect file type!';
    }

    if(isset($error1)){
        $_SESSION['ERROR1'] = $error1;
    }
    if(isset($error2)){
        $_SESSION['ERROR2'] = $error2;
    }

}
if(empty($name)){
    $name = 'icon.png';
}


?>

<!doctype html>
<html lang="en">
<meta charset="utf-8">
<meta name="author" content="yyq">
<meta name="description" content="LikeCenter">
<title>Little World</title>
<link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/croppie.css') ?>">
<link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/change_profile_picture.css') ?>">
</html>

<body>
<div id="loading_page">

</div>

<div id="container">
    <div id="title">Change Profile Image</div>
    <img class="my-image" src="<?php $path = 'uploaded_images/'; echo $path.$name ?>" />

    <form action="change_profile_picture.php" method="post" enctype="multipart/form-data" id="profile_form">
        <input type="file" id="profile" name="profile">
    </form>

    <div id="notice">
        <?php
        if(isset($error1)&&$error1!='' && isset($error2)&&$error2!=''){
            echo $error1."<br>".$error2;
        }
        elseif(isset($error1)&&$error1!=''){
            echo $error1;
        }
        elseif(isset($error2)&&$error2!=''){
            echo $error2;
        }
        else{

        }
        ?>
    </div>
</div>



<script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/croppie.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/change_profile_picture.js')?>" type="text/javascript"></script>
</body>
