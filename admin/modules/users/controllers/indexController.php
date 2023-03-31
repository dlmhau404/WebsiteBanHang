<?php
function construct()
{
    // echo "Dùng chung, load đầu tiên";
    load_model('index');
    // load('lib', 'validation');
    load('lib', 'email');
}

function indexAction()
{
}

function regAction()
{
    global $error, $fullname, $username, $password, $email;
    if (isset($_POST['btn_reg'])) {
        $error = array();
        #Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống Họ và tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống Tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống Mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống Email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        #Kết luận
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                <p>Bạn vui lòng click vào đường link để xác thực tài khoản: {$link_active}</p>
                <p>Nếu không phải bạn đăng ký vui lòng bỏ qua email này</p>
                <p>Thân!!!</p>";
                send_email('hauunitop@gmail.com', "Dương Lê Minh Hậu", 'Xác thực tài khoản', $content);
                //Thông báo
                // redirect("?mod=users&action=login");
            } else {
                $error['account'] = "Email or username đã tồn tại trên hệ thống";
            }
        }
    }
    load_view('reg');
}
function loginAction()
{
    // echo time();
    // echo date('d/m/Y');
    global $error, $username, $password;
    if (isset($_POST['btn_login'])) {
        $error = array();
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống Tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống Mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        if (empty($error)) {
            if (check_login($username, $password)) {
                //Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;

                // if (isset($_POST['remember_me'])) {
                //     setcookie('is_login', true, time() + 3600, '/');
                //     setcookie('user_login', $username, time() + 3600, '/');
                // }

                //Chuyển hướng login thành công
                redirect();
            } else {
                $error['account'] = "Tài khoản không tồn tại trên hệ thống";
            }
        }
    }

    load_view('login');
}

function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function activeAction()
{
    $link_login = base_url("?mod=users&action=login");
    $active_token = $_GET['active_token'];
    if (check_active_token($active_token)) {
        active_user($active_token);
        echo "Bạn đã kích hoạt thành công. Vui lòng click vào đây để đăng nhập <a href='{$link_login}'>Đăng nhập</a>";
    } else {
        echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt trước đó. Vui lòng click vào đây để đăng nhập <a href='{$link_login}'>Đăng nhập</a>";
    }
}

function resetAction()
{
    // global $error, $email;
    // $reset_token = $_GET['reset_token'];
    // if (!empty($reset_token)) {
    //     if (check_reset_token($reset_token)) {
    //         if (isset($_POST['btn_new_pass'])) {
    //             $error = array();
    //             if (empty($_POST['password'])) {
    //                 $error['password'] = "Không được để trống Mật khẩu";
    //             } else {
    //                 if (!is_password($_POST['password'])) {
    //                     $error['password'] = "Mật khẩu không đúng định dạng";
    //                 } else {
    //                     $password = md5($_POST['password']);
    //                 }
    //             }
    //             if (empty($error)) {
    //                 $data = array(
    //                     'password' => $password
    //                 );
    //                 update_pass($data, $reset_token);
    //                 redirect("?mod=users&action=resetOk");
    //             }
    //         }
    //         load_view('newPass');
    //     } else {
    //         echo "Yêu cầu xác nhận không hợp lệ";
    //     }
    // } else {
    //     if (isset($_POST['btn_reset'])) {
    //         $error = array();
    //         #Kiểm tra email
    //         if (empty($_POST['email'])) {
    //             $error['email'] = "Không được để trống Email";
    //         } else {
    //             if (!is_email($_POST['email'])) {
    //                 $error['email'] = "Email không đúng định dạng";
    //             } else {
    //                 $email = $_POST['email'];
    //             }
    //         }

    //         #Kết luận
    //         if (empty($error)) {
    //             if (check_email($email)) {
    //                 $reset_token = md5($email . time());
    //                 $data = array(
    //                     'reset_token' => $reset_token
    //                 );
    //                 //Cập nhật mã reset pass cho users cần khôi phục mật khẩu
    //                 update_reset_token($data, $email);
    //                 //Gửi link khôi phục vào email của người dùng
    //                 $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");
    //                 $content = "<p>Bạn vui lòng click vào link sau để khôi phục mật khẩu: {$link}</p>
    //             <p>Nếu không phải bạn vui lòng bỏ qua email này</p>";
    //                 send_email($email, '', 'Khôi phục mật khẩu', $content);
    //             } else {
    //                 $error['account'] = "Email không hợp lệ";
    //             }
    //         }
    //     }
    //     load_view('reset');
    // }
    load_view('reset');
}
function resetOkAction()
{
    load_view('resetOk');
}

function updateAction()
{
    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống Họ tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ";
        } else {
            $address = $_POST['address'];
        }
        if (empty($error)) {
            //Cập nhật
            $data = array(
                'fullname' => $fullname,
                'phone_number' => $phone_number,
                'address' => $address
            );
            update_user_login(user_login(), $data);
        }
    }

    $info_user = get_user_by_username(user_login());
    $data['info_user'] = $info_user;
    load_view('update', $data);
}