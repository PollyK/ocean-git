<?php $this->load->view('admin/header'); ?>
<div id="table-faq">
    <table>
        <tr>
            <td colspan="3" style="background: none repeat scroll 0 0 #F6F6F6; text-align: left;">
                Новые вопросы
            </td>
        </tr>    
        <?php
        if ($new_questions) {
            foreach ($new_questions as $new_item) {
                ?>
                <tr>
                    <td>
                        <?php echo $new_item->date; ?>
                    </td>
                    <td>
                        <?php echo $new_item->question; ?>
                    </td>
                    <td>
                        <a href="<?php echo SITE_URL; ?>admin/faq/view/<?php echo $new_item->id; ?>">просмотр</a> | <a href="<?php echo SITE_URL; ?>admin/faq/delete/<?php echo $new_item->id; ?>">удалить</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td colspan="3" style="background: none repeat scroll 0 0 #F6F6F6; text-align: left;">
                Все вопросы
            </td>
            <?php
            if ($old_questions) {
                foreach ($old_questions as $new_item) {
                    ?>
                <tr>
                    <td>
                        <?php echo $new_item->date; ?>
                    </td>
                    <td>
                        <?php echo $new_item->question; ?>
                    </td>
                    <td>
                        <a href="<?php echo SITE_URL; ?>admin/faq/view/<?php echo $new_item->id; ?>">просмотр</a> | <a href="<?php echo SITE_URL; ?>admin/faq/delete/<?php echo $new_item->id; ?>">удалить</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tr>    

        <table>
            </div>


            <?php $this->load->view('admin/footer'); ?>