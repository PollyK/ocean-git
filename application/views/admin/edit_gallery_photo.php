<?php $this->load->view('admin/header'); ?>


<div class="articles-row">       
    <form class="articles-form" action="<?php echo SITE_URL . 'admin/do_update_gallery_photo' ?>" method="post" enctype='multipart/form-data'>
        <input type="hidden" name="id" value="<?php echo $photo->id; ?>">

               <img width="100" src="<?php echo base_url() . $photo->image_th; ?>">
        <br>
        <input type="file" placeholder="Файл с фото:" name="photo_file" value="">  


        <input placeholder="Название:" type="text" name="title" value="<?php echo $photo->name; ?>"/> 

        <br>
        <input type="submit" value="Обновить"> 



    </form> 
</div>
<?php $this->load->view('admin/footer'); ?>
