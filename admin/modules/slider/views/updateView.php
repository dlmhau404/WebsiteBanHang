<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
                <?php
                echo form_success('slider');
                ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tên slider</label>
                        <input type="text" name="title" id="title" value="<?php echo $info_slider['slider_name'] ?>">
                        <?php echo form_error('slider_name') ?>
                        <!-- <label for="title">Link</label>
                        <input type="text" name="slug" id="slug"> -->
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc"
                            class="ckeditor"><?php echo $info_slider['slider_desc'] ?></textarea>
                        <label for="title">Thứ tự</label>
                        <input type="text" name="num_order" id="num-order"
                            value="<?php echo $info_slider['order_by'] ?>">
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <img src="uploads/slider/<?php echo $info_slider['slider_thumb'] ?>">
                        </div>
                        <!-- <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1">Công khai</option>
                            <option value="2">Chờ duyệt</option>
                        </select> -->
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