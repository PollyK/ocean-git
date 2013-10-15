<?php $this->load->view('admin/header'); ?>

<h2><?php echo get_success_message(); ?> </h2>
    <h2 style="color: red"><?php echo get_error_message(); ?></h2>
<div class="clear"></div>    
        <form class="articles-form" action="<?php echo SITE_URL . 'admin/upload_gallery_image' ?>" method="post" enctype='multipart/form-data'>
            <div class="articles-row">
                <input type="file" placeholder="Файл с фото:" name="image_file" value=""/>  
            </div>
            <div class="articles-row">
                <input placeholder="Описание фото:" type="text" name="title" value=""/> 
            </div>
            <input type="submit" value="Добавить фото"/>
        </form> 

    <div class="clear"></div>    
    <div id="table-faq">
        <table>
            <?php if (isset($photos) && $photos) { ?>
                <?php foreach ($photos as $photo) { ?>

                    <tr>
                        <td>
                            <img src="<?php echo base_url() .$photo->image_th; ?>">
                        </td>
                        <td>
                            <?php echo $photo->name;?>
                        </td>
                        <td>
                            <a href="<?php echo SITE_URL; ?>admin/edit_gallery_photo/<?php echo $photo->id; ?>">редактировать</a> | 
                            <a href="<?php echo SITE_URL; ?>admin/delete_gallery_photo/<?php echo $photo->id; ?>">удалить</a>
                        </td>
                    </tr>



                <?php } ?>
            <?php } ?>
        </table>
    
        

</div>

<?php $this->load->view('admin/footer'); ?>