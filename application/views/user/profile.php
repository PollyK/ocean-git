<?php $this->load->view('header'); ?>
<section class="all-right-block faq-news">
    <?php if ($message = $this->session->flashdata('message')) { ?>
        <h1><?php echo $message; ?></h1>
        <?php
    }
    ?>
    <form action="<?php echo SITE_URL; ?>user/update_profile" method="POST">
        <input type="hidden" name="action" value="post">
        <h1>Мой профиль</h1>
        Пароль
        <input class="input" name="new_password" type="text" placeholder="Введите новый пароль или оставьте поле пустым">
        <br>
        ФИО
        <input class="input" name="fio" type="text" placeholder="ФИО" value="<?php echo $user->fio;?>">
        <br>
        Телефон
        <input class="input" name="phone" type="text" placeholder="Телефон" value="<?php echo $user->phone;?>">
        
        <input type="hidden" name="code" value="<?php echo $user->secret_key;?>">
        <br>
        <button class="submit">Сохранить</button> 
    </form>
</section>
<?php $this->load->view('footer'); ?>
