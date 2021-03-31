$("#loading_page").css({"z-index":"1","opacity":"1"});
$(window).on("load",function () {
    var $window_width = $(window).width();

    var $cContainer = $("#comments_container");
    var $type = $("#type");
    var $title = $("#title");
    var $cContainerHeight = $(window).height() - $type.height() - $title.height();

    $cContainer.css("height",$cContainerHeight);


    $(".comment").each(function () {
        var $cc_scroll_height = $(this).children(".comment_content").children(".comment_container").prop("scrollHeight");
        var $user_scroll_height = $(this).children(".user").prop("scrollHeight");
        var $ic_scroll_height = $(this).children(".comment_content").children(".image_container").prop("scrollHeight");
        if($cc_scroll_height>=$user_scroll_height){
            if($cc_scroll_height>=$ic_scroll_height){
                $(this).css({"height":$cc_scroll_height});
            }
            else{
                $(this).css({"height":$ic_scroll_height});
            }
        }
        else{

            if($user_scroll_height>=$ic_scroll_height){
                $(this).css({"height":$user_scroll_height});
            }
            else{
                $(this).css({"height":$ic_scroll_height});
            }
        }
    });

    $(window).on("resize",function () {
        if($window_width<$(this).width()){
            $(".comment").each(function () {
                var $cc_height = $(this).height();
                var $cc_scroll_height = $(this).children(".comment_content").children(".comment_container").prop("scrollHeight");
                var $ic_scroll_height = $(this).children(".comment_content").children(".image_container").prop("scrollHeight");
                if($cc_scroll_height>=$cc_height){
                    if($ic_scroll_height>=$cc_height){
                        $(this).css({"height":$cc_height});
                    }
                    else{
                        $(this).css({"height":$ic_scroll_height});
                    }
                }
                else{

                    if($cc_scroll_height>=$ic_scroll_height){
                        $(this).css({"height":$ic_scroll_height});
                    }
                    else{
                        $(this).css({"height":$cc_scroll_height});
                    }
                }
            });

            $window_width = $(window).width();
        }
        else{
            $(".comment").each(function () {
                var $cc_scroll_height = $(this).children(".comment_content").children(".comment_container").prop("scrollHeight");
                var $user_scroll_height = $(this).children(".user").prop("scrollHeight");
                var $ic_scroll_height = $(this).children(".comment_content").children(".image_container").prop("scrollHeight");
                if($cc_scroll_height>=$user_scroll_height){
                    if($cc_scroll_height>=$ic_scroll_height){
                        $(this).css({"height":$cc_scroll_height});
                    }
                    else{
                        $(this).css({"height":$ic_scroll_height});
                    }
                }
                else{

                    if($user_scroll_height>=$ic_scroll_height){
                        $(this).css({"height":$user_scroll_height});
                    }
                    else{
                        $(this).css({"height":$ic_scroll_height});
                    }
                }

                $window_width = $(window).width();
            });
        }

        $cContainerHeight = $(window).height() - $type.height() - $title.height();
        $cContainer.css("height",$cContainerHeight);

    });




    $(".cr").each(function (index4) {
        $(this).children(".options_bar").children(".delete").on("click",function (event) {
            var $r=confirm("Really want to delete?");
            if($r === true)
            {
                $(this).parent().parent().load("/yyqGS/public/form/delete_comments.php",{index4:index4},function () {
                    $(this).children().remove();
                    $(this).remove();
                    location.reload();
                });
            }
        })
    });






    $(".single_reply").each(function () {
        var $reply_scroll_height = $(this).prop("scrollHeight");
        var $reply_height = $(this).height();
        if($reply_scroll_height>$reply_height){
            $(this).css({height:$reply_scroll_height});
            $(this).children(".reply_user").css({height:$reply_scroll_height});
        }
        else{
            $(this).css({height:$reply_height});
            $(this).children(".reply_user").css({height:$reply_height});
        }
    });

    var $rf = 1, $rf2 = 1;


    $(".reply").each(function (index5) {
        $(this).on("click",function () {

            $(".reply_container").each(function (index_r) {
                if(index_r===index5 && $rf === 1){


                    $(this).children(".reply_form").css({ opacity:"1",height:"auto", transition:"all 1s linear"});
                    //$($(this) > $("form")).css({height:"inherit", opacity:"1", transition:"all 1s linear"});
                    $rf = -$rf;
                }
                else if(index_r===index5 && $rf !== 1){
                    $(this).children(".reply_form").css({ opacity:"0",height:"0", transition:"all 1s linear"});
                    //$($(this) > $("form")).css({height:"inherit", opacity:"0", transition:"all 1s linear"});
                    $rf = -$rf;
                }
            });
        });


    });

    var $reply_width = $(".reply_reply").width();
    $(".reply_delete").css({right:$reply_width});


    $(".cr").each(function (index_sr) {
        $(this).children(".reply_container").children(".single_reply").children(".reply_delete").each(function (index6) {
            $(this).on("click",function () {
                var $r=confirm("Really want to delete?");
                if($r === true)
                {

                    $(this).parent().parent().load("/yyqGS/public/form/delete_reply.php",{index:index6,index_sr:index_sr},function (d) {

                        $(this).remove();
                        location.reload();
                    });
                }
            })
        });

        var $f=0;
        var $cid = index_sr;

        $(this).children(".options_bar").children(".reply").on("click",function () {
            $(this).parent().parent().children(".reply_container").children(".reply_form").children(".reply_button").on("click",function () {


                var $this = $(this);
                $this.parent().attr("action","/yyqGS/public/form/reply.php?cid=" + $cid);
                $this.parent().submit();


            });
        });



        $(this).children(".reply_container").children(".single_reply").each(function (index_b) {


            $(this).children(".reply_reply").on("click",function () {
                $(this).parent().parent().children(".reply_form").children(".reply_button").on("click",function (e) {
                    var $this = $(this);
                    $this.parent().attr("action","/yyqGS/public/form/reply2.php?cid=" + $cid+"&rid="+index_b);
                    $this.parent().submit();
                })
            });

        });

    });


    $("#gb").on("click",function () {
        $.get("/yyqGS/public/form/get_url.php",function (d) {
            var $data = d.split(",");
            location.href = "/yyqGS/public/countries.php?id="+$data[0]+"&country="+$data[1];
        })
    });


    $("#dt").on("click",function () {
        var c = confirm("Delete?");
        if(c===true){
            $(this).load("/yyqGS/public/form/delete_thread.php", function (d) {
                var $data = d.split(",");
                location.href = "/yyqGS/public/countries.php?id="+$data[0]+"&country="+$data[1];
            });
        }
    });

    $(".reply_container").each(function (index8) {
        $(this).children(".single_reply").children(".reply_reply").on("click",function () {

            $(".reply_container").each(function (index_r) {
                if(index_r===index8 && $rf2 === 1){


                    $(this).children(".reply_form").css({ opacity:"1",height:"auto", transition:"all 1s linear"});
                    //$($(this) > $("form")).css({height:"inherit", opacity:"1", transition:"all 1s linear"});
                    $rf2 = -$rf2;
                }
                else if(index_r===index8 && $rf2 !== 1){
                    $(this).children(".reply_form").css({ opacity:"0",height:"0", transition:"all 1s linear"});
                    //$($(this) > $("form")).css({height:"inherit", opacity:"0", transition:"all 1s linear"});
                    $rf2 = -$rf2;
                }
            });

        });
    });
    
    $.ajax({
        url:"/yyqGS/public/form/get_url.php",
        type:"GET",
        success:function (d) {
            var $data = d.split(",");
            for(var i = 0; i < $data[6]; i++){
                var j = i+1;
                var $pl;
                if(j === 1){
                    $pl = "<li><a class='page_list_a' href=\"/yyqGS/public/thread.php?id=" + $data[0] + "&country=" +$data[1]+ "&tid=" + $data[2]+"\">"+j+"</a></li>";
                }
                else{
                    $pl = "<li><a class='page_list_a' href=\"/yyqGS/public/thread.php?id=" + $data[0] + "&country=" +$data[1]+ "&tid=" + $data[2]+"&page="+j+"\">"+(i+1)+"</a></li>";
                }
                $("#page_list").append($pl);
            }
        },
        complete:function () {
            $("#loading_page").css({"opacity":0,"transition":"opacity .5s ease-out"});
            setTimeout(function () {
                $("#loading_page").css("z-index","-1");
            },500);
        }
    });
    

    var $uploaded_image = $(".uploaded_image");
    $uploaded_image.each(function (index) {
        var $ti_flag = 1;
        $(this).on("click",function (e) {

            if($ti_flag===1)
            {
                $("#show_image").css({"z-index":"2","background-image": "url(" + $(this).attr("src") +")"
                    ,"background-position":"center"
                    ,"background-color":"white"
                    ,"background-size":"contain"
                    ,"background-repeat":"no-repeat"});
                $ti_flag = -$ti_flag;
            }
        });
        $("#show_image").on("click",function () {
            if($ti_flag===-1) {
                $("#show_image").css({"z-index": "-1", "background-image": ""});
                $ti_flag = -$ti_flag;
            }
        })
    });

    var $send = $("#send_button");
    var $loading = $("#loading");
    $send.on("click",function (e) {
        e.preventDefault();
        $send.css({"z-index":-1});
        $loading.css({"z-index":1});
        var $form = new FormData($("#type_area")[0]);
        $.ajax({
            url:"/yyqGS/public/form/thread.php",
            type:"POST",
            data:$form,
            contentType: false,
            processData: false,
            success:function (d) {
                var $data = d.split(",");
                if($data[0] ==='' && $data[1] ==='' && $data[2] === ''){
                    location.reload()
                }
                else{
                    if($data[0] !==''){
                        alert($data[0]);
                    }
                    else if($data[1] !==''){
                        alert($data[1]);
                    }
                    else{
                        alert($data[2]);
                    }

                }
            },
            complete:function () {
                $send.css({"z-index":1});
                $loading.css({"z-index":-1});
            }
        })
    });

    $loading.on("click",function (e) {
        e.preventDefault();
    });


    var $like = $("#lb");
    var $dislike = $("#dlb");
    var $loading_button = $("#loading_button");
    $like.on("click",function () {
        $like.css({opacity:0,transition:"opacity .4s linear"});
        setTimeout(function () {
            $like.css("z-index","-1");
        },400);
        $loading_button.css({"z-index":"1",opacity:"1",transition:"opacity .4s linear"});

        $.ajax({
            url:"/yyqGS/public/form/get_url.php",
            success:function (d) {
                var $data = d.split(",");
                var $id = $data[0];
                var $country = $data[1];
                var $tid = $data[2];
                $.ajax({
                    url:"/yyqGS/public/form/like.php",
                    type:"POST",
                    data:{id:$id,country:$country,tid:$tid},
                    success:function (d) {

                        alert(d);
                    },
                    complete:function () {
                        $loading_button.css({"z-index":"-1",opacity:"0",transition:"opacity .4s linear"});
                        $dislike.css({"z-index":"1",opacity:"1",transition:"opacity .4s linear"});
                    }
                })
            }
        })
    });

    $dislike.on("click",function () {
        $dislike.css({opacity:0,transition:"opacity .4s linear"});
        setTimeout(function () {
            $dislike.css("z-index","-1");
        },400);
        $loading_button.css({"z-index":"1",opacity:"1",transition:"opacity .4s linear"});

        $.ajax({
            url:"/yyqGS/public/form/get_url.php",
            success:function (d) {
                var $data = d.split(",");
                var $id = $data[0];
                var $country = $data[1];
                var $tid = $data[2];
                $.ajax({
                    url:"/yyqGS/public/form/dislike.php",
                    type:"POST",
                    data:{id:$id,country:$country,tid:$tid},
                    success:function (d) {

                        alert(d);
                    },
                    complete:function () {
                        $loading_button.css({"z-index":"-1",opacity:"0",transition:"opacity .4s linear"});
                        $like.css({"z-index":"1",opacity:"1",transition:"opacity .4s linear"});
                    }
                })
            }
        })
    });
    $('#upload').change(function() {
        var filename = $('input[type=file]').val().split('\\').pop();
        $("#up_title").html(filename);
    });
});