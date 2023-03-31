<?php
function construct()
{
    load_model('index');
    load_model('indexCat');
}

function indexAction()
{
    $list_post = get_list_post();
    $data = array(
        'list_post' => $list_post
    );
    load_view('index', $data);
}

function addAction()
{
    global $error, $title, $success, $upload_file;
    // Kiểm tra upload ảnh
    if (isset($_FILES['file'])) {
        $upload_dir = "uploads/post/";
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
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                // echo "<img src='{$upload_file}'/><br>";
                // echo "<a href='{$upload_file}'>Download: {$_FILES['file']['name']}</a>";
            }
        }
    }

    // Kiểm tra submit
    if (isset($_POST['btn_add'])) {
        $error = array();
        $slug = $_POST['slug'];

        $post_title = $_POST['post_title'];

        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Không được để trống trường tiêu đề bài viết";
        } else {
            $post_title = $_POST['post_title'];
        }

        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Không được để trống trường nội dung bài viết";
        } else {
            $content = $_POST['post_content'];
        }

        if (empty($_POST['parent-Cat'])) {
            $error['cat'] = "Vui lòng chọn danh mục của bài viết";
        } else {
            $cat_id = $_POST['parent-Cat'];
        }


        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $data = array(
                'post_title' => $post_title,
                'slug' => $slug,
                'created_at' => time(),
                'creator' => $fullname,
                'post_content' => $content,
                'post_thumb' => $_FILES['file']['name'],
                'cat_id' => $cat_id
            );
            add_post($data);
            $success['post'] = "Thêm bài viết mới thành công";
        }
    }
    // Lấy danh sách category
    $list_category = get_list_category();

    $data = array(
        // 'upload_file' => $upload_file,
        'list_category' => $list_category
    );
    load_view('add', $data);
}

function updateAction()
{
    $post_id = (int)$_GET['post_id'];
    $info_post = get_info_post_by_id($post_id);
    $list_category = get_list_category();
    global $error, $title, $success, $upload_file;

    // show_array($_FILES);
    // Kiểm tra upload ảnh
    if ((isset($_FILES['file']))  && ($_FILES['file']['size'] > 0)) {
        $upload_dir = "uploads/post/";
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
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                // echo "<img src='{$upload_file}'/><br>";
                // echo "<a href='{$upload_file}'>Download: {$_FILES['file']['name']}</a>";
            }
        }
    }

    // Kiểm tra submit
    if (isset($_POST['btn_update'])) {
        $error = array();
        $slug = $_POST['slug'];
        $post_title = $_POST['post_title'];
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Không được để trống trường tiêu đề bài viết";
        } else {
            $post_title = $_POST['post_title'];
        }
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Không được để trống trường nội dung bài viết";
        } else {
            $content = $_POST['post_content'];
        }

        if (empty($_POST['parent-Cat'])) {
            $error['cat'] = "Vui lòng chọn danh mục của bài viết";
        } else {
            $cat_id = $_POST['parent-Cat'];
        }


        if (empty($error)) {
            // Kiểm tra trùng tên file khi cập nhật
            $file_name_update = $_FILES['file']['name'];
            if (!empty($new_file_name)) {
                $file_name_update = $new_file_name;
            }
            $data_update = array(
                'post_title' => $post_title,
                'slug' => $slug,
                'post_content' => $content,
                'post_thumb' => isset($upload_file) ? $file_name_update : $info_post['post_thumb'],
                'cat_id' => $cat_id
            );
            update_post($post_id, $data_update);
            $info_post = $data_update;
            $success['post'] = "Cập nhật bài viết mới thành công";
        }
    }
    $data = array(
        'list_category' => $list_category,
        'info_post' => $info_post
    );
    // show_array($data);
    load_view('update', $data);
}

function deleteAction()
{
    $post_id = (int)$_GET['post_id'];
    delete_post_by_id($post_id);
    redirect("?mod=post");
}