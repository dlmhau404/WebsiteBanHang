<?php
// Thêm trang mới vào database
function add_page($data)
{
    db_insert('tbl_pages', $data);
}
// Lấy thông tin danh sách trang từ database
function get_info_list_page()
{
    $list_page = db_fetch_array("select * from `tbl_pages`");
    return $list_page;
}
// Cập nhật dữ liệu trang theo id
function update_page_by_id($id, $data)
{
    db_update("tbl_pages", $data, "`page_id` = {$id}");
}
// Lấy thông tin trang bằng id
function get_page_by_id($id)
{
    $page = db_fetch_row("select * from `tbl_pages` where `page_id` = {$id}");
    return $page;
}