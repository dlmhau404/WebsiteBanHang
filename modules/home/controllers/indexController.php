<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('lib', 'pagging');

    # Numrows
    $num_per_page = 4;
    $num_rows_ornament = get_num_rows_ornament();
    $num_rows_pareparts = get_num_rows_pareparts();
    $num_rows_volopxe = get_num_rows_volopxe();
    $num_rows_nhotxe = get_num_rows_nhotxe();

    # Number of page
    $data['num_page_ornament'] = ceil($num_rows_ornament / $num_per_page);
    $data['num_page_parepart'] = ceil($num_rows_pareparts / $num_per_page);
    $data['num_page_volopxe'] = ceil($num_rows_volopxe / $num_per_page);
    $data['num_page_nhotxe'] = ceil($num_rows_nhotxe / $num_per_page);

    # Get Page and Start
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $data['start'] = ($data['page'] - 1) * $num_per_page;

    $data['list_category'] = get_list_category();
    $data['list_product'] = get_list_product();
    $data['list_slider'] = get_list_slider();

    $data['get_list_product_pagging_ornament'] = get_list_product_pagging_ornament($data['start'], $num_per_page);
    $data['get_list_product_pagging_parepart'] = get_list_product_pagging_parepart($data['start'], $num_per_page);
    $data['get_list_product_pagging_volopxe'] = get_list_product_pagging_volopxe($data['start'], $num_per_page);
    $data['get_list_product_pagging_nhotxe'] = get_list_product_pagging_nhotxe($data['start'], $num_per_page);

    // $list_category = get_list_category();
    // $list_product = get_list_product();
    // $list_slider = get_list_slider();
    // $data = array(
    //     'list_product' => $list_product,
    //     'list_category' => $list_category,
    //     'list_slider' => $list_slider,
    // );
    load_view('index', $data);
}

function addAction()
{
}

function editAction()
{
}