<!DOCTYPE html>
<html>

<head>
    <title>MY MOTOBIKE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url(); ?>">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/style.css">

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="home.html" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="?mod=product" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="bai-viet.html" title="">Blog</a>
                                </li>
                                <!-- <li>
                                    <a href="?page=detail_blog" title="">Giới thiệu</a>
                                </li> -->
                                <?php
                                if (isset($_SESSION['is_login']) && $_SESSION['is_login'] = true) {
                                ?>
                                <li>
                                    <a href="logout.html" title="">Thoát</a>
                                </li>

                                <?php
                                } elseif (!isset($_SESSION['is_login'])) {
                                ?>
                                <li>
                                    <a href="login.html">Đăng nhập</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="home.html" title="" id="logo" class="fl-left"><img width="250px"
                                src="public/images/logo_web-1.png" /></a>

                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="">
                                <input type="hidden" name="mod" value="product">
                                <input type="hidden" name="action" value="search">
                                <input type="text" name="q" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <input type="submit" value="Tìm kiếm" id="sm-s" name="btn_search">
                                <!-- <button type="submit" name="btn_search" id="sm-s">Tìm kiếm</button> -->
                            </form>
                        </div>

                        <div id="action-wp" class="fl-left">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>

                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <?php
                                    if (!empty($_SESSION['cart']) && ($_SESSION['cart']['info']['num_order'] > 0)) {
                                    ?>
                                    <span id="num"><?php echo $_SESSION['cart']['info']['num_order']; ?></span>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <?php
                                if (!empty($_SESSION['cart']['buy'])) {
                                    $num_order = count($_SESSION['cart']['buy']);
                                ?>
                                <div id="dropdown">
                                    <p class="desc">Có <span><?php echo $_SESSION['cart']['info']['num_order']; ?> sản
                                            phẩm</span> trong giỏ hàng</p>

                                    <ul class="list-cart">
                                        <?php
                                            if ($num_order <= 3) {
                                                foreach ($_SESSION['cart']['buy'] as $item) {
                                            ?>
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>"
                                                    alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title=""
                                                    class="product-name"><?php echo $item['product_name']; ?></a>
                                                <p class="price"><?php echo currency_format($item['price']); ?></p>
                                                <p class="qty">Số lượng: <span><?php echo $item['quantity']; ?></span>
                                                </p>
                                            </div>
                                        </li>
                                        <?php
                                                }
                                            } else {
                                                $list_buy = array_slice($_SESSION['cart']['buy'], 1, 2);
                                                foreach ($list_buy as $item) {
                                                ?>
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="admin/uploads/product/<?php echo $item['product_thumb']; ?>"
                                                    alt="">
                                            </a>
                                            <div class="info fl-right">

                                                <a href="" title=""
                                                    class="product-name"><?php echo $item['product_name']; ?></a>
                                                <p class="price"><?php echo currency_format($item['price']); ?></p>
                                                <p class="qty">Số lượng: <span><?php echo $item['quantity']; ?></span>
                                                </p>
                                            </div>
                                        </li>

                                        <?php
                                                }
                                                ?>
                                        <li class="clearfix">
                                            <div class="info fl-right">
                                                <p href="" title="" class="product-name">[ ............ ]</p>
                                            </div>
                                            <?php
                                            }
                                                ?>
                                    </ul>

                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">
                                            <?php echo currency_format($_SESSION['cart']['info']['total']); ?></p>
                                    </div>

                                    <dic class="action-cart clearfix">
                                        <a href="?mod=cart&action=index" title="Giỏ hàng" class="view-cart fl-left">Giỏ
                                            hàng</a>
                                        <a href="?mod=cart&action=checkout" title="Thanh toán"
                                            class="checkout fl-right">Thanh
                                            toán</a>
                                    </dic>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="user-info-wp" class="fl-right">
                            <div id="user-info">
                                <?php
                                if (isset($_SESSION['is_login']) && $_SESSION['is_login'] = true) {
                                ?>
                                <span>Chào</span>

                                <a href="?mod=order&action=index"><?php echo $_SESSION['user_login']; ?></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>