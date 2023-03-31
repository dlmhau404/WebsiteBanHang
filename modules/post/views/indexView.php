<?php
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix ">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($list_post as $item) {
                        ?>
                        <li class="clearfix">
                            <a href="bai-viet/<?php if (!empty($item['slug'])) echo $item['slug'] . '-' ?><?php echo $item['post_id']; ?>.html"
                                title="" class="thumb fl-left">
                                <img src="admin/uploads/post/<?php echo $item['post_thumb']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="bai-viet/<?php if (!empty($item['slug'])) echo $item['slug'] . '-' ?><?php echo $item['post_id']; ?>.html"
                                    title="" class="title"><?php echo $item['post_title']; ?></a>
                                <span
                                    class="create-date"><?php if (!empty($item['created_at'])) echo date('d/m/Y', $item['created_at']); ?></span>
                                <!-- <p class="desc">Trong ngày hôm nay (11/11) đoàn kiều bào đã tổ chức thành 4 nhóm đi tham quan các điểm như huyện Cần Giờ, Đại học Quốc gia, Khu công nghệ cao TP.HCM, Công viên phần mềm Quang Trung, Khu Nông nghiệp Công nghệ cao, Khu Đô thị mới Thủ Thiêm, Cảng Cát Lái... để kiều bào hiểu thêm về tình hình phát [...]</p> -->
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php
        get_sidebar('blog');
        ?>
    </div>
</div>
<?php
get_footer();
?>