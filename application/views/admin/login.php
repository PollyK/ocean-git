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
            <a href="<?php echo SITE_URL; ?>"><h1><span>Ocean Omsk Admin Panel</span></h1></a>

            <form action="<?php echo SITE_URL; ?>admin/login_action" method="post">
               <table>
                <tr>   
                    <td>Имя или Email:</td><td><input type="text" value="" name="name"></td>
                </tr>
                <tr>   
                <td>Пароль:</td><td><input type="password" value="" name="password"></td>
                </tr>
                <tr>   
                <td></td><td><input type="submit" value="Вход"></td>
                </tr>    
               </table>     
            </form>    


            <div id="containerHolder">
                <div id="container">
                    

                        
                    
                
                
                </div>
            </div>	

            <p id="footer">Разработка <a href="http://headway-studio.ru">Headway Studio</a></p>
        </div>

    </body>
</html>





