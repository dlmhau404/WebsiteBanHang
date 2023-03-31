<?php

function construct(){
    load_model('index');
}

function indexAction(){
    $list_product = get_list_product();
    $list_post = get_list_post();
    $data = array(
        'list_post' => $list_post,
        'list_product' => $list_product
    );
    load_view('index',$data);
}

function detailAction(){
    $id = (int)$_GET['id'];
    $info_post = get_info_post_by_id($id);
    $list_product = get_list_product();
    $data = array(
        'list_product' => $list_product,
        'info_post' => $info_post
    );
    load_view('detail',$data);
}