<?php get_header(); ?>
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
        <input type="text" name="tel" id="tel" placeholder="Tel" value="<?php echo set_value('tel') ?>">
        <?php echo form_error('tel'); ?>
        <textarea name="address" id="address" placeholder="Address"></textarea>
        <?php echo form_error('address'); ?>
        <select name="gender" id="gender">
            <option value="">--Chọn giới tính--</option>
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
        </select>
        <p class="error"><?php echo form_error('gender'); ?></p>
        <?php echo form_error('account'); ?>
        <?php echo form_success('reg'); ?>
        <input type="submit" name="btn_reg" id="btn_login" value="Đăng ký">
    </form>
    <a id="lost-pass" href="<?php echo base_url("?mod=users&action=login") ?>">Đăng nhập</a>
</div>
<?php get_footer(); ?>