<?php $this->load->view('admin/header'); ?>
<div id="table-faq">
    <h3><?php echo $this->session->flashdata('message'); ?></h3>
    <br>
    <form action="<?php echo SITE_URL; ?>admin/faq/answer" method="POST">
        <input type="hidden" name="record_id" value="<?php echo $record->id; ?>">
        <input type="hidden" name="user_email" value="<?php echo $record->user_email; ?>">

        <b class="color-blue">Вопрос:</b>    <?php echo $record->question; ?>
        <br><br>
        <b class="color-blue">Отправитель:</b>  <?php echo $record->user_email; ?>
        <br>
        <br>
        <input type="checkbox" name="is_publish" value="1" <?php echo ($record->is_published) ? " checked=\"cheched\"" : "" ?>>Публиковать вопрос? 
        <br>
        <br>
        <b class="color-blue">Ответ:</b><br>
        <textarea name="answer"><?php echo $record->answer; ?></textarea>
        <br><br>
        <input type="submit" value="Сохранить">
    </form>
</div>


<?php $this->load->view('admin/footer'); ?>