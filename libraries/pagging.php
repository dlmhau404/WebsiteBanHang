<?php
function get_pagging_custom($num_page, $page, $base_url = "")
{

    $str_pagging = "<ul class='list-pagging fl-right clearfix'>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li data-page='{$page_prev}'><a href='{$base_url}&page={$page_prev}'><</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        // $active = "";
        // if($i == $page){
        //     $active = "class ='active'";
        // }
        $str_pagging .= "<li data-page='{$i}'><a href='{$base_url}&page={$i}'>{$i}</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li data-page='{$page_next}'><a href='{$base_url}&page={$page_next}'>></a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}
function get_pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul id='list-paging' class='fl-right'>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li class='ajax_pagging' data-id='{$page_prev}'><a href='{$base_url}&page={$page_prev}' title=''><<</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) {
            $active = "class='active'";
        }
        $str_pagging .=  "<li class='ajax_pagging' data-id='{$i}'><a {$active} href=\"{$base_url}&page={$i}\" title=\"\">{$i}</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li class='ajax_pagging' data-id='{$page_next}'><a href='{$base_url}&page={$page_next}' title=''>>></a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}