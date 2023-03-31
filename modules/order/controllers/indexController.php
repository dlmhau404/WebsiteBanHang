<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $username = user_login();
    // echo $username;
    $data['info_order'] = get_info_order($username);
    load_view('index', $data);
}

function detailOrderAction()
{
    $transaction_code = $_GET['transaction'];
    // echo $transaction_code;
    // $data['transaction_info'] = get_transaction_info($transaction_code);
    $data['list_order_product'] = get_list_order_product($transaction_code);

    load_view('detailOrder', $data);
}