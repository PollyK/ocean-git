<!DOCTYPE html>
<html>

    <!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]> <html class="no-js"> <!--<![endif]-->
    <head>
        <title>Раздел каталога</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/css/style.css" type="text/css">
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

            <!--[if IE 8]> <link href="<?php echo base_url(); ?>stuff/css/ie8.css" rel= "stylesheet" media= "all" /> <![endif]-->
             <!--[if IE 7]> <link href="<?php echo base_url(); ?>stuff/css/ie7.css" rel= "stylesheet" media= "all" /> <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>stuff/img/favicon.ico" type="image/x-icon">
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jNice.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/css/tree.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/css/galleriffic-2.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/css/basic.css" type="text/css">
<!--            <style type="text/css">
            @import "<?php //echo base_url();                          ?>stuff/css/tree.css";
        </style>-->
        <style type="text/css">
            .dataTables_filter, .dataTables_info{
                display: none;
            }
        </style>

        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery.placeholder.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery.galleriffic.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery.opacityrollover.js"></script>

        <!-- Optionally add helpers - button, thumbnail and/or media -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>stuff/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

        <style>
            #nav ul{
                list-style:none;
                position:absolute;
                left:-9999px; 
                opacity:0; 
                -webkit-transition:0.25s linear opacity; 
            }
            #nav ul li{
                padding-top:1px;
                float:none;

            }
            #nav ul a{
                white-space:nowrap; 
                display:block;
            }
            #nav li:hover ul{ 
                left:0; 
                opacity:1;
            }
            #nav li:hover a{ 
                background:#6b0c36;
                background:rgba(107,12,54,0.75); 
                text-decoration:underline;
            }
            #nav li:hover ul a{ 
                text-decoration:none;
                -webkit-transition:-webkit-transform 0.075s linear;
            }
            #nav li:hover ul li a:hover{ 
                background:#333;
                background:rgba(51,51,51,0.75); 
                text-decoration:underline;
                -moz-transform:scale(1.05);
                -webkit-transform:scale(1.05);
            }
        </style>

    </head>
    <body>
        <script type="text/javascript">
            $(document).ready(function() {
                jQuery('input[placeholder], textarea[placeholder]').placeholder();
                $(".fancybox").fancybox();
            });
        
            function tree_toggle(event) {
                event = event || window.event
                var clickedElem = event.target || event.srcElement

                if (!hasClass(clickedElem, 'Expand') && !hasClass(clickedElem, 'Content') ) {
                    return 
                }

                var node = clickedElem.parentNode
                if (hasClass(node, 'ExpandLeaf')) {
                    return // клик на листе
                }

                // определить новый класс для узла
                var newClass = hasClass(node, 'ExpandOpen') ? 'ExpandClosed' : 'ExpandOpen'
                // заменить текущий класс на newClass
                // регексп находит отдельно стоящий open|close и меняет на newClass
                var re =  /(^|\s)(ExpandOpen|ExpandClosed)(\s|$)/
                node.className = node.className.replace(re, '$1'+newClass+'$3')
            }


            function hasClass(elem, className) {
                return new RegExp("(^|\\s)"+className+"(\\s|$)").test(elem.className)
            }
                
                
                
        </script>
        <script src="<?php echo base_url(); ?>stuff/js/jquery.dataTables.js"></script>

        <script type="text/javascript">
            var ajaxSource = '<?php echo SITE_URL; ?>welcome/load_catalog_products/';
            var group_id = "2";
    
            $(function(){
                    
                oTable = $('#products').dataTable();
                $('#search').keypress(function(e){
                    if(e.which == 13) {
                        global_search();
                    }else{
                        //oTable.fnFilter( $(this).val() );
                    }
                });
                  
                load_table();
                    
                    
            });
    
            function load_table(){
                $('#products').dataTable( {
                    "sAjaxSource": ajaxSource,
                    "sServerMethod": "POST",
                    "iDisplayLength": 300,
                    "bProcessing": true,
                    "bDestroy": true,
                    "bInfo":false,
                    "bPaginate":false,
                    "fnServerParams": function (aoData) {
                        aoData.push({
                            "name": "group_id",
                            "value": group_id
                        })
                    },
                    "oLanguage": {
                        "sZeroRecords": "Товары не найдены. Уточните запрос...",
                        "sProcessing": "Обработка запроса..."
                    }
                });
            }
    
            function load_products(id){
                group_id = id;
                if ($("#products").length > 0){
                    load_table();
                }else{
                        
                    $.post(
                    "<?php echo SITE_URL; ?>welcome/init_product_table", 
                    { },
                    function(data){
                        $('#right-block').html(data[0]);
                        load_table();
                    },"json"
                );
                }
            }
                                                
            function global_search(){
                var text = $("#search").val();
                if(text==""){
                    return false;
                }
                    
                var search_url = "<?php echo SITE_URL; ?>welcome/search";
                    
                if ($("#products").length > 0){
                    $('#products').dataTable( {
                        "sAjaxSource": search_url,
                        "sServerMethod": "POST",
                        "iDisplayLength": 300,
                        "bProcessing": true,
                        "bDestroy": true,
                        "bInfo":false,
                        "bPaginate":false,
                        "fnServerParams": function (aoData) {
                            aoData.push({
                                "name": "keyword",
                                "value": text
                            })
                        },
                        "oLanguage": {
                            "sZeroRecords": "Товары не найдены. Уточните запрос...",
                            "sProcessing": "Обработка запроса..."
                        }
                    });
                }else{
                        
                    $.post(
                    "<?php echo SITE_URL; ?>welcome/init_product_table", 
                    { },
                    function(data){
                        $('#right-block').html(data[0]);
                        $('#products').dataTable( {
                            "sAjaxSource": search_url,
                            "sServerMethod": "POST",
                            "iDisplayLength": 300,
                            "bProcessing": true,
                            "bDestroy": true,
                            "bInfo":false,
                            "bPaginate":false,
                            "fnServerParams": function (aoData) {
                                aoData.push({
                                    "name": "keyword",
                                    "value": text
                                })
                            },
                            "oLanguage": {
                                "sZeroRecords": "Товары не найдены. Уточните запрос...",
                                "sProcessing": "Обработка запроса..."
                            }
                        });
                    },"json"
                );
                }
                    
                    
                    
            }
    
            $(document).ready(function(){
                $('.basket-table-img').live('click',function(){
                    var record = $(this).parent().parent();
                    var art = record.find('td:first').find('div.article').html();
                    var count =   record.find('input').attr('value');
                    var count_all = record.find(':nth-child(5)').html();
                    var price = record.find(':nth-child(4)').html();
                        
                    count = parseFloat(count.replace(",", "."));
                    
                    //if(parseInt(count_all) < parseInt(count)){
                    //    alert('Выбранного количества нет в наличии');
                    //} else {
                    record.find(':nth-child(5)').html(Math.round((count_all - count)*1000)/1000);
                            
                    $.post(
                    "<?php echo SITE_URL; ?>welcome/add_to_cart", 
                    { art: art, count: count, price: price },
                    function(data){
                        $('#cart_count').html(data[0] + ' товаров/');
                        $('#cart_price').html(data[1] + ' руб.');
                    },"json"
                );
                });
                    
                    
            });
    
        </script>

        <section id="all-content">
            <div class="registr-block">
                <a class="float-right" href="#" style="margin-left:2px;"> Регистрация</a> <a class="float-right" href="#">Вход / </a>
            </div>
            <ul id="nav">
                <li <?php if (!isset($alias)) { ?> class="active" <?php } ?>>
                    <a href="<?php echo SITE_URL; ?>welcome/news">
                        Новости
                        <span <?php if($this->session->userdata('news_unread')){ ?>  class="message-news" ><?php echo $this->session->userdata('news_unread');?></span> <?php } ?>
                    </a>
                </li>

                <li <?php if (isset($alias) && in_array($alias, array('about', 'discount', 'gallery', 'faq'))) { ?> class="active" <?php } ?>>
                    <a href="<?php echo SITE_URL; ?>welcome/page/about">Для покупателя</a>
                    <ul>
                        <li><a href="<?php echo SITE_URL; ?>welcome/page/about">О нас</a></li>
                        <li><a href="<?php echo SITE_URL; ?>welcome/page/discount">Дисконтная программа</a></li>
                        <li><a href="<?php echo SITE_URL; ?>welcome/gallery">Галерея</a></li>
                        <li><a href="<?php echo SITE_URL; ?>welcome/faq">Обратная связь</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo SITE_URL; ?>welcome/page/production">Собственное производство</a></li>

                <li><a href="<?php echo SITE_URL; ?>welcome/page/delivery">Доставка</a></li>
                <li><a href="<?php echo SITE_URL; ?>"><div class="icon-home"></div></a></li>
            </ul>
            <header>

                <?php if (isset($no_catalog) && $no_catalog) { ?>
                    <a href="<?php echo SITE_URL; ?>welcome/catalog"><div class="logo"></div></a>
                <?php } else { ?>
                    <a href="<?php echo SITE_URL; ?>"><div class="logo"></div></a>
                <?php } ?>
                <div>
                    <a href="<?php echo SITE_URL; ?>welcome/cart">
                        <div id="basket">
                            <div class="basket-img"></div>
                            <div class="text-basket">
                                <h3>Ваша корзина:<br></h3>
                                <span id="cart_count">
                                    <?php
                                    if ($this->session->userdata('cart_count')) {
                                        echo $this->session->userdata('cart_count') . ' товаров/';
                                    }
                                    ?>
                                </span> 
                                <span id="cart_price">
                                    <?php
                                    if ($this->session->userdata('cart_price')) {
                                        echo $this->session->userdata('cart_price') . ' руб.';
                                    }
                                    ?>
                                </span> 
                            </div>
                        </div>
                    </a>    
                    <div class="search-faq">
                        <?php
                        if (isset($no_catalog) && $no_catalog) {
                            
                        } else {
                            ?>
                            <input id="search" type="text" name="search">
                            <div class="search-button" onclick="global_search()">
                                <div class="fish-search"></div>
                            </div>
                            <a class="faq" href="<?php echo SITE_URL; ?>welcome/faq">
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </header>

            <?php
            if (isset($no_catalog) && $no_catalog) {
                
            } else {
                ?>
                <section class="content">
                    <aside class="float">
                        <div class="lathing"></div>
                        <a href="<?php echo SITE_URL; ?>welcome/catalog">
                            <div class="header-catalog"></div>
                        </a>


                        <div onclick="tree_toggle(arguments[0])" style="width: 270px; margin-left: 20px; position: relative; z-index: 100;">

                            <ul class="Container level_1">
                                <?php if ($catalog) { ?>
                                    <?php foreach ($catalog as $item_0) { ?>
                                        <li class="Node ExpandClosed ">
                                            <div class="<?php echo!($item_0['content']) ? "IsLastmy" : "Expand"; ?>"></div>
                                            <div class="Content"><?php echo $item_0['name']; ?></div>

                                            <?php if ($item_0['content']) { ?>
                                                <ul class="Container level_2">
                                                    <?php foreach ($item_0['content'] as $item_1) { ?>

                                                        <?php if (!($item_1['content'])) { ?>    
                                                            <li class="Node IsLast">
                                                            <?php } else { ?>
                                                            <li class="Node ExpandClosed">    
                                                            <? } ?>        
                                                            <div class="<?php echo!($item_1['content']) ? "IsLastmy" : "Expand"; ?>"></div>
                                                            <div class="Content" >
                                                                <?php if ($item_1['content']) { ?>
                                                                    <?php echo $item_1['name']; ?>
                                                                <?php } else { ?>
                                                                    <a onclick="load_products('<?php echo $item_1['group_id']; ?>')">
                                                                        <?php echo $item_1['name']; ?>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                            <?php if ($item_1['content']) { ?>
                                                                <ul class="Container level_3">
                                                                    <?php foreach ($item_1['content'] as $item_2) { ?>
                                                                        <li class="Node ExpandLeaf IsLast">
                                                                            <div class="<?php echo!($item_2['content']) ? "IsLastmy" : "Expand"; ?>"></div>
                                                                            <div class="Content">
                                                                                <a onclick="load_products('<?php echo $item_2['group_id']; ?>')">
                                                                                    <?php echo $item_2['name']; ?>
                                                                                </a>
                                                                            </div>
                                                                            <?php if ($item_2['content']) { ?>
                                                                                <ul class="Container level_4">
                                                                                    <?php foreach ($item_2['content'] as $item_3) { ?>
                                                                                        <li class="Node ExpandLeaf IsLast">
                                                                                            <div class="<?php echo!($item_3['content']) ? "IsLastmy" : "Expand"; ?>"></div>
                                                                                            <div class="Content">
                                                                                                <a onclick="load_products('<?php echo $item_3['group_id']; ?>')">
                                                                                                    <?php echo $item_3['name']; ?>
                                                                                                </a>
                                                                                            </div>
                                                                                        </li>
                                                                                    <?php } ?>
                                                                                </ul>
                                                                            <?php } ?>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        Подождите...идет обновление базы.
                                        <?php
                                    }
                                    ?>
                            </ul>
                            <div class="banner">
                                <?php
                                if ($banners) {
                                    foreach ($banners as $banner) {
                                        ?>
                                        <a href="<?php echo SITE_URL; ?>welcome/show_news/<?php echo $banner->banner_link_to_article; ?>" title="<?php echo $banner->banner_header; ?>">
                                            <img src="<?php echo base_url() . "stuff/news_images/" . $banner->banner_photo; ?>">
                                        </a>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>

                    </aside>
                    <div id="right-block" >
                        <div class="angle_1"></div>
                        <div class="angle_2"></div>
                        <div class="angle_3"></div>
                        <div class="angle_4"></div>


                    <?php }
                    ?>

