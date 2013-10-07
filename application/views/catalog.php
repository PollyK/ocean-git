<?php $this->load->view('header'); ?>
<div class="angle_1"></div>
<div class="angle_2"></div>
<div class="angle_3"></div>
<div class="angle_4"></div>
<table class="table-catalog datatable" id="products">
    <thead>
        <tr>

            <th>Артикул</th>
            <th>
                Наименование <br>
                товара 
            </th>
            <th>Производ.</th>
            <th>Цена<br> руб.</th>
            <th>Наличие</th>
            <th>
                Ед. <br>
                изм. 
            </th>
            <th>
                Кол-во.
            </th>
            <th>
                В заказ
                <!--                                                        <button onClick="add_to_card()" class="basket-table-img"></button>-->
            </th>
        </tr>
    </thead>

</table>

<link rel="stylesheet" href="<?php echo base_url(); ?>stuff/css/colorbox.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>stuff/js/jquery.colorbox.js"></script>

<?php if ($flash_banner) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".inline").colorbox({inline:true, width:"50%"});
            $.colorbox({inline:true, href:"#inline_content", width:"50%"});
            
            $('#cboxClose').click(function(){
                $.post(
                "<?php echo SITE_URL; ?>welcome/disable_flash_banner", 
                {banner_id : <?php echo $flash_banner->id; ?>},
                function(data){
                    
                },"json");
            });
        });
    </script>

    <a class='inline' href="#inline_content"></a>
    <div style='display:none'>
        <div id='inline_content' style='padding:10px; background:#fff;'>
            <a href="<?php echo SITE_URL; ?>welcome/show_news/<?php echo $flash_banner->banner_link_to_article; ?>" title="<?php echo $flash_banner->banner_header; ?>">
                <img src="<?php echo base_url() . "stuff/news_images/" . $flash_banner->banner_photo; ?>">
            </a>
        </div>
    </div>
<?php } ?>


<?php $this->load->view('footer'); ?>

