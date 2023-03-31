<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
                <?php echo form_success('product'); ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name">
                        <?php echo form_error('product_name'); ?>
                        <label for="slug">Slug (link thân thiện)</label>
                        <input type="text" name="slug" id="product-name">
                        <?php echo form_error('slug'); ?>
                        <label for="code">Mã sản phẩm</label>
                        <input type="text" name="code" id="code">
                        <?php echo form_error('code'); ?>
                        <label for="price">Giá bán hiện tại của sản phẩm</label>
                        <input type="text" name="price" id="price">
                        <?php echo form_error('price'); ?>

                        <label for="original_price">Giá gốc của sản phẩm</label>
                        <input type="text" name="original_price" id="original_price">

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="desc" id="desc"></textarea>
                        <label for="desc">Chi tiết</label>
                        <textarea name="detail" id="desc" class="ckeditor"></textarea>
                        <label>Hình ảnh sản phẩm</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->

                            <!-- Xử lý saus -->
                            <!-- <img src="<?php if (isset($upload_file)) echo $upload_file;
                                            else echo 'public/images/img-thumb.png'; ?>"> -->
                        </div>
                        <label>Hình ảnh chi tiết</label>
                        <div id="uploadFile">
                            <input type="file" name="files[]" id="upload-thumb" multiple="multiple">
                        </div>
                        <input type="checkbox" name="outstanding_product" id="outstanding_product">
                        <label for="outstanding_product" style="display: inline-block">Sản phẩm nổi bật</label>
                        <br>
                        <input type="checkbox" name="celling_product" id="celling_product">
                        <label for="celling_product" style="display: inline-block">Sản phẩm bán chạy</label>

                        <?php
                        if (!empty($list_category)) {
                        ?>
                        <label>Danh mục sản phẩm</label>
                        <select name="category_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                                foreach ($list_category as $item) {
                                ?>
                            <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title'] ?></option>
                            <?php
                                }
                                ?>
                        </select>
                        <?php
                        }
                        ?>


                        <!-- <label>Trạng thái</label>
                        <select name="status">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="1">Chờ duyệt</option>
                            <option value="2">Đã đăng</option>
                        </select> -->
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