<?php
require_once '../private/initialize.php';
session_start();
session_destroy();
?>

    <!doctype html>
    <html lang="en">
    <meta charset="utf-8">
    <meta name="author" content="yyq">
    <meta name="description" content="LikeCenter">
    <title>Little World</title>
    <link type="text/css" rel="stylesheet" href="<?php echo url_for('/stylesheet/index.css') ?>">
    </html>

    <body>
    <div id="loading_page">
        <div class="blah"
        <div class="lds-css">
            <div class="lds-microsoft">
                <div></div>>
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
            Welcome to your Little World.
        </div>

        <footer id="footer">
            yang643@uwm.edu
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

    <div id="logIn_UI">
        <form id="li_form" method="post" action="<?php echo url_for('/form/log_in.php') ?>">
            <div id="input">
                <div id="formTitle">
                    Little World
                </div>
                <!--Account Name<br> -->
                <div id="formAccount">
                    <input type="text" name="account_li" placeholder="Account Name" id="an" onClick="this.setSelectionRange(0, this.value.length)">
                    <br><br>
                </div>
                <!--Password<br>-->
                <div id="formPassword">
                    <input type="password" name="password_li" placeholder="Password" id="password" onClick="this.setSelectionRange(0, this.value.length)">
                    <br>
                </div>
            </div>
            <input type="submit" name="login" value="Log In" id="li_button">
            <input type="button" value="Sign Up" id="su_button">
            <div id="info"></div>
        </form>
    </div>

    <script src="<?php echo url_for('/script/jquery-3.1.1.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/index.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/three.js')?>" type="text/javascript"></script>
    <script src="<?php echo url_for('/script/OrbitControls.js')?>" type="text/javascript"></script>
    </body>

<?php db_disconnect($db)?>