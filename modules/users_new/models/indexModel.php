<?php

# Function for user

function add_user($data)
{
    return db_insert('tbl_users', $data);
}

function user_exists($username, $email)
{
    $check_user = db_num_rows("SELECT * FROM tbl_users WHERE username = '{$username}' OR email = '{$email}'");
    if ($check_user > 0) {
        return true;
    }
    return false;
}

function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    foreach ($result as &$user) {
        $user['url_update'] = "?mod=users&controller=index&action=update&id={$user['id']}";
        $user['url_delete'] = "?mod=users&controller=index&action=delete&id={$user['id']}";
    }
    return $result;
}

function get_user_info($user_login)
{
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$user_login}'");
    if (!empty($result)) return $result;

    return false;
}

function update_user_info($data, $username)
{
    db_update("tbl_users", $data, "`username` = '{$username}'");
}

# Function for control the User panel

function check_login($username, $password)
{
    $password = md5($password);
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username} ' AND `password` = '{$password}' AND `is_active` = '1'");
    if ($check_user == 1) return true;

    return false;
}

function check_token($active_token)
{
    $check_token = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` = '$active_token'");
    if ($check_token == 1) {
        return true;
    }
    return false;
}

function active_user($active_token)
{
    $data['is_active'] = 1;
    $where = "`active_token` = '{$active_token}' AND `is_active` = '0'";
    return db_update('tbl_users', $data, $where);
}

function check_email($email)
{
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
    if ($result == 1) {
        return true;
    }
    return false;
}

function update_reset_token($data, $email)
{
    db_update('tbl_users', $data, "`email` = '{$email}'");
}

function check_reset_token($reset_token)
{
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_token` = '{$reset_token}'");
    if ($result == 1) {
        return true;
    }
    return false;
}

function update_pass($data, $reset_token)
{
    db_update('tbl_users', $data, "`reset_token` = '{$reset_token}'");
}

# Function Global for All

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

function get_url_upload_image($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_page` WHERE `id` = {$id}");
    return $result['page_thumbnail'];
}

function is_exists($table, $key, $value)
{
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0) return true;

    return false;
}