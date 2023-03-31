<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div id="wp-form-login">
        <h1>ĐĂNG KÝ TÀI KHOẢN</h1>
        <form action="" method="post" id="form-login">
            <input type="text" name="fullname" id="fullname" placeholder="Họ và tên"
                value="<?php echo set_value('fullname'); ?>">
            <?php echo form_error('fullname'); ?>
            <input type="text" name="username" id="username" placeholder="Tên đăng nhập"
                value="<?php echo set_value('username'); ?>">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" id="password" placeholder="Mật khẩu" value="">
            <?php echo form_error('password'); ?>
            <input type="text" name="email" id="email" placeholder="Email" value="">
            <?php echo form_error('email'); ?>
            <input type="submit" name="btn_reg" id="btn_login" value="Đăng ký">
            <?php echo form_error('account'); ?>
        </form>
        <a id="lost-pass" href="<?php echo base_url("?mod=users&action=login") ?>">Đăng nhập</a>
    </div>
</body>

</html>