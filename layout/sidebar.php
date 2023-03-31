<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <?php
        if (!empty($list_category)) {
        ?>
        <div class="secion-detail">
            <ul class="list-item">
                <?php
                    foreach ($list_category as $item) {
                        if ($item['parent_id'] == 0) {
                    ?>
                <li>
                    <a href="?mod=product&action=cat_product&cat_id=<?php echo $item['cat_id']; ?>"
                        title=""><?php echo $item['cat_title']; ?></a>
                    <?php
                                if ($item['is_has_child'] == 1) {
                                ?>
                    <ul class="sub-menu">
                        <?php
                                        foreach ($list_category as $item2) {
                                            if ($item2['parent_id'] == $item['cat_id']) {
                                        ?>
                        <li>
                            <a href="?mod=product&action=cat_product&cat_id=<?php echo $item2['cat_id']; ?>"
                                title=""><?php echo $item2['cat_title'] ?></a>
                        </li>
                        <?php
                                            }
                                        }
                                        ?>
                    </ul>
                    <?php
                                }
                                ?>
                </li>
                <?php
                        }
                    }
                    ?>
            </ul>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <?php
        if (!empty($list_product)) {
        ?>
        <div class="section-detail">
            <ul class="list-item">
                <?php
                    foreach ($list_product as $item) {
                        if ($item['celling_product'] == 1) {
                    ?>
                <li class="clearfix">
                    <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>"
                        title="<?php echo $item['product_name']; ?>" class="thumb fl-left">
                        <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>"
                            title="<?php echo $item['product_name']; ?>"
                            class="product-name"><?php echo $item['product_name']; ?></a>
                        <div class="price">
                            <span class="new"><?php echo currency_format($item['price']); ?></span>
                            <span
                                class="old"><?php if ($item['original_price'] != 0) echo currency_format($item['original_price']); ?></span>
                        </div>
                        <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                            class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <?php
                        }
                    }
                    ?>
            </ul>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner-2.jpg" alt="">
            </a>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner-3.jpg" alt="">
            </a>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner-4.jpg" alt="">
            </a>
        </div>
    </div>
</div>