<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
                <?php
                echo form_success('cat');
                ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="title" id="title">
                        <?php echo form_error('title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <label for="parent_cat">Danh mục cha</label>
                        <select name="parent_cat" id="parent_cat">
                            <option value="">Chọn</option>
                            <?php
                            if (!empty($list_category)) {
                                foreach ($list_category as $item) {
                                    if ($item['parent_id'] == 0) {
                            ?>
                            <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title'] ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>

                        </select>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>