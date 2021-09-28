// $("#loading_page").css({"z-index":"20","opacity":"1"});
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




    /*

        Window resize handler.

     */

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




    // $(".cr").each(function (index4) {
    //     console.log(index4);
    //     $(this).children(".options_bar").children(".delete").on("click",function (event) {
    //
    //         event.preventDefault();
    //
    //         alert(index4);
    //
    //
    //         // var $comment = $(this).parent().parent().children(".comment").children(".comment_container").children(".comment_cotent");
    //         // // var $image = $(this).parent();
    //         // // var $name = $(this);
    //         //
    //         //
    //         //
    //         // var $r=confirm("Really want to delete?");
    //         // if($r === true)
    //         // {
    //         //     $.ajax({
    //         //         url:"/yyqGS/public/form/delete_comments.php",
    //         //         method:"POST",
    //         //         data:{index4:index4,page:},
    //         //         success:function (d) {
    //         //
    //         //             $comment.html("Deleted");
    //         //         }
    //         //     });
    //         //
    //         // }
    //     })
    // });




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


    /*
        "Leave comments" functionality.
     */


    $(".reply").each(function (index5) {
        $(this).on("click",function () {

            var option_bar = $(this).parent();
            var reply1_form = $(this).parent().parent().children(".reply_form");

            option_bar.removeClass("d-flex");
            option_bar.addClass("d-none");

            reply1_form.removeClass("d-none");
            reply1_form.addClass("d-flex");

            // $(".reply_container").each(function (index_r) {
            //     if(index_r===index5 && $rf === 1){
            //
            //
            //         $(this).children(".reply_form").css({ display:"flex", opacity:"1",height:"auto", transition:"all 1s linear"});
            //         //$($(this) > $("form")).css({height:"inherit", opacity:"1", transition:"all 1s linear"});
            //         $rf = -$rf;
            //     }
            //     else if(index_r===index5 && $rf !== 1){
            //         $(this).children(".reply_form").css({ display:"none", opacity:"0",height:"0", transition:"all 1s linear"});
            //         //$($(this) > $("form")).css({height:"inherit", opacity:"0", transition:"all 1s linear"});
            //         $rf = -$rf;
            //     }
            // });
        });


    });



    // var $reply_width = $(".reply_reply").width();
    // $(".reply_delete").css({right:$reply_width});


    // $(".cr").each(function (index_sr) {
    //
    //
    //     $(this).children(".reply_container").children(".single_reply").each(function (index6) {
    //         $(this).children(".reply_delete").on("click",function () {
    //
    //
    //             var rc = $(this).parent();
    //
    //             var $r=confirm("Really want to delete the reply?");
    //             if($r === true)
    //             {
    //                 $.ajax({
    //                     url:"./form/delete_reply.php",
    //                     method:"POST",
    //                     data:{index:index6,index_sr:index_sr},
    //                     success:function (d) {
    //
    //                         rc.css({"display":"none"});
    //                         $(this).parent().children(".reply_content").html("Delete");
    //                         $(this).parent().children(".reply_user").children("reply_user_name").html("-");
    //
    //
    //                         // console.log(index6+"  "+index_sr+"  "+d);
    //                     }
    //                 });
    //
    //                 // $(this).parent().parent().load("/yyqGS/public/form/delete_reply.php",{index:index6,index_sr:index_sr},function (d) {
    //                 //
    //                 //     console.log(d);
    //                 //     // $(this).remove();
    //                 //     // location.reload();
    //                 // });
    //             }
    //         });
    //
    //         // $(this).children(".reply_delete").each(function (index6) {
    //         //
    //         // });
    //     });
    //
    //     var $f=0;
    //     var $cid = index_sr;
    //
    //     $(this).children(".options_bar").children(".reply").on("click",function () {
    //         $(this).parent().parent().children(".reply_container").children(".reply_form").children(".reply_button").on("click",function () {
    //
    //
    //             var $this = $(this);
    //             $this.parent().attr("action","/yyqGS/public/form/reply.php?cid=" + $cid);
    //             $this.parent().submit();
    //
    //
    //         });
    //     });
    //
    //
    //
    //     $(this).children(".reply_container").children(".single_reply").each(function (index_b) {
    //
    //
    //         $(this).children(".reply_reply").on("click",function () {
    //             $(this).parent().parent().children(".reply_form").children(".reply_button").on("click",function (e) {
    //                 var $this = $(this);
    //                 $this.parent().attr("action","/yyqGS/public/form/reply2.php?cid=" + $cid+"&rid="+index_b+"page="+index_sr);
    //                 $this.parent().submit();
    //             })
    //         });
    //
    //     });
    //
    // });


    /*
        "Go back" functionality.
     */

    $("#gb").on("click",function () {

        $(".tb_button").each(function (i) {
            $(this).attr("disabled","true");
        });
        $(".page_list_a").each(function () {
            $(this).addClass("disabled");
        });

        $.get("./form/get_url.php",function (d) {
            var $data = d.split(",");
            location.href = "./countries.php?id="+$data[0]+"&country="+$data[1];

            // location.href = "/yyqGS/public/countries.php?id="+$data[0]+"&country="+$data[1];
        }).always(function () {
            setTimeout(function () {
                $(".tb_button").each(function (i) {
                    $(this).removeAttr("disabled");
                });

                $(".page_list_a").each(function () {
                    $(this).removeClass("disabled");
                });

            },5000);
        })
    });



    /*
        "Delete" functionality.
     */

    $("#dt").on("click",function () {
        var c = confirm("Delete?");
        if(c===true){

            $.ajax({
                url:"./form/delete_thread.php",
                method:"GET",
                success:function (d) {
                    var $data = d.split(",");
                    location.href = "./countries.php?id="+$data[0]+"&country="+$data[1];
                },
                error:function () {
                    alert("Can't delete it because of some error.");
                }
            });

            // $(this).load("/yyqGS/public/form/delete_thread.php", function (d) {
            //     var $data = d.split(",");
            //     location.href = "/yyqGS/public/countries.php?id="+$data[0]+"&country="+$data[1];
            // });
        }
    });





    /*
        "Reply" functionality
     */

    $(".reply_container").each(function (index8) {
        $(this).children(".single_reply").children(".single_reply_container").children(".reply_reply").on("click",function () {

            var reply_form = $(this).parent().parent().children(".reply_reply_form");
            var reply_container = $(this).parent();

            if((reply_form.hasClass("d-none"))){
                // alert(1);

                reply_container.removeClass("d-flex");
                reply_container.addClass("d-none");

                reply_form.removeClass("d-none");
                reply_form.addClass("d-flex");
            }
            else if(!(reply_form.hasClass("show_form"))){

                reply_container.removeClass("d-none");
                reply_container.addClass("d-flex");

                reply_form.removeClass("d-flex");
                reply_form.addClass("d-none");


            }


            // $(".reply_container").each(function (index_r) {
            //
            //     var reply_form = $(this).children(".single_reply").children(".reply_reply_form");
            //
            //     if(index_r===index8 && (reply_form.hasClass("d-none"))){
            //         // alert(1);
            //
            //         reply_form.removeClass("d-none");
            //         reply_form.addClass("d-flex");
            //     }
            //     else if(index_r===index8 && !(reply_form.hasClass("show_form"))){
            //
            //         reply_form.removeClass("d-flex");
            //         reply_form.addClass("d-none");
            //
            //
            //     }
            //
            //
            //     // if(index_r===index8 && $rf2 === 1){
            //     //
            //     //
            //     //     $(this).children(".single_reply").children(".reply_reply_form").css({ display:"flex", opacity:"1",height:"auto", transition:"all 1s linear"});
            //     //     //$($(this) > $("form")).css({height:"inherit", opacity:"1", transition:"all 1s linear"});
            //     //     $rf2 = -$rf2;
            //     // }
            //     // else if(index_r===index8 && $rf2 !== 1){
            //     //     $(this).children(".reply_reply_form").css({ display:"none", opacity:"0",height:"0", transition:"all 1s linear"});
            //     //     //$($(this) > $("form")).css({height:"inherit", opacity:"0", transition:"all 1s linear"});
            //     //     $rf2 = -$rf2;
            //     // }
            // });

        });
    });


    /*
        "Pagination" functionality.
     */

    $.ajax({
        url:"./form/get_url.php",
        type:"GET",
        success:function (d) {
            var $data = d.split(",");
            for(var i = 0; i < $data[6]; i++){
                var j = i+1;
                var $pl;
                if(j === 1){
                    $pl = "<a class='page_list_a list-group-item list-group-item-action text-center' href=\"./thread.php?id=" + $data[0] + "&country=" +$data[1]+ "&tid=" + $data[2]+"\">"+j+"</a>";
                }
                else{
                    $pl = "<a class='page_list_a list-group-item list-group-item-action text-center' href=\"./thread.php?id=" + $data[0] + "&country=" +$data[1]+ "&tid=" + $data[2]+"&page="+j+"\">"+(i+1)+"</a>";
                }
                $("#page_list").append($pl);
            }
        },
        complete:function () {

        }
    });



    /*
        Upload image functionality.
     */

    var $uploaded_image = $(".uploaded_image");
    $uploaded_image.each(function (index) {



        $(this).on("click",function () {

            var show_image = $("#show_image");
            if(!show_image.hasClass("clicked")){
                show_image.addClass("clicked");

                show_image.css({"z-index":"2","background": "no-repeat center white"});
                $("#thread_image").attr("src",$(this).attr("src"));

            }


        });

        $("#show_image").on("click",function () {

            if($("#show_image").hasClass("clicked")){

                $("#show_image").removeClass("clicked");

                $("#show_image").css({"z-index": "-1"});

            }
        })




        // var $ti_flag = 1;
        // $(this).on("click",function (e) {
        //
        //     var $image_url = $(this).attr("src");
        //     if($ti_flag===1)
        //     {
        //         $("#show_image").css({"z-index":"10","background-image": "url(" + $image_url +")"
        //             ,"background-position":"center"
        //             ,"background-color":"white"
        //             ,"background-size":"contain"
        //             ,"background-repeat":"no-repeat"});
        //         $ti_flag = -$ti_flag;
        //     }
        // });
        // $("#show_image").on("click",function () {
        //     if($ti_flag===-1) {
        //         $("#show_image").css({"z-index": "-1", "background-image": ""});
        //         $ti_flag = -$ti_flag;
        //     }
        // })
        //
        //

    });



    var $send = $("#send_button");
    // var $loading = $("#loading");
    $send.on("click",function (e) {
        e.preventDefault();
        // $send.css({"z-index":-1});
        // $loading.css({"z-index":1});

        // console.log($("#type_area").val()==='');

        $(".tb_button").each(function (i) {
            $(this).attr("disabled","true");
        });
        $(".page_list_a").each(function () {
            $(this).addClass("disabled");
        });


        if($("#type_bar").val()===''){
            alert("Type something.");
            $(".tb_button").each(function (i) {
                $(this).removeAttr("disabled","true");
            });
            $(".page_list_a").each(function () {
                $(this).removeClass("disabled");
            });
        }

        else{
            var $form = new FormData($("#type_area")[0]);
            $.ajax({
                url:"./form/thread.php",
                // url:"/yyqGS/public/form/ttt.php",
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
                            console.log($data[0]);
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
                    // $send.css({"z-index":1});
                    // $loading.css({"z-index":-1});

                    setTimeout(function () {
                        $(".tb_button").each(function (i) {
                            $(this).removeAttr("disabled","true");
                        });
                        $(".page_list_a").each(function () {
                            $(this).removeClass("disabled");
                        });
                    },2000);


                }
            })
        }

    });

    // $loading.on("click",function (e) {
    //     e.preventDefault();
    // });


    // var $like = $("#lb");
    //
    // $like.on("click",function () {
    //
    //
    //     $(".tb_button").each(function (i) {
    //         $(this).attr("disabled","true");
    //     });
    //
    //     $(".page_list_a").each(function () {
    //         $(this).addClass("disabled");
    //     });
    //
    //     if($.trim($like.html())==="Mark"){
    //
    //         $.ajax({
    //             url:"/yyqGS/public/form/like.php",
    //             type:"POST",
    //             data:{id:$id,country:$country,tid:$t_id},
    //             success:function (d) {
    //
    //             },
    //             complete:function () {
    //
    //                 $(".tb_button").each(function (i) {
    //                     $(this).removeAttr("disabled");
    //                 });
    //                 $(".page_list_a").each(function () {
    //                     $(this).removeClass("disabled");
    //                 });
    //
    //                 $like.html("Remove");
    //             }
    //         })
    //
    //     }
    //     else if($.trim($like.html())==="Remove"){
    //
    //         $.ajax({
    //             url:"/yyqGS/public/form/dislike.php",
    //             type:"POST",
    //             data:{id:$id,country:$country,tid:$t_id},
    //             success:function (d) {
    //
    //                 alert(d);
    //             },
    //             complete:function () {
    //                 $(".tb_button").each(function (i) {
    //                     $(this).removeAttr("disabled");
    //                 });
    //
    //                 $(".page_list_a").each(function () {
    //                     $(this).removeClass("disabled");
    //                 });
    //
    //                 $like.html("Mark");
    //
    //             }
    //         })
    //
    //     }
    //     else{
    //
    //         $.ajax({
    //             url:"/yyqGS/public/form/like_status.php",
    //             type:"POST",
    //             data:{id:$id,country:$country,tid:$t_id},
    //             success:function (d) {
    //
    //                 d = parseInt(d);
    //
    //                 console.log(typeof d);
    //
    //                 if(d===0){
    //                     $like.html("Mark");
    //                 }
    //                 else if(d===1){
    //                     $like.html("Remove");
    //                 }
    //                 else{
    //                     alert("Please refresh the page!");
    //                 }
    //             },
    //             complete:function () {
    //                 $(".tb_button").each(function (i) {
    //                     $(this).removeAttr("disabled");
    //                 });
    //                 $(".page_list_a").each(function () {
    //                     $(this).removeClass("disabled");
    //                 });
    //
    //                 alert("Please click again!");
    //
    //             }
    //         })
    //
    //
    //     }
    //
    // });

    // $dislike.on("click",function () {
    //     $dislike.css({opacity:0,transition:"opacity .4s linear"});
    //     setTimeout(function () {
    //         $dislike.css("z-index","-1");
    //     },400);
    //     $loading_button.css({"z-index":"1",opacity:"1",transition:"opacity .4s linear"});
    //
    //     $.ajax({
    //         url:"/yyqGS/public/form/get_url.php",
    //         success:function (d) {
    //             var $data = d.split(",");
    //             var $id = $data[0];
    //             var $country = $data[1];
    //             var $tid = $data[2];
    //             $.ajax({
    //                 url:"/yyqGS/public/form/dislike.php",
    //                 type:"POST",
    //                 data:{id:$id,country:$country,tid:$tid},
    //                 success:function (d) {
    //
    //                     alert(d);
    //                 },
    //                 complete:function () {
    //                     $loading_button.css({"z-index":"-1",opacity:"0",transition:"opacity .4s linear"});
    //                     $like.css({"z-index":"1",opacity:"1",transition:"opacity .4s linear"});
    //                 }
    //             })
    //         }
    //     })
    // });






    /*
        Log out functionality.
     */

    $("#lo_button").on("click",function () {
        // alert('1');

        $(".tb_button").each(function (i) {
            $(this).attr("disabled","true");
        });
        $(".page_list_a").each(function () {
            $(this).addClass("disabled");
        });

        $.ajax({
            url:"./form/log_out.php",
            method:"GET",
            success:function () {
                // location.href = "./index.php";
            },
            complete:function () {
                location.href = "./index.php";
            }
        });

    });


    // $("#ob_button").on("click",function () {
    //     // alert('1');
    //
    //     $(".tb_button").each(function (i) {
    //         $(this).attr("disabled","true");
    //     });
    //     $(".page_list_a").each(function () {
    //         $(this).addClass("disabled");
    //     });
    //
    //     $.ajax({
    //         url:"./redirect.php",
    //         method:"POST",
    //         data:{url:$url},
    //         success:function () {
    //             // location.href = "./index.php";
    //         },
    //         complete:function () {
    //             location.href = "./index.php";
    //         }
    //     });
    //
    // });




    $(".cr").each(function () {

        var index_sr = $(this).children(".comment").children(".user").children(".thread_num").text();
        console.log(Math.ceil(index_sr/10));

        var $page=Math.ceil(index_sr/10);

        $(this).children(".reply_container").children(".single_reply").each(function (index6) {


            $(this).children(".single_reply_container").children(".reply_reply_delete").on("click",function () {

                var reply_container = $(this).parent();

                var $r=confirm("Really want to delete the reply?");
                if($r === true)
                {
                    // reply_container.children(".reply_content").html("Delete");
                    // reply_container.children(".reply_user").children(".reply_username").html("-");


                    $.ajax({
                        url:"./form/delete_reply.php",
                        method:"POST",
                        data:{rid:index6,cid:index_sr,page:$page},
                        success:function (d) {

                            // console.log(d);

                            reply_container.children(".reply_content").html("Delete");
                            reply_container.children(".reply_user").children(".reply_username").html("-");
                            reply_container.parent().css({"display":"none"});


                            // console.log(index6+"  "+index_sr+"  "+d);
                        }
                    });

                    // $(this).parent().parent().load("/yyqGS/public/form/delete_reply.php",{index:index6,index_sr:index_sr},function (d) {
                    //
                    //     console.log(d);
                    //     // $(this).remove();
                    //     // location.reload();
                    // });
                }
            });

            // $(this).children(".reply_delete").each(function (index6) {
            //
            // });
        });

        var $f=0;
        var $cid = index_sr;

        var reply1_form = $(this).children(".reply_form");

        var option_bar = $(this).children(".options_bar");


        // var option_bar = $(this).parent();
        // var reply1_form = $(this).parent().parent().children(".reply_form");



        reply1_form.children(".reply_button").on("click",function () {

            var type_area1 = reply1_form.children(".reply_area").val();

            $(".tb_button").each(function (i) {
                $(this).attr("disabled","true");
            });
            $(".page_list_a").each(function () {
                $(this).addClass("disabled");
            });


            // console.log(type_area1);


            if(type_area1==='' || type_area1 === null || type_area1 === undefined){

                // alert("Say something");

                option_bar.addClass("d-flex");
                option_bar.removeClass("d-none");

                reply1_form.addClass("d-none");
                reply1_form.removeClass("d-flex");

                reply1_form.trigger("reset");

                $(".tb_button").each(function (i) {
                    $(this).removeAttr("disabled","true");
                });
                $(".page_list_a").each(function () {
                    $(this).removeClass("disabled");
                });


            }
            else{


                $.ajax({
                    url:"./form/reply.php",
                    method:"POST",
                    data:{cid:$cid,content:type_area1,page:$page},
                    success:function (d) {

                        console.log(d);

                    },
                    complete: function () {

                        option_bar.addClass("d-flex");
                        option_bar.removeClass("d-none");

                        reply1_form.addClass("d-none");
                        reply1_form.removeClass("d-flex");

                        reply1_form.trigger("reset");

                        $(".tb_button").each(function (i) {
                            $(this).removeAttr("disabled","true");
                        });
                        $(".page_list_a").each(function () {
                            $(this).removeClass("disabled");
                        });

                        location.reload();

                    }
                });

            }


        });




        // $(this).children(".options_bar").children(".reply").on("click",function () {
        //     $(this).parent().parent().children(".reply_container").children(".reply_form").children(".reply_button").on("click",function () {
        //
        //
        //         var $this = $(this);
        //         $this.parent().attr("action","/yyqGS/public/form/reply.php?cid=" + $cid);
        //         $this.parent().submit();
        //
        //
        //     });
        // });


//         function callAjax(index_b) {
//
//             return $.ajax({
//
//                         url:"/yyqGS/public/form/reply2.php",
//                         method:"POST",
//                         data:{cid:$cid,rid:index_b,page:$page},
//                         success:function(d){
//
// //                    $(".reply_reply_form").trigger("reset");
//
//                             console.log(d);
//                         },
//                         complete:function(d){
//
//                             $(".reply_reply_form").trigger("reset");
//
//                             console.log(d);
//                         }
//
//
//                     });
//
//         }

        $(this).children(".reply_container").children(".single_reply").each(function (index_b) {


            var reply_form = $(this).children(".reply_reply_form");
            var reply_container = $(this).children(".single_reply_container");


            $(this).children(".reply_reply_form").children(".reply_reply_button").on("click",function () {

                var r_content = ($(this).parent().children(".reply_reply_area")).val();

                $(".tb_button").each(function (i) {
                    $(this).attr("disabled","true");
                });
                $(".page_list_a").each(function () {
                    $(this).addClass("disabled");
                });


                if(r_content===''){

                    // alert("Say something first.");

                    reply_form.removeClass("d-flex");
                    reply_form.addClass("d-none");

                    reply_container.removeClass("d-none");
                    reply_container.addClass("d-flex");


                    $(".tb_button").each(function (i) {
                        $(this).removeAttr("disabled","true");
                    });
                    $(".page_list_a").each(function () {
                        $(this).removeClass("disabled");
                    });


                }
                else{

                    $.ajax({
                        // url:"/yyqGS/public/form/reply2.php",
                        url:"./form/reply2.php",
                        method:"POST",
                        data:{cid:$cid,rid:index_b,page:$page,r_content:r_content},
                        success:function(d){

                            // console.log(d);

                        },
                        complete:function(d){

                            reply_form.trigger("reset");

                            reply_container.removeClass("d-none");
                            reply_container.addClass("d-flex");

                            reply_form.removeClass("d-flex");
                            reply_form.addClass("d-none");

                            $(".tb_button").each(function (i) {
                                $(this).removeAttr("disabled","true");
                            });
                            $(".page_list_a").each(function () {
                                $(this).removeClass("disabled");
                            });

                            location.reload();


                        }
                    });

                }

                // console.log(index_b);

                    // $.ajax({
                    //     url:"/yyqGS/public/form/reply2.php",
                    //     method:"POST",
                    //     data:{cid:$cid,rid:index_b,page:$page},
                    //     success:function(d){
                    //
                    //         console.log(d);
                    //
                    //     },
                    //     complete:function(d){
                    //
                    //         $(".this").parent().trigger("reset");
                    //
                    //         reply_container.removeClass("d-none");
                    //         reply_container.addClass("d-flex");
                    //
                    //         reply_form.removeClass("d-flex");
                    //         reply_form.addClass("d-none");
                    //
                    //
                    //     }
                    // });


            })

//             $(this).children(".reply_reply").on("click",function () {
//                 $(this).parent().parent().children(".reply_reply_form").children(".reply_reply_button").on("click",function (e) {
//                     e.preventDefault();
//
//                     console.log(index_b);
//
// //                     $.ajax({
// //
// //                         url:"/yyqGS/public/form/reply2.php",
// //                         method:"POST",
// //                         data:{cid:$cid,rid:index_b,page:$page},
// //                         success:function(d){
// //
// // //                    $(".reply_reply_form").trigger("reset");
// //
// //                             console.log(d);
// //                         },
// //                         complete:function(d){
// //
// //                             $(".reply_reply_form").trigger("reset");
// //
// //                             console.log(d);
// //                         }
// //
// //
// //                     });
//
// //                    var $this = $(this);
// //                    $this.parent().attr("action","/yyqGS/public/form/reply2.php?cid=" + $cid+"&rid="+index_b+"&page="+$page);
// //                    $this.parent().submit();
//                 })
//             });

        });

    });





    $(".cr").each(function (index4) {
        $(this).children(".options_bar").children(".reply_delete").on("click",function (event) {

            event.preventDefault();

            var $cid = $(this).parent().parent().children(".comment").children(".user").children(".thread_num").text();
            var $page = Math.ceil($cid/10);


//          console.log($index4);

            var $comment = $(this).parent().parent().children(".comment").children(".comment_container").children(".comment_content");
            var $image = $(this).parent().parent().children(".comment").children(".user").children(".profile_image_container").children(".profile_image");
            var $name = $(this).parent().parent().children(".comment").children(".user").children(".user_name");
            var $obar = $(this).parent().parent().children(".options_bar");


//        alert($index4);


            var $r=confirm("Really want to delete the comment?");
            if($r === true)
            {
                $.ajax({
                    url:"./form/delete_comments.php",
                    method:"POST",
                    data:{cid:$cid,page:$page},
                    success:function (d) {
                        // console.log(d);
                        $comment.html("Deleted");
                        $name.html("Global News");
                        $image.attr("src","uploaded_images/icon.png");
                        $obar.remove();

                    }
                });

            }
        })
    });





    $('#upload').change(function() {
        var filename = $('input[type=file]').val().split('\\').pop();
        $("#up_title").html(filename);
    });

    $(document).ajaxStop(function () {
        $("#loading_page").css({"opacity":0,"transition":"opacity .5s ease-out"});
        setTimeout(function () {
            $("#loading_page").css("z-index","-1");
        },1000);
    })

});