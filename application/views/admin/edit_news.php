<?php $this->load->view('admin/header'); ?>

<script>
    $(document).ready(function(){
        $( "#datepicker" ).datepicker();
        $("#datepicker").datepicker( "option", "dateFormat", "yy-mm-dd" );
        $('#datepicker').datepicker().val("<?php echo $article->date; ?>").trigger('change');
    });
</script>

<div class="clear"></div>  

<form action="<?php echo SITE_URL . 'admin/create_news/edit' ?>" method="post" enctype='multipart/form-data'>
    <div class="block-input-admin">
        <input type="hidden" name="news_id" value="<?php echo $article->id; ?>"/>
        <input type="hidden" name="old_image" value="<?php echo $article->image; ?>"/>
        <input id="datepicker" type="text" name="date" value="<?php echo $article->date; ?>" placeholder="Дата:"/><br/>
        Файл с фото:<br><img width="250" src="<?php echo base_url() . 'stuff/news_images/' . $article->image; ?>"><br/>
        <input type="file" name="news_file" value="" placeholder="Загрузить новый файл:"/><br/>   
        <input type="text" name="title" value="<?php echo $article->title; ?>" placeholder="Заголовок:"/><br/>
        <textarea placeholder="Краткое содержание:" name="short_content"><?php echo $article->short_descr; ?></textarea><br/>
        <textarea placeholder="Полный текст:" class="ckeditor" name="content"><?php echo $article->descr; ?></textarea><br/>
        <input type="submit" value="Изменить новость"/>
    </div>
</form> 


<?php $this->load->view('admin/footer'); ?>
