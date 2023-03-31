<?php
function get_info_order($username)
{
    return db_fetch_array("select * from `tbl_transaction` where `username` = '{$username}'");
}
function get_list_order_product($transaction_code)
{

    $list_order_product = array();

    $transaction_order = db_fetch_array("SELECT * FROM `tbl_order` WHERE `transaction_code` = '{$transaction_code}'");

    foreach ($transaction_order as $item) {
        $id = $item['product_id'];
        $list_order_product[] = array(
            'detail' => db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id` = '{$id}'"),
            'quantity' => $item['quantity'],
            'sub_total' => $item['sub_total'],
        );
    }
    return $list_order_product;
}