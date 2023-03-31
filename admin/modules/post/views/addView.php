<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
                <?php
                echo form_success('post');
                ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tên bài viết</label>
                        <input type="text" name="post_title" id="title">
                        <?php echo form_error('post_title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="post_content" id="desc" class="ckeditor" rows="30"></textarea>
                        <?php echo form_error('post_content'); ?>
                        <label>Hình ảnh bài viết</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->

                            <!-- Xử lý saus -->
                            <!-- <img src="<?php if (isset($upload_file)) echo $upload_file;
                                            else echo 'public/images/img-thumb.png'; ?>"> -->
                        </div>
                        <label>Danh mục bài viết</label>
                        <select name="parent-Cat">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if (!empty($list_category)) {
                                foreach ($list_category as $item) {
                                    if ($item['parent_id'] == 0) {
                            ?>
                            <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title']; ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('cat'); ?>
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