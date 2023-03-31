<?php

use Aws\Common\Enum\Time;

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('lib', 'pagging');
    $data['num_rows'] = get_num_rows("tbl_product");
    $num_per_page = 4;
    // echo $num_per_page;
    $data['num_page'] = ceil($data['num_rows'] / $num_per_page);

    $data['page'] = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $data['start'] = ($data['page'] - 1) * $num_per_page;

    // $data['list_product_pagging'] = get_list_product_pagging($start, $num_per_page);

    $data['list_product'] = get_list_product($data['start'], $num_per_page);
    if (isset($_POST['search'])) {
        $keyword = $_POST['search'];
        // Lấy danh sách sản phẩm tìm kiếm theo tên
        $data['list_product'] = get_list_post_by_keyword($keyword);
    }
    // $data = array(
    //     'list_product' => $list_product
    // );
    load_view('index', $data);
}

function addAction()
{
    global $error, $success, $product_name, $price;
    //Kiểm tra submit ảnh sản phẩm
    if (isset($_FILES['file'])) {
        $upload_dir = "uploads/product/";
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
    //Kiểm tra submit ảnh chi tiết sản phẩm
    if (isset($_FILES['files'])) {
        $total = count($_FILES['files']['name']);
        //Loop through each file
        for ($i = 0; $i < $total; $i++) {
            $upload_dir = "uploads/product/";
            $upload_file = $upload_dir . $_FILES['files']['name'][$i];
            $error = array();
            $type_allow = array('png', 'gif', 'jpeg', 'jpg');
            $type = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) {
                $error['file_type'] = 'Upload không đúng file ảnh';
            } else {
                $file_size = $_FILES['files']['size'][$i];
                if ($file_size > 29000000) {
                    $error['file_size'] = 'Kích thước upload ảnh phải dưới 20MB';
                }

                if (file_exists($upload_file)) {
                    $file_name = pathinfo($_FILES['files']['name'][$i], PATHINFO_FILENAME);
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
                move_uploaded_file($_FILES['files']['tmp_name'][$i], $upload_file);
            }
        }
    }

    if (isset($_POST['btn_add'])) {
        $error = array();
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống trường tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }

        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống trường giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }

        $code = $_POST['code'];

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống trường link thân thiện";
        } else {
            $slug = $_POST['slug'];
        }

        if (isset($_POST['outstanding_product'])) {
            $outstanding_product = 1;
        } else {
            $outstanding_product = 0;
        }

        if (isset($_POST['celling_product'])) {
            $celling_product = 1;
        } else {
            $celling_product = 0;
        }

        $original_price = $_POST['original_price'];
        $desc_short = $_POST['desc'];
        $detail = $_POST['detail'];
        $cat_id = (int)$_POST['category_id'];
        // $status = $_POST['status'];
        $creator = get_fullname_by_username(user_login());
        if (empty($error)) {
            $data_product = array(
                'product_name' => $product_name,
                'slug_product' => $slug,
                'price' => $price,
                'code' => $code,
                'original_price' => $original_price,
                'desc_short' => $desc_short,
                'product_detail' => $detail,
                'product_thumb' => $_FILES['file']['name'],
                'cat_id' => $cat_id,
                'celling_product' => $celling_product,
                'outstanding_product' => $outstanding_product,
                // 'status' => $status,
                'creator' => $creator,
                'created_at' => time()
            );
            $product_id = add_product($data_product);

            // Thêm ảnh chi tiết sản phẩm
            $list_file_name = $_FILES['files']['name'];
            foreach ($list_file_name as $item) {
                $data_product_image = array(
                    'product_id' => $product_id,
                    'link_image' => $item
                );
                insert_image_product($data_product_image);
            }
            $success['product'] = "Thêm sản phẩm thành công";
        }
    }
    $list_category = get_list_category();
    $data = array(
        'list_category' => $list_category
    );
    // show_array($list_category);
    load_view('add', $data);
}

