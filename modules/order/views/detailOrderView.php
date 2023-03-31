<?php
get_header();
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <div class="section">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm đơn hàng</h3>
                <a href="?mod=order&action=index">Trở về</a>
            </div>
            <div class="table-responsive">
                <?php
                if (!empty($list_order_product)) {
                ?>
                <table class="table info-exhibition">
                    <thead>
                        <tr>
                            <td class="thead-text">STT</td>
                            <td class="thead-text">Ảnh sản phẩm</td>
                            <td class="thead-text">Tên sản phẩm</td>
                            <td class="thead-text">Đơn giá</td>
                            <td class="thead-text">Số lượng</td>
                            <td class="thead-text">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $temp = 0;
                            foreach ($list_order_product as $item) {
                                $temp++;
                            ?>
                        <tr>
                            <td class="thead-text"><?php echo $temp; ?></td>
                            <td class="thead-text">
                                <div class="thumb">
                                    <img style="display: inline-block; width: 125px; height: 125px"
                                        src="admin/uploads/product/<?php echo $item['detail']['product_thumb']; ?>"
                                        alt="">
                                </div>
                            </td>
                            <td class="thead-text"><?php echo $item['detail']['product_name']; ?></td>
                            <td class="thead-text"><?php echo currency_format($item['detail']['price']); ?></td>
                            <td class="thead-text"><?php echo $item['quantity']; ?></td>
                            <td class="thead-text"><?php echo currency_format($item['sub_total']); ?></td>
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>
                </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
?>