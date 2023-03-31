<?php

function construct()
{
    // load('lib','cart');
    load_model('index');
}

function addAction()
{
    $id = (int) $_GET['id'];
    $item = get_info_product_by_id($id);

    if (isset($_GET['num-order'])) {
        $quantity = $_GET['num-order'];
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + $quantity;
        }
        if ($quantity > 15)
            $quantity = 15;
    } else {
        $quantity = 1;
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + 1;
        }
    }

    $_SESSION['cart']['buy'][$id] = array(
        'product_id' => $item['product_id'],
        'product_name' => $item['product_name'],
        'price' => $item['price'],
        'code' => $item['code'],
        'url' => $item['url'],
        'product_thumb' => $item['product_thumb'],
        'quantity' => $quantity,
        'sub_total' => $item['price'] * $quantity,
    );
    update_info_cart();
    redirect("?mod=cart&action=index");
}

function indexAction()
{
    if (isset($_SESSION['cart']['buy'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete_cart'] = "?mod=cart&action=delete&id={$item['product_id']}";
            $item['url_detail'] = "?mod=product&action=detail&id={$item['product_id']}";
        }
        $data['list_buy'] = $_SESSION['cart']['buy'];
        $data['total_cart'] = $_SESSION['cart']['info']['total'];

        if (isset($_SESSION['cart']['info'])) {
            $data['num_order'] = $_SESSION['cart']['info']['num_order'];
        }

        load_view('index', $data);
    } else {
        if (isset($_SESSION['cart']['info'])) {
            $data['num_order'] = $_SESSION['cart']['info']['num_order'];
        } else {
            $data['num_order'] = 0;
        }
        load_view('index', $data);
    }
}

function deleteAction()
{
    $id = (int) $_GET['id'];
    if (empty($id)) {
        unset($_SESSION['cart']['buy']);
        update_info_cart();
        redirect("?mod=cart&action=index");
    } else {
        unset($_SESSION['cart']['buy'][$id]);
        update_info_cart();
        redirect("?mod=cart&action=index");
    }
}


function updateAction()
{

    if (isset($_POST['update_cart'])) {
        $error = array();

        $id = (int) $_POST['id'];
        $num_order = (int) $_POST['num_order'];
        if ($num_order > 15) {
            $selector_num_order = "tr[data-id='{$id}'] > td:nth-child(5) > p";
            $result = array(
                'num_order' => "Số lượng order quá lớn",
                'selector_num_order' => $selector_num_order,
            );
            echo json_encode($result);
        } else {
            $price = $_SESSION['cart']['buy'][$id]['price'];
            $sub_total = $price * $num_order;

            $selector_sub_total = "tr[data-id='{$id}'] > td:nth-child(6)";
            $selector_num_order = "tr[data-id='{$id}'] > td:nth-child(5) > p";

            $_SESSION['cart']['buy'][$id]['quantity'] = $num_order;
            $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;
            update_info_cart();

            $cart_num_order = $_SESSION['cart']['info']['num_order'];
            $total = $_SESSION['cart']['info']['total'];

            $text = "{$cart_num_order} sản phẩm";

            $result = array(
                'product_id' => $id,
                'num_order' => $num_order,
                'price' => $price,
                'sub_total' => number_format($sub_total) . "đ",
                'selector_sub_total' => $selector_sub_total,
                'cart_num_order' => $cart_num_order,
                'total' => number_format($total) . "Đ",
                'num_order' => "",
                'selector_num_order' => $selector_num_order,
                'text' => $text,
            );
            echo json_encode($result);
        }
    } elseif (isset($_POST['show_dropdown_cart'])) {
        $num_order = $_SESSION['cart']['info']['num_order'];

        $result = array(
            'num_order' => "{$num_order} sản phẩm",
        );
        echo json_encode($result);
    }
}

function checkoutAction()
{
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    }
    global $error, $fullname, $email, $address, $tel, $payment_method, $note;

    if ($_SESSION['is_login']) {
        if (empty($id)) {
            if (isset($_POST['checkout'])) {

                $error = array();

                // if (empty($_POST['fullname'])) {
                //     $error['fullname'] = "Không được để trống Họ và Tên";
                // } else {
                $fullname = $_POST['fullname'];
                // }

                // if (empty($_POST['email'])) {
                //     $error['email'] = "Không được để trống email";
                // } else {
                $email = $_POST['email'];
                // }

                // if (empty($_POST['address'])) {
                //     $error['address'] = "Không được để trống địa chỉ";
                // } else {
                $address = $_POST['address'];
                // }

                // if (empty($_POST['tel'])) {
                //     $error['tel'] = "Không được để trống số điện thoại";
                // } else {
                $tel = $_POST['tel'];
                // }

                if (empty($_POST['payment-method'])) {
                    $error['payment-method'] = "Phải chọn phương thức thanh toán";
                } else {
                    $payment_method = $_POST['payment-method'];
                }

                $note = $_POST['note'];

                if (empty($error)) {
                    $_SESSION['cart']['customer_info'] = array(
                        'name' => $fullname,
                        'email' => $email,
                        'address' => $address,
                        'telephone_number' => $tel,
                        'note' => $note,
                        'payment_method' => $payment_method,
                    );
                    // show_array($_SESSION['cart']);
                    receiveOderAction();
                }
            }

            if (isset($_SESSION['cart']['buy'])) {
                $data['list_buy'] = $_SESSION['cart']['buy'];
                $data['num_order'] = $_SESSION['cart']['info']['num_order'];
                $data['total'] = $_SESSION['cart']['info']['total'];
                $username = $_SESSION['user_login'];
                $data['info_customer'] = get_info_customer($username);
                load_view('checkout', $data);
            }
        } else {

            $item = get_info_product_by_id($id);

            $quantity = 1;
            if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
                $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + 1;
            }

            $_SESSION['cart']['buy'][$id] = array(
                'id' => $item['product_id'],
                'title' => $item['product_name'],
                'price' => $item['price'],
                'code' => $item['code'],
                'url' => "",
                'thumbnail' => $item['product_thumb'],
                'quantity' => $quantity,
                'sub_total' => $item['price'] * $quantity,
            );
            update_info_cart();

            if (isset($_POST['checkout'])) {

                $error = array();

                // if (empty($_POST['fullname'])) {
                //     $error['fullname'] = "Không được để trống Họ và Tên";
                // } else {
                $fullname = $_POST['fullname'];
                // }

                // if (empty($_POST['email'])) {
                //     $error['email'] = "Không được để trống email";
                // } else {
                $email = $_POST['email'];
                // }

                // if (empty($_POST['address'])) {
                //     $error['address'] = "Không được để trống địa chỉ";
                // } else {
                $address = $_POST['address'];
                // }

                // if (empty($_POST['tel'])) {
                //     $error['tel'] = "Không được để trống số điện thoại";
                // } else {
                $tel = $_POST['tel'];
                // }

                if (empty($_POST['payment-method'])) {
                    $error['payment-method'] = "Phải chọn phương thức thanh toán";
                } else {
                    $payment_method = $_POST['payment-method'];
                }

                $note = $_POST['note'];

                if (empty($error)) {
                    $_SESSION['cart']['customer_info'] = array(
                        'name' => $fullname,
                        'email' => $email,
                        'address' => $address,
                        'telephone_number' => $tel,
                        'note' => $note,
                        'payment_method' => $payment_method,
                    );
                    // show_array($_SESSION['cart']);
                    receiveOderAction();
                }
            }

            if (isset($_SESSION['cart']['buy'])) {
                $data['list_buy'] = $_SESSION['cart']['buy'];
                $data['num_order'] = $_SESSION['cart']['info']['num_order'];
                $data['total'] = $_SESSION['cart']['info']['total'];
                $username = $_SESSION['user_login'];
                $data['info_customer'] = get_info_customer($username);
                load_view('checkout', $data);
            }
        }
    } else {
        redirect("?mod=users&action=login");
    }
}

