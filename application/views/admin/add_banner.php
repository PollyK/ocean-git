<?php $this->load->view('admin/header'); ?>


<div class="clear"></div>    
<h2 style="color: red"><?php echo get_error_message();?></h2>
<form class="articles-form" action="<?php echo SITE_URL . 'admin/do_create_banner' ?>" method="post" enctype='multipart/form-data'>
    <div class="articles-row">
        <input type="file" placeholder="Файл с фото:" name="banner_file" value=""/>  
    </div>
    <div class="articles-row">
        <input placeholder="Заголовок:" type="text" name="title" value=""/> 
    </div>
    
    <div class="articles-row">
        Видимый?<br>
        <input type="checkbox" checked="checked" name="is_published" value="1"/> 
    </div>
    
    <div class="articles-row">
        Ссылка на новость<br>
        <?php if ($available_articles) { ?>
            <select name="article_id">
                <?php
                foreach ($available_articles as $item) {
                    ?>
                    <option value="<?php echo $item->id; ?>"><?php echo $item->title; ?> (<?php echo $item->date; ?>)</option>
                    <?php
                }
                ?>
            </select>
            <?php } else { ?>
                    Нет новостей для привязки к баннеру. <a href="<?php echo SITE_URL;?>admin/news/create_news">Создайте</a> новость. 
            <?php } ?>
    </div>
    <div class="articles-row">
        <br>
        <input type="submit" value="Добавить"> 
    </div>


</form> 

<?php $this->load->view('admin/footer'); ?>