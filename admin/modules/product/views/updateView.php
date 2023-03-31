<?php
get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm sản phẩm</h3>
                    <a href="?mod=product" title="" id="add-new" class="fl-left">Danh sách sản phẩm</a>
                </div>
                <?php echo form_success('product'); ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name"
                            value="<?php echo $info_product['product_name']; ?>">
                        <?php echo form_error('product_name'); ?>
                        <label for="slug">Slug (link thân thiện)</label>
                        <input type="text" name="slug" id="product-name"
                            value="<?php echo $info_product['slug_product']; ?>">
                        <?php echo form_error('slug'); ?>
                        <label for="code">Mã sản phẩm</label>
                        <input type="text" name="code" id="code" value="<?php echo $info_product['code']; ?>">
                        <?php echo form_error('code'); ?>
                        <label for="price">Giá bán hiện tại của sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo $info_product['price']; ?>">
                        <?php echo form_error('price'); ?>
                        <label for="original_price">Giá gốc của sản phẩm</label>
                        <input type="text" name="original_price" id="original_price"
                            value="<?php echo (int)$info_product['original_price']; ?>">
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="desc" id="desc"><?php echo $info_product['desc_short']; ?></textarea>
                        <label for="desc">Chi tiết</label>
                        <textarea name="detail" id="desc"
                            class="ckeditor"><?php echo $info_product['product_detail']; ?></textarea>
                        <label>Hình ảnh sản phẩm</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <img src="uploads/product/<?php echo $info_product['product_thumb'] ?>" alt="">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->

                            <!-- Xử lý saus -->
                            <!-- <img src="<?php if (isset($upload_file)) echo $upload_file;
                                            else echo 'public/images/img-thumb.png'; ?>"> -->
                        </div>
                        <label>Hình ảnh chi tiết</label>
                        <div id="uploadFile">
                            <input type="file" name="files[]" id="upload-thumb" multiple="multiple">
                            <div class="row">
                                <?php
                                foreach ($list_image_product as $value) {
                                ?>
                                <div class="col-md-4" style="max-width: 200px">
                                    <a href="#" class="thumbnail">
                                        <img src="uploads/product/<?php echo $value['link_image']; ?>" alt="">
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <input type="checkbox" name="outstanding_product" id="outstanding_product"
                            <?php if ($info_product['outstanding_product'] == 1) echo "checked='checked'" ?>>
                        <label for="outstanding_product" style="display: inline-block">Sản phẩm nổi bật</label>
                        <br>
                        <input type="checkbox" name="celling_product" id="celling_product"
                            <?php if ($info_product['celling_product'] == 1) echo "checked='checked'" ?>>
                        <label for="celling_product" style="display: inline-block">Sản phẩm bán chạy</label>

                        <label>Danh mục sản phẩm</label>
                        <select name="parent_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            foreach ($list_category as $item) {
                            ?>
                            <option <?php if ($info_product['cat_id'] == $item['cat_id']) echo "selected='selected'"; ?>
                                value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <!-- <label>Trạng thái</label>
                                    <select name="status">
                                        <option value="0">-- Chọn danh mục --</option>
                                        <option value="1">Chờ duyệt</option>
                                        <option value="2">Đã đăng</option>
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