<?php

// Lấy thông tin sản phẩm theo id
function get_info_product_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id` = {$id}");
    // $result['url_detail'] = "?mod=products&action=detail&id={$result['id']}";
    if (!empty($result))
        return $result;

    return false;
}
function get_user_id($user_login)
{
    $result = db_fetch_row("SELECT `id` FROM `tbl_users` WHERE `username` = '{$user_login}'");
    if (!empty($result))
        return $result['id'];

    return false;
}
function add_transaction($data)
{
    db_insert("tbl_transaction", $data);
}

function add_order($data)
{
    db_insert("tbl_order", $data);
}

function get_info_customer($username)
{
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    // $result['url_detail'] = "?mod=products&action=detail&id={$result['id']}";
    if (!empty($result))
        return $result;

    return false;
}