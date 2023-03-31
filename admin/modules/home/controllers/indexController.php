<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('lib', 'pagging');

    $data['num_rows_delivering'] = get_num_rows("tbl_transaction", "`status` = '1'");
    $data['num_rows_waiting'] = get_num_rows("tbl_transaction", "`status` = '0'");
    $data['num_rows_delivered'] = get_num_rows("tbl_transaction", "`status` = '2'");
    $data['total_sales'] = get_total_sales();



    $num_per_page = 7;
    $data['num_rows'] = get_num_rows("tbl_users");
    $data['num_page'] = ceil($data['num_rows'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $data['list_customer'] = get_list_customer($start, $num_per_page);
    load_view('index', $data);
}

function listCustomerAction()
{
    load('lib', 'pagging');

    $num_per_page = 10;
    $data['num_rows'] = get_num_rows("tbl_users");
    $data['num_page'] = ceil($data['num_rows'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $data['list_customer'] = get_list_customer($start, $num_per_page);

    load_view('listCustomer', $data);
}

function editAction()
{
}