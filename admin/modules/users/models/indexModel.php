<?php
function update_user_login($username, $data)
{
    db_update('tbl_admin', $data, "`username` = '{$username}'");
}

function get_user_by_username($username)
{
    $item = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `username` = '{$username}'");
    if (!empty($item))
        return $item;
}

function update_pass($data, $reset_token)
{
    db_update('tbl_admin', $data, "`reset_token` = '{$reset_token}'");
}

function check_reset_token($reset_token)
{
    $check = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `reset_token` = '{$reset_token}'");
    if ($check > 0)
        return true;
    return false;
}

function update_reset_token($data, $email)
{
    db_update('tbl_admin', $data, "`email` = '{$email}'");
}

function check_email($email)
{
    $check = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `email` = '{$email}'");
    if ($check > 0)
        return true;
    return false;
}

function check_login($username, $password)
{
    $check_user = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if ($check_user > 0)
        return true;
    return false;
}

function add_user($data)
{
    return db_insert('tbl_users', $data);
}
function user_exists($username, $email)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_admin` WHERE `email` = '{$email}' OR `username` = '{$username}'");
    echo $check_user;
    if ($check_user > 0)
        return true;
    return false;
}
function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_admin`");
    return $result;
}

function get_user_by_id()
{
    $id = (int)$_GET['id'];
    $result = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `user_id` = $id");
    return $result;
}
// function active_user($active_token)
// {
//     return db_update('tbl_admin', array('is_active' => 1), "`active_token`='{$active_token}'");
// }
// function check_active_token($active_token)
// {
//     $check = db_num_rows("SELECT * FROM `tbl_admin` WHERE `active_token` = '{$active_token}' AND `is_active`='0'");
//     if ($check > 0)
//         return true;
//     return false;
// }