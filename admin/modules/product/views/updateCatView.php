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
                    <h3 id="index" class="fl-left">Cập nhật danh mục</h3>
                    <a href="?mod=product&controller=indexCategory" title="" id="add-new" class="fl-left">Danh sách danh
                        mục</a>
                </div>
                <?php
                echo form_success('cat');
                ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="title" id="title"
                            value="<?php if (isset($category_info)) echo $category_info['cat_title']; ?>">
                        <?php echo form_error('title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug"
                            value="<?php if (isset($category_info)) echo $category_info['slug']; ?>">
                        <label for="parent_cat">Danh mục cha</label>
                        <select name="parent_cat" id="parent_cat">
                            <option value="">Chọn</option>
                            <?php
                            if (!empty($list_category)) {
                                foreach ($list_category as $item) {
                            ?>
                            <option
                                <?php if ($item['cat_id'] == $category_info['parent_id']) echo "selected='selected'" ?>
                                value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title'] ?></option>
                            <?php
                                }
                            }
                            ?>

                        </select>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>