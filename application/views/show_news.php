<?php $this->load->view('header'); ?>
<section class="all-right-block block-news">
                            <div class="img-news"></div>
                            
                            <?php if(isset($one_record) && $one_record){ ?>
                                <p><b><?php echo $one_record->title;?></b></p>
                                <p><?php echo $one_record->date;?></p>
                                <img width="250" src="<?php echo base_url();?>stuff/news_images/<?php echo $one_record->image;?>"><br/>
                                <?php echo $one_record->descr;?>
                            <?php } ?>
                             
                        </section>
<?php $this->load->view('footer'); ?>
