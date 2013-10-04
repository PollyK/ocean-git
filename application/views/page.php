<?php $this->load->view('header'); ?>
<?php if(isset($additional_css) && $additional_css){ ?>
<section class="all-right-block text-block">
    <?php echo $content; ?>   
</section>
<?php }else{ ?>    
    <?php echo $content; ?>   
<?php } ?>
    
    
<?php $this->load->view('footer'); ?>