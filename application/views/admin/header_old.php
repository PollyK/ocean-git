<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Панель Администратора</title>

        <!-- CSS -->
        <link href="<?php echo base_url(); ?>stuff/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
        <!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>stuff/css/ie6.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>stuff/css/ie7.css" /><![endif]-->

        <!-- JavaScripts-->
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jNice.js"></script>
    </head>

    <body>
        <div id="wrapper">
            <h1><a href="#"><span>Ocean Omsk Admin Panel</span></a></h1>

            <ul id="mainNav">
                <?php
                foreach ($nav_menu as $key => $menu) {
                    $is_active = "";
                    if ($key == $active_page) {
                        $is_active = " class=\"active\" ";
                    }
                    ?>
                    <li><a href="/admin/<?php echo $menu['url']; ?>" <?php echo $is_active; ?>><?php echo $menu['title']; ?></a></li>
                <?php } ?>


                <li class="logout"><a href="#">Выход</a></li>
            </ul>


            <div id="containerHolder">
                <div id="container">
                    <div id="sidebar">
                        <ul class="sideNav">
                            <li><a href="#"></a></li>
                            <?php
                            foreach ($nav_menu[$active_page]['subpages'] as $key => $sub_items) {
                                if ($key == $active_subpage) {
                                    $is_active = " class=\"active\" ";
                                }
                                ?>
                                <li><a href="<?php echo SITE_URL.'/admin/'.$sub_items['url']; ?>" <?php echo $is_active; ?> ><?php echo $sub_items['title']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                        
                    </div>    
                    <h2><a href="#"><?php echo $nav_menu[$active_page]['title']; ?></a> &raquo; 
                        <a href="#" class="active"><?php echo $nav_menu[$active_page]['subpages'][$active_subpage]['title']; ?></a></h2>

                        
                    


