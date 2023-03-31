<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div id="wp-form-login">
        <h1>ĐĂNG NHẬP</h1>
        <form action="" method="post" id="form-login">
            <input type="text" name="username" id="username" placeholder="Tên đăng nhập"
                value="<?php echo set_value('username'); ?>">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" id="password" placeholder="Mật khẩu" value="">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn_login" id="btn_login" value="Đăng nhập">
            <?php echo form_error('account'); ?>
        </form>
    </div>
</body>

</html>