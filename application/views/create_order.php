<?php $this->load->view('header'); ?>



<section class="all-right-block delivery-block">
    <?php if (isset($cart)) { ?> 
        <h1 style="margin-top: 0;">Заказ:</h1>

        <form action="<?php echo SITE_URL; ?>welcome/confirm_order" method="post">
            <ul>
                <?php $result_price = 0; ?>    
                <?php for ($i = 0; $i < count($cart['id']); $i++) { ?>
                    <?php $result_price += $cart['qty'][$i] * $cart['price'][$i]; ?>
                    <input type="hidden" name="id[]" value="<?php echo $cart['id'][$i]; ?>">
                    <input type="hidden" name="qty[]" value="<?php echo $cart['qty'][$i]; ?>">
                    <li><?php echo $cart['article'][$i] . ' ' . $cart['product_name'][$i] . ' ' . $cart['qty'][$i] . ' ' . $cart['unit'][$i] . ' по ' . $cart['price'][$i] . ' руб.'; ?></li>
                <?php } ?>
            </ul>
            <p>Сумма заказа <b><?php echo $result_price; ?> руб.</b></p> <br><br>

            <p>
                <b>Контактное лицо (ФИО):</b>
                <?php echo $contact['contact_name']; ?><br/> 
            </p>

            <input type="hidden" name="contact_name" value="<?php echo $contact['contact_name']; ?>">
            <p>
                <b>Телефон(email) для связи:</b>
                <?php echo $contact['contact_phone']; ?><br/>
            </p>

            <input type="hidden" name="contact_phone" value="<?php echo $contact['contact_phone']; ?>">

            <p>
                <b>Дополнительная информация:</b> 
                <?php echo $contact['contact_dop']; ?><br/>
            </p>

            <input type="hidden" name="contact_dop" value="<?php echo $contact['contact_dop']; ?>">

            <br>
            <input class="button-order_2" type="submit" value="">
        </form>
    <?php } else { ?>
        В корзине нет товаров.
    <?php } ?> 
</section>



<?php $this->load->view('footer'); ?>
