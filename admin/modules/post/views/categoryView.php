<?php
get_header();
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục bài viết</h3>
                    <a href="?mod=post&controller=category&action=addCat" title="" id="add-new" class="fl-left">Thêm
                        mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <?php
                        if (!empty($list_category)) {
                        ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <!-- <td><span class="thead-text">Thứ tự</span></td> -->
                                    <!-- <td><span class="thead-text">Trạng thái</span></td> -->
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $temp = 0;
                                    foreach ($list_category as $item) {
                                        if ($item['parent_id'] == 0) {
                                            $temp++;
                                    ?>
                                <tr>
                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['cat_title']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=post&controller=category&action=updateCat&cat_id=<?php echo $item['cat_id']; ?>"
                                                    title="Sửa" class="edit"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=post&controller=category&action=deleteCat&cat_id=<?php echo $item['cat_id']; ?>"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $item['creator'] ?></span></td>
                                    <td><span
                                            class="tbody-text"><?php if (!empty($item['created_date'])) echo date('d/m/Y', $item['created_date']); ?></span>
                                    </td>
                                </tr>

                                <?php
                                        }
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
<?php
get_footer();
?>