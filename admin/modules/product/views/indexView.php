<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <!-- <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(69)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(51)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt<span class="count">(0)</span> |</a></li>
                            <li class="pending"><a href="">Thùng rác<span class="count">(0)</span></a></li>
                        </ul> -->
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="search" id="s" placeholder="Nhập tên sản phẩm">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                        </form>
                    </div>
                    <!-- <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div> -->

                    <?php
                    if (!empty($list_product)) {
                    ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                                    <td><span class="thead-text">STT</span></td>
                                    <!-- <td><span class="thead-text">Mã sản phẩm</span></td> -->
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá bán hiện tại</span></td>
                                    <td><span class="thead-text">Giá gốc</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Sản phẩm nổi bật</span></td>
                                    <td><span class="thead-text">Sản phẩm bán chạy</span></td>
                                    <!-- <td><span class="thead-text">Trạng thái</span></td> -->
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $temp = $start;
                                    foreach ($list_product as $item) {
                                        $temp++;
                                    ?>
                                <tr>
                                    <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                                    <td><span class="tbody-text"><?php echo $temp; ?></span></td>
                                    <!-- <td><span class="tbody-text"><?php echo $item['product_code']; ?></span></td> -->
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="uploads/product/<?php echo $item['product_thumb']; ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['product_name'] ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=product&action=update&product_id=<?php echo $item['product_id']; ?>"
                                                    title="Sửa" class="edit"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=product&action=delete&product_id=<?php echo $item['product_id']; ?>"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo currency_format($item['price']); ?></span>
                                    </td>
                                    <td><span
                                            class="tbody-text"><?php echo currency_format($item['original_price']) ?></span>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $item['cat_title']; ?></span></td>
                                    <td class="text-center">
                                        <?php
                                                if ($item['outstanding_product'] == 0) {
                                                ?>
                                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                        <?php
                                                } else {
                                                ?>
                                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                                        <?php
                                                }
                                                ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                                if ($item['celling_product'] == 0) {
                                                ?>
                                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                        <?php
                                                } else {
                                                ?>
                                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                                        <?php
                                                }
                                                ?>
                                    </td>
                                    <!-- <td><span class="tbody-text">Hoạt động</span></td> -->
                                    <td><span class="tbody-text"><?php echo $item['creator']; ?></span></td>
                                    <td><span
                                            class="tbody-text"><?php if (!empty($item['created_at'])) echo date('d/m/Y', $item['created_at']); ?></span>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <!-- <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p> -->
                    <?php echo get_pagging($num_page, $page, "?mod=product&action=index"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// echo $num_rows;
get_footer();
?>