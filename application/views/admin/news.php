<?php $this->load->view('admin/header'); ?>

<script>
    $(document).ready(function(){
        $( "#datepicker" ).datepicker();
        $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    });
</script>


<?php if ($action != "create") { ?>
    <div class="clear"></div>    
    <div id="table-faq">
        <table>
            <?php if (isset($articles) && $articles) { ?>
                <?php foreach ($articles as $article) { ?>

                    <tr>
                        <td>
                            <?php echo $article->date; ?>
                        </td>
                        <td>
                            <a target="_blank" href="<?php echo SITE_URL; ?>welcome/news/<?php echo $article->id; ?>"><?php echo $article->title; ?></a>
                        </td>
                        <td>
                            <a target="_blank"  href="<?php echo SITE_URL; ?>welcome/news/<?php echo $article->id; ?>">просмотр</a> | 
                            <a href="<?php echo SITE_URL; ?>admin/edit_news/<?php echo $article->id; ?>">редактировать</a> | 
                            <a href="<?php echo SITE_URL; ?>admin/delete_news/<?php echo $article->id; ?>">удалить</a>
                        </td>
                    </tr>



                <?php } ?>
            <?php } ?>
        </table>
    <?php } else { ?>
        <div class="clear"></div>    
        <form class="articles-form" action="<?php echo SITE_URL . 'admin/create_news' ?>" method="post" enctype='multipart/form-data'>
            <div class="articles-row">
                <input placeholder="Дата:" id="datepicker" type="text" name="date" value=""/>
            </div>
            <div class="articles-row">
                <input type="file" placeholder="Файл с фото:" name="news_file" value=""/>  
            </div>
            <div class="articles-row">
                <input placeholder="Заголовок:" type="text" name="title" value=""/> 
            </div>
            <div>
                <textarea placeholder="Краткое содержание:" name="short_content"></textarea>
            </div>
            Полный текст: <br><br><textarea class="ckeditor" name="content"></textarea><br/>
            <input type="submit" value="Создать новость"/>


        </form> 
    <?php } ?>  

</div>

<?php $this->load->view('admin/footer'); ?>