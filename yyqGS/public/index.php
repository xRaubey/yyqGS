<?php
require_once '../private/initialize.php';
session_start();
session_destroy();
?>

    <!doctype html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="author" content="yyq">
        <meta name="description" content="LikeCenter">
        <title>Global News</title>
        <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/index.css') ?>">
        <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/bootstrap.css') ?>">

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
            Global News
        </div>
        <footer id="footer">
            Yuqing Yang
        </footer>
    </div>


    <script type="x-shader/x-vertex" id="vertexShader">

uniform vec3 viewVector;
uniform float c;
uniform float p;
varying float intensity;
void main()
{
    vec3 vNormal = normalize( normalMatrix * normal );
    vec3 vNormel = normalize( normalMatrix * viewVector);
    intensity = pow (c - dot(vNormal, vNormel), p);

    gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
}


</script>

    <script type="x-shader/x-vertex" id="fragmentShader">

uniform vec3 glowColor;
varying float intensity;

void main()
{
	vec3 glow = glowColor * intensity;
	gl_FragColor = vec4(glow,1.0);
}

</script>

    <div class="container h-100">
        <div class="row h-100 w-100 p-0 m-0 justify-content-center align-content-around">
            <div id="logIn_UI2" class="col-6 col-lg-4 border border-dark rounded-top pb-3">
                <form id="li_form" class="form-group p-0 m-0" method="post" action="<?php echo url_for('/form/log_in.php') ?>">
                    <div id="input" class="row p-0 m-0 d-inline-flex justify-content-center">
                        <div id="formTitle" class="col-12 mt-3 mb-3">
                            Global News
                        </div>
                        <!--Account Name<br> -->
                        <div id="formAccount" class="row col-12 justify-content-center">
                            <input type="text" class="form-control col-10 m-2 border-dark" name="account_li" placeholder="Account" id="an" onClick="this.setSelectionRange(0, this.value.length)">
                        </div>
                        <!--Password<br>-->
                        <div id="formPassword" class="row col-12 justify-content-center">
                            <input type="password" class="form-control col-10 m-2 border-dark " name="password_li" placeholder="Password" id="password" onClick="this.setSelectionRange(0, this.value.length)">
                        </div>

                        <input type="button" class="btn btn-danger col-4 m-2 mt-5" value="Sign Up" id="su_button">
                        <input type="submit" class="btn btn-primary col-4 m-2 mt-5" name="login" value="Log In" id="li_button">

                        <div id="info" class="col-12 position-relative"></div>
                    </div>
                </form>
            </div>

            <div id="socialLoginContainer" class="col-12 row justify-content-center">
                <div id="wc" class="col-2 col-lg-1 rounded border-dark">
                    <img src="pic/wcIcon.jpg" style="width: 100%;height: auto; opacity: 0.8; cursor: pointer;" class="OAuthIcon rounded border-dark" id="wcIcon">
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/bootstrap.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/index.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/three.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/OrbitControls.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/TweenMax.min.js')?>" type="text/javascript"></script>


    </body>

    <?php db_disconnect($db)?>

    </html>

