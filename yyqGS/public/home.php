<?php
    require_once '../private/initialize.php';
    session_start();

    $info_array='';
if(!$_SESSION['loggedIn']){
    session_destroy();
    redirect_to(url_for("index.php"));
}
else{

    //    $_SESSION['id'] = $_GET['id'];


    if(isset($_SESSION['ID'])){
        $id = $_SESSION['ID'];
        $sql = "SELECT * FROM log_in WHERE id='" . $id . "'";
        $result = mysqli_query($db,$sql);
        $info_array = mysqli_fetch_assoc($result);

        if(isset($_SESSION['country'])){
            unset($_SESSION['country']);
        }

//        redirect_to(url_for("home.php?id=". $_SESSION['ID']));


//        echo '<scprit> alert('. $info_array['id']. ')</scprit>';
//
//
//        if($info_array['id']!=$id){
//            echo'<script>window.location = \'index.php\';</script>';
//        }

        mysqli_free_result($result);
    }
    else{
        session_destroy();
        echo'<script>window.location = \'index.php\';</script>';
    }

}

?>

<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="author" content="yyq">
        <meta name="description" content="LC-Home">
        <title>Global News</title>
        <link href="./stylesheet/bootstrap.css" type="text/css" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/home.css') ?>">


    </head>

<body>

    <div id="loading_page">
        <div class="blah">
            <div class="lds-css">
                <div class="lds-microsoft">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <div id="welcomings1">
            Loading...
        </div>
        <footer id="footer">
            Yuqing Yang
        </footer>
    </div>


    <div id="person_info">
        Welcome
            <?php
            echo "<image id='profile_image' src='";

                if(isset($id))
                {
                    $sql_image = "SELECT * FROM log_in WHERE id='". $id."'";
                    $result_image = mysqli_query($db,$sql_image);
                    $subject_image = mysqli_fetch_assoc($result_image);
                    $image_name = $subject_image['image_name'];

                }
                else{
                    $image_name = 'icon';
                }

            echo "uploaded_images/".$image_name.".png'>";

            ?>

        <?php
            echo "<a href=";
            echo url_for("personal_center.php?id=") . $_SESSION['ID'];
            echo ">";
            echo isset($info_array['user_name'])?$info_array['user_name']:'';
            echo "</a>";
        ?>
    </div>

    <div id="info">
        <?php
        $length = isset($_SESSION['NEW_COUNT'])?$_SESSION['NEW_COUNT']:'0';
            if($length>0){
                echo $length." new replies";
            }
            else{
                echo "No new replies yet";
            }
        ?>
        <a id="logout" href="<?php echo url_for('/form/log_out.php') ?>" target="_self">[Log Out]</a>
    </div>

<!--        <div id="tooltip-container"></div>-->
<!---->
<!--        <div id="canvas-svg"></div>-->
<!---->
    <div id="tooltip"></div>



    <!--        <script src="https://d3js.org/d3.v4.min.js"></script>-->

    <!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/topojson/1.1.0/topojson.min.js"></script>-->
    <script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/d3.v4.min.js') ?>"></script>
    <script src="<?php echo url_for('/script/topojson.min.js') ?>"></script>

    <script src="<?php echo url_for('/script/three.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/home.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/OrbitControls.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/TweenMax.min.js')?>" type="text/javascript"></script>

    <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

</body>

</html>