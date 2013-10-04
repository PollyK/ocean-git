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
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jNice.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery-ui-1.9.2.custom.js"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/css/ui-lightness/jquery-ui-1.9.2.custom.css" />
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
                    <li><a href="<?php echo SITE_URL;?>admin/<?php echo $menu['url']; ?>" <?php echo $is_active; ?>><?php echo $menu['title']; ?></a></li>
                <?php } ?>


                <li class="logout"><a href="<?php echo SITE_URL ?>admin/logout">Выход</a></li>
            </ul>


            <div id="containerHolder">
                <div id="container">
                    <div id="sidebar" style="width: 235px; margin-right: 20px;">
                        <ul class="sideNav">
                            <li><a href="#"></a></li>
                            <?php
                            foreach ($nav_menu[$active_page]['subpages'] as $key => $sub_items) {
                                if ($key == $active_subpage) {
                                    $is_active = " class=\"active\" ";
                                }
                                ?>
                                <li><a href="<?php echo SITE_URL . 'admin/' . $sub_items['url']; ?>" <?php echo $is_active; ?> ><?php echo $sub_items['title']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <div style="margin-left: 10px; margin-top:10px; padding-right: 10px;">
                            <?php
                            if ($active_subpage == "catalog") {
                                $this->load->view("admin/pages/catalog_tree");
                            }
                            ?>    
                        </div>

                    </div>    
                    

                    <div style="float:left; ">
                        <h2 style="float: none;"><a href="#"><?php echo $nav_menu[$active_page]['title']; ?></a> &raquo; 
                        <a href="#" class="active"><?php echo $nav_menu[$active_page]['subpages'][$active_subpage]['title']; ?></a></h2>








