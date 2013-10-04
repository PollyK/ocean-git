<?php $this->load->view('header'); ?>
                                        
                                        <?php if($cart){?>
                                        <form action="<?php echo SITE_URL;?>welcome/create_order" method="post">
                                        <table class="table-catalog basket">
                                        <thead>
                                            <tr>
                                                <td>№</td>
                                                <td>
                                                    Наименование 
                                                    товара 
                                                </td>
                                                <td>Цена руб.</td>
                                                <td>Кол-во</td>
                                                <td>
                                                    Ед. 
                                                    изм. 
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($cart as $key=>$value){?>    
                                            <tr>
                                                <td><?php echo $key;?></td>
                                                    <input type="hidden" name="article[]" value="<?php echo $key;?>">
                                                    <input type="hidden" name="id[]" value="<?php echo $value['id'];?>">
                                                <td>
                                                    <?php echo $value['product_name'];?>
                                                </td>
                                                    <input type="hidden" name="product_name[]" value="<?php echo $value['product_name'];?>">
                                                <td><?php echo $value['price'];?></td>
                                                <input type="hidden" name="price[]" value="<?php echo $value['price'];?>">
                                                <td><input name="qty[]" type="text" value="<?php echo $value['qty'];?>"></td>
                                                <td>
                                                    <?php echo $value['unit'];?> 
                                                </td>
                                                <input type="hidden" name="unit[]" value="<?php echo $value['unit'];?>">
                                            </tr>
                                        <?php }?>     
                                        </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <b>Итого:</b>  <?php echo $result_price;?> руб.
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>    
                                            
                                        <input class="input" type="text" value="Контактное лицо (ФИО):">
                            <input class="input" type="text" value="Телефон(email) для связи:">
                            <textarea class="textarea">Дополнительная информация: </textarea>    
                                            
                                        <input class="button-order float" type="submit" value="">
                                        
                            </form>            
                                        <?php } else { ?>
                                             В корзине нет товаров.   
                                        <?php }?>     
                                        
                                        <?php if($cart){?>
                                             <form action="<?php echo SITE_URL;?>welcome/create_order" method="post">
                                        <table>
                                            <tr>
                                                <th>Артикул</th>
                                                <th>Наименование товара</th>
                                                <th>Цена, руб.</th>
                                                <th>Кол-во</th>
                                                <th>Ед. изм.</th>
                                            </tr>
                                           <?php foreach($cart as $key=>$value){?>
                                            <tr>
                                                <td><?php echo $key;?></td>
                                                <input type="hidden" name="article[]" value="<?php echo $key;?>">
                                                <input type="hidden" name="id[]" value="<?php echo $value['id'];?>">
                                                <td><?php echo $value['product_name'];?></td>
                                                <input type="hidden" name="product_name[]" value="<?php echo $value['product_name'];?>">
                                                <td><?php echo $value['price'];?></td>
                                                <input type="hidden" name="price[]" value="<?php echo $value['price'];?>">
                                                <td><input name="qty[]" type="text" value="<?php echo $value['qty'];?>" style="width:50px;"></td>
                                                <td><?php echo $value['unit'];?></td>
                                                <input type="hidden" name="unit[]" value="<?php echo $value['unit'];?>">
                                            </tr>
                                           <?php }?>    
                                        </table> 
                                        <br/>
                                        <b>Сумма заказа:</b><?php echo $result_price;?>
                                        <br/>
                                        
                                        <br/>
                                        Контактное лицо (ФИО):<br/>
                                        <input type="text" name="contact_name" value=""><br/>
                                        Телефон(email) для связи:<br/>
                                        <input type="text" name="contact_phone" value=""><br/>
                                        Дополнительная информация:<br/>
                                        <textarea name="contact_dop"></textarea><br/>
                                        
                                        <input type="submit" value="Оформить заказ">
                                        </form>
                                        <?php } else { ?>
                                             В корзине нет товаров.   
                                        <?php }?>    
                                        
<?php $this->load->view('footer'); ?>