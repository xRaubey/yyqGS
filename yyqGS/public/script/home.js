$("#loading_page").css("display","block");
$(window).on("load",function(){

    /*
        Loading page animation.
     */

    var $w1 = $("#welcomings1");
    var $blah = $(".blah");
    var $blah_width = $blah.width();

    $w1.css({left:$blah_width,width:"auto",opacity:"1",transition:"opacity 1s ease-in-out"});

   /*setTimeout(function () {
        $("#loading_page").css("display","none");
    },4000);*/




   /*
        D3.js => Map of earth functionality.
    */

    var height = window.innerHeight;
    var width = window.innerWidth;
    var origin = {
        x: 55,
        y: -40
    };


    $.ajax({
            url:"./form/country_color.php",
            method:"GET",
            success: function (d) {

                var color_data = JSON.parse(d);
                // console.log(JSON.parse(d).length);

                var svg = d3.select("body")
                    .append("svg")
                    .attr("width",width)
                    .attr("height",height);


                var group = svg.append("g").datum({
                    x:0 ,
                    y:0
                });


                svg.datum({
                    x:0,
                    y:0
                });

                var geo = d3.geoOrthographic();
                var projection = geo
                    .translate([width/2,height/2])
                    .scale(300)
                    .rotate([origin.x,origin.y]);

                svg.call(d3.drag().on('drag',dragged));

                var path = d3.geoPath()
                    .projection(projection);

                $(window).on("resize",function () {

                    height = window.innerHeight;
                    width= window.innerWidth;
                    $("svg").css({height:height,width:width});

                    projection = geo
                        .translate([width/2,height/2])
                        .scale(300)
                        .rotate([origin.x,origin.y]);

                    updatePaths(svg, path);
                });


                var mx = d3.scaleLinear()
                    .domain([-width, width])
                    .range([-180, 180]);

                var my = d3.scaleLinear()
                    .domain([-height, height])
                    .range([90, -90]);

                d3.json("world-topo-min.json",function(error, world){

                    var loading = 0;

                    var countries = topojson.feature(world, world.objects.countries).features;

                    function fill (d,callback) {
                        var name= d.properties.name;

                        // var num = -1;

                        var name2 = name;
                        if(name2.indexOf(' ')!==-1){
                            name2 = name2.replace(/\s/g,'_');
                        }
                        if(name2.indexOf('\'')!==-1){
                            name2 = name2.replace('\'','_');
                        }
                        if(name2.indexOf('(')!==-1){
                            name2 = name2.replace('(','_');
                        }
                        if(name2.indexOf(')')!==-1){
                            name2 = name2.replace(')','_');
                        }

                        for(var i=0;i<color_data.length;i++){
                            // console.log(color_data[i].cname);
                            if(name===color_data[i].cname){
                                console.log(name);

                                callback(name2,color_data[i].amount);
                                break;
                            }
                        }


                        // $("#"+name2).css("fill","yellow");


                        // console.log(typeof name);





                        // if(name !== null && typeof name === "string"){
                        //     $.ajax({
                        //         url: "/yyqGS/public/form/country_color.php",
                        //         method: "POST",
                        //         data:{country:name},
                        //         async:true,
                        //         dataType:"text",
                        //         success: function (data) {
                        //             // console.log(data);
                        //
                        //             num = parseInt(data);
                        //
                        //             $("#"+name2).css("fill","yellow");
                        //             // if(typeof num === 'number'){
                        //             //     callback(name2,num);
                        //             // }
                        //         },
                        //         error:function (e) {
                        //             $.ajax(this);
                        //             // console.log(e);
                        //         },
                        //         complete: function () {
                        //             // callback(name,num);
                        //         }
                        //     });
                        // }




                    }

                    function processData(name,num) {

                        if(num < 0){
                            $("#"+name).css("fill","yellow");
                        }
                        else if(num === 0){
                            $("#"+name).css("fill","rgb(207,207,207)");
                        }
                        else if(num>=1 && num<=10){
                            $("#"+name).css("fill","rgb(202,254,255)");

                        }
                        else if(num>10 && num<100){
                            $("#"+name).css("fill","rgb(157,238,216)");

                        }
                        else if(num>=100 && num<500){
                            $("#"+name).css("fill","rgb(222,128,23)");

                        }
                        else{
                            $("#"+name).css("fill","rgb(222,23,23)");
                        }
                    }

                    group.selectAll(".country")
                        .data(countries)
                        .enter()
                        .append("path")
                        .attr("class","country")
                        .attr("d", path)
                        .attr("name",function (d) {
                            return d.properties.name;
                        })
                        .attr("id",function (d) {
                            var name= d.properties.name;
                            if(name.indexOf(' ')!==-1 || name.indexOf('\'')!==-1 || name.indexOf('(')!==-1 || name.indexOf(')')!==-1){
                                name = name.replace(/\s/g,'_');
                                name = name.replace('\'','_');
                                name = name.replace('(','_');
                                name = name.replace(')','_');
                                return name;
                            }
                            else{
                                return name;
                            }
                        })
                        .attr("fill",function (d) {

                            fill(d,processData);


                        })
                        .on("mouseover",function (d) {
                            var name= d.properties.name;
                            d3.select("#tooltip")
                                .html(name);

                        })
                        .on("mouseout",function (d) {
                            var name= d.properties.name;
                            d3.select("#tooltip")
                                .html("");
                        })
                        .on("click",function (d) {
                            var url = window.location.href;
                            var user_id = url.substr(url.lastIndexOf('?')+1);
                            var country_name = d.properties.name;
                            // alert(country_name);
                            $.ajax({
                                url:"./form/selected_country.php",
                                method: "POST",
                                data: {country:country_name},
                                success:function (d) {
                                    window.location = "countries.php?"+ user_id+"&country=" + country_name;
                                }
                            });

                        });



                });

                // $.ajax({
                //     url:"https://saurav.tech/NewsAPI/top-headlines/category/health/in.json",
                //     method: "GET",
                //     success:function (d) {
                //         console.log(d)
                //     }
                // })



                function dragged(d) {
                    var r = {
                        x: mx(d.x = d3.event.x),
                        y: my(d.y = d3.event.y)
                    };
                    projection.rotate([origin.x + r.x, origin.y + r.y]);
                    updatePaths(svg, path);
                }

                function updatePaths(svg, path) {
                    svg.selectAll('.country').attr('d', path);
                }
            }
        });





    var $info = $("#info");
    var $pInfo = $("#person_info");
    var $pInfoHeight = $pInfo.height();
    var $pInfoWidth = $pInfo.width();
    $info.css({top:$pInfoHeight,width:$pInfoWidth});



    /*
        Remove the loading page after all ajax calls are done.
     */

    $(document).ajaxComplete(function(){

        setTimeout(function () {

            TweenLite.fromTo($("#loading_page"),2.3,{right:'0'},{right:'100%',display:"none",ease:Bounce.easeOut});

        },1000);

        // $("#loading_page").css({opacity:0,transition:"opacity 1s linear"});
        // setTimeout(function () {
        //     $("#loading_page").css("z-index","-1");
        // },1000);


    });

});