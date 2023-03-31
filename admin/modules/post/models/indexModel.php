<?php

// Thêm bài viết vào database
function add_post($data){
    db_insert("tbl_post",$data);
}

// Lấy danh sách bài viết
function get_list_post(){
    return db_fetch_array("select `tbl_post`.*,`tbl_category`.`cat_title` from `tbl_post` inner join `tbl_category` on `tbl_post`.`cat_id` =  `tbl_category`.`cat_id`");
}

//Lấy thông tin bài biết by id
function get_info_post_by_id($post_id){
    return db_fetch_row("select * from `tbl_post` where `post_id` = {$post_id}");
}

// Cập nhật bài viết theo id
function update_post($post_id, $data){
    db_update('tbl_post',$data,"`post_id`= {$post_id}");
}

// Xóa bài viết theo id
function delete_post_by_id($post_id){
    db_delete("tbl_post","`post_id` = {$post_id}");
}