<?php $this->load->view('header'); ?>
<section class="all-right-block faq-news">
    <?php if ($message = $this->session->flashdata('message')) { ?>
        <h1><?php echo $message; ?></h1>
        <?php
    }
    ?>
    
        <?php if($orders){
                foreach($orders as $order){ ?>
        <h6>[<?php echo date("d-m-y", strtotime($order->date));?>] сумма:  <?php echo $order->sum;?>
            [<a href="<?php echo SITE_URL;?>user/view_order/<?php echo $order->id;?>">просмотр заказа</a>]
        </h6>  
        <?php
                }
        }else{
            echo "Заказы не найдены";
        }
        ?>
        
        
</section>
<?php $this->load->view('footer'); ?>