// Cập nhật sản phẩm
function updateAction()
{
    global $error, $success, $product_name, $price;
    $id = (int) $_GET['product_id'];
    $info_product = get_info_product_by_product_id($id);
    $list_image_product = get_list_image_product_by_id($id);
    // show_array($_FILES['files']);
    //Kiểm tra submit ảnh sản phẩm
    if (isset($_FILES['file'])  && ($_FILES['file']['size'] > 0)) {
        $upload_dir = "uploads/product/";
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
    //Kiểm tra submit ảnh chi tiết sản phẩm
    if (isset($_FILES['files'])  && ($_FILES['files']['size'] > 0)) {
        $total = count($_FILES['files']['name']);
        //Loop through each file
        for ($i = 0; $i < $total; $i++) {
            $upload_dir = "uploads/product/";
            $upload_file = $upload_dir . $_FILES['files']['name'][$i];
            $error = array();
            $type_allow = array('png', 'gif', 'jpeg', 'jpg');
            $type = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) {
                $error['file_type'] = 'Upload không đúng file ảnh';
            } else {
                $file_size = $_FILES['files']['size'][$i];
                if ($file_size > 29000000) {
                    $error['file_size'] = 'Kích thước upload ảnh phải dưới 20MB';
                }

                if (file_exists($upload_file)) {
                    $file_name = pathinfo($_FILES['files']['name'][$i], PATHINFO_FILENAME);
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
                move_uploaded_file($_FILES['files']['tmp_name'][$i], $upload_file);
            }
        }
    }

    if (isset($_POST['btn_update'])) {
        $error = array();

        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống trường tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }

        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống trường giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống trường link thân thiện";
        } else {
            $slug = $_POST['slug'];
        }

        if (isset($_POST['outstanding_product'])) {
            $outstanding_product = 1;
        } else {
            $outstanding_product = 0;
        }

        if (isset($_POST['celling_product'])) {
            $celling_product = 1;
        } else {
            $celling_product = 0;
        }

        $code = $_POST['code'];
        $original_price = $_POST['original_price'];
        $desc_short = $_POST['desc'];
        $detail = $_POST['detail'];
        $cat_id = $_POST['parent_id'];
        // $status = $_POST['status'];
        if (empty($error)) {
            $data_product = array(
                'product_name' => $product_name,
                'slug_product' => $slug,
                'price' => $price,
                'code' => $code,
                'original_price' => $original_price,
                'desc_short' => $desc_short,
                'product_detail' => $detail,
                'product_thumb' => !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : $info_product['product_thumb'],
                'cat_id' => $cat_id,
                'outstanding_product' => $outstanding_product,
                'celling_product' => $celling_product,
                // 'status' => $status,
                // 'updated_user' => get_fullname_by_username(user_login()),
                // 'updated_at' => time()
            );
            update_product_by_id($id, $data_product);
            // Thêm ảnh chi tiết sản phẩm
            $list_file_name = $_FILES['files']['name'];
            if (isset($_FILES['files'])  && $_FILES['files']['size'][0] > 0 && !empty($_FILES['files']['name'][0])) {
                delete_list_image_product_by_id($id);
                foreach ($list_file_name as $item) {
                    $data_product_image = array(
                        'product_id' => $id,
                        'link_image' => $item
                    );
                    insert_image_product($data_product_image);
                }
            }
            $success['product'] = "Cập nhật sản phẩm thành công";
            $info_product = $data_product;
        }
    }
    $list_category = get_list_category();
    $data = array(
        'list_category' => $list_category,
        'info_product' => $info_product,
        'list_image_product' => $list_image_product
    );
    load_view('update', $data);
}

// Xóa sản phẩm
function deleteAction()
{
    $product_id = (int)$_GET['product_id'];
    delete_list_image_product_by_id($product_id);
    delete_product_by_id($product_id);
    redirect("?mod=product");
}