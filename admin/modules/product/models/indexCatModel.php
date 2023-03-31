<?php
// Thêm danh mục
function add_category($data)
{
    db_insert("tbl_category", $data);
}

// Lấy danh sách danh mục bài viết
function get_list_category()
{
    return db_fetch_array("select `cat_0`.`cat_id`, if(`cat_1`.`cat_title` is null, `cat_0`.`cat_title` ,concat(`cat_1`.`cat_title`,' --- ',`cat_0`.`cat_title`)) `cat_title`, `cat_0`.`parent_id`,`cat_0`.`creator`,`cat_0`.`created_date`
    from `tbl_category` cat_0 
    LEFT JOIN `tbl_category` cat_1
    ON `cat_0`.`parent_id` = `cat_1`.`cat_id`");
}


// Xóa danh mục bởi cat id
function delete_category_by_cat_id($cat_id)
{
    db_delete("tbl_category", "`cat_id` = {$cat_id}");
}

// Lấy thông tin category bằng cat_id
function get_info_category_by_cat_id($cat_id)
{
    return db_fetch_row("select * from `tbl_category` where `cat_id` = {$cat_id}");
}

// Cập nhật danh mục bài viết bởi cat id
function update_category_by_cat_id($cat_id, $data)
{
    db_update("tbl_category", $data, "`cat_id` = {$cat_id}");
}

// Lấy level của danh mục theo cat_id
function get_level_by_cat_id($cat_id)
{
    $item = db_fetch_row("select `level` from `tbl_category` where `cat_id` = {$cat_id}");
    return $item['level'];
}

// Lấy danh sách cây danh mục
function get_list_category_tree()
{
    return db_fetch_array("SELECT `cat_id`id,`cat_title` 'text',if(parent_id = 0, '#', `parent_id`) parent FROM `tbl_category`;");
}