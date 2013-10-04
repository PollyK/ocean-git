<?php $this->load->view('admin/header'); ?>


<div class="clear"></div>    
<h2 style="color: red"><?php echo get_error_message();?></h2>
<form class="articles-form" action="<?php echo SITE_URL . 'admin/do_update_banner' ?>" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="banner_id" value="<?php echo $banner->id; ?>"
    <div class="articles-row2">
        <img width="100" src="<?php echo base_url() . "stuff/news_images/" . $banner->banner_photo; ?>">
        <br>
        <input type="file" placeholder="Файл с фото:" name="banner_file" value=""/>  
    </div>
    <div class="articles-row">
        <input placeholder="Заголовок:" type="text" name="title" value="<?php echo $banner->banner_header; ?>"/> 
    </div>
    
    <div class="articles-row">
        Видимый?<br>
        <input type="checkbox" <?php echo ($banner->visible)?'checked="checked"':"";?> name="is_published" value="1"/> 
    </div>
    
    <div class="articles-row">
        Ссылка на новость<br>
        <?php if ($available_articles) { ?>
            <select name="article_id">
                <?php
                foreach ($available_articles as $item) {
                    if($banner->banner_link_to_article == $item->id){
                        $selected = ' selected="selected" ';
                    }  else {
                        $selected = "";
                    }
                    ?>
                <option <?php echo $selected;?> value="<?php echo $item->id; ?>"><?php echo $item->title; ?> (<?php echo $item->date; ?>)</option>
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
        <input type="submit" value="Обновить"> 
    </div>


</form> 

<?php $this->load->view('admin/footer'); ?>
