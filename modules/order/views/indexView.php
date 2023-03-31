<?php
get_header();
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">

        <div class="section" id="title-page">
            <div class="clearfix">
                <b>
                    <h2 id="index" class="fl-left">Đơn hàng của bạn</h2>
                </b>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="table-responsive">
                    <?php
                    if (!empty($info_order)) {
                    ?>
                    <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã đơn hàng</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Số sản phẩm</span></td>
                                <td><span class="thead-text">Tổng giá</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                                <td><span class="thead-text">Chi tiết</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $temp = 0;
                                foreach ($info_order as $item) {
                                    $temp++;
                                ?>
                            <tr>
                                <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                <td><span class="tbody-text"><?php echo $item['transaction_code']; ?></h3></span>
                                <td>
                                    <div class="tb-title fl-left">
                                        <a href="?mod=users&action=detail" title=""><?php echo $item['fullname']; ?></a>
                                    </div>
                                </td>
                                <td><span class="tbody-text"><?php echo $item['quantity']; ?></span></td>
                                <td><span class="tbody-text"><?php echo currency_format($item['total']); ?></span></td>
                                <td><span class="tbody-text "><?php switch ($item['status']) {
                                                                            case 0:
                                                                                echo $item['status'] = "Đang chờ";
                                                                                $item['status_css'] = 0;
                                                                                break;
                                                                            case 1:
                                                                                echo $item['status'] = "Đang chuyển";
                                                                                $item['status_css'] = 1;
                                                                                break;
                                                                            case 2:
                                                                                echo $item['status'] = "Đã nhận";
                                                                                $item['status_css'] = 2;
                                                                                break;
                                                                        } ?></span></td>
                                <td><span
                                        class="tbody-text"><?php if (!empty($item['created_date'])) echo date('d/m/Y', $item['created_date']); ?></span>
                                </td>
                                <td><a href="?mod=order&action=detailOrder&transaction=<?php echo $item['transaction_code']; ?>"
                                        title="" class="tbody-text">Chi
                                        tiết</a></td>
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
</div>

</div>
</div>
<?php
get_footer();
?>