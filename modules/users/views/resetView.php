<?php get_header(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div id="wp-form-login">
        <h1>KHÔI PHỤC MẬT KHẨU</h1>
        <form action="" method="post" id="form-login">
            <input type="text" name="email" id="email" placeholder="Email" value="">
            <?php echo form_error('email'); ?>
            <input type="submit" name="btn_reset" id="btn_login" value="GỬI YÊU CẦU">
            <?php echo form_error('account'); ?>
            <a id="lost-pass" href="<?php echo base_url("?mod=users&action=login") ?>">Đăng nhập</a> |
            <a id="lost-pass" href="<?php echo base_url("?mod=users&action=reg") ?>">Đăng ký</a>
        </form>
    </div>
</body>

</html>
<?php get_footer(); ?>