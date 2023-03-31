<?php

use GuzzleHttp\Promise\Is;

function construct()
{
    load_model('index');
}

// Danh sách sản phẩm của tất cả danh mục
function indexAction()
{
    $list_product = get_list_product();
    $list_category = get_list_category();
    $data = array(
        'list_product' => $list_product,
        'list_category' => $list_category
    );
    load_view('index', $data);
}

// Danh sách sản phẩm của từng danh mục
function cat_productAction()
{
    $cat_id = (int)$_GET['cat_id'];
    $list_product = get_list_product_by_cat_id($cat_id);
    $list_category = get_list_category();
    $info_category = get_info_category_by_cat_id($cat_id);
    if (isset($_POST['btn_filter'])) {
        $filter = $_POST['filter'];
        if ($filter == 1) {
            $list_product = get_list_product_filter_product_name_az($cat_id);
        } else if ($filter == 2) {
            $list_product = get_list_product_filter_product_name_za($cat_id);
        } else if ($filter == 3) {
            $list_product = get_list_product_filter_price_asc($cat_id);
        } else if ($filter == 4) {
            $list_product = get_list_product_filter_price_desc($cat_id);
        }
    }
    $data = array(
        'info_category' => $info_category,
        'list_category' => $list_category,
        'list_product' => $list_product
    );
    load_view('cat_product', $data);
}

// Chi tiết sản phẩm
function detailAction()
{
    $id = (int)$_GET['id'];

    $product = get_info_product_by_id($id);
    $cat_id = $product['cat_id'];
    $list_product = get_list_product_by_cat_id($cat_id);

    $list_category = get_list_category();
    $info_product = get_info_product_by_id($id);
    $list_product_image = get_list_image_product_by_id($id);
    $data = array(
        'list_category' => $list_category,
        'info_product' => $info_product,
        'list_product_image' => $list_product_image,
        'list_product' => $list_product
    );
    load_view('detail', $data);
}

// Tìm kiếm sản phẩm
function searchAction()
{
    if (isset($_GET['btn_search'])) {
        if (empty($_GET['q'])) {
            redirect("?");
        } else {
            $list_category = get_list_category();
            $q = $_GET['q'];
            $list_product = get_list_product_by_key_word($q);
        }
    }
    $data = array(
        'list_product' => $list_product,
        'list_category' => $list_category
    );
    load_view('search', $data);
}