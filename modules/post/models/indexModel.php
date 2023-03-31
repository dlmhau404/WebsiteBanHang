<?php

// Lấy danh sách sản phẩm
function get_list_product(){
    return db_fetch_array('select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    ');
}

// Lấy danh sách bài viết
function get_list_post(){
    return db_fetch_array("select * from `tbl_post`");
}

// Lấy thông tin bài viết theo id
function get_info_post_by_id($id){
    return db_fetch_row("select * from `tbl_post` where `post_id` = {$id}");
}