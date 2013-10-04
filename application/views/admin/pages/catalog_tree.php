
<h3>Каталог</h3>
<div onclick="tree_toggle(arguments[0])" style="width: 250px">
    <ul class="Container">
        <li class="Node IsRoot IsLast ExpandClosed">
            <div class="Expand"></div>
            <div class="Content">Продукция</div>
            <ul class="Container">
                <?php foreach ($catalog as $item_0) { ?>
                    <li class="Node ExpandClosed ">
                        <div class="<?php echo!($item_0['content']) ? "IsLast" : "Expand"; ?>"></div>
                        <div class="Content"><?php echo $item_0['name']; ?></div>

                        <?php if ($item_0['content']) { ?>
                            <ul class="Container">
                                <?php foreach ($item_0['content'] as $item_1) { ?>
                                    <li class="Node IsLast">
                                        <div class="<?php echo!($item_1['content']) ? "IsLast" : "Expand"; ?>"></div>
                                        <div class="Content">
                                            <a onclick="load_products('<?php echo $item_1['group_id']; ?>')">
                                                <?php echo $item_1['name']; ?>
                                            </a>
                                        </div>
                                        <?php if ($item_1['content']) { ?>
                                            <ul class="Container">
                                                <?php foreach ($item_1['content'] as $item_2) { ?>
                                                    <li class="Node ExpandLeaf IsLast">
                                                        <div class="<?php echo!($item_2['content']) ? "IsLast" : "Expand"; ?>"></div>
                                                        <div class="Content">
                                                            <a onclick="load_products('<?php echo $item_2['group_id']; ?>')">
                                                                <?php echo $item_2['name']; ?>
                                                            </a>
                                                        </div>
                                                        <?php if ($item_2['content']) { ?>
                                                            <ul class="Container">
                                                                <?php foreach ($item_2['content'] as $item_3) { ?>
                                                                    <li class="Node ExpandLeaf IsLast">
                                                                        <div class="<?php echo!($item_3['content']) ? "IsLast" : "Expand"; ?>"></div>
                                                                        <div class="Content">
                                                                            <a onclick="load_products('<?php echo $item_3['group_id']; ?>')">
                                                                                <?php echo $item_3['name']; ?>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                    <?php } ?>
                </li>
            </ul>
            </div>
