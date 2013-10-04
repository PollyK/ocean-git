<script type="text/javascript">
    $(document).ready(function(){
        $('#tooltip').hide();
        $('#show_tooltip').click(function(){
            $('#tooltip').show();
        })
    });
</script>

<div id="main" style="float:left">
    
    <h2><?php echo get_success_message();?> </h2>
    
    <?php if (!$file_to_import) { ?>
        <h3>Нет доступных файлов для импорта
            <a id="show_tooltip"><b>[?]</b></a>
        </h3>
        <div id="tooltip">
            Файлы дампа должны быть загружены в каталог "/httpdocs/ocean-omsk.ru/dump" и иметь атрибут 777
        </div>
    <?php } else { ?>
        <form action="<?php echo SITE_URL;?>admin/service_do_import" class="jNice" method="POST">

            <h3>Доступные файлы для импорта</h3>
            <table cellpadding="0" cellspacing="0">
                <?php 
                $counter = 0;
                foreach ($file_to_import as $key=>$file_item) { 
                    $counter++;
                    ?>
                    <tr <?php if($counter%2){ echo "class=\"odd\""; }?> >
                        <td>
                            <input type="checkbox" name="files[]" value="<?php echo $file_item['server_path'];?>">
                        <?php echo $file_item['name'];?></td>
                        <td class="action">
                            <?php echo $file_item['size'];?> | Элементов: <?php echo $file_item['items_amount'];?> | <?php echo $file_item['date'];?> 
                        </td>
                    </tr>                        
                    
                <?php } ?>       
            </table>
            <input type="submit" value="Импорт!" />
        </form>
    <?php } ?>
</div>
<!-- // #main -->

<div class="clear"></div>
