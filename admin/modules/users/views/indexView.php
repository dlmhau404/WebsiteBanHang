<?php
// show_array($list_users);
get_header();
?>
<div id="content">
    <h1>Danh sách thành viên</h1>
    <table>
        <thead>
            <tr>
                <td>STT</td>
                <td>Tên</td>
                <td>Email</td>
                <td>Tuổi</td>
                <td>Thu nhập</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $t = 0;
            if (!empty($list_users)) {
                foreach ($list_users as $user) {
                    $t++;
            ?>
            <tr>
                <td><?php echo $t ?></td>
                <td><?php echo $user['fullname'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['age'] ?></td>
                <td><?php echo currency_format($user['earn']) ?></td>
            </tr>
            <?php
                }
                ?>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>


<?php
get_footer();
?>