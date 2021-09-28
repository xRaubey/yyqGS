$("#loading_page").css({"z-index":"20"});


$('.my-image').croppie({
    viewport: {
        width: 250,
        height: 250
    },
    boundary: { width: 300, height: 300 }
});

$('.my-image').parent().addClass("row p-0 m-0 justify-content-center col-12 align-content-center")
    .append("<div id='svg_container' class='col-12 row p-0 m-0 justify-content-center'></div>");

$("#svg_container")
    .append("<svg id='choose_profile' class='align-self-center' width=\"55\" height=\"55\" xmlns=\"http://www.w3.org/2000/svg\">\n" +
        " <g>\n" +
        "  <rect fill=\"none\" id=\"canvas_background\" height=\"21.298228\" width=\"21.298228\" y=\"-1\" x=\"-1\"/>\n" +
        "  <g display=\"none\" id=\"canvasGrid\">\n" +
        "   <rect fill=\"url(#gridpattern)\" stroke-width=\"0\" y=\"1\" x=\"1\" height=\"400\" width=\"580\" id=\"svg_3\"/>\n" +
        "  </g>\n" +
        " </g>\n" +
        " <g>\n" +
        "  <ellipse stroke=\"#1af2d5\" ry=\"25\" rx=\"25\" id=\"svg_1\" cy=\"27.564104\" cx=\"27.641024\" stroke-width=\"3.5\" fill=\"none\"/>\n" +
        "  <path stroke=\"#000\" id=\"svg_4\" d=\"m11.288527,26.092019l3.599989,-3.60126l9.862113,9.860836l16.439823,-16.434726l3.601262,3.598715l-20.041085,20.038532\" stroke-width=\"0\" fill=\"#456\"/>\n" +
        " </g>\n" +
        "</svg>");


$('.my-image').attr('src', './uploaded_images/icon.png');
$('.cr-image').attr('src', './uploaded_images/icon.png');

$(window).on("load",function () {
    $("#loading_page").css({"z-index":"-1"});

    // $("#profile").on("change",function (e) {
    //     e.preventDefault();
    //     // $("#profile_form").submit();
    //
    //
    //
    // });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {


                $('.my-image').croppie('bind',{url: e.target.result});

                // $('.my-image').croppie('result','base64');

                // $('.my-image').attr('src', e.target.result);
                // $('.cr-image').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#profile").change(function(){
        readURL(this);
    });



        // .append("<div id=\"loading_button\" class=\"tb_button svg_container\">\n" +
        //     "        <svg width=\"55.00000000000001\" height=\"55.00000000000001\" xmlns=\"http://www.w3.org/2000/svg\">\n" +
        //     "            <g>\n" +
        //     "                <rect fill=\"none\" id=\"canvas_background\" height=\"7.583746\" width=\"7.583746\" y=\"-1\" x=\"-1\"/>\n" +
        //     "                <g display=\"none\" id=\"canvasGrid\">\n" +
        //     "                    <rect fill=\"url(#gridpattern)\" stroke-width=\"0\" y=\"1\" x=\"1\" height=\"400\" width=\"580\" id=\"svg_3\"/>\n" +
        //     "                </g>\n" +
        //     "            </g>\n" +
        //     "            <g>\n" +
        //     "                <ellipse stroke=\"#1af2d5\" ry=\"25\" rx=\"25\" id=\"svg_1\" cy=\"27.564104\" cx=\"27.641024\" stroke-width=\"3.5\" fill=\"none\"/>\n" +
        //     "                <path stroke=\"null\" id=\"svg_6\" d=\"m28.225565,15.387951c1.253755,0.001585 2.45149,0.218668 3.585801,0.581329l-0.897725,1.552643l6.372394,0l-1.593506,-2.759719l-1.59229,-2.758894l-0.838194,1.45376c-1.570909,-0.574328 -3.264408,-0.895755 -5.035338,-0.895755c-8.151461,0 -14.758476,6.607428 -14.758476,14.758856c0,3.383111 1.150644,6.491448 3.06557,8.98186l2.244103,-1.723017c-1.548738,-2.012595 -2.479924,-4.524033 -2.484977,-7.258028c0.01128,-6.590322 5.34313,-11.922931 11.932637,-11.933035l0.000001,0zm11.694462,2.953473l-2.244098,1.723842c1.548348,2.011829 2.479539,4.521684 2.483799,7.256492c-0.011281,6.590268 -5.34313,11.922114 -11.93302,11.932974c-1.167767,-0.00151 -2.284961,-0.191391 -3.350005,-0.508942l0.844789,-1.460806l-6.372366,0l1.592327,2.758192l1.593476,2.761996l0.888387,-1.541703c1.506697,0.524518 3.119237,0.817144 4.803391,0.817905c8.152637,-0.001519 14.758518,-6.608953 14.760433,-14.760387c-0.001915,-3.383103 -1.153377,-6.490682 -3.067115,-8.979562l0,-0.000001z\" stroke-opacity=\"null\" stroke-width=\"0.2\" fill=\"#ffffff\"/>\n" +
        //     "            </g>\n" +
        //     "        </svg>\n" +
        //     "    </div>");


    var $width = window.innerWidth;
    var $height = window.innerHeight;
    var $button_width = $('#choose_profile').width();
    var $container_width = $('#container').width();
    var $container_height = $('#container').height();
    var $container_left = ($width-$container_width-6)/2;
    var $left = ($container_width-$button_width)/2;
    // $('#choose_profile').css({left:$left});
    var $loading_button = $("#loading_button");
    // $loading_button.css({left:$left});
    // $('#container').css({left:$container_left});


    // if($height<=$container_height){
    //     $("body").css({height:$container_height});
    //     $("#container").css({top:"0"});
    // }
    // else{
    //     $("body").css({height:$height});
    //     $("#container").css({top:"10%"});
    // }



    // $(window).on("resize",function () {
    //     $width = window.innerWidth;
    //     $left = ($container_width-$button_width)/2;
    //     $('#choose_profile').css({left:$left});
    //     $loading_button.css({left:$left});
    //
    //
    //     $height = window.innerHeight;
    //     if($height<=$container_height){
    //         $("body").css({height:$container_height});
    //         $("#container").css({top:"0"});
    //     }
    //     else{
    //         $("body").css({height:$height});
    //         $("#container").css({top:"10%"});
    //     }
    //     $container_left = ($width-$container_width-6)/2;
    //     $('#container').css({left:$container_left});
    // });


    $('#choose_profile').on("click",function () {
        // $("#loading_page").css({"z-index":"20"});
        //
        // $('#choose_profile').css({opacity:"0","z-index":"-1"});
        // $loading_button.css({opacity:"1","z-index":"1"});

        $('.my-image').croppie('result','base64').then(function (image) {
            $.ajax({
                url:"./form/profile.php",
                type:"POST",
                data:{profile:image},
                success:function (d) {

                    var data = JSON.parse(d);

                    console.log(data.id);

                    if(data.error1===''&& data.error2===''){
                        location.href="./home.php?id="+data.id;
                    }
                    else{

                        $("#notice").html("Try again");
                    }


                }
            })
        });

    });

    $loading_button.on("click",function (e) {
        e.preventDefault();
    })

});