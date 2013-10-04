<?php $this->load->view('admin/header'); ?>

<div id="table-faq">
    <table>
        <?php if ($action != "create") { ?>
            <?php if (isset($pages) && $pages) { ?>
                <?php foreach ($pages as $page) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo SITE_URL; ?>welcome/page/<?php echo $page->url; ?>"><?php echo $page->title; ?></a> 
                        </td>
                        <td>
                            <a href="<?php echo SITE_URL; ?>welcome/page/<?php echo $page->alias; ?>">просмотр</a> | 
                            <a href="<?php echo SITE_URL; ?>admin/edit_page/<?php echo $page->id; ?>">редактировать</a> | 
                            <a href="<?php echo SITE_URL; ?>admin/delete_page/<?php echo $page->id; ?>">удалить</a>
                        </td>
                    </tr>

                <?php } ?>
            <?php } ?>
        <?php } else { ?>   
        </table>    
    </div>

    <div class="clear"></div>    
    <div class="block-input-admin">
        <form action="<?php echo SITE_URL . '/admin/create_page' ?>" method="post">
           <input placeholder="Алиас" type="text" name="alias" value=""/><br/>
            <input placeholder="Заголовок" type="text" name="title" value=""/><br/>
            <textarea placeholder="Текст" class="ckeditor" name="content"></textarea><br/>
            <input type="submit" placeholder="Создать раздел"/>
        </form> 
    </div>

<?php } ?>        

<?php $this->load->view('admin/footer'); ?>