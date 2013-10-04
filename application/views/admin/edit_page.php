 <?php $this->load->view('admin/header'); ?>

                          
                        <div class="clear"></div>  
                        
                        <form action="<?php echo SITE_URL.'/admin/create_page/edit'?>" method="post">
                            <input type="hidden" name="page_id" value="<?php echo $page->id;?>"/>
                            Алиас<input type="text" name="alias" value="<?php echo $page->alias;?>"/><br/>
                            Заголовок<input type="text" name="title" value="<?php echo $page->title;?>"/><br/>
                            Текст<textarea class="ckeditor" name="content"><?php echo $page->content;?></textarea><br/>
                            <input type="submit" value="Изменить раздел"/>
                        </form> 
                        
                        
<?php $this->load->view('admin/footer'); ?>