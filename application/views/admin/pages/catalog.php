<style type="text/css">
    @import "<?php echo base_url(); ?>stuff/css/tree.css";
</style>

<script src="<?php echo base_url(); ?>stuff/js/jquery.dataTables.js"></script>

<script type="text/javascript">
    var ajaxSource = '<?php echo SITE_URL; ?>admin/load_catalog_products/';
    var group_id = "2";
    
    $(function(){
        load_table();
    });
    
    function load_table(){
        $('#products').dataTable( {
            "sAjaxSource": ajaxSource,
            "sServerMethod": "POST",
            "iDisplayLength": 20,
            "bProcessing": true,
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push({
                    "name": "group_id",
                    "value": group_id
                })
            }
        });
    }
    
    
    function load_products(id){
        group_id = id;
        load_table();
    }
    
</script>

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

<style type="text/css">

    .Container {
        padding: 0;
        margin: 0;
    }

    .Container li {
        list-style-type: none;
    }


    /* indent for all tree children excepts root */
    .Node {
        background-image : url(<?php echo base_url(); ?>stuff/img/i.gif);
        background-position : top left;
        background-repeat : repeat-y;
        margin-left: 18px;
        zoom: 1;
    }

    .IsRoot {
        margin-left: 0;
    }


    /* left vertical line (grid) for all nodes */
    .IsLast {
        background-image: url(<?php echo base_url(); ?>stuff/img/i_half.gif);
        background-repeat : no-repeat;
    }

    .ExpandOpen .Expand {
        background-image: url(<?php echo base_url(); ?>stuff/img/expand_minus.gif);
    }

    /* closed is higher priority than open */
    .ExpandClosed .Expand {
        background-image: url(<?php echo base_url(); ?>stuff/img/expand_plus.gif);
    }

    /* highest priority */
    .ExpandLeaf .Expand {
        background-image: url(<?php echo base_url(); ?>stuff/img/expand_leaf.gif);
    }

    .Content {
        min-height: 18px;
        margin-left:18px;
    }

    * html .Content {
        height: 18px;
    }

    .Expand {
        width: 18px;
        height: 18px;
        float: left;
    }


    .ExpandOpen .Container {
        display: block;
    }

    .ExpandClosed .Container {
        display: none;
    }

    .ExpandOpen .Expand, .ExpandClosed .Expand {
        cursor: pointer;
    }
    .ExpandLeaf .Expand {
        cursor: auto;
    }

</style>



<div id="main" style="float:left">
        <div id="content">
            <table class="datatable" id="products" >
                <thead>
                    <tr>
                        <th></th>
                        <th style="width: 350px">Название</th>
                        <th>Артикул</th>
                        <th>Страна</th>
                        <th>Ед.изм.</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>
<!-- // #main -->

<div class="clear"></div>