function receiveOderAction()
{
    load('helper', 'email');
    load('lib', 'email');

    if (isset($_SESSION['cart'])) {
        # Lấy thông tin, xắp sếp thông tin hợp đồng
        // 1. Thông tin giỏ hàng
        $num_order = $_SESSION['cart']['info']['num_order'];
        $total = $_SESSION['cart']['info']['total'];

        // 2. Thông tin khách hàng
        $customer_fullname = $_SESSION['cart']['customer_info']['name'];
        $customer_email = $_SESSION['cart']['customer_info']['email'];
        $customer_address = $_SESSION['cart']['customer_info']['address'];
        $customer_telephone_number = $_SESSION['cart']['customer_info']['telephone_number'];
        $customer_note = $_SESSION['cart']['customer_info']['note'];
        $payment_method = $_SESSION['cart']['customer_info']['payment_method'];
        $username = $_SESSION['user_login'];
        $user_id = get_user_id($username);

        // 3. Thông tin hợp đồng
        $transaction_code = rand();
        $subject = "[My Motobike] Shopping - Xác nhận đơn hàng {$transaction_code}";
        $form_email_cart = form_email_cart();
        $content = "Cảm ơn khách hàng {$customer_fullname} đã đặt hàng từ cửa hàng chúng tôi. Đây là Email thông báo quy trình đặt hàng đã hoàn tất. Dưới đây là các mặt hàng quý khách đã đặt mua: </br></br>" . $form_email_cart;
        $created_date = time();

        # Lưu thông tin hợp đồng vào database
        $data = array(
            'transaction_code' => $transaction_code,
            'username' => $username,
            'user_id' => $user_id,
            'fullname' => $customer_fullname,
            'email' => $customer_email,
            'phone' => $customer_telephone_number,
            'address' => $customer_address,
            'payment_method' => $payment_method,
            'note' => $customer_note,
            'created_date' => $created_date,
            'quantity' => $num_order,
            'total' => $total,
        );

        add_transaction($data);

        # Lưu thông tin đơn hàng
        foreach ($_SESSION['cart']['buy'] as $item) {
            $data = array(
                'transaction_code' => $transaction_code,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'sub_total' => $item['sub_total'],
            );
            add_order($data);
        }

        #Lưu thông tin khách hàng
        # Gửi mail xác nhận đơn hàng cho khách
        send_email($customer_email, $customer_fullname, $subject, $content);

        # Gửi mail báo cáo thông tin đơn hàng 
        $my_email = "haub1805857@student.ctu.edu.vn";
        $content = "Nhận đơn hàng {$transaction_code} từ khách hàng {$customer_fullname} gồm" . $form_email_cart . "<p>Địa chỉ: <strong>{$customer_address}</strong></p><p>Số điện thoại của khách hàng: <strong>{$customer_telephone_number}</strong></p><p>Chú thích: <strong>{$customer_note}</strong></p><p>Phương thức thanh toán: <strong>{$payment_method}</strong></p>";
        send_email($my_email, "", $subject, $content);
        unset($_SESSION['cart']);
        update_info_cart();

        load_view('thanks');
    }
}