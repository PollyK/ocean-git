<script type="text/javascript">
    $(document).ready(function(){
        $('#tooltip').hide();
        $('#show_tooltip').click(function(){
            $('#tooltip').show();
        })
    });
</script>

<style>

    .banner_table tr td {
        vertical-align: middle;
    }

</style>

<div id="main" style="float:left">

    <h2><?php echo get_success_message(); ?> </h2>
    <h2 style="color: red"><?php echo get_error_message(); ?></h2>

    <?php if (!$banners) { ?>
        <h3>Нет доступных баннеров
            <a id="show_tooltip"><b>[?]</b></a>
        </h3>
    <?php } else { ?>
        <table class="banner_table">
            <tr>
                <td>Фото</td>
                <td>Заголовок (ссылка)</td>
                <td>Видимый?</td>
                <td>Дата</td>
                <td></td>
                <td></td>
            </tr>

            <?php
            foreach ($banners as $item) {
                ?>
                <tr>
                    <td>
                        <img src="<?php echo base_url() . "stuff/news_images/" . $item->banner_photo; ?>">
                    </td>
                    <td>
                        <a href="<?php echo SITE_URL; ?>welcome/show_news/<?php echo $item->banner_link_to_article; ?>" target="_blank">
                            <?php echo $item->banner_header; ?>
                        </a>
                    </td>
                    <td><?php echo ($item->visible) ? "да" : "нет"; ?></td>
                    <td><?php echo $item->date; ?></td>
                    <td>
                        <a href="<?php echo SITE_URL; ?>admin/edit_banner/<?php echo $item->id; ?>">редактировать</a>
                    </td>
                    <td>
                        <a onclick="return confirm('Удалить баннер?');" href="<?php echo SITE_URL; ?>admin/delete_banner/<?php echo $item->id; ?>">удалить</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>

    <?php } ?>
</div>
<!-- // #main -->

<div class="clear"></div>
