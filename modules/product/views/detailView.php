<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $info_product['cat_title']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img style="width: 350px; height: 350px; max-width: 350px; min-width: 350px" id="zoom"
                                src="admin/uploads/product/<?php echo $info_product['product_thumb']; ?>"
                                data-zoom-image="admin/uploads/product/<?php echo $info_product['product_thumb']; ?>" />
                        </a>
                        <div id="list-thumb">
                            <a href="" data-image="admin/uploads/product/<?php echo $info_product['product_thumb'] ?>"
                                data-zoom-image="admin/uploads/product/<?php echo $info_product['product_thumb'] ?>    ">
                                <img style="width: 70px; height: 70px; max-width: 70px; min-width: 70px" id="zoom"
                                    src="admin/uploads/product/<?php echo $info_product['product_thumb'] ?>" />
                            </a>
                            <?php
                            foreach ($list_product_image as $item) {
                            ?>
                            <a href="" data-image="admin/uploads/product/<?php echo $item['link_image'] ?>"
                                data-zoom-image="admin/uploads/product/<?php echo $item['link_image'] ?>    ">
                                <img style="width: 70px; height: 70px; max-width: 70px; min-width: 70px" id="zoom"
                                    src="admin/uploads/product/<?php echo $item['link_image'] ?>" />
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $info_product['product_name'] ?></h3>
                        <div class="desc">
                            <?php echo $info_product['desc_short'] ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">Còn hàng</span>
                        </div>
                        <div class="num-product">
                            <span class="title">Mã sản phảm: </span>
                            <span class="status"><?php echo $info_product['code']; ?></span>
                        </div>
                        <p class="price"><?php echo currency_format($info_product['price']) ?></p>
                        <!-- <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a href="?mod=cart&action=add&id=<?php echo $info_product['product_id']; ?>"
                            title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a> -->
                        <form method="GET" action="?">
                            <input type="hidden" name="mod" value="cart">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="id" value="<?php echo $info_product['product_id']; ?>">
                            <div id="num-order-wp">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <input type="submit" value="Thêm giỏ hàng" name="btn-submit" class="add-cart">
                            <!-- <a href="<?php //echo $product['url_add_cart']    
                                            ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a> -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $info_product['product_detail'] ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_product)) {
                    ?>
                    <div class="section-detail">
                        <ul class="list-item ">
                            <?php
                                foreach ($list_product as $item) {
                                ?>
                            <li style="text-align: center">
                                <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                    class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                    <img src="admin/uploads/product/<?php echo $item['product_thumb'] ?>">
                                </a>
                                <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>" title=""
                                    class="product-name"><?php echo $item['product_name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['price']) ?></span>
                                    <span
                                        class="old"><?php if ($item['original_price'] != 0) echo currency_format($item['original_price']) ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="?mod=cart&action=add&id=<?php echo $item['product_id']; ?>"
                                        title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?mod=product&action=detail&id=<?php echo $item['product_id']; ?>"
                                        title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <?php
                                }
                                ?>
                        </ul>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
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
                                    <a href="?mod=product&cat_id=<?php echo $item2['cat_id']; ?>"
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
            <!-- <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>
<?php
get_footer();
?>