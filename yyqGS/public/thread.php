<?php
require_once "../private/initialize.php";
session_start();
if(!$_SESSION['loggedIn']){
    redirect_to(url_for("index.php"));
}

//$id = $_GET['id'];
$id = $_SESSION['ID'];
$t_id = $_GET['tid'];
$_SESSION['tid'] = $t_id;
// $country = $_GET['country'];
$country = $_SESSION['country'];
// $country = mysqli_real_escape_string($db,$country);
// $_SESSION['country']=$country;
$page = isset($_GET['page'])?$_GET['page']:'1';


$auto='';

$r_author = "SELECT * FROM comments WHERE country='".$country."' AND t_id='".$t_id."' AND c_id='1' AND r_id='0'";
$r_result = mysqli_query($db,$r_author);
$r_row = mysqli_fetch_assoc($r_result);

$url = $r_row['url'];

                    if($r_row['user']=='GN'){
                        $auto='T';
                    }
                    else{
                        $auto='F';
                    }






if(isset($_SESSION['ID']) && isset($_SESSION['country'])){

    if($id != $_GET['id'] || $country!=$_GET['country']){
        redirect_to(url_for("countries.php?id=".$_SESSION['ID']."&country=". $country));
    }
    else{



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
<title>Global News</title>
<link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/thread.css') ?>">
<link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/bootstrap.min.css') ?>"

</html>

<body>
<div id="loading_page"></div>

<div class="container p-0 m-0 w-100 h-100">
    <div class="row p-0 m-0 h-100 w-100">

        <div id="container" class="col-10 h-100 p-0 m-0">

            <div class="row col-12 p-0 m-0" style="height: 90%; z-index: 1;">

                <div id="title" class="col-12 p-2 h-25 bg-light text-dark font-weight-bold">
                    <?php
                    $req = "SELECT * FROM new_thread WHERE country='" .$country. "' AND t_id='" .$t_id. "'";
                    $result = mysqli_query($db,$req);
                    $subject = mysqli_fetch_assoc($result);
                    echo $subject['title'];
                    ?>
                </div>

                <div id="comments_container" class="col-12 m-0 text-light h-75 row p-0">

                    <?php
                    $req_find = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$t_id. "' AND r_id='0' AND page='".$page."'" ;
                    $result_find = mysqli_query($db,$req_find);
                    $result_find_row = mysqli_num_rows($result_find);




//                    $req_find_page = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$t_id. "' AND r_id='0'" ;
//                    $result_find_page = mysqli_query($db,$req_find_page);
//                    $thread_amount = mysqli_num_rows($result_find_page);

                    if($result_find_row>0){
                        $index = 0;

//                        $index2 = 0;
                        while($subject_find=mysqli_fetch_assoc($result_find)){
//                            $index2++;



                            $index2 = ($page-1)*10+$index+1;
                            $index ++;
                            $index_r = 0;
                            $req_user = "SELECT * FROM log_in WHERE user_name='" .$subject_find['user']. "'";
                            $result_user = mysqli_query($db,$req_user);
                            $subject_user = mysqli_fetch_assoc($result_user);
                            if($subject_user){
                                $user_id = $subject_user['id'];
                            }
                            else{
                                $user_id = 0;
                            }

                            echo "<div class='cr col-12 p-0 m-0 row align-content-start'>";


                            echo "<div class='comment col-12 row p-0 m-0'>";


                            echo "<div class = 'user col-3 col-md-2 row p-0 m-0'>";

                            if($user_id !=0){

                                echo "<div class='profile_image_container col-12 p-0 m-0 row justify-content-center'>";

                                echo "<img class='profile_image' src='uploaded_images/";
                                echo $subject_user['image_name'].'.png';
                                echo "'>";

                                echo "</div>";

                                echo "<div class='user_name col-12 p-0 m-0 text-center'>";

                                echo $subject_find['user'];

                                echo "</div>";

                            }

                            else{
                                echo "<div class='profile_image_container col-12 p-0 m-0 row justify-content-center'>";

                                echo "<img class='profile_image' src='uploaded_images/icon.png'>";

                                echo "</div>";

                                echo "<div class='user_name col-12 p-0 m-0 text-center'>";
                                echo "Global News";


                                echo "</div>";
                            }
//                            echo "<br>";


                            $req_first = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$t_id. "' AND c_id='1'";
                            $result_first = mysqli_query($db,$req_first);
                            $subject_first = mysqli_fetch_assoc($result_first);

//                            $req_current = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$t_id. "' AND c_id='" .$index. "'";
                            $req_current = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$t_id. "' AND c_id='" .$index2. "'";

                            $result_current = mysqli_query($db,$req_current);
                            $subject_current = mysqli_fetch_assoc($result_current);

                            date_default_timezone_set("America/Chicago");
                            $now = strtotime('now');
                            $current = strtotime($subject_current['time']);
                            $reply_time = strtotime($subject_first['time']);
                            $diff = abs(($now-$reply_time) - ($current-$reply_time));

                            //echo "now=".$now ."first=".$reply_time ."diff=" .$diff;


                            echo "<div class='col-12 p-0 m-0 text-center'>";


                            if($diff < 60){

//                                echo "<div class='col-12 p-0 m-0 text-center'>";

                                    echo "Just Now";

//                                echo "</div>";

//                                echo "<br>";

//                                echo "<div class='thread_num col-12 p-0 m-0 text-center'>";
//
//                                    echo $index2;
////                                echo $index;
//
//                                echo "</div>";


                            }
                            elseif($diff>=60 && $diff<120){

//                                echo "<div class='col-12 p-0 m-0 text-center'>";

                                echo "1 Min Ago";

//                                echo "</div>";

//                                echo "<br>";

//                                echo "<div class='thread_num col-12 p-0 m-0 text-center'>";
//
//                                echo $index2;
////                                echo $index;
//
//                                echo "</div>";

//                                echo "1 Min Ago";
//                                echo "<br>";
//                                echo $index2;
                            }
                            elseif($diff>=60 && $diff<3600){

//                                echo "<div class='col-12 p-0 m-0 text-center'>";

                                echo floor($diff/60)." Mins Ago";

//                                echo "</div>";

//                                echo "<br>";

//                                echo "<div class='col-12 p-0 m-0 text-center'>";
//
//                                echo $index2;
////                                echo $index;
//
//                                echo "</div>";


//                                echo floor($diff/60)." Mins Ago";
//                                echo "<br>";
//                                echo $index2;
                            }
                            elseif ($diff>=3600 && $diff<7200){

//                                echo "<div class='col-12 p-0 m-0 text-center'>";

                                echo "1 Hour Ago";

//                                echo "</div>";

//                                echo "<br>";

//                                echo "<div class='col-12 p-0 m-0 text-center'>";
//
//                                echo $index2;
////                                echo $index;
//
//                                echo "</div>";


//                                echo "1 Hour Ago";
//                                echo "<br>";
//                                echo $index2;
                            }
                            elseif ($diff>=3600 && $diff< 24*60*60){


//                                echo "<div class='col-12 p-0 m-0 text-center'>";

                                echo floor($diff/3600) . " Hours Ago";

//                                echo "</div>";

//                                echo "<br>";

//                                echo "<div class='col-12 p-0 m-0 text-center'>";
//
//                                echo $index2;
////                                echo $index;
//
//                                echo "</div>";


//                                echo floor($diff/3600) . " Hours Ago";
//                                echo "<br>";
//                                echo $index2;
                            }
                            else{

//                                echo "<div class='col-12 p-0 m-0 text-center'>";

                                echo substr($subject_first['time'],0,strpos($subject_first['time'],' '));

//                                echo "</div>";

//                                echo "<br>";

//                                echo "<div class='col-12 p-0 m-0 text-center'>";
//
//                                echo $index2;
////                                echo $index;
//
//                                echo "</div>";

//                                echo substr($subject_first['time'],0,strpos($subject_first['time'],' '));
//                                echo "<br>";
//                                echo $index2;
                            }

                            echo "</div>";



                            echo "<div class='thread_num col-12 p-0 m-0 text-center'>";

                            echo $index2;
//                                echo $index;

                            echo "</div>";


                            echo "</div>";



                            echo "<div class = 'comment_container col-9 col-md-10 p-0 m-0 row'>";


                            echo "<div class = 'comment_content col-10 p-0 m-0'>";
                            echo $subject_find['comment'];
                            echo "</div>";


                            echo "<div class = 'image_container col-2 m-0 p-0 align-content-center justify-content-center row' style='right:0;'>";

                            if($subject_find['user']=="GN"){


                                $path = $subject_find['images'];
                                echo "<img class='uploaded_image align-self-center' src='".$path."'>";
                            }
                            elseif($subject_find['image_name']){
//                                echo "<br>";

                                $path = './uploaded_images/';
                                echo "<img class='uploaded_image align-self-center' src='" . $path . $subject_find['image_name'] . "'>";
                            }
                            else{

                            }

                            echo "</div>";


                            echo "</div>";

                            echo "</div>";

                            echo "<div class='reply_container col-12 row p-0 m-0'>";

//                            $req_reply = "SELECT * FROM comments WHERE country='".$country."' AND t_id='" .$t_id."' AND c_id='" .$index. "' AND r_id!='0'";
                            $req_reply = "SELECT * FROM comments WHERE country='".$country."' AND t_id='" .$t_id."' AND c_id='" .$index2. "' AND r_id!='0' AND page='". $page."'";

                            $result_reply = mysqli_query($db,$req_reply);

                            if(mysqli_num_rows($result_reply)>0){
                                while($subject_reply=mysqli_fetch_assoc($result_reply)){

                                    $index_r++;

                                    $req_user2 = "SELECT * FROM log_in WHERE user_name='" .$subject_reply['user']. "'";
                                    $result_user2 = mysqli_query($db,$req_user2);
                                    $subject_user2 = mysqli_fetch_assoc($result_user2);
                                    $user_id2 = $subject_user2['id'];




                                    if($subject_reply['user']!='-'){
                                        echo "<div class='single_reply col-12 row p-0 m-0 justify-content-start align-content-center align-items-center'>";
                                    }
                                    else{
                                        echo "<div class='single_reply col-12 row p-0 m-0 justify-content-start align-content-conter align-items-center d-none'>";
                                    }




                                    echo "<div class='single_reply_container col-12 p-0 m-0 row align-content-center'>";



                                    echo "<div class='reply_user col-3 p-0 m-0 row align-content-center'>";

                                    echo "<div class='col-12 p-0 m-0 reply_username' style='white-space:nowrap; overflow: hidden;text-overflow: ellipsis;'>";

                                    echo $subject_reply['user'];
                                    $req_receiver = "SELECT * FROM comments WHERE country='" . $country
                                        . "' AND t_id='" . $t_id
                                        ."' AND c_id='" . $index
                                        ."' AND r_id='".$index_r . "'";
                                    $result_receiver = mysqli_query($db,$req_receiver);
                                    $subject_receiver = mysqli_fetch_assoc($result_receiver);
                                    $receiver = $subject_receiver['receiver'];
                                    $replier = $subject_receiver['user'];
                                    if($receiver!=$replier && $receiver!='-'){
                                        echo "@". $receiver . ":";
                                    }

                                    echo "</div>";


//                                    echo "<br>";


                                    echo "<div class='col-12 p-0 m-0 reply_usertime' style='white-space:nowrap; overflow: hidden;text-overflow: ellipsis;'>";

                                    $req_ri = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$t_id. "' AND c_id='" . $index . "'AND r_id!='0'";
                                    $result_ri = mysqli_query($db,$req_ri);
                                    $subject_ri = mysqli_fetch_assoc($result_ri);

                                    $req_current_r = "SELECT * FROM comments WHERE country='" .$country. "' AND t_id='" .$t_id. "' AND c_id='" . $index . "'AND r_id='" .$index_r. "'";
                                    $result_current_r = mysqli_query($db,$req_current_r);
                                    $subject_current_r = mysqli_fetch_assoc($result_current_r);

                                    date_default_timezone_set("America/Chicago");
                                    $now2 = strtotime('now');
                                    $current2 = strtotime($subject_current_r['time']);
                                    $reply_time2 = strtotime($subject_ri['time']);
                                    $diff2 = abs(($now2-$reply_time2) - ($current2-$reply_time2));

                                    //echo "now=".$now ."first=".$reply_time ."diff=" .$diff;

                                    if($diff2 < 60){
                                        echo "Just Now";
                                        echo "<br>";
                                    }
                                    elseif($diff2>=60 && $diff2<3600){
                                        echo floor($diff2/60)." Mins Ago";
                                        echo "<br>";
                                    }
                                    elseif ($diff2>=3600 && $diff2< 24*60*60){
                                        echo floor($diff2/3600) . " Hours Ago";
                                        echo "<br>";
                                    }
                                    else{
                                        echo substr($subject_first['time'],0,strpos($subject_first['time'],' '));
                                        echo "<br>";
                                    }

                                    echo "</div>";


                                    echo "</div>";

                                    echo "<div class='reply_content col-7 p-0 pr-1 pl-1 m-0 align-self-center'>";
                                    echo $subject_reply['comment'];
//                                    echo 'index2='.$index2;

                                    echo "</div>";

                                    if($id == $user_id2){
                                        echo "<button class='tb_button btn btn-danger reply_reply_delete align-self-center col-1 p-0 m-0' style=\"white-space:nowrap; overflow: hidden; text-overflow: ellipsis\">";
                                        echo "delete";
                                        echo "</button>";
                                    }
//                                    elseif($id == $user_id2  && $index2=='1'){
//
//                                        echo "<div class=\"tb_button col-12 svg_container\">";
//
//                                        echo "<button id='dt' class='tb_button btn btn-danger w-100'>Delete Thread</button>";
//
//                                        echo "</div>";
//                                    }

                                    if($subject_reply['user']!='-'){
                                        echo "<button class='tb_button btn btn-primary align-self-center reply_reply col-1 p-0 m-0' style=\"white-space:nowrap; overflow: hidden; text-overflow: ellipsis\">";
                                        echo "reply";
                                        echo "</button>";
                                    }




                                    echo "</div>";


                                    echo "<form action='' method='POST' class='reply_reply_form form-inline col-12 p-0 m-0 d-none align-self-center'>";
                                    echo "<input type='text' name='reply_reply_area' class='reply_reply_area form-control p-0 m-0'>";
                                    echo "<input type='button' name='reply_reply' class='tb_button btn btn-primary reply_reply_button form-control p-0 m-0' value='Reply/Cancel'>";
                                    echo "</form>";


                                    echo "</div>";
                                }
                            }
                            else{

                            }

//                            echo "<form action='' method='POST' class='reply_form col-12 row p-0 m-0 align-content-start'>";
//                            echo "<input type='text' name='reply_area' class='reply_area form-control col-11 col-md-10 p-0 m-0'>";
//                            echo "<input type='button' name='reply' class='tb_button btn btn-primary reply_button form-control col-1 col-md-2 p-0 m-0' value='Send'>";
//                            echo "</form>";


                            echo "</div>";


                            echo "<form action='' method='POST' class='reply_form form-inline col-12  p-0 m-0 d-none align-self-center'>";
                            echo "<input type='text' name='reply_area' class='reply_area form-control p-0 m-0'>";
                            echo "<input type='button' name='reply' class='tb_button btn btn-primary reply_button form-control p-0 m-0' value='Send/Cancel'>";
                            echo "</form>";


                            echo "<div class='options_bar col-12 row p-0 m-0 align-content-end justify-content-end'>";
//                            if($id == $user_id){
//                                echo "<button class='tb_button btn btn-danger delete col-2 h-100'>";
//                                echo "Delete";
//                                echo "</button>";
//                            }


                            if($id == $user_id  && $index2!='1'){
                                echo "<button class='tb_button btn btn-danger reply_delete align-self-center col-2 h-100 p-0 m-0' style=\"white-space:nowrap; overflow: hidden; text-overflow: ellipsis\">";
                                echo "Delete";
                                echo "</button>";
                            }
                            elseif($id == $user_id  && $index2=='1'){

                                echo "<button id='dt' class='tb_button btn btn-danger align-self-center col-2 h-100 p-0 m-0' style='white-space:nowrap; overflow:hidden; text-overflow:ellipsis'>Delete Thread</button>";

//                                echo "<div class=\"tb_button col-12 svg_container\">";
//
//                                echo "<button id='dt' class='tb_button btn btn-danger w-100'>Delete Thread</button>";
//
//                                echo "</div>";
                            }


                            if($user_id!=0){
                                echo "<button class='tb_button btn btn-primary reply col-2 h-100'>";
                                echo "Reply";
                                echo "</button>";
                            }



                            echo "</div>";

                            echo "</div>";
                        };
                    }

                    ?>

                </div>

            </div>

            <div id="type" class="col-12 m-0 p-0 bg-dark border-top border-2 border-light" style="height: 10%; box-sizing: border-box;">

                <form class="row h-100 p-0 m-0" action="<?php echo url_for("form/thread.php")?>" method="post" id="type_area" enctype="multipart/form-data">

                    <textarea class="form-control-lg col-8 h-100 bg-dark text-light border-0" rows="2" type="text" id="type_bar" name="comment" maxlength="1000" placeholder="Say something..."></textarea>

                    <div class="col-4 row p-0 m-0 border-1 border-light p-1 justify-content-center h-100" style="box-sizing:border-box">
                        <div class="form-group col-12 bg-dark row p-0 m-0 align-content-around justify-content-center">
<!--                            <label for="upload" class="tb_button col-4 form-label p-0 m-0">I</label>-->
                            <input class="bg-dark border-0 text-light form-control col-12 p-0 m-0" type="file" name="upi" id="upload">
                        </div>
                        <input class="tb_button btn btn-dark text-light col-12 p-0 m-0" type="submit" value="Send" id="send_button" name="type_content">
                    </div>

<!--                    <div class="form-group col-4 p-0 m-0 align-content-around justify-content-center">-->
<!--                        <label for="upload" class="form-check-label col-12">Upload Image</label>-->
<!--                        <input class="form-control col-12" type="file" name="upi" id="upload">-->
<!--                    </div>-->
<!--                    <label id="upload_container">-->
<!--                        <input type="file" name="upi" id="upload">-->
<!--                        <div id="up_title">Upload Image</div>-->
<!--                    </label>-->
<!--                    <input class="btn btn-primary col-4 p-0 m-0" type="submit" value="Send" id="send_button" name="type_content">-->
<!--                    <button id="loading">Loading...</button>-->
                </form>

            </div>

<!--            <div id="show_image"></div>-->

            <div id="show_image" class="row p-0 m-0 justify-content-center align-content-center">

                <img id="thread_image" src="" class="col-12 col-lg-10" style="object-fit: contain">

            </div>

        </div>

        <div id="toolbar" class="col-2 p-0 m-0 h-100 bg-dark" style="opacity:0.9">

            <div class="row p-0 m-0 h-100 align-content-around">

                <div id="page_list_container" class="svg_container col-12">
                    <div id="page_list" class="list-group">

                    </div>
                </div>





                    <?php


                    if($r_row['user']=="GN"){

                        echo "
                            <div class=\"col-12\">
                        
                                <button id=\"ob\" class=\"tb_button w-100 btn btn-outline-light\" style=\"white-space:nowrap; overflow: hidden; text-overflow: ellipsis\"> Redirect </button>
    
                            </div>  
                        ";

                    }
                    else{

                    }

                    ?>





                <div class="col-12">
                    <button id="lo_button" class="tb_button btn btn-outline-warning w-100" style="white-space:nowrap; overflow: hidden; text-overflow: ellipsis">
                        Log out
                    </button>
                </div>



                <?php
                $req_find2 = "SELECT * FROM log_in WHERE id='" . $id."'";
                $result_find2 = mysqli_query($db,$req_find2);
                $subject_find2 = mysqli_fetch_assoc($result_find2);
                $req_liked = "SELECT * FROM liked WHERE user_name='".$subject_find2['user_name']."' AND country='".$country."' AND t_id='".$t_id."'";
                $result_liked = mysqli_query($db,$req_liked);

                ?>

                <div class="col-12">
                    <button id="lb" class="tb_button btn btn-outline-danger w-100" style="white-space:nowrap; overflow: hidden; text-overflow: ellipsis">
                        <?php

                        if(mysqli_num_rows($result_liked)){
                            echo "Remove";
                        }
                        else{
                            echo "Mark";
                        }

                        ?>

                    </button>
<!--                    <svg width="55.00000000000001" height="55.00000000000001" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <g>-->
<!--                            <rect fill="none" id="canvas_background" height="7.583746" width="7.583746" y="-1" x="-1"/>-->
<!--                            <g display="none" id="canvasGrid">-->
<!--                                <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
<!--                            </g>-->
<!--                        </g>-->
<!--                        <g>-->
<!---->
<!--                            <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
<!--                            <path stroke="null" id="svg_2" d="m23.188929,37.845874c-7.649314,-6.009595 -10.384249,-9.811157 -10.406414,-14.464956c-0.020213,-4.242508 3.355922,-8.337154 6.854692,-8.313541c1.747129,0.011815 5.494833,1.573291 6.821908,2.842378c0.668658,0.63944 0.985367,0.576385 2.474064,-0.492575c4.051604,-2.90925 8.008036,-2.970314 10.570395,-0.163132c4.095195,4.486467 3.349619,9.844129 -2.143276,15.40147c-2.920339,2.954606 -9.297718,8.196242 -9.972177,8.196242c-0.205228,0 -2.094864,-1.352652 -4.199193,-3.005889l0,0.000001z" fill-opacity="null" stroke-opacity="null" stroke-width="0.2" fill="#ffffff"/>-->
<!--                        </g>-->
<!--                    </svg>-->
                </div>


                <div class="col-12">
                    <button id="gb" class="tb_button w-100 btn btn-outline-primary" style="white-space:nowrap; overflow: hidden; text-overflow: ellipsis"> Go Back </button>

                </div>



                <?php
//                $sql1 = "SELECT * FROM log_in WHERE id='" .$_SESSION['ID']. "'";
//                $result1 = mysqli_query($db,$sql1);
//                $subject1 = mysqli_fetch_assoc($result1);
//                $sql_author = "SELECT * FROM new_thread WHERE country='" .$_SESSION['country']. "' AND t_id='" .$_SESSION['tid']. "'";
//                $result_author = mysqli_query($db,$sql_author);
//                $subject_author = mysqli_fetch_assoc($result_author);
//                if($subject1['user_name'] == $subject_author['author']){
//                    echo "<div class=\"tb_button col-12 svg_container\">";
//
//                    echo "<button id='dt' class='tb_button btn btn-danger w-100'>Delete Thread</button>";
////        echo "
////        <svg width=\"55\" height=\"55\" xmlns=\"http://www.w3.org/2000/svg\">
////         <g>
////          <rect x=\"-1\" y=\"-1\" width=\"57\" height=\"57\" id=\"canvas_background\" fill=\"none\"/>
////          <g id=\"canvasGrid\" display=\"none\">
////           <rect id=\"svg_3\" width=\"580\" height=\"400\" x=\"1\" y=\"1\" stroke-width=\"0\" fill=\"url(#gridpattern)\"/>
////          </g>
////         </g>
////         <g>
////
////          <ellipse fill=\"none\" stroke-width=\"3.5\" cx=\"27.641024\" cy=\"27.564104\" id=\"svg_1\" rx=\"25\" ry=\"25\" stroke=\"#1af2d5\"/>
////          <path stroke=\"null\" id=\"svg_2\" d=\"m39.890766,35.923571l-8.375668,-8.536673l8.374145,-8.536673l-4.305051,-4.390909l-8.375668,8.536673l-8.375668,-8.536673l-4.305051,4.390909l8.374145,8.536673l-8.375668,8.536673l4.308095,4.389358l8.374145,-8.536673l8.374145,8.536673\" fill-opacity=\"null\" stroke-opacity=\"null\" stroke-width=\"0.2\" fill=\"#ffffff\"/>
////         </g>
////        </svg>
////        ";
//                    echo "</div>";
//                }
                ?>



            </div>



<!--            <div id="loading_button" class="tb_button svg_container">-->
<!--                <svg width="55.00000000000001" height="55.00000000000001" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <g>-->
<!--                        <rect fill="none" id="canvas_background" height="7.583746" width="7.583746" y="-1" x="-1"/>-->
<!--                        <g display="none" id="canvasGrid">-->
<!--                            <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
<!--                        </g>-->
<!--                    </g>-->
<!--                    <g>-->
<!--                        <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
<!--                        <path stroke="null" id="svg_6" d="m28.225565,15.387951c1.253755,0.001585 2.45149,0.218668 3.585801,0.581329l-0.897725,1.552643l6.372394,0l-1.593506,-2.759719l-1.59229,-2.758894l-0.838194,1.45376c-1.570909,-0.574328 -3.264408,-0.895755 -5.035338,-0.895755c-8.151461,0 -14.758476,6.607428 -14.758476,14.758856c0,3.383111 1.150644,6.491448 3.06557,8.98186l2.244103,-1.723017c-1.548738,-2.012595 -2.479924,-4.524033 -2.484977,-7.258028c0.01128,-6.590322 5.34313,-11.922931 11.932637,-11.933035l0.000001,0zm11.694462,2.953473l-2.244098,1.723842c1.548348,2.011829 2.479539,4.521684 2.483799,7.256492c-0.011281,6.590268 -5.34313,11.922114 -11.93302,11.932974c-1.167767,-0.00151 -2.284961,-0.191391 -3.350005,-0.508942l0.844789,-1.460806l-6.372366,0l1.592327,2.758192l1.593476,2.761996l0.888387,-1.541703c1.506697,0.524518 3.119237,0.817144 4.803391,0.817905c8.152637,-0.001519 14.758518,-6.608953 14.760433,-14.760387c-0.001915,-3.383103 -1.153377,-6.490682 -3.067115,-8.979562l0,-0.000001z" stroke-opacity="null" stroke-width="0.2" fill="#ffffff"/>-->
<!--                    </g>-->
<!--                </svg>-->
<!--            </div>-->
<!---->
<!---->
<!--            <div id="dlb" class="tb_button svg_container" style="--><?php
//            if(mysqli_num_rows($result_liked) > 0){
//                echo "z-index:1";
//            }
//            else{
//                echo "z-index:-1";
//            }
//            ?><!--">-->
<!--                <svg width="55.00000000000001" height="55.00000000000001" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <defs>-->
<!--                        <linearGradient y2="1" x2="1" y1="0.585938" x1="0.5625" id="svg_5">-->
<!--                            <stop offset="0" stop-color="#CE7975"/>-->
<!--                            <stop offset="1" stop-color="#31868a"/>-->
<!--                        </linearGradient>-->
<!--                    </defs>-->
<!--                    <g>-->
<!--                        <rect fill="none" id="canvas_background" height="7.583746" width="7.583746" y="-1" x="-1"/>-->
<!--                        <g display="none" id="canvasGrid">-->
<!--                            <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
<!--                        </g>-->
<!--                    </g>-->
<!--                    <g>-->
<!--                        <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
<!--                        <path stroke="null" id="svg_2" d="m23.188929,37.845874c-7.649314,-6.009595 -10.384249,-9.811157 -10.406414,-14.464956c-0.020213,-4.242508 3.355922,-8.337154 6.854692,-8.313541c1.747129,0.011815 5.494833,1.573291 6.821908,2.842378c0.668658,0.63944 0.985367,0.576385 2.474064,-0.492575c4.051604,-2.90925 8.008036,-2.970314 10.570395,-0.163132c4.095195,4.486467 3.349619,9.844129 -2.143276,15.40147c-2.920339,2.954606 -9.297718,8.196242 -9.972177,8.196242c-0.205228,0 -2.094864,-1.352652 -4.199193,-3.005889l0,0.000001z" stroke-opacity="null" stroke-width="0.2" fill="url(#svg_5)"/>-->
<!--                    </g>-->
<!--                </svg>-->
<!--            </div>-->


        </div>

    </div>
</div>


<!--<div id="toolbar">-->
<!---->
<!--    <div id="page_list_container" class="svg_container">-->
<!--        <ul id="page_list">-->
<!---->
<!--        </ul>-->
<!--    </div>-->
<!---->
<!--    <div id="gb" class="tb_button svg_container">-->
<!--        <svg width="55" height="55" xmlns="http://www.w3.org/2000/svg" id="gb_button">-->
<!---->
<!--            <g>-->
<!--                <rect fill="none" id="canvas_background" height="57" width="57" y="-1" x="-1"/>-->
<!--                <g display="none" id="canvasGrid">-->
<!--                    <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
<!--                </g>-->
<!--            </g>-->
<!--            <g>-->
<!--                <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
<!--                <path id="svg_2" d="m24.301544,18.44399l0,-2.618723l-13.062219,8.111073l13.062219,8.111145l0,-2.809936c3.544505,-0.001783 9.767133,0.323995 9.767133,2.632884c0,3.226055 -6.498803,4.947059 -6.498803,4.947059l0,2.473502c0,0 14.598732,0.536472 14.598732,-11.39912c0,-9.377081 -12.503267,-9.729446 -17.867062,-9.447884z" stroke-width="0.2" fill="#ffffff"/>-->
<!--            </g>-->
<!--        </svg>-->
<!--    </div>-->
<!---->
<!---->
<!--    --><?php
//        $req_find2 = "SELECT * FROM log_in WHERE id='" . $id."'";
//        $result_find2 = mysqli_query($db,$req_find2);
//        $subject_find2 = mysqli_fetch_assoc($result_find2);
//        $req_liked = "SELECT * FROM liked WHERE user_name='".$subject_find2['user_name']."' AND country='".$country."' AND t_id='".$t_id."'";
//        $result_liked = mysqli_query($db,$req_liked);
//
//    ?>
<!--    <div id="lb" class="tb_button svg_container" style="--><?php
//        if(mysqli_num_rows($result_liked)){
//            echo "z-index:-1";
//        }
//        else{
//            echo "z-index:1";
//        }
//    ?><!--">-->
<!--        <svg width="55.00000000000001" height="55.00000000000001" xmlns="http://www.w3.org/2000/svg">-->
<!--            <g>-->
<!--                <rect fill="none" id="canvas_background" height="7.583746" width="7.583746" y="-1" x="-1"/>-->
<!--                <g display="none" id="canvasGrid">-->
<!--                    <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
<!--                </g>-->
<!--            </g>-->
<!--            <g>-->
<!---->
<!--                <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
<!--                <path stroke="null" id="svg_2" d="m23.188929,37.845874c-7.649314,-6.009595 -10.384249,-9.811157 -10.406414,-14.464956c-0.020213,-4.242508 3.355922,-8.337154 6.854692,-8.313541c1.747129,0.011815 5.494833,1.573291 6.821908,2.842378c0.668658,0.63944 0.985367,0.576385 2.474064,-0.492575c4.051604,-2.90925 8.008036,-2.970314 10.570395,-0.163132c4.095195,4.486467 3.349619,9.844129 -2.143276,15.40147c-2.920339,2.954606 -9.297718,8.196242 -9.972177,8.196242c-0.205228,0 -2.094864,-1.352652 -4.199193,-3.005889l0,0.000001z" fill-opacity="null" stroke-opacity="null" stroke-width="0.2" fill="#ffffff"/>-->
<!--            </g>-->
<!--        </svg>-->
<!--    </div>-->
<!---->
<!--    <div id="loading_button" class="tb_button svg_container">-->
<!--        <svg width="55.00000000000001" height="55.00000000000001" xmlns="http://www.w3.org/2000/svg">-->
<!--            <g>-->
<!--                <rect fill="none" id="canvas_background" height="7.583746" width="7.583746" y="-1" x="-1"/>-->
<!--                <g display="none" id="canvasGrid">-->
<!--                    <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
<!--                </g>-->
<!--            </g>-->
<!--            <g>-->
<!--                <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
<!--                <path stroke="null" id="svg_6" d="m28.225565,15.387951c1.253755,0.001585 2.45149,0.218668 3.585801,0.581329l-0.897725,1.552643l6.372394,0l-1.593506,-2.759719l-1.59229,-2.758894l-0.838194,1.45376c-1.570909,-0.574328 -3.264408,-0.895755 -5.035338,-0.895755c-8.151461,0 -14.758476,6.607428 -14.758476,14.758856c0,3.383111 1.150644,6.491448 3.06557,8.98186l2.244103,-1.723017c-1.548738,-2.012595 -2.479924,-4.524033 -2.484977,-7.258028c0.01128,-6.590322 5.34313,-11.922931 11.932637,-11.933035l0.000001,0zm11.694462,2.953473l-2.244098,1.723842c1.548348,2.011829 2.479539,4.521684 2.483799,7.256492c-0.011281,6.590268 -5.34313,11.922114 -11.93302,11.932974c-1.167767,-0.00151 -2.284961,-0.191391 -3.350005,-0.508942l0.844789,-1.460806l-6.372366,0l1.592327,2.758192l1.593476,2.761996l0.888387,-1.541703c1.506697,0.524518 3.119237,0.817144 4.803391,0.817905c8.152637,-0.001519 14.758518,-6.608953 14.760433,-14.760387c-0.001915,-3.383103 -1.153377,-6.490682 -3.067115,-8.979562l0,-0.000001z" stroke-opacity="null" stroke-width="0.2" fill="#ffffff"/>-->
<!--            </g>-->
<!--        </svg>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div id="dlb" class="tb_button svg_container" style="--><?php
//    if(mysqli_num_rows($result_liked) > 0){
//        echo "z-index:1";
//    }
//    else{
//        echo "z-index:-1";
//    }
//    ?><!--">-->
<!--        <svg width="55.00000000000001" height="55.00000000000001" xmlns="http://www.w3.org/2000/svg">-->
<!--            <defs>-->
<!--                <linearGradient y2="1" x2="1" y1="0.585938" x1="0.5625" id="svg_5">-->
<!--                    <stop offset="0" stop-color="#CE7975"/>-->
<!--                    <stop offset="1" stop-color="#31868a"/>-->
<!--                </linearGradient>-->
<!--            </defs>-->
<!--            <g>-->
<!--                <rect fill="none" id="canvas_background" height="7.583746" width="7.583746" y="-1" x="-1"/>-->
<!--                <g display="none" id="canvasGrid">-->
<!--                    <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
<!--                </g>-->
<!--            </g>-->
<!--            <g>-->
<!--                <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
<!--                <path stroke="null" id="svg_2" d="m23.188929,37.845874c-7.649314,-6.009595 -10.384249,-9.811157 -10.406414,-14.464956c-0.020213,-4.242508 3.355922,-8.337154 6.854692,-8.313541c1.747129,0.011815 5.494833,1.573291 6.821908,2.842378c0.668658,0.63944 0.985367,0.576385 2.474064,-0.492575c4.051604,-2.90925 8.008036,-2.970314 10.570395,-0.163132c4.095195,4.486467 3.349619,9.844129 -2.143276,15.40147c-2.920339,2.954606 -9.297718,8.196242 -9.972177,8.196242c-0.205228,0 -2.094864,-1.352652 -4.199193,-3.005889l0,0.000001z" stroke-opacity="null" stroke-width="0.2" fill="url(#svg_5)"/>-->
<!--            </g>-->
<!--        </svg>-->
<!--    </div>-->
<!---->
<!---->
<!--</div>-->




    <script src="script/jquery-3.1.1.js"></script>
    <script src="script/jquery.redirect.js"></script>

    <script src="<?php echo url_for('/script/bootstrap.min.js')?>" type="text/javascript"></script>
    <script src="script/thread.js"></script>

    <?php


        echo "<script>";

        echo "
        
        
        var \$like = $(\"#lb\");
   
        \$like.on(\"click\",function () {
    
    
            $(\".tb_button\").each(function (i) {
                $(this).attr(\"disabled\",\"true\");
            });
    
            $(\".page_list_a\").each(function () {
                $(this).addClass(\"disabled\");
            });
    
            if($.trim(\$like.html())===\"Mark\"){
    
                $.ajax({
                    url:\"./form/like.php\",
                    type:\"POST\",
                    data:{id:$id,country:\"$country\",tid:$t_id,auto:\"$auto\"},
                    success:function (d) {
    
//                        alert(d);
                    },
                    complete:function () {
    
                        $(\".tb_button\").each(function (i) {
                            $(this).removeAttr(\"disabled\");
                        });
                        $(\".page_list_a\").each(function () {
                            $(this).removeClass(\"disabled\");
                        });
    
                        \$like.html(\"Remove\");
                    }
                })
    
            }
            else if($.trim(\$like.html())===\"Remove\"){
    
                $.ajax({
                    url:\"./form/dislike.php\",
                    type:\"POST\",
                    data:{id:$id,country:\"$country\",tid:$t_id},
                    success:function (d) {
    
//                        alert(d);
                    },
                    complete:function () {
                        $(\".tb_button\").each(function (i) {
                            $(this).removeAttr(\"disabled\");
                        });
    
                        $(\".page_list_a\").each(function () {
                            $(this).removeClass(\"disabled\");
                        });
    
                        \$like.html(\"Mark\");
    
                    }
                })
    
            }
            else{
    
                $.ajax({
                    url:\"./form/like_status.php\",
                    type:\"POST\",
                    data:{id:$id,country:\"$country\",tid:$t_id},
                    success:function (d) {
    
                        d = parseInt(d);
    
                        console.log(typeof d);
    
                        if(d===0){
                            \$like.html(\"Mark\");
                        }
                        else if(d===1){
                            \$like.html(\"Remove\");
                        }
                        else{
                            alert(\"Please refresh the page!\");
                        }
                    },
                    complete:function () {
                        $(\".tb_button\").each(function (i) {
                            $(this).removeAttr(\"disabled\");
                        });
                        $(\".page_list_a\").each(function () {
                            $(this).removeClass(\"disabled\");
                        });
    
                        alert(\"Please click again!\");
    
                    }
                })
    
    
            }
    
        });
        
        
        $(\"#ob\").on(\"click\",function () {
    
            $(\".tb_button\").each(function (i) {
                $(this).attr(\"disabled\",\"true\");
            });
            $(\".page_list_a\").each(function () {
                $(this).addClass(\"disabled\");
            });
    
            $.redirect('./redirect.php', {'url': '$url'});
    
        });
        
        
        
        
        
        ";


    echo "</script>";


    ?>


</body>