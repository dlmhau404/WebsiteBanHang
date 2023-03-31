<?php
get_header();
?>
<div id="main-content-wp" class="cart-page">

    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <?php
                if (!empty($list_buy)) {
                    // show_array($list_buy);
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($list_buy as $item) {
                            ?>
                        <tr data-id="<?php echo $item['product_id']; ?>">
                            <td><?php echo $item['code']; ?></td>
                            <td>
                                <a href="<?php echo $item['url_detail']; ?>" title="" class="thumb">
                                    <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $item['url_detail']; ?>" title=""
                                    class="name-product"><?php echo $item['product_name']; ?></a>
                            </td>
                            <td><?php echo currency_format($item['price']); ?></td>
                            <td>
                                <input type="number" min="1" max="15"
                                    name="quantity_of_product[<?php echo $item['product_id'] ?>]"
                                    value="<?php echo $item['quantity']; ?>" class="num-order">
                                <p style="color: red;"></p>
                            </td>
                            <td><?php echo currency_format($item['sub_total']); ?></td>
                            <td>
                                <a href="<?php echo $item['url_delete_cart']; ?>" title="" class="del-product"><i
                                        class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá :
                                        <span><?php echo currency_format($total_cart); ?></span>
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <a href="?mod=cart&action=checkout" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <a href="?" title="" id="buy-more">Mua tiếp</a><br />
                <a href="?mod=cart&action=delete" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>