<?php
// Khai báo biến
$username = $userID = $password = $repass = $email = $gender = $interest = $address = $bird = "";
$flag = false;
$errors = $err_day = "";
$day = $month = $year = "";
$err_username = $err_userID = $err_password = $err_repass = $err_email = $err_gender = $err_interest = $err_address = $err_bird = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Kiểm tra họ và tên
    if (empty($_POST["username"])) {
        $err_username = "Không được để họ tên là trống";
    } else {
        $username = check_data($_POST["username"]);
    }

    // Kiểm tra Tên đăng nhập
    if (empty($_POST["userID"])) {
        $err_userID = "Không được để Tên đăng nhập là trống";
    } else {
        $userID = check_data($_POST["userID"]);
    }

    // Biểu thức chính quy kiểm tra tên đăng nhập
    if (!preg_match("/^[a-zA-Z0-9]+$/", $userID)) {
        $err_userID = "Tên đăng nhập phải theo đúng chuẩn chỉ có chữ và số";
    }

    // Kiểm tra Mật khẩu
    if (empty($_POST["password"])) {
        $err_password = "Không được để mật khẩu là trống";
    } else {
        $password = check_data($_POST["password"]);
    }

    // Biểu thức chính quy kiểm tra mật khẩu
    if (!preg_match("/^[a-zA-Z0-9]{8,30}$/", $password)) {
        $err_password = "Mật khẩu phải đủ ít nhất 8 ký tự và theo chuẩn";
    }

    // Kiểm tra nhập lại mật khẩu
    if (empty($_POST["repass"])) {
        $err_repass = "Không được để nhập lại mật khẩu là trống";
    } else {
        $repass = check_data($_POST["repass"]);
    }

    // Kiểm tra mật khẩu và nhập lại mật khẩu
    if ($password != $repass) {
        $errors = "Mật khẩu và nhập lại mật khẩu không khớp";
    }

    // Kiểm tra Email
    if (empty($_POST["email"])) {
        $err_email = "Email không được để trống";
    } else {
        $email = check_data($_POST["email"]);
    }

    // Biểu thức chính quy kiểm tra email
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $err_email = "Phải nhập đúng định dạng email có @ và dấu chấm";
    }

    // Kiểm tra năm sinh phải đúng chuẩn
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];

    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            if ($day > 30) {
                $err_bird = "Lỗi ngày không khớp với tháng.";
            }
            break;
        case 2:
            if ($year % 4 == 0) {
                if ($year % 100 == 0) {
                    if ($year % 400 == 0) {
                        if ($day > 29) {
                            $err_bird = "Lỗi ngày không khớp với tháng.";
                        }
                    } else {
                        if ($day > 28) {
                            $err_bird = "Lỗi ngày không khớp với tháng.";
                        }
                    }
                } else {
                    if ($day > 29) {
                        $err_bird = "Lỗi ngày không khớp với tháng.";
                    }
                }
            } else {
                if ($day > 28) {
                    $err_bird = "Lỗi ngày không khớp với tháng.";
                }
            }
            break;
    }

    if (empty($err_bird)) {
        $bird = strval($year) . '-' . strval($month) . '-' . strval($day);
    }

    // Kiểm tra địa chỉ
    if (!empty($_POST["address"])) {
        $address = check_data($_POST["address"]);
    }
}

function check_data($data) {
    $data = trim($data); // Cắt khoảng trắng 2 đầu
    $data = stripslashes($data); // Cắt bỏ ký tự escape
    $data = htmlspecialchars($data); // Bỏ tác dụng của thẻ HTML
    return $data;
}

// Hiển thị ra các lỗi trong form
if (!empty($err_username)) {
    $flag = TRUE;
    echo $err_username . "<br>";
}
if (!empty($err_userID)) {
    $flag = true;
    echo $err_userID . "<br>";
}
if (!empty($err_password)) {
    $flag = true;
    echo $err_password . "<br>";
}
if (!empty($err_repass)) {
    $flag = true;
    echo $err_repass . "<br>";
}
if (!empty($errors)) {
    $flag = true;
    echo $errors . "<br>";
}
if (!empty($err_email)) {
    $flag = true;
    echo $err_email . "<br>";
}
if (!empty($err_bird)) {
    $flag = true;
    echo $err_bird . "<br>";
}

if (!$flag) {
    echo "Họ và tên: " . $username . "<br>";
    echo "Tên đăng nhập: " . $userID . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Ngày sinh: " . $bird . "<br>";
    echo "Địa chỉ: " . $address . "<br>";
    echo "Giới tính: " . $gender . "<br>";
}
?>
<?php
// Khai báo thông tin kết nối
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "qlkh";

// Kết nối cơ sở dữ liệu
$conn = mysqli_connect($servername, $username_db, $password_db, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
} else {
    echo "Kết nối thành công tới cơ sở dữ liệu MySQL<br>";

    // Lấy dữ liệu từ form (đảm bảo rằng các biến đã được xử lý an toàn trước khi chèn vào SQL)
    $userID = mysqli_real_escape_string($conn, $_POST['userID']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $bird = mysqli_real_escape_string($conn, $_POST['bird']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Chuẩn bị câu lệnh SQL
    $sql = "INSERT INTO regis (user, pass, fullname, bird, email) 
            VALUES ('$userID', '$password', '$username', '$bird', '$email')";

    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if (mysqli_query($conn, $sql)) {
        echo "Dữ liệu đã được chèn thành công vào cơ sở dữ liệu.<br>";
    } else {
        echo "Có lỗi khi chèn dữ liệu vào cơ sở dữ liệu: " . mysqli_error($conn) . "<br>";
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
