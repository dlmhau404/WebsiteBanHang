<?php

// Thêm sản phẩm mới
function add_product($data)
{
    return db_insert("tbl_product", $data);
}

// Lấy danh sách danh mục bài viết
function get_list_category()
{
    return db_fetch_array("select `cat_0`.`cat_id`, if(`cat_1`.`cat_title` is null, `cat_0`.`cat_title` ,concat(`cat_1`.`cat_title`,' --- ',`cat_0`.`cat_title`)) `cat_title`, `cat_0`.`parent_id`,`cat_0`.`creator` 
    from `tbl_category` cat_0 
    LEFT JOIN `tbl_category` cat_1
    ON `cat_0`.`parent_id` = `cat_1`.`cat_id`");
}

// Lấy danh sách sản phẩm kết với bản category
function get_list_product($start, $num_per_page)
{
    return db_fetch_array("
    select `tbl_product`.*,`tbl_category`.* 
    from `tbl_product` 
    inner join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` LIMIT {$start}, {$num_per_page}");
}

// Lấy danh sách sản phẩm by keyword kết với bản category
function get_list_post_by_keyword($keyword)
{
    return db_fetch_array("
    select `tbl_product`.*,`tbl_category`.* 
    from `tbl_product` 
    inner join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_product`.`product_name` like '%{$keyword}%'");
}

// Function xóa sản phẩm theo mã sản phẩm
function delete_product_by_id($product_id)
{
    db_delete("tbl_product", "`product_id` = {$product_id}");
}

// // Function xóa sản phẩm theo mã sản phẩm
// function delete_image_by_id($product_id)
// {
//     db_delete("tbl_product_image", "`product_id` = {$product_id}");
// }

// Lấy thông tin sản phẩm by produce code kết với bảng category
function get_info_product_by_product_id($product_id)
{
    return db_fetch_row("select * from `tbl_product` where `product_id` = {$product_id}");
}

function update_product_by_id($product_id, $data)
{
    db_update("tbl_product", $data, "`product_id` = {$product_id}");
}

// Thêm ảnh chi tiết của sản phẩm
function insert_image_product($data)
{
    db_insert("tbl_product_image", $data);
}

// Cập nhật avartar của sản phẩm theo id
function update_product_thumb_by_id($product_id, $data)
{
    db_update("tbl_product", $data, "`product_id` = {$product_id}");
}

// Lấy danh sách ảnh chi tiết sản phẩm theo id
function get_list_image_product_by_id($id)
{
    return db_fetch_array("select * from `tbl_product_image` where `product_id` = {$id}");
}

function delete_list_image_product_by_id($id)
{
    db_delete("tbl_product_image", "`product_id` = {$id}");
}

function get_num_rows($table, $where = '')
{
    if (empty($where)) {
        $result = db_num_rows("SELECT * FROM `{$table}`");
        return $result;
    } else {
        $result = db_num_rows("SELECT * FROM `{$table}` WHERE {$where}");
        return $result;
    }
}
function get_list_product_pagging($start, $num_per_page)
{
    $result = db_fetch_array("select `tbl_product`.*,`tbl_category`.* 
    from `tbl_product` 
    inner join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` LIMIT {$start}, {$num_per_page}");
    return $result;
}