<?php $this->load->view('header'); ?>
<script type="text/javascript">
    function tree_toggle(event) {
        event = event || window.event
        var clickedElem = event.target || event.srcElement
        if (!hasClass(clickedElem, 'Expand')) {
            return // клик не там
        }
        // Node, на который кликнули
        var node = clickedElem.parentNode
        if (hasClass(node, 'ExpandLeaf')) {
            return // клик на листе
        }
        // определить новый класс для узла
        var newClass = hasClass(node, 'ExpandOpen') ? 'ExpandClosed' : 'ExpandOpen'
        // заменить текущий класс на newClass
        // регексп находит отдельно стоящий open|close и меняет на newClass
        var re =  /(^|\s)(ExpandOpen|ExpandClosed)(\s|$)/
        node.className = node.className.replace(re, '$1'+newClass+'$3')
    }

    function hasClass(elem, className) {
        return new RegExp("(^|\\s)"+className+"(\\s|$)").test(elem.className)
    }
</script>

<section class="content">
    <div id="right-block-big">
        <div class="angle_1"></div>
        <div class="angle_2"></div>
        <div class="angle_3"></div>
        <div class="angle_4"></div>
        <section class="all-right-block text-block">
            <div id="container">
                <div id="gallery" class="content">
                    <div id="controls" class="controls"></div>
                    <div class="slideshow-container">
                        <div id="loading" class="loader"></div>
                        <div id="slideshow" class="slideshow"></div>
                    </div>
                    <div id="caption" class="caption-container"></div>
                </div>
                <div id="thumbs" class="navigation">
                    <ul class="thumbs noscript">
                        <?php if ($photos) {
                            foreach ($photos as $photo_item) {
                                ?>
                                <li>
                                    <a class="thumb" name="leaf" href="<?php echo base_url().$photo_item->image;?>" title="<?php echo $photo_item->name;?>">
                                        <img src="<?php echo base_url().$photo_item->image_th;?>" alt="<?php echo $photo_item->name;?>" />
                                    </a>
                                    <div class="caption">

                                        <h3 class="image-title"><?php echo $photo_item->name;?></h3>
<!--                                        <div class="image-desc">О ещё можно описать товар как чего куда..</div>-->
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>


                    </ul>
                </div>
                <div style="clear: both;"></div>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    // We only want these styles applied when javascript is enabled
                    $('div.navigation').css({'width' : '300px', 'float' : 'left'});
                    $('div.content').css('display', 'block');

                    // Initially set opacity on thumbs and add
                    // additional styling for hover effect on thumbs
                    var onMouseOutOpacity = 0.67;
                    $('#thumbs ul.thumbs li').opacityrollover({
                        mouseOutOpacity:   onMouseOutOpacity,
                        mouseOverOpacity:  1.0,
                        fadeSpeed:         'fast',
                        exemptionSelector: '.selected'
                    });
				
                    // Initialize Advanced Galleriffic Gallery
                    var gallery = $('#thumbs').galleriffic({
                        delay:                     2500,
                        numThumbs:                 15,
                        preloadAhead:              10,
                        enableTopPager:            true,
                        enableBottomPager:         true,
                        maxPagesToShow:            7,
                        imageContainerSel:         '#slideshow',
                        controlsContainerSel:      '#controls',
                        captionContainerSel:       '#caption',
                        loadingContainerSel:       '#loading',
                        renderSSControls:          true,
                        renderNavControls:         true,
                        playLinkText:              'Показ Слайдов',
                        pauseLinkText:             'Остановить Сайдшоу',
                        prevLinkText:              '&#171; Назад ',
                        nextLinkText:              'Вперед &#187;',
                        nextPageLinkText:          'Далее &rsaquo;',
                        prevPageLinkText:          '&lsaquo; Назад',
                        enableHistory:             false,
                        autoStart:                 false,
                        syncTransitions:           true,
                        defaultTransitionDuration: 900,
                        onSlideChange:             function(prevIndex, nextIndex) {
                            // 'this' refers to the gallery, which is an extension of $('#thumbs')
                            this.find('ul.thumbs').children()
                            .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                            .eq(nextIndex).fadeTo('fast', 1.0);
                        },
                        onPageTransitionOut:       function(callback) {
                            this.fadeTo('fast', 0.0, callback);
                        },
                        onPageTransitionIn:        function() {
                            this.fadeTo('fast', 1.0);
                        }
                    });
                });
            </script>

            <div class="clear-block"></div>

        </section>
<?php $this->load->view('footer'); ?>