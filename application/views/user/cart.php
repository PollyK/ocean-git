<?php $this->load->view('header'); ?>

<?php if ($cart) { ?>
    <form action="<?php echo SITE_URL; ?>user/load_order" method="post">
        <table class="table-catalog basket">
            <thead>
                <tr>
                    <th>№</th>
                    <th>
                        Наименование
                        товара 
                    </th>
                    <th>Цена  руб.</th>
                    <th>Кол-во</th>
                    <th>
                        Ед. 
                        изм. 
                    </th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $key => $value) { ?>    
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td>
                            <?php echo $value['product_name']; ?>
                        </td>
                        <td>
                            <?php echo $value['price']; ?>
                        </td>
                        <td>
                            <input name="qty[]" type="text" value="<?php echo $value['qty']; ?>">
                        </td>
                        <td>
                            <?php echo $value['unit']; ?> 
                            <input type="hidden" name="unit[]" value="<?php echo $value['unit']; ?>">
                            <input type="hidden" name="article[]" value="<?php echo $key; ?>">
                            <input type="hidden" name="id[]" value="<?php echo $value['id']; ?>">
                            <input type="hidden" name="price[]" value="<?php echo $value['price']; ?>">
                            <input type="hidden" name="product_name[]" value="<?php echo $value['product_name']; ?>">
                        </td>
                        <td>
                            <a class="delete_cart_item" onclick="delete_cart_item(this)" id="<?php echo $value['id']; ?>"></a>
                        </td>

                    </tr>
                <?php } ?>     
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <b>Итого:</b>  <span id="pre_sum"><?php echo $result_price; ?></span> руб.
                    </td>
                </tr>
            </tfoot>
        </table>    
        <section class="all-right-block delivery-block">
            <a class="float" style="margin-left: 14px; margin-top: 24px;"href="<?php echo SITE_URL; ?>user/load_order">Продолжить оформление заказа</a>
        </section>
    </form>
<?php } else { ?>
    <section class="all-right-block delivery-block">

        В корзине нет товаров.   
    </section>
<?php } ?>    







<?php $this->load->view('footer'); ?>
