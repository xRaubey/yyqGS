<?php
    require_once "../private/initialize.php";
    session_start();

//    $country = mysqli_real_escape_string($db,$_GET['country']);
//    $_SESSION['country'] = $country;




if(!$_SESSION['loggedIn']){
    session_destroy();

    redirect_to(url_for("index.php"));
}


if(isset($_SESSION['ID']) && isset($_SESSION['country'])){
    $sid = $_SESSION['ID'];

    $country = $_SESSION['country'];

    if($sid != $_GET['id'] || $country!=$_GET['country']){
        redirect_to(url_for("countries.php?id=".$_SESSION['ID']."&country=". $country));
    }
}
else{
    session_destroy();
    echo'<script>window.location = \'index.php\';</script>';
}

?>

<!doctype html>
<html lang="en" ng-app="countriesC">

<script src="./script/angular.js" rel="script" type="text/javascript"></script>
<script src="./script/angular-route.js" rel="script" type="text/javascript"></script>

<head>



    <meta charset="utf-8">
    <meta name="author" content="yyq">
    <meta name="description" content="LikeCenter">
    <title>Global News</title>



    <link type="text/css" rel="stylesheet" href="./stylesheet/countries.css">
    <link type="text/css" rel="stylesheet" href="./stylesheet/bootstrap.css">

</head>

<body ng-controller="countriesController">

<div class="container w-100">

    <div class="row p-0 m-0 h-100">

        <div id="container" class="col-10 p-0" style="box-shadow: 5px 10px #888888;">

            <div class="row p-0 m-0 h-100">

                <div id="country_name" class="col-12 p-0">
                    <?php echo $_GET['country']?>
                </div>

                <div id="country_des" class="col-12 p-0 m-0 row">
                    <!--                    Language:-->
                    <?php

                    echo "<div class='col-3'>";

                    echo "Language: ";

                    $req = "SELECT * FROM world_x.country WHERE Name='" .$country . "'";
                    $result = mysqli_query($db,$req);
                    $subject = mysqli_fetch_assoc($result);
                    $code = $subject['Code'];

                    $req2 = "SELECT * FROM world_x.countrylanguage WHERE CountryCode='". $code ."' AND IsOfficial='T'";
                    $result2 = mysqli_query($db,$req2);
                    $subject2 = mysqli_fetch_assoc($result2);

                    echo $subject2['Language']?$subject2['Language']:'No official language.';

                    echo "</div>";

                    echo "<div class='col-6'>";

                    echo "<image class='flag' src='flags/".strtolower($subject['Code2']).".png'>";

                    echo "</div>";


                    echo "<div class='col-3'>";

                    echo "<input type='text' ng-model='query' class='form-control rounded' placeholder='Search'>";

                    echo "{{query}}";

                    echo "</div>";

                    ?>

                </div>

                <nav class="col-12 p-0 bg-dark">
                    <div class="nav nav-tabs" role="tablist">
                        <a class="nav-item nav-link active rounded-0" data-toggle="tab" href="#nav-tech" role="tab">Technology</a>
                        <a class="nav-item nav-link rounded-0" data-toggle="tab" href="#nav-bns" role="tab">Business</a>
                        <a class="nav-item nav-link rounded-0" data-toggle="tab" href="#nav-ent" role="tab">Entertainment</a>
                        <a class="nav-item nav-link rounded-0" data-toggle="tab" href="#nav-other" role="tab">Other</a>

                    </div>
                </nav>

                <div class="tab-content col-12 p-0" style="overflow: hidden; height: calc(100% - 50px); box-shadow: 5px 10px black;" id="nav-tabContent">

                    <div class="threads tab-pane fade show active" id="nav-tech" role="tabpanel" aria-labelledby="nav-contact-tab">

                        <div ng-hide="query">
                            <?php
                                $sql = "SELECT * FROM new_thread WHERE country='" .$country. "' AND category='tech' ORDER BY latest DESC";
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


                                        echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\">";


                                            echo "<a class='link-light text-light col-8 p-0 m-0 row single_thread_link' href='";
                                            echo  url_for("thread.php?id=".$_SESSION['ID']."&country=".$country."&tid=".$row['t_id']);
                                            echo  "'>";

                                                echo "<div class=\"thread_title col-12 p-0 m-0\">";
                                                echo $row['title'];
                                                echo "</div>";

                                                echo "<div class=\"thread_content col-12 p-0 m-0\">";
                                                echo $subject_content['comment'];
                                                echo "</div>";


                                                echo "<div class='reply_num col-12 p-0 m-0'>";
                                                echo $subject_t_date['date'] . ' ';
                                                echo "Replies:".$rn;
                                                echo "</div>";


                                            echo "</a>";


                                            echo "<div class=\"thread_image_container row justify-content-center align-self-center col-4 p-0 m-0\">";
                                            $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                                            if($subject_content['user']=="GN"){
                                                $path = $subject_content['images'];
                                                echo "<img class='col-12 col-md-10 col-lg-8 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                            }
                                            elseif(!empty($image_name)){
                                                $path = "col-12 col-md-10 col-lg-8 uploaded_images/".$image_name;
                                                echo "<img class='col-12 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                            }
                                            echo "</div>";


                                        echo "</div>";



                                    }
                                }
                                else{
                                    echo "No threads yet";
                                }
                        ?>
                        </div>

                        <div ng-show="query">

                            <?php

                            echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\" ng-repeat='item in info | filter:query'>";

