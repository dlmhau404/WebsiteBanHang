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
        <h1>NHẬP MẬT KHẨU MỚI</h1>
        <form action="" method="post" id="form-login">
            <p>Yêu cầu thay đổi mật khẩu mới thành công. Vui lòng click vào link sau để đăng nhập.
                <a id="lost-pass" href="<?php echo base_url("?mod=users&action=login") ?>">Đăng nhập</a>
            </p>
        </form>
    </div>
</body>

</html>