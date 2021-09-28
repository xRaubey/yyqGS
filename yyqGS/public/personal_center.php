<?php
require_once '../private/initialize.php';
session_start();
//$id = isset($_GET['id'])?$_GET['id']:'';

if(!$_SESSION['loggedIn']){

    session_destroy();
    redirect_to(url_for("index.php"));
}

$sid = null;

if(isset($_SESSION['ID'])){
    $sid = $_SESSION['ID'];

    if($sid != $_GET['id']){
        redirect_to(url_for("personal_center.php?id=".$_SESSION['ID']));
    }
}
else{

    session_destroy();

    echo'<script>window.location = \'index.php\';</script>';
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="yyq">
    <meta name="description" content="LW-Home">
    <title>Global News</title>
    <link href="./stylesheet/personal_center.css" type="text/css" rel="stylesheet">
    <link href="./stylesheet/bootstrap.css" type="text/css" rel="stylesheet">

</head>


<body>

<div id="loading_page">

</div>

<div class="container p-0 m-0 h-100 w-100">

    <div class="row h-100 p-0 m-0">

        <div class="col-10 p-0 m-0 h-100" id="content_container">
            <nav class="col-12 m-0 mb-1 bg row align-content-end" style="height: 10%">
                <div class="nav nav-tabs bg-dark h-100 row p-0 m-0 border border-dark rounded-top col-12 align-self-end">
                    <a class="nav-item nav-link active col-6" data-toggle="tab" href="#notifications">Notifications</a>
                    <a class="nav-item nav-link col-6" data-toggle="tab" href="#likes">Read Later</a>
                </div>
            </nav>
            <div class="tab-content col-12" style="height: 90%">

                <div class="tab-pane fade show active row p-0 m-0 h-100 bg-dark" role="tabpanel" id="notifications">

                    <?php

                    $req_user = "SELECT * FROM log_in WHERE id='" .$_SESSION['ID'] ."'";
                    $result_user = mysqli_query($db,$req_user);
                    $subject_user = mysqli_fetch_assoc($result_user);
                    $receiver = $subject_user['user_name'];



//                    $req = "SELECT * FROM notification WHERE receiver='" .$receiver."' AND replier!='".$receiver."' ORDER BY id DESC LIMIT 50";
                    $req = "SELECT * FROM notification WHERE receiver='" .$receiver."' AND replier!='".$receiver."' ORDER BY id DESC";
                    $result = mysqli_query($db,$req);

//                    $info = [];

                    if(mysqli_num_rows($result)>0){

//                        $info_index = 0;

                        while($subject = mysqli_fetch_assoc($result)){
                            $user = $subject['replier'];
                            $req_image = "SELECT * FROM log_in WHERE user_name='".$user."'";
                            $result_image = mysqli_query($db,$req_image);
                            $subject_image = mysqli_fetch_assoc($result_image);

//                            array_push($info,["tid"=>$subject['t_id'],"country"=>$subject['country'],"cid"=>$subject['c_id'],"rid"=>$subject['r_id'],"page"=>$subject['page'],"new"=>$subject['new'],"reply"=>$subject['reply']]);
//                            $info_index++;


                            if($subject['new']==1){
                                echo "<div class='note_container border border-dark rounded row p-0 m-0 mb-1 col-12 new'>";
                            }
                            else{
                                echo "<div class='note_container border border-dark rounded bg-light row p-0 m-0 mb-1 col-12'>";
                            }


                            echo "<div class='comment col-12'>";
                            echo "You said: ";
                            echo $subject['comment'];
                            echo "</div>";

                            echo "<div class='reply col-12 row p-0 m-0'>";


                            echo "<div class='col-4 row justify-content-center align-content-center p-0 m-0'>";

                            echo "<image class='profile_image align-self-center' src='";
                            echo "uploaded_images/".$subject_image['image_name'].".png'>";

                            echo "<div class='col-12 text-center'>";
                            echo $subject['replier'];
                            echo "</div>";

                            echo "</div>";


                            echo "<div class='col-6 p-0 m-0'>";
                            echo $subject['reply'];
                            echo "</div>";

                            echo "<div class='col-2 p-0 m-0'>";
                            echo "<button class='tb_button btn btn-primary go w-100 h-100 p-0 m-0'>Go</button>";
                            echo "</div>";


                            echo "</div>";

                            echo "</div>";


                        }

                    }
                    else{
                        echo "No Notifications Yet!";
                    }

                    ?>

                </div>

                <div class="tab-pane fade row p-0 m-0 h-100 bg-dark" role="tabpanel" id="likes">

                    <?php

                        $req_likes = "SELECT * FROM liked WHERE user_name='".$receiver."'";
                        $result_likes = mysqli_query($db,$req_likes);
                        if (mysqli_num_rows($result_likes)>0){
                            while($subject_likes = mysqli_fetch_assoc($result_likes)){
                                $req_get_likes = "SELECT * FROM new_thread WHERE country='".$subject_likes['country']."' AND t_id='".$subject_likes['t_id']."'";
                                $result_get_likes = mysqli_query($db,$req_get_likes);
                                $subject_get_likes = mysqli_fetch_assoc($result_get_likes);

                                if($subject_likes['auto_delete']=='T'){
                                    echo "<div class='likes col-12 bg-info border border-dark rounded'>";
                                }
                                else{
                                    echo "<div class='likes col-12 bg-light border border-dark rounded'>";
                                }
                                echo $subject_get_likes['title'];
                                echo "</div>";
                            }
                        }
                        else{

                            echo "<div class='col-12 bg-light h-100 text-light bg-dark border border-dark rounded'>";
                            echo "No content.";
                            echo "</div>";

                        }

                    ?>

                </div>

            </div>
        </div>

        <div class="col-2 p-0 m-0 row h-100 align-content-around bg-dark" id="toolbar">

            <div class="col-12 p-0 m-0 row justify-content-center">
                <?php
                $req_profile = "SELECT * FROM log_in WHERE id='".$_SESSION['ID']."'";
                $result_profile = mysqli_query($db,$req_profile);
                $subject_profile = mysqli_fetch_assoc($result_profile);
                $path = "uploaded_images/".$subject_profile['image_name'];
                echo "<image class='profile_image2' src='" .$path. ".png'>"
                ?>
            </div>

            <div class="col-12" id="gb">

                <button class="tb_button btn btn-danger w-100 tb_button" id="gb_button">Go Back</button>

                <!--                    <svg width="55" height="55" xmlns="http://www.w3.org/2000/svg" id="gb_button">-->
                <!---->
                <!--                        <g>-->
                <!--                            <rect fill="none" id="canvas_background" height="57" width="57" y="-1" x="-1"/>-->
                <!--                            <g display="none" id="canvasGrid">-->
                <!--                                <rect fill="url(#gridpattern)" stroke-width="0" y="1" x="1" height="400" width="580" id="svg_3"/>-->
                <!--                            </g>-->
                <!--                        </g>-->
                <!--                        <g>-->
                <!--                            <ellipse stroke="#1af2d5" ry="25" rx="25" id="svg_1" cy="27.564104" cx="27.641024" stroke-width="3.5" fill="none"/>-->
                <!--                            <path id="svg_2" d="m24.301544,18.44399l0,-2.618723l-13.062219,8.111073l13.062219,8.111145l0,-2.809936c3.544505,-0.001783 9.767133,0.323995 9.767133,2.632884c0,3.226055 -6.498803,4.947059 -6.498803,4.947059l0,2.473502c0,0 14.598732,0.536472 14.598732,-11.39912c0,-9.377081 -12.503267,-9.729446 -17.867062,-9.447884z" stroke-width="0.2" fill="#ffffff"/>-->
                <!--                        </g>-->
                <!--                    </svg>-->
            </div>



        </div>

    </div>

</div>


<script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/bootstrap.js')?>" type="text/javascript"></script>
<script src="<?php echo url_for('/script/personal_center.js')?>" type="text/javascript"></script>

<script>

    <?php

//            $tid = isset($_SESSION['tid'])?$_SESSION['ID']:null;

            if(!((isset($_SESSION['country']))) && $sid!=null){

                echo "
            
                $(\"#gb_button\").on(\"click\",function () {
                
                    $(\".tb_button\").each(function (i) {
                        $(this).attr(\"disabled\",\"true\");
                    });
                
                    location.href = \"./home.php?id=".$_SESSION['ID'] . "\"});
                
                ";

            }

            elseif((isset($_SESSION['country'])) && $sid!=null){
                echo "
            
                $(\"#gb_button\").on(\"click\",function () {
                
                    $(\".tb_button\").each(function (i) {
                        $(this).attr(\"disabled\",\"true\");
                    });
                
                
                    location.href = \"./countries.php?id=".$_SESSION['ID'] . "&country=".$_SESSION['country']."\"});
                
                ";
            }
            else{

                echo "
            
                $(\"#gb_button\").on(\"click\",function () {
                
                    $(\".tb_button\").each(function (i) {
                        $(this).attr(\"disabled\",\"true\");
                    });
                
                
                    location.href = \"location.href=".PUBLIC_PATH."/index.php\"});
                
                ";


                session_destroy();

            }



            if($sid!=null){

//                $info=json_encode($info);


                echo " 
                
                $.ajax({
                    url:\"./form/find_notification.php\",
                    method:\"POST\",
                    data:{id:$sid},
                    success:function (d) {
                    
                        var info = JSON.parse(d);
                        console.log(JSON.parse(d));
                        
                        
                        
                        
                        $(\".go\").each(function (i) {
                            $(this).on(\"click\",function () {
                    
                                var go_info = info[i];
                                
                                $(\".tb_button\").each(function (i) {
                                    $(this).attr(\"disabled\",\"true\");
                                });
                                
                                if(go_info.page===1 || go_info.page==='1'){
                                    location.href = \"./thread.php?id=\" +$sid+ \"&country=\" +go_info.country+ \"&tid=\"+go_info.tid;
                                }
                                else{
                                    location.href = \"./thread.php?id=\" +$sid+ \"&country=\" +go_info.country+ \"&tid=\"+go_info.tid+\"&page=\"+go_info.page;
                                }
                    
                            })
                        });
                        
                        
                        
                        
                        
                        
                        $(\".note_container\").each(function (i) {
                
                
                        $(this).on(\"click\",function () {
                                           
                            if($(this).hasClass(\"new\")) {
                                                                        
                                var reply_info = info[i];
                                var ts = \$(this);
                           
                                
                                $.ajax({
                        
                                        url: \"./form/notification_new.php\",
                                        data: {tid:reply_info.tid, cid:reply_info.cid, rid:reply_info.rid, page:reply_info.page, country:reply_info.country},
                                        type: \"POST\",
                                        success: function () {
                            
                                            ts.removeClass(\"new\");
                                            ts.addClass(\"bg-light\");
                            
                                        },
                                        complete: function () {
                            
                                        }
                                    })
                                    
                                }
                                
                        
                            else{
                                
                                console.log(\"not new\");
                            
                                }
                            
                        });
                        
                        
                    });
                        
                    }
                });
                
                
                
                
                
                $(\".likes\").each(function (i) {

                    $(this).on(\"click\",function () {
            
                        $.ajax({
                            url:\"./form/goto_likes.php\",
                            method:\"POST\",
                            data:{id:$sid},
                            success:function (d) {
                                var likes_data = JSON.parse(d)[i];
//                                console.log(likes_data);
                                location.href = \"./thread.php?id=" .$sid. "&country=\" +likes_data.country+ \"&tid=\"+likes_data.tid;
//                                console.log( \"./thread.php?id=" .$sid. "&country=\" +likes_data.country+ \"&tid=\"+likes_data.tid );

                            }
                        });
                        
                    })
                });
                
                
                
                
                ";

            }



    ?>

</script>

</body>

</html>





