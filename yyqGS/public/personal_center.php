<?php
require_once '../private/initialize.php';
session_start();
//$id = isset($_GET['id'])?$_GET['id']:'';

if(!$_SESSION['loggedIn']){
    redirect_to(url_for("index.php"));
}

if(isset($_SESSION['ID'])){
    $sid = $_SESSION['ID'];

    if($sid != $_GET['id']){
        redirect_to(url_for("personal_center.php?id=".$_SESSION['ID']));
    }
}
else{
    echo'<script>window.location = \'index.php\';</script>';
}

?>

<!doctype html>
<html lang="en">
<meta charset="utf-8">
<meta name="author" content="yyq">
<meta name="description" content="LW-Home">
<title>Little World</title>
<link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/personal_center.css') ?>">
</html>

<body>
<div id="loading_page">

</div>

<div id="person_content">
            <?php

            $req_user = "SELECT * FROM log_in WHERE id='" .$_GET['id'] ."'";
            $result_user = mysqli_query($db,$req_user);
            $subject_user = mysqli_fetch_assoc($result_user);


            $req = "SELECT * FROM notification WHERE receiver='" .$subject_user['user_name']."' AND replier!='".$subject_user['user_name']."' ORDER BY id DESC LIMIT 50";
            $result = mysqli_query($db,$req);


            if(mysqli_num_rows($result)>0){
                while($subject = mysqli_fetch_assoc($result)){
                    $user = $subject['replier'];
                    $req_image = "SELECT * FROM log_in WHERE user_name='".$user."'";
                    $result_image = mysqli_query($db,$req_image);
                    $subject_image = mysqli_fetch_assoc($result_image);

                    if($subject['new']==1){
                        echo "<div class='note_container new'>";

                        echo "<div class='comment'>";
                        echo "You said: ";
                        echo $subject['comment'];
                        echo "</div>";

                        echo "<div class='reply'>";
                        echo "<image class='profile_image' src='";
                        echo "uploaded_images/".$subject_image['image_name'].".png'>";
                        echo $subject['replier'];
                        echo " replies you: ";
                        echo $subject['reply'];
                        echo "</div>";

                        echo "</div>";
                    }
                    else{
                        echo "<div class='note_container'>";

                        echo "<div class='comment'>";
                        echo "You said: ";
                        echo $subject['comment'];
                        echo "</div>";

                        echo "<div class='reply'>";
                        echo "<image class='profile_image' src='";
                        echo "uploaded_images/".$subject_image['image_name'].".png'>";
                        echo $subject['replier'];
                        echo " replies you: ";
                        echo $subject['reply'];

                        echo "<button class='go'>Go</button>";
                        echo "</div>";

                        echo "</div>";
                    }

                }

            }
            else{
                echo "No Notifications Yet!";
            }
            ?>

</div>

<div id="like_content">
    <?php
    if($id !=''){
        $req_likes = "SELECT * FROM liked WHERE user_name='".$subject_user['user_name']."'";
        $result_likes = mysqli_query($db,$req_likes);
        if (mysqli_num_rows($result_likes)>0){
            while($subject_likes = mysqli_fetch_assoc($result_likes)){
                $req_get_likes = "SELECT * FROM new_thread WHERE country='".$subject_likes['country']."' AND t_id='".$subject_likes['t_id']."'";
                $result_get_likes = mysqli_query($db,$req_get_likes);
                $subject_get_likes = mysqli_fetch_assoc($result_get_likes);

                echo "<div class='likes_container'>";
                echo $subject_get_likes['title'];
                echo "</div>";
            }
        }
    }

    ?>

</div>

<div id="bottom_bar">
    <div id="notification">Notification</div>
    <div id="likes">Likes</div>
</div>

<div id="toolbar">

    <div class="svg_container">
        <?php
        $req_profile = "SELECT * FROM log_in WHERE id='".$_GET['id']."'";
        $result_profile = mysqli_query($db,$req_profile);
        $subject_profile = mysqli_fetch_assoc($result_profile);
        $path = "uploaded_images/".$subject_profile['image_name'];
        echo "<image class='profile_image2' src='" .$path. ".png'>"
        ?>
    </div>

    <div class="svg_container" id="gb">
        <svg width="55" height="55" xmlns="http://www.w3.org/2000/svg" id="gb_button">

            <g>
                <rect fill="none" id="canvas_background" height="57" width="57" y="-1" x="-1"/>
                <g display="none" id="canvasGrid">
                    <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>
                </g>
            </g>
            <g>
                <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>
                <path id="svg_2" d="m24.301544,18.44399l0,-2.618723l-13.062219,8.111073l13.062219,8.111145l0,-2.809936c3.544505,-0.001783 9.767133,0.323995 9.767133,2.632884c0,3.226055 -6.498803,4.947059 -6.498803,4.947059l0,2.473502c0,0 14.598732,0.536472 14.598732,-11.39912c0,-9.377081 -12.503267,-9.729446 -17.867062,-9.447884z" stroke-width="0.2" fill="#ffffff"/>
            </g>
        </svg>
    </div>


</div>

<script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/personal_center.js')?>" type="text/javascript"></script>
</body>



