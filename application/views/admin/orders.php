<?php $this->load->view('admin/header'); ?>
<style type="text/css">
    .closed{
        display: none;
    }
    .open{
        display: block;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.order-list').live('click',function(){
            $(this).parent().parent().find('.open').attr('class','closed');
            $(this).parent().find('.closed').attr('class','open');
        })
    });
</script>               
<?php if ($all_orders) { ?>

    <ul>
        <?php foreach ($all_orders as $one_order) { ?>
            <li>
                <h3 class="order-list"><?php echo '[Заказ' . $one_order['order']->id . '] ' . $one_order['order']->date . ' IP:' . $one_order['order']->ip; ?></h3>
                <div class="closed">
                    <table style="width: 450px;">
                        <?php $sum = 0; ?> 
                        <?php foreach ($one_order['goods_on_order'] as $good_on_order) { ?> 
                            <tr>
                                <td><?php echo $good_on_order->article; ?></td>
                                <td><?php echo $good_on_order->product_name . ' ' . $good_on_order->order_qty . $good_on_order->unit . ' по ' . $good_on_order->price; ?></td>
                                <?php $sum += $good_on_order->order_qty * $good_on_order->price; ?>
                            <tr>
                            <?php } ?>     
                    </table>
                    <p><b class="color-blue">Сумма заказа  </b> <b><?php echo $sum; ?> руб.</b></p>
                    <br><br>
                    <h4>Информация заказчика</h4><br/>
                    <p><b class="color-blue">Контактное лицо(ФИО): </b><?php echo $one_order['order']->contact_name; ?></p><br>
                    <p><b class="color-blue">Телефон для связи</b>: <?php echo $one_order['order']->contact_phone; ?></p><br>
                    <p><b class="color-blue">Дополнительная информация: </b><?php echo $one_order['order']->contact_dopinfo; ?></p><br/>
                    <?php if ($one_order['order']->status == 0) { ?>
                        <a href="<?php SITE_URL; ?>change_order_status/<?php echo $one_order['order']->id; ?>">Изменить статус Заказа</a><br><br>
                        <a href="<?php SITE_URL; ?>delete_order/<?php echo $one_order['order']->id; ?>">Удалить Заказ</a><br><br>
                    <?php } else { ?>
                        Заказ выполнен.
                    <?php } ?>
                </div>


            </li>
        <?php } ?>
    </ul>    
<?php } ?>

<?php $this->load->view('admin/footer'); ?>