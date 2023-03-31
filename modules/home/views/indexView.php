<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    foreach ($list_slider as $item) {
                    ?>
                    <div class="item">
                        <img src="admin/uploads/slider/<?php echo $item['slider_thumb']; ?>" alt="">
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <?php
                if (!empty($list_product)) {
                ?>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                            foreach ($list_product as $item) {
                                if ($item['outstanding_product'] == 1) {
                            ?>
                        <li style="text-align: center">
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb'] ?>">
                            </a>
                            <a href="" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']) ?></span>
                                <span
                                    class="old"><?php if (!empty($item['original_price'])) echo currency_format($item['original_price']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['product_id']; ?>" title=""
                                    class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                    title="" class="buy-now fl-right">Mua ngay</a>
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
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Đồ kiểng xe máy</h3>
                </div>
                <?php
                if (!empty($get_list_product_pagging_ornament)) {
                ?>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                            foreach ($get_list_product_pagging_ornament as $item) {
                                if ($item['cat_id'] == 1 || $item['parent_id'] == 1) {
                            ?>
                        <li style="text-align: center">
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a>
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="product-name"><?php echo $item['product_name'] ?></a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="product-name"><?php echo $item['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']) ?></span>
                                <span
                                    class="old"><?php if (!empty($item['original_price'])) echo currency_format($item['original_price']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['product_id']; ?>"
                                    title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                    title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php
                                }
                            }
                            ?>
                    </ul>
                    <div class="section" id="paging-wp">
                        <div class="section-detail clearfix">
                            <!-- <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p> -->
                            <?php echo get_pagging($num_page_ornament, $page, "?mod=home&action=index"); ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Phụ tùng thay thế</h3>
                </div>
                <?php
                if (!empty($get_list_product_pagging_parepart)) {
                ?>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                            foreach ($get_list_product_pagging_parepart as $item) {
                                if ($item['cat_id'] == 14 || $item['parent_id'] == 14) {
                            ?>
                        <li style="text-align: center">
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a>
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="product-name"><?php echo $item['product_name'] ?></a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="product-name"><?php echo $item['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']) ?></span>
                                <span
                                    class="old"><?php if (!empty($item['original_price'])) echo currency_format($item['original_price']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['product_id']; ?>"
                                    title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                    title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php
                                }
                            }
                            ?>
                    </ul>
                    <div class="section" id="paging-wp">
                        <div class="section-detail clearfix">
                            <!-- <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p> -->
                            <?php echo get_pagging($num_page_parepart, $page, "?mod=home&action=index"); ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Vỏ xe máy (Lốp xe)</h3>
                </div>
                <?php
                if (!empty($list_product)) {
                ?>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                            foreach ($get_list_product_pagging_volopxe as $item) {
                                if ($item['cat_id'] == 21 || $item['parent_id'] == 21) {
                            ?>
                        <li style="text-align: center">
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a>
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="product-name"><?php echo $item['product_name'] ?></a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="product-name"><?php echo $item['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']) ?></span>
                                <span
                                    class="old"><?php if (!empty($item['original_price'])) echo currency_format($item['original_price']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['product_id']; ?>"
                                    title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                    title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php
                                }
                            }
                            ?>
                    </ul>
                    <div class="section" id="paging-wp">
                        <div class="section-detail clearfix">
                            <!-- <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p> -->
                            <?php echo get_pagging($num_page_volopxe, $page, "?mod=home&action=index"); ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Nhớt xe máy</h3>
                </div>
                <?php
                if (!empty($list_product)) {
                ?>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                            foreach ($get_list_product_pagging_nhotxe as $item) {
                                if ($item['cat_id'] == 26 || $item['parent_id'] == 26) {
                            ?>
                        <li style="text-align: center">
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a>
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="product-name"><?php echo $item['product_name'] ?></a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="product-name"><?php echo $item['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']) ?></span>
                                <span
                                    class="old"><?php if (!empty($item['original_price'])) echo currency_format($item['original_price']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['product_id']; ?>"
                                    title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                    title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php
                                }
                            }
                            ?>
                    </ul>
                    <div class="section" id="paging-wp">
                        <div class="section-detail clearfix">
                            <!-- <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p> -->
                            <?php echo get_pagging($num_page_nhotxe, $page, "?mod=home&action=index"); ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Phụ kiện cho biker</h3>
                </div>
                <?php
                if (!empty($list_product)) {
                ?>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                            foreach ($list_product as $item) {
                                if ($item['cat_id'] == 30 || $item['parent_id'] == 0) {
                            ?>
                        <li style="text-align: center">
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>">
                            </a>
                            <!-- <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                title="" class="product-name"><?php echo $item['product_name'] ?></a> -->
                            <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                class="product-name"><?php echo $item['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']) ?></span>
                                <span
                                    class="old"><?php if (!empty($item['original_price'])) echo currency_format($item['original_price']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['product_id']; ?>"
                                    title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="san-pham/<?php if (!empty($item['slug_product'])) echo $item['slug_product'] . '-' ?><?php echo $item['product_id']; ?>.html"
                                    title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
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

        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
?>