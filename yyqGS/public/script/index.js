$("#loading_page").css("display","block");
$(window).on("load",function(){

    /*
        Loading page animation and style.
     */

    var $w1 = $("#welcomings1");
    var $blah = $(".blah");
    var $blah_width = $blah.width();

    $w1.css({left:$blah_width,width:"auto",opacity:"1",transition:"opacity 1s ease-in-out"});


    // $.ajax({
    //     url:"https://saurav.tech/NewsAPI/top-headlines/category/technology/gb.json",
    //     method:"GET",
    //     success: function (d) {
    //
    //         console.log(d);
    //         // console.log($.parseJSON(d));
    //         // console.log(Math.min(d.articles.length,50));
    //
    //         // console.log(d.articles);
    //         var news_array = [];
    //         for (var i=0;i<Math.min(d.articles.length,5);i++){
    //             news_array[i]=d.articles[i];
    //         }
    //
    //
    //         // console.log(typeof d);
    //         // news_array[0] = d.articles[0];
    //         // console.log(news_array[1].content);
    //
    //         $.ajax({
    //             url:"./form/updateNews.php",
    //             method:"POST",
    //             data: {news:news_array,currentTime:"1620172800000",country:"United Kingdom",category:"tech"},
    //             success: function (d) {
    //                 // console.log(d);
    //             }
    //         })
    //
    //     }
    // });

    // $.ajax({
    //         url:"https://saurav.tech/NewsAPI/top-headlines/category/entertainment/us.json",
    //         method:"GET",
    //         async:false,
    //         success: function (d) {
    //
    //             console.log(d);
    //         }
    //     });



    /*

        Choose news APIs, and display them in the project.

     */



    var number_of_record = 10;  // Set the number of news displayed for each category of news.

    var ajax_request_list = [
        ["https://saurav.tech/NewsAPI/top-headlines/category/technology/au.json","Australia","tech"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/technology/us.json","United States","tech"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/business/us.json","United States","bns"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/technology/in.json","India","tech"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/technology/ru.json","Russian Federation","tech"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/entertainment/us.json","United States","ent"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/technology/fr.json","France","tech"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/entertainment/fr.json","France","ent"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/entertainment/gb.json","United Kingdom","ent"],
        ["https://saurav.tech/NewsAPI/top-headlines/category/technology/gb.json","United Kingdom","tech"]
    ];  // News APIs used to acquire news.

    // var ajax_request_list = [
    //     ["https://saurav.tech/NewsAPI/top-headlines/category/technology/gb.json","United Kingdom","tech"]
    // ];


    /**
     *
     * @description
     * Delete outdated news
     * @param currentTime = current system time
     * @returns {*}
     */

    function ajax0(currentTime) {
        return $.ajax({
            url:"./form/delete_news.php",
            method:"POST",
            data:{currentTime:currentTime},
            async:false,
            success: function (d) {

            }
        });
    }

    /*

        Run all the ajax calls at one. Update news content of the web site.

     */

    $.ajax({

        url: "./form/timer.php",
        method:"GET",
        success: function(d){
            var currentTime = new Date().getTime();
            currentTime = currentTime-(currentTime%(24*60*60*1000));

            if (currentTime>=(parseInt(d)+(24*60*60*1000))){

                // $.when(ajax0(currentTime),ajax1(currentTime),ajax2(currentTime),ajax3(currentTime),ajax4(currentTime),ajax5(currentTime),ajax6(currentTime),ajax7(currentTime),ajax8(currentTime),ajax9(currentTime),ajax10(currentTime)).then(function(a0,a1,a2,a3,a4,a5,a6){
                //     // console.log("done");
                //
                //
                //     // console.log(a6);
                //
                // });

                ajax0(currentTime);

                $.each(ajax_request_list,function (i,v) {

                    var ajax_url = v[0];
                    var news_country = v[1];
                    var news_type = v[2];


                    $.ajax({
                        url:ajax_url,
                        method:"GET",
                        async:true,
                        success: function (d) {

                            console.log(d);

                            var news_array = [];
                            for (var i=0;i<Math.min(d.articles.length,number_of_record);i++){
                                news_array[i]=d.articles[i];
                            }
                            // console.log(news_array.length);

                            $.ajax({
                                url:"./form/updateNews.php",
                                method:"POST",
                                async:true,
                                data:{news:news_array,country:news_country,currentTime:currentTime,category:news_type},
                                success: function (d) {
                                    // console.log(d);
                                }
                            })
                        }
                    });

                });




            }
        },
        error: function () {
           alert("Ajax Error.") ;
        },
        complete: function () {

        }
        });


    $(document).ajaxStop(function () {
        setTimeout(function () {
            TweenLite.fromTo($("#loading_page"),2.3,{right:'0'},{right:'100%',display:"none",ease:Bounce.easeOut});

            // TweenMax.to($("#loading_page"),1.3, {ease: Elastic.easeOut.config(1,0.3),"letf":0});

            // $("#loading_page").css({opacity:0,transition:"opacity 1s ease-in-out"});
            // setTimeout(function () {
            //     $("#loading_page").css("z-index","-1");
            // },1000);
        },1000);
    });




    /*

        Three.js background setting.

     */



    var $height = 350;
    var $width = 300;
    var $window_height = window.innerHeight;
    var $window_width = window.innerWidth;
    var $window_height2 = window.innerHeight-6;
    var $window_width2 = window.innerWidth-6;
    var $LogIn = $("#logIn_UI");

    if($window_height>=$height && $window_width>=$width){
        $LogIn.css({height:$height,width:$width});
    }
    else if($window_height<$height && $window_width>=$width){
        $LogIn.css({height:$window_height2,width:$width});
    }
    else if($window_height>=$height && $window_width<$width){
        $LogIn.css({height:$height,width:$window_width2});
    }
    else{
        $LogIn.css({height:$window_height2,width:$window_width2});
    }

    var $actual_height = $LogIn.height();
    var $actual_width = $LogIn.width();
    var $top = ($window_height-($actual_height+6))/2;
    var $left = ($window_width-($actual_width+6))/2;
    $LogIn.css({left:$left,top:$top});

    $("#su_button").on("click",function(){
        window.location = 'signup_home.php';
    });


    var aspect_ratio = window.innerWidth / window.innerHeight;
    var scene = new THREE.Scene();


    var camera = new THREE.PerspectiveCamera( 60, aspect_ratio, 0.1, 1000 );
    camera.position.set(0,0,5);


    $(window).on("resize",function () {
        $height = 350;
        $width = 300;
        $window_height = window.innerHeight;
        $window_width = window.innerWidth;
        $window_height2 = window.innerHeight-6;
        $window_width2 = window.innerWidth-6;

        if($window_height>=$height && $window_width>=$width){
            $LogIn.css({height:$height,width:$width});
        }
        else if($window_height<$height && $window_width>=$width){

            $LogIn.css({height:$window_height2,width:$width});
        }
        else if($window_height>=$height && $window_width<$width){
            $LogIn.css({height:$height,width:$window_width2});
        }
        else{
            $LogIn.css({height:$window_height2,width:$window_width2});
        }

        $actual_height = $LogIn.height();
        $actual_width = $LogIn.width();
        $top = ($window_height-($actual_height+6))/2;
        $left = ($window_width-($actual_width+6))/2;
        $LogIn.css({left:$left,top:$top});

        aspect_ratio = window.innerWidth / window.innerHeight;
        camera.aspect = aspect_ratio;
        camera.updateProjectionMatrix();
    });

    var renderer = new THREE.WebGLRenderer({antialias:true});
    renderer.setSize( window.innerWidth, window.innerHeight );


    $(window).on("resize",function () {
        renderer.setSize( window.innerWidth, window.innerHeight );
    });

    document.body.appendChild( renderer.domElement );

    var plane_geo = new THREE.PlaneGeometry(37,12,32,32);
    var plane_material = new THREE.MeshBasicMaterial();
    plane_material.map = new THREE.TextureLoader().load('pic/4k-universe-galaxy-inside_e1ootpanx__F0000.png');
    var plane = new THREE.Mesh(plane_geo,plane_material);
    plane.position.set(0,0,-3);
    scene.add(plane);



    var geometry = new THREE.SphereGeometry(3.5, 62, 62);
    var material = new THREE.MeshLambertMaterial({
        map: new THREE.TextureLoader().load('pic/earth.jpg')
    });
    var earthMesh = new THREE.Mesh( geometry, material );
    earthMesh.position.set(2.5,-2.5,0);
    scene.add( earthMesh );

    var atmosphereShader = new THREE.ShaderMaterial(
        {
            uniforms:{
                "c": {type:"f",value:0.3},
                "p": {type:"f",value:3.5},
                glowColor: {type:"c", value:new THREE.Color(0x00aaff)},
                viewVector: {type:"v3", value: camera.position}
            },
            vertexShader: document.getElementById("vertexShader").textContent,
            fragmentShader: document.getElementById("fragmentShader").textContent,
            side: THREE.BackSide,
            blending: THREE.AdditiveBlending,
            transparent: true
        } );

    atmosphereShader.depthTest=true;

    var geometry_atm = new THREE.SphereGeometry(3.5, 62, 62);
    var earthMesh2 = new THREE.Mesh(geometry_atm, atmosphereShader);
    earthMesh2.position.set(2.5,-2.5,0);
    //earthMesh2.position = earthMesh.position;
    earthMesh2.scale.multiplyScalar(1.3);

    scene.add(earthMesh2);


    var light = new THREE.DirectionalLight( 0xcccccc,1.5);
    light.position.set( -3, 0.2, 0.2 );
    var light2 = new THREE.AmbientLight( 0x404040,1 ); // soft white light

    //spriteMaterial.map = THREE.ImageUtils.loadTexture('pic/earth.jpg');


    scene.add(light,light2);

    var geometry_cloud = new THREE.SphereGeometry(3.52,32,32);
    var material_cloud = new THREE.MeshBasicMaterial({transparent:true, opacity: 1});
    var cloudMesh = new THREE.Mesh(geometry_cloud,material_cloud);

    material_cloud.map = new THREE.TextureLoader().load('pic/Earth-clouds.png');

    cloudMesh.position.set(2.5,-2.5,0);
    scene.add(cloudMesh);





    var geometry3 = new THREE.SphereGeometry(0.3,32,32);
    var material3 = new THREE.MeshLambertMaterial();
    var moonMesh = new THREE.Mesh(geometry3,material3);

    material3.map = new THREE.TextureLoader().load('pic/moonmap.jpg');
    material3.bumpMap = new THREE.TextureLoader().load('pic/moonbump.jpg');
    material3.bumpScale = 0.01;
    scene.add(moonMesh);
    moonMesh.position.set(-3,-0.1,0);

    var glow2 = new THREE.ShaderMaterial(
        {
            uniforms:{
                "c": {type:"f",value:0.1},
                "p": {type:"f",value:6.0},
                glowColor: {type:"c", value:new THREE.Color(0xffffcc)},
                viewVector: {type:"v3", value: camera.position}
            },
            vertexShader: document.getElementById("vertexShader").textContent,
            fragmentShader: document.getElementById("fragmentShader").textContent,
            side: THREE.BackSide,
            blending: THREE.AdditiveBlending,
            transparent: true
        } );

    var geometry_glow2 = new THREE.SphereGeometry(0.3, 32, 32);
    var glowMesh2 = new THREE.Mesh(geometry_glow2, glow2);
    glowMesh2.position.set(-3.2,-0.1,0);
    //earthMesh2.position = earthMesh.position;
    glowMesh2.scale.multiplyScalar(1.6);

    scene.add(glowMesh2);




    function animate() {
        requestAnimationFrame( animate );

        cloudMesh.rotation.y += 0.0005;
        earthMesh.rotation.y += 0.00053;
        moonMesh.rotation.y = 1;
        //parent.rotation.y += 0.005;

        //mesh.rotation.y += 0.005;


        renderer.render( scene, camera );
    }
    animate();





    /*

        Log in functionality.

     */

    var $form = $("#li_form");

    $("#li_button").on("click",function (e) {
        e.preventDefault();
        $.ajax({
            url:"./form/log_in.php",
            type:"POST",
            data:$form.serialize(),
            success:function (d) {
                if(d === "Account or Password is not correct!"){
                    $("#info").addClass("text-danger").html(d);
                    // $("#info").css("color","red");
                }
                else{
                    location.href = "./home.php?id="+d;
                }
            }
        })
    });





    /*

        Social login.

     */


    $("#wcIcon").on("click",function () {
        alert(1);
        window.location.href = 'oauth_index.html';
    });

});