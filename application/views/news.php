<?php $this->load->view('header'); ?>
<section class="all-right-block block-news">
                            <div class="img-news"></div>
                            
                            <?php if(isset($news) && $news){ ?>
                                <?php foreach ($news as $one_record){?>
                                    <div class="news-one">
                                        <p><span><?php echo $one_record->date;?></span></p>
                                        <h5><?php echo $one_record->title;?></h5>
                                        <p>
                                            <?php echo $one_record->short_descr;?>
                                        </p>
                                        <a href="<?php echo SITE_URL;?>welcome/show_news/<?php echo $one_record->id;?>">Подробнее...</a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                             
                        </section>
<?php $this->load->view('footer'); ?>
