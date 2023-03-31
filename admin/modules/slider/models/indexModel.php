<?php

// Thêm slider vào database
function add_slider($data){
    db_insert("tbl_slider",$data);
}

// Lấy danh sách slider
function get_list_slider(){
    return db_fetch_array("select * from `tbl_slider`");
}

// Xóa slider theo id
function delete_slider_by_id($id){
    db_delete("tbl_slider","`slider_id` = {$id}");
}

// Lấy thông tin slider theo id
function get_info_slider_by_id($id){
    return db_fetch_row("select * from `tbl_slider` where `slider_id` = {$id}");
}

// 
function update_slider($id,$data){
    db_update("tbl_slider",$data,"`slider_id` = {$id}");
}