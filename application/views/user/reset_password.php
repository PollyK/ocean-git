<?php $this->load->view('header'); ?>
<section class="all-right-block faq-news">
    <?php if ($message = $this->session->flashdata('message')) { ?>
        <h1><?php echo $message; ?></h1>
        <?php
    }
    ?>
    <form action="<?php echo SITE_URL; ?>user/do_reset" method="POST">
        <input type="hidden" name="action" value="post">
        <h1>Новый пароль</h1>
        <input class="input" name="new_password" type="text" placeholder="">
        <input type="hidden" name="code" value="<?php echo $user->secret_key;?>">
        <br>
        <button class="submit">Сохранить</button> 
    </form>
</section>
<?php $this->load->view('footer'); ?>
