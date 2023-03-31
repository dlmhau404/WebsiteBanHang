<?php get_header(); ?>
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
        <input type="checkbox" name="remember_me">Ghi nhớ đăng nhập <br>
        <a id="lost-pass" href="<?php echo base_url("?mod=users&action=reset&reset_token
") ?>">Quên mật khẩu?</a> |
        <a id="lost-pass" href="<?php echo base_url("?mod=users&action=index") ?>">Đăng ký</a>
    </form>
</div>
<?php get_footer(); ?>