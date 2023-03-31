<?php
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
//Lấy tổng doanh số
function get_total_sales()
{
    $item = db_fetch_row("select sum(`sub_total`) total_sales from `tbl_order`");
    return $item['total_sales'];
}
function get_list_customer($start, $num_per_page)
{
    $result = db_fetch_array("SELECT * FROM `tbl_users` LIMIT {$start}, {$num_per_page}");
    if (!empty($result)) {
        foreach ($result as &$user) {
            $user['url_edit'] = "?mod=customers&action=editUser&id={$user['id']}";
            $user['url_delete'] = "?mod=customers&action=deleteUser&id={$user['id']}";
        }
        return $result;
    };
    return false;
}
function get_user_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `id` = {$id}");
    if (!empty($result))
        return $result;
    return false;
}

function edit_user($data, $id)
{
    $check = db_update("tbl_users", $data, "`id` = {$id}");
    if ($check)
        return true;
    return false;
}

function delete_user($id)
{
    $check = db_delete("tbl_users", "`id` = {$id}");
    if ($check)
        return true;
    return false;
}