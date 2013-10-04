<?php $this->load->view('header'); ?>

                                       <h1>Заказ</h1> 
                                       <?php if(isset($cart)){?>
                                       <form action="<?php echo SITE_URL;?>welcome/confirm_order" method="post">
                                            <table>
                                            <?php $result_price = 0;?>    
                                            <?php for($i=0;$i<count($cart['id']);$i++){?>
                                                
                                                <?php $result_price += $cart['qty'][$i] * $cart['price'][$i];?>
                                                <input type="hidden" name="id[]" value="<?php echo $cart['id'][$i];?>">
                                                <input type="hidden" name="qty[]" value="<?php echo $cart['qty'][$i];?>">
                                                <tr>
                                                    <td>
                                                        <b><?php echo $cart['article'][$i];?></b>
                                                    </td>
                                                    <td>
                                                        <?php echo $cart['product_name'][$i].' '.$cart['qty'][$i].' '.$cart['unit'][$i].' по '.$cart['price'][$i].' руб.';?>
                                                    </td>    
                                                </tr>    
                                            <?php }?>
                                            </table>
                                            
                                            <br/>
                                                <b>Сумма заказа:</b><?php echo $result_price;?>
                                            <br/>
                                           
                                            
                                            <b>Контактное лицо (ФИО):</b><br/>
                                            <?php echo $contact['contact_name'];?><br/>
                                            <input type="hidden" name="contact_name" value="<?php echo $contact['contact_name'];?>">
                                            <b>Телефон(email) для связи:</b><br/>
                                            <?php echo $contact['contact_phone'];?><br/>
                                            <input type="hidden" name="contact_phone" value="<?php echo $contact['contact_phone'];?>">
                                            <b>Дополнительная информация:</b> <br/>
                                            <?php echo $contact['contact_dop'];?><br/>
                                            <input type="hidden" name="contact_dop" value="<?php echo $contact['contact_dop'];?>">
                                       
                                            
                                            <input type="submit" value="Подтвердить заказ">
                                       </form>     
                                       <?php } else {?>
                                        В корзине нет товаров.
                                       <?php }?> 
                                    <?php $this->load->view('footer'); ?>
