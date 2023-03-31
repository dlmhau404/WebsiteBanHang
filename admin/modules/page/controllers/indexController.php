<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $list_page = get_info_list_page();
    $data = array(
        'list_page' => $list_page
    );
    load_view('index', $data);
}

function add_pageAction()
{
    global $error, $success;
    if (isset($_POST['btn-add-page'])) {
        $error = array();
        if (empty($_POST['page-title'])) {
            $error['page-title'] = "Không được để trống tiêu đề";
        } else {
            $page_title = $_POST['page-title'];
        }

        $slug = $_POST['slug'];

        $page_desc = $_POST['page-desc'];

        if (empty($error)) {
            $creator = get_fullname_by_username(user_login());
            $data = array(
                'page_title' => $page_title,
                'slug' => $slug,
                'creator' => $creator,
                'created_date' => time(),
                'content' => $page_desc
            );
            add_page($data);
            $success['page'] = "Thêm trang mới thành công";
        }
    }
    // echo date('d/m/Y');
    load_view('add_page');
}

function update_pageAction()
{
    $id = (int) $_GET['id'];
    global $error, $success;
    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống trường tiêu đề";
        } else {
            $title = $_POST['title'];
        }
        $slug = $_POST['slug'];
        $content = $_POST['desc'];

        if (empty($error)) {
            $data = array(
                'page_title' => $title,
                'slug' => $slug,
                'content' => $content
            );
            update_page_by_id($id, $data);
            $success['page'] = "Cập nhật trang thành công";
        }
    }

    $page = get_page_by_id($id);
    $data = array(
        'page' => $page
    );
    load_view('update_page', $data);
}

function delete_pageAction()
{
}