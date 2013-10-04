<!DOCTYPE html>
<html>

    <!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
        <head>
            <title>Главная страница</title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/start/css/style.css" type="text/css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/start/css/jqClock.css" type="text/css">
            <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <!-- Le fav and touch icons -->
            <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
            <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery-1.7.1.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jqClock.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){


                    // do work
                    $('.background-start').hide();
                    $("#loading-div").show();
                });
        
                $(window).load (function () { 
                    $("#loading-div").hide();
                    $('.background-start').show();

	$('html, body').animate({
        scrollTop: $("#block-logo").offset().top
    }, 200);


                });

                $(function(){
			scrollTo(($(document).width() - $(window).width()) / 2, 0);			

	
                    var obj=document.body;  // obj=element for example body
                    // bind mousewheel event on the mouseWheel function
                    if(obj.addEventListener)
                    {
                        obj.addEventListener('DOMMouseScroll',mouseWheel,false);
                        obj.addEventListener("mousewheel",mouseWheel,false);
                    }
                    else obj.onmousewheel=mouseWheel;

                    function mouseWheel(e)
                    {
                        // disabling
                        e=e?e:window.event;
                        if(e.ctrlKey)
                        {
                            if(e.preventDefault) e.preventDefault();
                            else e.returnValue=false;
                            return false;
                        }
                    }

                    $(".shop").click(function(){
                        location.href="<?php echo SITE_URL; ?>welcome/catalog";
                    });
                    $(".logo-shop").click(function(){
                        location.href="<?php echo SITE_URL; ?>welcome/catalog";
                    });
                    
                    $(".restaurant").click(function(){
                        location.href="http://pelikan1997.ru";
                    });
                    $(".logo-restaurant").click(function(){
                        location.href="http://pelikan1997.ru";
                    });
                    
                    //document.body.style.zoom="300%"
                }); 
               
                
                
            </script>


            <style>
                ul {
                    list-style: none outside none;
                    margin: 0;
                    padding: 0;
                }
                #ny, #kyiv, #local, #london {
                    float: left;
                    height: 125px;
                    margin: 5px;
                    width: 125px;
                }
                #clock .jqc-clock-face {
                    background-color: #66f;
                }
                #local .jqc-clock-face{
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/local.png") no-repeat scroll 0 0 transparent;
                    width: 125px!important;
                    height:125px!important;
                }
                #kyiv .jqc-clock-face{
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/kyiv.png") no-repeat scroll 0 0 transparent;
                    width: 125px!important;
                    height:125px!important;
                }
                #ny .jqc-clock-face{
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/ny.png") no-repeat scroll 0 0 transparent;
                    width: 125px!important;
                    height:125px!important;
                }
                #london .jqc-clock-face{
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/london.png") no-repeat scroll 0 0 transparent;
                    width: 125px!important;
                    height:125px!important;
                }
                #paris .jqc-clock-face{
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/paris.png") no-repeat scroll 0 0 transparent;
                    width: 125px!important;
                    height:125px!important;
                }
                .jqc-clock-sec span {
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/seconds.png") no-repeat scroll 0 0 transparent;
                    box-shadow: 0 0;
                    height: 53px;
                    margin-top: 17px;
                    width: 2px;
                }
                .jqc-clock-min span {
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/minutes.png") no-repeat scroll 0 0 transparent;
                    box-shadow: 0 0;
                    height: 45px;
                    margin-top: 25px;
                    width: 3px;
                }
                .jqc-clock-hour span {
                    background: url("<?php echo base_url(); ?>stuff/start/img/clock/hours.png") no-repeat scroll 0 0 transparent;
                    box-shadow: 0 0;
                    height: 36px;
                    margin-top: 36px;
                    width: 5px;
                }

            </style>


            <script>
<?php
$time_1 = date('m/d/Y H:i:s', time() - 3 * 3600);
$time_2 = date('m/d/Y H:i:s', time());
$time_3 = date('m/d/Y H:i:s', time() + 2 * 3600);
$time_4 = date('m/d/Y H:i:s', time() - 11 * 3600);
?>
    jQuery(function () {
                    
        jQuery('#kyiv').clock({
            graduations: 0,
            size: 250,
            date: new Date('<?php echo $time_1; ?>')
        });
        jQuery('#local').clock({
            graduations: 0,
            size: 250,
            date: new Date('<?php echo $time_2; ?>')
        });
        jQuery('#london').clock({
            graduations: 0,
            size: 250,
            date: new Date('<?php echo $time_3; ?>')
        });
        jQuery('#ny').clock({
            graduations: 0,
            size: 250,
            date: new Date('<?php echo $time_4; ?>')
        });
                    
                    
    });
            </script>
        </head>
        <body class="<?php echo $day_night; ?>">
            <div id="loading-div" style="position:relative; width: 100%; height: 700px;">
                <div id="loading">
                    <div class="logo-1"></div>
                    <div style="color: #fff; text-align: center; margin-top: 30px; font: italic 17px arial;">
                        Загрузка... 
                    </div>
                </div> 
            </div>
            <div class="background-start">
                <div class="img-back" id="img-back">
                    <div class="layer">
                        <div class="block-logo" id="block-logo">
                            <a class="logo-club"></a>
                            <a class="logo-restaurant"></a>
                            <a class="logo-shop"></a>
                        </div>
                        <div class="block-stage">
                            <div class="restaurant"></div>
                            <div class="club"></div>
                            <div class="shop"></div>
                        </div>
                    </div>
                    <div class="time">
                        <div class="float" style="width: 270px;">
                            <div class="float" id="ny"></div>
                            <div class="float" id="kyiv"></div>
                        </div>
                        <div class="float-right" style="width: 270px;">
                            <div class="float" id="local"></div>
                            <div class="float" id="london"></div>
                        </div>
                        <!--     <ul>
                                   <li id="ny"></li>
                                   <li id="kyiv"></li>
                                   <li id="local"></li>
                                   <li id="london"></li>
                               </ul>-->
                    </div> 
                </div>
            </div>
        </body>
    </html>

