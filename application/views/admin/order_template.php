<table>
    <?php $sum = 0; ?> 
    <?php foreach ($goods_on_order as $good_on_order) { ?> 
        <tr>
            <td><b><?php echo $good_on_order->article; ?></b> "<?php echo $good_on_order->product_name . '" ' . $good_on_order->order_qty ."". $good_on_order->unit . ' по ' . number_format($good_on_order->price , 2, ',', '')." руб."; ?></td>
            <?php $sum += $good_on_order->order_qty * $good_on_order->price; ?>
        <tr>
        <?php } ?>     
</table>
<p><b class="color-blue">Сумма заказа  </b> <b><?php echo $sum; ?> руб.</b></p>
<br>
<h4>Информация заказчика</h4>
<p>Контактное лицо(ФИО):<br> <?php echo $orders_data['contact_name']; ?></p><br>
<p>Телефон для связи:<br> <?php echo $orders_data['contact_phone']; ?></p><br>
<p>Дополнительная информация:<br><?php echo $orders_data['contact_dopinfo']; ?></p>
