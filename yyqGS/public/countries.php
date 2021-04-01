<?php
    require_once "../private/initialize.php";
    session_start();

//    $country = mysqli_real_escape_string($db,$_GET['country']);
//    $_SESSION['country'] = $country;

    $country = $_SESSION['country'];

if(!$_SESSION['loggedIn']){
    redirect_to(url_for("index.php"));
}


if(isset($_SESSION['ID']) && isset($_SESSION['country'])){
    $sid = $_SESSION['ID'];

    if($sid != $_GET['id'] || $country!=$_GET['country']){
        redirect_to(url_for("countries.php?id=".$_SESSION['ID']."&country=". $country));
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
<meta name="description" content="LikeCenter">
<title>Little World</title>
<link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/countries.css') ?>">
</html>

<body>

<div id="toolbar">
    <div class="svg_container">
        <?php
        $req_profile = "SELECT * FROM log_in WHERE id='".$_GET['id']."'";
        $result_profile = mysqli_query($db,$req_profile);
        $subject_profile = mysqli_fetch_assoc($result_profile);
        $path = "uploaded_images/".$subject_profile['image_name'];
        echo "<image class='profile_image' src='" .$path. ".png'>"
        ?>
    </div>

    <div class="svg_container">
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

    <div class="svg_container">
    <svg width="55" height="55" xmlns="http://www.w3.org/2000/svg" id="dialog_button">

        <g>
            <rect x="-1" y="-1" width="57" height="57" id="canvas_background" fill="none"/>
            <g id="canvasGrid" display="none">
                <rect id="svg_3" width="580" height="400" x="1" y="1" stroke-width="0" fill="url(#gridpattern)"/>
            </g>
        </g>
        <g>
            <ellipse fill="none" stroke-width="3.5" cx="27.641024" cy="27.564104" id="svg_1" rx="25" ry="25" stroke="#1af2d5"/>
            <path fill="#ffffff" stroke-width="1.5" d="m44.084882,17.997256l0,0c0,-1.754287 -1.71817,-3.176421 -3.837633,-3.176421l-1.744379,0l0,0l-8.373003,0l-15.699385,0c-1.017798,0 -1.993918,0.334664 -2.713607,0.930358c-0.7197,0.595694 -1.124015,1.403631 -1.124015,2.246063l0,7.941057l0,0l0,4.764626l0,0c0,1.754287 1.71816,3.176421 3.837623,3.176421l15.699385,0l10.938297,8.076901l-2.565293,-8.076901l1.744379,0c2.119463,0 3.837633,-1.422134 3.837633,-3.176421l0,0l0,-4.764626l0,0l0,-7.941057z" id="svg_2"/>
        </g>
    </svg>
    </div>


</div>



<div id="container">
    <div id="country_name">
        <?php echo $_GET['country']?>
    </div>
    <div id="country_des">
        Language:
        <?php
        $req = "SELECT * FROM world_x.country WHERE Name='" .$country . "'";
        $result = mysqli_query($db,$req);
        $subject = mysqli_fetch_assoc($result);
        $code = $subject['Code'];

        $req2 = "SELECT * FROM world_x.countrylanguage WHERE CountryCode='". $code ."' AND IsOfficial='T'";
        $result2 = mysqli_query($db,$req2);
        $subject2 = mysqli_fetch_assoc($result2);

        echo $subject2['Language']?$subject2['Language']:'No official language.';

        echo "<image class='flag' src='flags/".strtolower($subject['Code2']).".png'>";

        ?>

    </div>

    <div id="threads">

        <?php
            $sql = "SELECT * FROM new_thread WHERE country='" .$country. "' ORDER BY latest DESC";
            $result3 = mysqli_query($db,$sql);




            if(mysqli_num_rows($result3)>0){
                $index = 0;
                while($row=mysqli_fetch_assoc($result3))
                {
                    $sql_rn = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$row['t_id']. "'";
                    $result_rn = mysqli_query($db,$sql_rn);
                    $rn = mysqli_num_rows($result_rn);

                    $sql_t_date = "SELECT * FROM new_thread WHERE country='" .$country. "' AND t_id='". $row['t_id']."'";
                    $result_t_date = mysqli_query($db,$sql_t_date);
                    $subject_t_date = mysqli_fetch_assoc($result_t_date);

                    $sql_content = "SELECT * FROM comments WHERE country='". $country ."' AND t_id='". $row['t_id']."' AND c_id='1' AND r_id='0'";
                    $result_content = mysqli_query($db,$sql_content);
                    $subject_content = mysqli_fetch_assoc($result_content);


                    echo "<div class=\"single_thread\">";
                    echo "<div class=\"thread_title\">";
                    echo "<a href='";
                    echo  url_for("thread.php?id=".$_GET['id']."&country=".$country."&tid=".$row['t_id']);
                    echo  "'>";
                    echo $row['title'];
                    echo "</a>";
                    echo "</div>";
                    echo "<div class=\"thread_content\">";
                    echo $subject_content['comment'];
                    echo "</div>";
                    echo "<div class=\"thread_image_container\">";
                    $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                    if(!empty($image_name)){
                        $path = "uploaded_images/".$image_name;
                        echo "<image class='thread_image' src='".$path."'>";
                    }
                    echo "</div>";
                    echo "<div class='reply_num'>";
                    echo $subject_t_date['date'] . ' ';
                    echo "Replies:".$rn;
                    echo "</div>";
                    echo "</div>";

                }
            }
            else{
                echo "No threads yet";
            }
        ?>
    </div>


    <div id="new_thread">
        <form enctype='multipart/form-data' id="thread" method="post" action="<?php echo url_for('/form/new_thread.php') ?>">
            <div id="themeT">
                Theme<br>
            </div>

            <input type="text" maxlength="50" placeholder="Title-" name="title" id="theme"><br>

            <div id="contentT">Content<br>
            </div>
            <input type="file" id="image" name="tImage"><br>
            <div class="note"></div>

            <textarea placeholder="Say something" name="content" id="content"></textarea>

            <button id="cancel" >Cancel</button>
            <button id="send">Send</button>
            <button id="loading">Loading...</button>

        </form>
    </div>

    <div id="show_image"></div>


</div>

    <script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/countries.js')?>" type="text/javascript"></script>
</body>