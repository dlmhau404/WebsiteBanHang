<?php
get_header();
?>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //fill data to tree  with AJAX call
    $('#tree-container').jstree({
        'plugins': ["wholerow"],
        'core': {
            'data': {
                "url": "?mod=product&controller=indexCategory&action=get_list_category_tree",
                "dataType": "json" // needed only if you do not supply JSON headers
            }
        }
    })
    $('#tree-container').on('ready.jstree', function() {
        $("#tree-container").jstree("open_all");
    });
});
</script>

<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục sản phẩm</h3>
                    <a href="?mod=product&controller=indexCategory&action=add" title="" id="add-new"
                        class="fl-left">Thêm mới</a>
                    <?php
                    if ($type == 2) {
                    ?>
                    <a href="?mod=product&controller=indexCategory&action=index&type=1" title="" id="add-new"
                        style="background: gray"><i class="fa fa-list" aria-hidden="true"></i></a>
                    <?php
                    }
                    ?>
                    <?php
                    if ($type == 1) {
                    ?>
                    <a href="?mod=product&controller=indexCategory&action=index&type=2" title="" id="add-new"
                        style="background: blue"><i class="fa fa-tree" aria-hidden="true"></i></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <?php
                        if ($type == 1) {
                            if (!empty($list_category)) {
                        ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $temp = 0;
                                        foreach ($list_category as $item) {
                                            $temp++;
                                        ?>
                                <tr>
                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['cat_title']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=product&controller=indexCategory&action=update&cat_id=<?php echo $item['cat_id']; ?>"
                                                    title="Sửa" class="edit"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=product&controller=indexCategory&action=delete&cat_id=<?php echo $item['cat_id']; ?>"
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
                                        ?>
                            </tbody>
                        </table>
                        <?php
                            }
                        }
                        ?>


                        <?php
                        if ($type == 2) {
                        ?>
                        <div id="tree-container"></div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <!-- <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</div>
<?php
get_footer();
?>