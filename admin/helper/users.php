<?php
//Trả về true nếu đã login
function is_login()
{
    if (isset($_SESSION['is_login']))
        return true;
    return false;
}
//Trả về username của người login
function user_login()
{
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return false;
}
// Lấy họ và tên bởi username đăng nhập 
function get_fullname_by_username($username)
{
    $item = db_fetch_row("select * from `tbl_admin` where `username` = '{$username}'");
    return $item['fullname'];
}
function info_user($field)
{
    global $list_users;
    if (isset($_SESSION['is_login'])) {
        foreach ($list_users as $user) {
            if ($_SESSION['user_login'] == $user['username']) {
                if (array_key_exists($field, $user)) {
                    return $user[$field];
                }
            }
        }
    }
    return false;
}