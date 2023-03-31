<?php
// Lấy danh sách sản phẩm thep phan trang
function get_list_product_pagging_ornament($start, $num_per_page)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `tbl_category`.`cat_id` = 1 OR `tbl_category`.`parent_id` = 1 LIMIT {$start}, {$num_per_page}");
}
function get_list_product_pagging_parepart($start, $num_per_page)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `tbl_category`.`cat_id` = 14 OR `tbl_category`.`parent_id` = 14 LIMIT {$start}, {$num_per_page}");
}

function get_list_product_pagging_volopxe($start, $num_per_page)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `tbl_category`.`cat_id` = 21 OR `tbl_category`.`parent_id` = 21 LIMIT {$start}, {$num_per_page}");
}

function get_list_product_pagging_nhotxe($start, $num_per_page)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `tbl_category`.`cat_id` = 26 OR `tbl_category`.`parent_id` = 26 LIMIT {$start}, {$num_per_page}");
}

// Lấy danh sách sản phẩm
function get_list_product()
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`");
}

// Lấy danh sách danh mục 
function get_list_category()
{
    return db_fetch_array("select *, IF( EXISTS(
        SELECT *
        FROM `tbl_category` `B`
        WHERE `B`.`parent_id` = `A`.`cat_id` ), 1, 0) is_has_child from `tbl_category` `A`;");
}

// // Lấy danh sách dịch vụ
// function get_list_service(){
//     return db_fetch_array("select * from `tbl_service`");
// }

// Lấy danh sách slider 
function get_list_slider()
{
    return db_fetch_array("select * from `tbl_slider` order by `order_by` asc");
}

//Lấy tổng ds theo loại để phân trang
function get_num_rows_ornament()
{
    $result =  db_num_rows("
    select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  1 OR `tbl_category`.`parent_id` = 1");
    return $result;
}

function get_num_rows_pareparts()
{
    $result =  db_num_rows("
    select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  14 OR `tbl_category`.`parent_id` = 14");
    return $result;
}

function get_num_rows_volopxe()
{
    $result =  db_num_rows("
    select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  21 OR `tbl_category`.`parent_id` = 21");
    return $result;
}

function get_num_rows_nhotxe()
{
    $result =  db_num_rows("
    select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  26 OR `tbl_category`.`parent_id` = 26");
    return $result;
}