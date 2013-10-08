<?php $this->load->view('header'); ?>
<div class="angle_1"></div>
<div class="angle_2"></div>
<div class="angle_3"></div>
<div class="angle_4"></div>
<table class="table-catalog datatable" id="products">
    <thead>
        <tr>

            <th>Артикул</th>
            <th>
                Наименование <br>
                товара 
            </th>
            <th>Производ.</th>
            <th>Цена<br> руб.</th>
            <th>Наличие</th>
            <th>
                Ед. <br>
                изм. 
            </th>
            <th>
                Кол-во.
            </th>
            <th>
                В заказ
                <!--                                                        <button onClick="add_to_card()" class="basket-table-img"></button>-->
            </th>
        </tr>
    </thead>

</table>
<?php $this->load->view('footer'); ?>

