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
    global $error, $fullname, $username, $password, $email, $success;
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

        #Kiểm tra SĐT
        if (empty($_POST['tel'])) {
            $error['tel'] = "Không được để trống Số điện thoại";
        } else {
            if (!is_phone_number($_POST['tel'])) {
                $error['tel'] = "Số điện thoại không đúng định dạng";
            } else {
                $tel = $_POST['tel'];
            }
        }

        #Kiểm tra Địa chỉ
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống Địa chỉ";
        } else {
            $address = $_POST['address'];
        }

        #Kiểm tra giới tính
        if (empty($_POST['gender'])) {
            $error['gender'] = "Bạn phải chọn giới tính";
        } else {
            $gender = $_POST['gender'];
        }

        #Kết luận
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $subject = 'Kích hoạt tài khoản';
                $registry_date = time();
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'tel' => $tel,
                    'address' => $address,
                    'gender' => $gender,
                    'registry_date' => $registry_date,
                    'active_token' => $active_token,
                );
                add_user($data);
                $link_active = base_url("?mod=users&controller=index&action=active&active_token=$active_token");
                $content = "<p>Chào bạn {$fullname}, bạn vui lòng click vào {$link_active} này để kích hoạt tài khoản </p>
                <p>Nếu không phải bạn đăng ký vui lòng bỏ qua email này</p>
                <p>Nhóm hỗ trợ .....</p>";

                send_email($email, $fullname, $subject, $content);

                redirect("?mod=users&action=checkMail");
                // redirect("?mod=users&action=login");
            } else {
                $error['account'] = "Email or username đã tồn tại trên hệ thống";
            }
        }
    }
    load_view('reg');
}

function checkMailAction()
{
    load_view('checkMail');
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

function loginAction()
{
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
                redirect("home.html");
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
    redirect("home.html");
}

function resetAction()
{
    global $error, $email;
    $reset_token = $_GET['reset_token'];
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn_new_pass'])) {
                $error = array();
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
                    $data = array(
                        'password' => $password
                    );
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=resetOk");
                }
            }
            load_view('newPass');
        } else {
            echo "Yêu cầu xác nhận không hợp lệ";
        }
    } else {
        if (isset($_POST['btn_reset'])) {
            $error = array();
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
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    //Cập nhật mã reset pass cho users cần khôi phục mật khẩu
                    update_reset_token($data, $email);
                    //Gửi link khôi phục vào email của người dùng
                    $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    $content = "<p>Bạn vui lòng click vào link sau để khôi phục mật khẩu: {$link}</p>
                <p>Nếu không phải bạn vui lòng bỏ qua email này</p>";
                    send_email($email, '', 'Khôi phục mật khẩu', $content);
                } else {
                    $error['account'] = "Email không hợp lệ";
                }
            }
        }
        load_view('reset');
    }
}
function resetOkAction()
{
    load_view('resetOk');
}

function detailAction()
{

    global $error;

    $user_login = $_SESSION['user_login'];
    $data['user_info'] = get_user_info($user_login);

    if ($data['user_info']['gender'] == "male") {
        $data['gender'] = "Nam";
    } elseif ($data['user_info']['gender'] == "female") {
        $data['gender'] = "Nữ";
    }

    if (isset($_POST['btn_update_info'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $fullname = $data['user_info']['fullname'];
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['tel'])) {
            $tel = $data['user_info']['tel'];
        } else {
            $tel = $_POST['tel'];
        }

        if (empty($_POST['address'])) {
            $address = $data['user_info']['address'];
        } else {
            $address = $_POST['address'];
        }

        if (empty($_POST['gender'])) {
            $gender = $data['user_info']['gender'];
        } else {
            $gender = $_POST['gender'];
            echo $gender;
        }

        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'tel' => $tel,
                'address' => $address,
                'gender' => $gender
            );
            update_user_info($data, $user_login);
            redirect("?mod=users&action=detail");
        }
    }

    if (isset($_POST['btn_update_pass'])) {
        $error = array();

        if (!empty($_POST['password'])) {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
            } else {
                $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu không đúng định dạng";
                } else {
                    $password = md5($_POST['password']);
                }
            }
        }

        if (empty($error)) {
            $data = array(
                'password' => $password,
            );
            update_user_info($data, $user_login);
            redirect("?mod=users&action=login");
        }
    }

    load_view('detail', $data);
}