//                            echo "{{item.rows}}";


                            echo "<a class='link-light text-light col-12 p-0 m-0 row single_thread_link' href='";
                            echo  "thread.php?id=".$_SESSION['ID']."&country=".$country."&tid={{item.t_id}}";
                            echo  "'>";

                                echo "<div class=\"thread_title col-10 p-0 m-0\">";
                                echo "{{item.title}}";
                                echo "</div>";


                                echo "<div class=\"thread_content col-8 p-0 m-0\">";
                                echo "{{item.content}}";
                                echo "</div>";


                            //                            echo "<div class=\"thread_image_container row justify-content-center col-4 p-0 m-0\">";
                            //                            $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                            //                            if($subject_content['user']=="GN"){
                            //                                $path = $subject_content['images'];
                            //                                echo "<img class='img-circle thread_image' src='".$path."'>";
                            //                            }
                            //                            elseif(!empty($image_name)){
                            //                                $path = "uploaded_images/".$image_name;
                            //                                echo "<img class='thread_image' src='".$path."'>";
                            //                            }
                            //                            echo "</div>";

                                echo "<div class='reply_num col-12 p-0 m-0'>";
                                echo "{{item.date}} ";
                                echo "Replies: {{item.rows}}";
                                echo "</div>";

                            echo "</a>";



                            echo "</div>";

                            ?>

                        </div>

                    </div>


                    <div class="threads tab-pane fade col-12 p-0" id="nav-other" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div ng-hide="query">
                            <?php
                            $sql = "SELECT * FROM new_thread WHERE country='" .$country. "' AND category='other' ORDER BY latest DESC";
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


                                    echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\">";


                                    echo "<a class='link-light text-light col-8 p-0 m-0 row single_thread_link' href='";
                                    echo  url_for("thread.php?id=".$_SESSION['ID']."&country=".$country."&tid=".$row['t_id']);
                                    echo  "'>";

                                    echo "<div class=\"thread_title col-12 p-0 m-0\">";
                                    echo $row['title'];
                                    echo "</div>";

                                    echo "<div class=\"thread_content col-12 p-0 m-0\">";
                                    echo $subject_content['comment'];
                                    echo "</div>";


                                    echo "<div class='reply_num col-12 p-0 m-0'>";
                                    echo $subject_t_date['date'] . ' ';
                                    echo "Replies:".$rn;
                                    echo "</div>";


                                    echo "</a>";


                                    echo "<div class=\"thread_image_container row justify-content-center align-self-center col-4 p-0 m-0\">";
                                    $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                                    if($subject_content['user']=="GN"){
                                        $path = $subject_content['images'];
                                        echo "<img class='col-12 col-md-10 col-lg-8 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                    }
                                    elseif(!empty($image_name)){
                                        $path = "uploaded_images/".$image_name;
                                        echo "<img class='col-12 col-md-10 col-lg-8 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                    }
                                    echo "</div>";


                                    echo "</div>";

                                }
                            }
                            else{
                                echo "No threads yet";
                            }
                            ?>
                        </div>

                        <div ng-show="query">

                            <?php

                            echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\" ng-repeat='item in info | filter:query'>";

                            //                            echo "{{item.rows}}";


                            echo "<a class='link-light text-light col-12 p-0 m-0 row single_thread_link' href='";
                            echo  "thread.php?id=".$_SESSION['ID']."&country=".$country."&tid={{item.t_id}}";
                            echo  "'>";

                            echo "<div class=\"thread_title col-10 p-0 m-0\">";
                            echo "{{item.title}}";
                            echo "</div>";


                            echo "<div class=\"thread_content col-8 p-0 m-0\">";
                            echo "{{item.content}}";
                            echo "</div>";


                            //                            echo "<div class=\"thread_image_container row justify-content-center col-4 p-0 m-0\">";
                            //                            $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                            //                            if($subject_content['user']=="GN"){
                            //                                $path = $subject_content['images'];
                            //                                echo "<img class='img-circle thread_image' src='".$path."'>";
                            //                            }
                            //                            elseif(!empty($image_name)){
                            //                                $path = "uploaded_images/".$image_name;
                            //                                echo "<img class='thread_image' src='".$path."'>";
                            //                            }
                            //                            echo "</div>";

                            echo "<div class='reply_num col-12 p-0 m-0'>";
                            echo "{{item.date}} ";
                            echo "Replies: {{item.rows}}";
                            echo "</div>";

                            echo "</a>";



                            echo "</div>";

                            ?>

                        </div>

                    </div>

                    <div class="threads tab-pane fade" id="nav-bns" role="tabpanel" aria-labelledby="nav-profile-tab">

                        <div ng-hide="query">
                            <?php
                            $sql = "SELECT * FROM new_thread WHERE country='" .$country. "' AND category='bns' ORDER BY latest DESC";
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


                                    echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\">";


                                    echo "<a class='link-light text-light col-8 p-0 m-0 row single_thread_link' href='";
                                    echo  url_for("thread.php?id=".$_SESSION['ID']."&country=".$country."&tid=".$row['t_id']);
                                    echo  "'>";

                                    echo "<div class=\"thread_title col-12 p-0 m-0\">";
                                    echo $row['title'];
                                    echo "</div>";

                                    echo "<div class=\"thread_content col-12 p-0 m-0\">";
                                    echo $subject_content['comment'];
                                    echo "</div>";


                                    echo "<div class='reply_num col-12 p-0 m-0'>";
                                    echo $subject_t_date['date'] . ' ';
                                    echo "Replies:".$rn;
                                    echo "</div>";


                                    echo "</a>";


                                    echo "<div class=\"thread_image_container row justify-content-center align-self-center col-4 p-0 m-0\">";
                                    $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                                    if($subject_content['user']=="GN"){
                                        $path = $subject_content['images'];
                                        echo "<img class='col-12 col-md-10 col-lg-8 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                    }
                                    elseif(!empty($image_name)){
                                        $path = "uploaded_images/".$image_name;
                                        echo "<img class='col-12 col-md-10 col-lg-8 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                    }
                                    echo "</div>";


                                    echo "</div>";

                                }
                            }
                            else{
                                echo "No threads yet";
                            }
                            ?>
                        </div>

                        <div ng-show="query">

                            <?php

                            echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\" ng-repeat='item in info | filter:query'>";

                            //                            echo "{{item.rows}}";


                            echo "<a class='link-light text-light col-12 p-0 m-0 row single_thread_link' href='";
                            echo  "thread.php?id=".$_SESSION['ID']."&country=".$country."&tid={{item.t_id}}";
                            echo  "'>";

                            echo "<div class=\"thread_title col-10 p-0 m-0\">";
                            echo "{{item.title}}";
                            echo "</div>";


                            echo "<div class=\"thread_content col-8 p-0 m-0\">";
                            echo "{{item.content}}";
                            echo "</div>";


                            //                            echo "<div class=\"thread_image_container row justify-content-center col-4 p-0 m-0\">";
                            //                            $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                            //                            if($subject_content['user']=="GN"){
                            //                                $path = $subject_content['images'];
                            //                                echo "<img class='img-circle thread_image' src='".$path."'>";
                            //                            }
                            //                            elseif(!empty($image_name)){
                            //                                $path = "uploaded_images/".$image_name;
                            //                                echo "<img class='thread_image' src='".$path."'>";
                            //                            }
                            //                            echo "</div>";

                            echo "<div class='reply_num col-12 p-0 m-0'>";
                            echo "{{item.date}} ";
                            echo "Replies: {{item.rows}}";
                            echo "</div>";

                            echo "</a>";



                            echo "</div>";

                            ?>

                        </div>

                    </div>

                    <div class="threads tab-pane fade" id="nav-ent" role="tabpanel" aria-labelledby="nav-contact-tab">


                        <div ng-hide="query">
                            <?php
                            $sql = "SELECT * FROM new_thread WHERE country='" .$country. "' AND category='ent' ORDER BY latest DESC";
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


                                    echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\">";


                                    echo "<a class='link-light text-light col-8 p-0 m-0 row single_thread_link' href='";
                                    echo  url_for("thread.php?id=".$_SESSION['ID']."&country=".$country."&tid=".$row['t_id']);
                                    echo  "'>";

                                    echo "<div class=\"thread_title col-12 p-0 m-0\">";
                                    echo $row['title'];
                                    echo "</div>";

                                    echo "<div class=\"thread_content col-12 p-0 m-0\">";
                                    echo $subject_content['comment'];
                                    echo "</div>";


                                    echo "<div class='reply_num col-12 p-0 m-0'>";
                                    echo $subject_t_date['date'] . ' ';
                                    echo "Replies:".$rn;
                                    echo "</div>";


                                    echo "</a>";


                                    echo "<div class=\"thread_image_container row justify-content-center align-self-center col-4 p-0 m-0\">";
                                    $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                                    if($subject_content['user']=="GN"){
                                        $path = $subject_content['images'];
                                        echo "<img class='col-12 col-md-10 col-lg-8 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                    }
                                    elseif(!empty($image_name)){
                                        $path = "uploaded_images/".$image_name;
                                        echo "<img class='col-12 col-md-10 col-lg-8 rounded-top p-0 pl-1 pr-1 thread_image' src='".$path."'>";
                                    }
                                    echo "</div>";


                                    echo "</div>";

                                }
                            }
                            else{
                                echo "No threads yet";
                            }
                            ?>
                        </div>

                        <div ng-show="query">

                            <?php

                            echo "<div class=\"single_thread row p-0 m-0 align-content-around m-0\" ng-repeat='item in info | filter:query'>";

                            //                            echo "{{item.rows}}";


                            echo "<a class='link-light text-light col-12 p-0 m-0 row single_thread_link' href='";
                            echo  "thread.php?id=".$_SESSION['ID']."&country=".$country."&tid={{item.t_id}}";
                            echo  "'>";

                            echo "<div class=\"thread_title col-10 p-0 m-0\">";
                            echo "{{item.title}}";
                            echo "</div>";


                            echo "<div class=\"thread_content col-8 p-0 m-0\">";
                            echo "{{item.content}}";
                            echo "</div>";


                            //                            echo "<div class=\"thread_image_container row justify-content-center col-4 p-0 m-0\">";
                            //                            $image_name = isset($subject_content['image_name'])?$subject_content['image_name']:'';
                            //                            if($subject_content['user']=="GN"){
                            //                                $path = $subject_content['images'];
                            //                                echo "<img class='img-circle thread_image' src='".$path."'>";
                            //                            }
                            //                            elseif(!empty($image_name)){
                            //                                $path = "uploaded_images/".$image_name;
                            //                                echo "<img class='thread_image' src='".$path."'>";
                            //                            }
                            //                            echo "</div>";

                            echo "<div class='reply_num col-12 p-0 m-0'>";
                            echo "{{item.date}} ";
                            echo "Replies: {{item.rows}}";
                            echo "</div>";

                            echo "</a>";



                            echo "</div>";

                            ?>

                        </div>


                    </div>

                </div>

                <div id="new_thread" class="col-12 row p-0 m-0 h-100">

                    <form class="justify-content-center row p-0 m-0 h-100 align-content-center" enctype='multipart/form-data' id="thread" method="post" action="<?php echo url_for('/form/new_thread.php') ?>">
                        <!--                        <div id="themeT">-->
                        <!--                            Theme<br>-->
                        <!--                        </div>-->

                        <div class="form-group col-12 row p-0 m-0 mb-3">
                            <label id="themeT" for="theme" class="col-12">Theme</label>
                            <input type="text" class="form-control col-12 border-0" maxlength="50" placeholder="Title-" name="title" id="theme"><br>
                        </div>

                        <div class="form-group col-12 col-md-6 row justify-content-center p-0 m-0 mb-3">
                            <label id="contentT" for="image" class="col-12">Content</label>
                            <input type="file" id="image" class="form-control col-12 border-0" name="tImage">
                            <!--                            <input type="text" class="form-control col-12" maxlength="50" placeholder="Title-" name="title" id="theme"><br>-->
                        </div>

                        <!--                        <div id="contentT">Content<br>-->
                        <!--                        </div>-->
                        <!--                        <input type="file" id="image" name="tImage"><br>-->


                        <div class="form-group col-12 col-md-6 row p-0 m-0 mb-3">
                            <label id="textT" for="content" class="col-12">Text</label>
                            <textarea class="form-control-lg col-12 border-dark" placeholder="Say something" name="content" id="content" rows="3"></textarea>
                        </div>

                        <!--                        <div class="note"></div>-->

                        <!--                        <textarea placeholder="Say something" name="content" id="content"></textarea>-->

                        <button id="cancel" class="launchBtn btn btn-danger col-12 m-0 col-md-5 mr-md-1" >Cancel</button>
                        <button id="send" class="launchBtn btn btn-primary col-12 m-0 col-md-5 ml-md-1">Send</button>
                        <!--                        <button id="loading">Loading...</button>-->

                    </form>

                </div>

                <div id="show_image" class="row p-0 m-0 justify-content-center align-content-center">

                    <img id="thread_image" src="" class="col-12" style="object-fit: contain">

                </div>
            </div>
        </div>

        <div id="toolbar" class="col-2 p-0 bg-dark" style="opacity: 0.9">

            <div class="row p-0 m-0 align-content-around  justify-content-center" style="height: 100%;">

                <div class="cbtn col-12">
                    <?php
                    $req_profile = "SELECT * FROM log_in WHERE id='".$_SESSION['ID']."'";
                    $result_profile = mysqli_query($db,$req_profile);
                    $subject_profile = mysqli_fetch_assoc($result_profile);
                    $path = "uploaded_images/".$subject_profile['image_name'];
                    echo "<img class='profile_image cbtn_button' src='" .$path. ".png'>"
                    ?>
                </div>

                <div class="cbtn col-12">
                    <button id="lo_button" class="cbtn_button btn btn-outline-warning w-100">
                        Log out
                    </button>
                </div>


                <div class="cbtn col-12">
                    <button id="dialog_button" class="cbtn_button btn btn-outline-danger w-100">
                        Post
                    </button>
                </div>


                <div class="cbtn col-12">
                    <button id="gb_button" class="cbtn_button btn btn-outline-primary w-100">
                        Go back
                    </button>
                </div>



            </div>
        </div>

    </div>

</div>


<script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" rel="script" type="text/javascript"></script>
<script src="<?php echo url_for('/script/bootstrap.js')?>" rel="script" type="text/javascript"></script>
<script src="<?php echo url_for('/script/TweenMax.min.js')?>" rel="script" type="text/javascript"></script>
<script src="<?php echo url_for('/script/countries.js')?>" rel="script" type="text/javascript"></script>
<script src="<?php echo url_for('/script/countries_controller.js')?>" rel="script" type="text/javascript"></script>


</body>

</html>
