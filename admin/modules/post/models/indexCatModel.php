<?php
// Thêm danh mục
function add_category($data){
    db_insert("tbl_category",$data);
}

// Lấy danh sách danh mục bài viết
function get_list_category(){
    return db_fetch_array("select * from `tbl_category`");
}

// Xóa danh mục bởi cat id
function delete_category_by_cat_id($cat_id){
    db_delete("tbl_category","`cat_id` = {$cat_id}");
}

// Lấy thông tin category bằng cat_id
function get_info_category_by_cat_id($cat_id){
    return db_fetch_row("select * from `tbl_category` where `cat_id` = {$cat_id}");
}

// Cập nhật danh mục bài viết bởi cat id
function update_category_by_cat_id($cat_id,$data){
    db_update("tbl_category",$data,"`cat_id` = {$cat_id}");
}