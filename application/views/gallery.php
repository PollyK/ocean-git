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
                        <li>
                            <a class="thumb" name="leaf" href="http://farm4.static.flickr.com/3261/2538183196_8baf9a8015.jpg" title="Title #0">
                                <img src="http://farm4.static.flickr.com/3261/2538183196_8baf9a8015_s.jpg" alt="Title #0" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>
                        <li>
                            <a class="thumb" name="drop" href="http://farm3.static.flickr.com/2404/2538171134_2f77bc00d9.jpg" title="Title #1">
                                <img src="http://farm3.static.flickr.com/2404/2538171134_2f77bc00d9_s.jpg" alt="Title #1" />
                            </a>
                            <div class="caption">
                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>
                        <li>
                            <a class="thumb" name="bigleaf" href="http://farm3.static.flickr.com/2093/2538168854_f75e408156.jpg" title="Title #2">
                                <img src="http://farm3.static.flickr.com/2093/2538168854_f75e408156_s.jpg" alt="Title #2" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" name="lizard" href="http://farm4.static.flickr.com/3153/2538167690_c812461b7b.jpg" title="Title #3">
                                <img src="http://farm4.static.flickr.com/3153/2538167690_c812461b7b_s.jpg" alt="Title #3" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm4.static.flickr.com/3150/2538167224_0a6075dd18.jpg" title="Title #4">
                                <img src="http://farm4.static.flickr.com/3150/2538167224_0a6075dd18_s.jpg" alt="Title #4" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm4.static.flickr.com/3204/2537348699_bfd38bd9fd.jpg" title="Title #5">
                                <img src="http://farm4.static.flickr.com/3204/2537348699_bfd38bd9fd_s.jpg" alt="Title #5" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm4.static.flickr.com/3124/2538164582_b9d18f9d1b.jpg" title="Title #6">
                                <img src="http://farm4.static.flickr.com/3124/2538164582_b9d18f9d1b_s.jpg" alt="Title #6" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm4.static.flickr.com/3205/2538164270_4369bbdd23.jpg" title="Title #7">
                                <img src="http://farm4.static.flickr.com/3205/2538164270_4369bbdd23_s.jpg" alt="Title #7" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm4.static.flickr.com/3211/2538163540_c2026243d2.jpg" title="Title #8">
                                <img src="http://farm4.static.flickr.com/3211/2538163540_c2026243d2_s.jpg" alt="Title #8" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2315/2537343449_f933be8036.jpg" title="Title #9">
                                <img src="http://farm3.static.flickr.com/2315/2537343449_f933be8036_s.jpg" alt="Title #9" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2167/2082738157_436d1eb280.jpg" title="Title #10">
                                <img src="http://farm3.static.flickr.com/2167/2082738157_436d1eb280_s.jpg" alt="Title #10" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2342/2083508720_fa906f685e.jpg" title="Title #11">
                                <img src="http://farm3.static.flickr.com/2342/2083508720_fa906f685e_s.jpg" alt="Title #11" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2132/2082721339_4b06f6abba.jpg" title="Title #12">
                                <img src="http://farm3.static.flickr.com/2132/2082721339_4b06f6abba_s.jpg" alt="Title #12" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2139/2083503622_5b17f16a60.jpg" title="Title #13">
                                <img src="http://farm3.static.flickr.com/2139/2083503622_5b17f16a60_s.jpg" alt="Title #13" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2041/2083498578_114e117aab.jpg" title="Title #14">
                                <img src="http://farm3.static.flickr.com/2041/2083498578_114e117aab_s.jpg" alt="Title #14" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2149/2082705341_afcdda0663.jpg" title="Title #15">
                                <img src="http://farm3.static.flickr.com/2149/2082705341_afcdda0663_s.jpg" alt="Title #15" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2014/2083478274_26775114dc.jpg" title="Title #16">
                                <img src="http://farm3.static.flickr.com/2014/2083478274_26775114dc_s.jpg" alt="Title #16" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2194/2083464534_122e849241.jpg" title="Title #17">
                                <img src="http://farm3.static.flickr.com/2194/2083464534_122e849241_s.jpg" alt="Title #17" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm4.static.flickr.com/3127/2538173236_b704e7622e.jpg" title="Title #18">
                                <img src="http://farm4.static.flickr.com/3127/2538173236_b704e7622e_s.jpg" alt="Title #18" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2375/2538172432_3343a47341.jpg" title="Title #19">
                                <img src="http://farm3.static.flickr.com/2375/2538172432_3343a47341_s.jpg" alt="Title #19" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2353/2083476642_d00372b96f.jpg" title="Title #20">
                                <img src="http://farm3.static.flickr.com/2353/2083476642_d00372b96f_s.jpg" alt="Title #20" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm3.static.flickr.com/2201/1502907190_7b4a2a0e34.jpg" title="Title #21">
                                <img src="http://farm3.static.flickr.com/2201/1502907190_7b4a2a0e34_s.jpg" alt="Title #21" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm2.static.flickr.com/1116/1380178473_fc640e097a.jpg" title="Title #22">
                                <img src="http://farm2.static.flickr.com/1116/1380178473_fc640e097a_s.jpg" alt="Title #22" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>

                        <li>
                            <a class="thumb" href="http://farm2.static.flickr.com/1260/930424599_e75865c0d6.jpg" title="Title #23">
                                <img src="http://farm2.static.flickr.com/1260/930424599_e75865c0d6_s.jpg" alt="Title #23" />
                            </a>
                            <div class="caption">

                                <h3 class="image-title">Как мы готовим суши</h3>
                                <div class="image-desc">О ещё можно описать товар как чего куда..</div>
                            </div>
                        </li>
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