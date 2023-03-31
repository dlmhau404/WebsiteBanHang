<?php
function is_username($label_field)
{
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (!preg_match($partten, $_POST['username'], $matchs))
        return false;
    return true;
}
function is_password($label_field)
{
    $partten = "/^([A-Za-z0-9_\.!@#$%^&*()]){6,31}$/";
    if (!preg_match($partten, $_POST['password'], $matchs))
        return false;
    return true;
}
function is_email($label_field)
{
    $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (!preg_match($partten, $_POST['email'], $matchs))
        return false;
    return true;
}
function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field])) return "<p class='error'>$error[$label_field]</p>";
}
function set_value($label_field)
{
    global $$label_field;
    if (!empty($$label_field)) return $$label_field;
}

function form_success($label_field)
{
    global $success;
    if (!empty($success[$label_field])) return "<p class='success'>$success[$label_field]</p>";
}