<?php $this->load->view('header'); ?>
<section class="all-right-block faq-news">
    <?php if ($message = $this->session->flashdata('message')) { ?>
        <h1><?php echo $message; ?></h1>
        <?php
    }
    ?>

    <?php if ($faq) {
        foreach ($faq as $item) {
            ?>
            <div class="faq-one">
                <h3>- <?php echo $item->question;?></h3>
                <p>
                    <?php echo $item->answer;?>
                </p>
            </div>
            <?php
        }
    }
    ?>

   
    <form action="<?php echo SITE_URL; ?>welcome/faq" method="POST">
        <input type="hidden" name="action" value="post">
        <h1>Задать вопрос</h1>
        <input class="input" name="faq_email" type="text" placeholder="Ваш e-mail:">
        <textarea class="textarea" name="faq_question" placeholder="Текст вопроса"></textarea>
        <button class="button-faq"></button> 
    </form>
</section>
<?php $this->load->view('footer'); ?>
