<?php

function construct()
{
    load_model('index');
}

// Danh sách slider
function indexAction()
{

    $list_slider = get_list_slider();
    $data = array(
        'list_slider' => $list_slider
    );
    load_view('index', $data);
}

// Thêm mới slider
function addAction()
{
    global $error, $slider_name, $slider_desc, $success;
    $error = array();
    if (isset($_FILES['file'])) {
        $upload_dir = "uploads/slider/";
        $upload_file = $upload_dir . $_FILES['file']['name'];
        $error = array();
        $type_allow = array('png', 'gif', 'jpeg', 'jpg');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($type), $type_allow)) {
            $error['file_type'] = 'Upload không đúng file ảnh';
        } else {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['file_size'] = 'Kích thước upload ảnh phải dưới 20MB';
            }

            if (file_exists($upload_file)) {
                //$error['file_exists'] = 'File đã tồn tại trong hệ thống';
                $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $new_file_name = $file_name . ' - Copy.';
                $new_upload_file = $upload_dir . $new_file_name . $type;
                $k = 1;
                while (file_exists($new_upload_file)) {
                    $new_file_name = $file_name . " - Copy({$k}).";
                    $k++;
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                }
                $upload_file = $new_upload_file;
            }
        }
        if (empty($error)) {
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
        }
    }

    if (isset($_POST['btn_add'])) {
        if (empty($_POST['title'])) {
            $error['slider_name'] = "Không được để trống trường tên slider";
        } else {
            $slider_name = $_POST['title'];
        }

        $slider_desc = $_POST['desc'];
        $order_by = $_POST['num_order'];

        if (empty($error)) {
            $data_add = array(
                'slider_name' => $slider_name,
                'slider_thumb' => $_FILES['file']['name'],
                'order_by' => $order_by,
                'slider_desc' => $slider_desc,
                'creator' => get_fullname_by_username(user_login()),
                'created_at' => time()
            );
            add_slider($data_add);
            $success['slider'] = "Thêm slider mới thành công";
        }
    }
    load_view('add');
}

// Xóa slider
function deleteAction()
{
    $slider_id = (int)$_GET['slider_id'];
    delete_slider_by_id($slider_id);
    redirect("?mod=slider");
}

// Cập nhập slider
function updateAction()
{
    $slider_id = (int)$_GET['slider_id'];
    $info_slider = get_info_slider_by_id($slider_id);

    global $error, $slider_name, $slider_desc, $success;
    $error = array();
    // Kiểm tra submit hình ảnh
    if (isset($_FILES['file'])  && $_FILES['file']['size'] > 0) {
        $upload_dir = "uploads/slider/";
        $upload_file = $upload_dir . $_FILES['file']['name'];
        $error = array();
        $type_allow = array('png', 'gif', 'jpeg', 'jpg');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($type), $type_allow)) {
            $error['file_type'] = 'Upload không đúng file ảnh';
        } else {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['file_size'] = 'Kích thước upload ảnh phải dưới 20MB';
            }

            if (file_exists($upload_file)) {
                //$error['file_exists'] = 'File đã tồn tại trong hệ thống';
                $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $new_file_name = $file_name . ' - Copy.';
                $new_upload_file = $upload_dir . $new_file_name . $type;
                $k = 1;
                while (file_exists($new_upload_file)) {
                    $new_file_name = $file_name . " - Copy({$k}).";
                    $k++;
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                }
                $upload_file = $new_upload_file;
            }
        }
        if (empty($error)) {
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
        }
    }

    // Kiểm tra thông tin cập nhật hình ảnh
    if (isset($_POST['btn_update'])) {
        if (empty($_POST['title'])) {
            $error['slider_name'] = "Không được để trống trường tên slider";
        } else {
            $slider_name = $_POST['title'];
        }

        $slider_desc = $_POST['desc'];
        $order_by = $_POST['num_order'];

        if (empty($error)) {
            // Kiểm tra trùng tên file khi cập nhật
            $file_name_update = $_FILES['file']['name'];
            if (!empty($new_file_name)) {
                $file_name_update = $new_file_name;
            }
            $data_update = array(
                'slider_name' => $slider_name,
                'slider_thumb' => isset($upload_file) ? $file_name_update : $info_slider['slider_thumb'],
                'order_by' => $order_by,
                'slider_desc' => $slider_desc
            );
            update_slider($slider_id, $data_update);
            $success['slider'] = "Cập nhật thông tin slider thành công";
            $info_slider = $data_update;
        }
    }

    $data = array(
        'info_slider' => $info_slider
    );
    load_view('update', $data);
}