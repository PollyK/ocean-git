<?php $this->load->view('header'); ?>
<section class="all-right-block faq-news">
    <?php if ($message = $this->session->flashdata('message')) { ?>
        <h1><?php echo $message; ?></h1>
        <?php
    }
    ?>
    
        <?php if($order){ ?>
        <h2>Заказ от <?php echo date("d-m-y", strtotime($order->date));?></h2>
        <?php
        
                foreach($items as $item){            var_dump($item);die; ?>
         
        <?php
                } 
          
        }else{
            echo "Заказы не найдены";
        }
        ?>
        
        
</section>
<?php $this->load->view('footer'); ?>
