<?php $this->load->view('header'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.button-order').live('click',function(){
            var name = $('input[name="contact_name"]').val();
            var phone = $('input[name="contact_phone"]').val();
            var dop = $('textarea[name="contact_dop"]').text();
            if(!name){
                alert("Введите ФИО");
                return false;
            }
            if(!phone){
                alert("Введите телефон или email");
                return false;
            }
            //        if(!dop){
            //            alert("Введите дополнительные данные");
            //            return false;
            //        }
        
            return true;
        });
    
    });
    
    
    function delete_cart_item(el){
        if(confirm('Удалить товар?')){
            var cart_element_id = $(el).attr('id');
            $.post(
            "<?php echo SITE_URL; ?>welcome/delete_cart_item", 
            {cart_element_id:cart_element_id},
            function(data){
                $('#'+data.delete_id).parent().parent().hide();
                $('#pre_sum').html(data.total);
            },"json"
        );
        }
    }
    
    
</script>
<?php if ($cart) { ?>
    <form action="<?php echo SITE_URL; ?>welcome/create_order" method="post">
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
            <input name="contact_name" class="input" type="text" placeholder="Контактное лицо (ФИО):" value="<?php echo $order_name;?>">
            <input  name="contact_phone" class="input" type="text" placeholder="Телефон(email) для связи:" value="<?php echo $order_phone;?>">
            <textarea name="contact_dop" class="textarea" placeholder="Дополнительная информация: "><?php echo $order_creds;?></textarea>    

            <input class="button-order float" type="submit" value="">


            <a class="float" style="margin-left: 14px; margin-top: 24px;"href="<?php echo SITE_URL; ?>welcome/cleare_cart">Очистить корзину</a>
        </section>
    </form>
<?php } else { ?>
    <section class="all-right-block delivery-block">

        В корзине нет товаров.   
    </section>
<?php } ?>    







<?php $this->load->view('footer'); ?>
