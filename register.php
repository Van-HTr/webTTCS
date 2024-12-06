<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <div id="div1"></div>
    <div id="div2">
        <form action="./insert.php" name="Register" method="post">
            <table cellpadding="5" cellspacing="0" id="table_form" align="center">
                <!-- Họ và tên -->
                <tr>
                    <td width="30%" class="coll"><label for="username">Họ và tên người dùng:</label></td>
                    <td><input type="text" size="40" id="username" name="username" value=""><span id="eruser" class="error">*</span></td>
                </tr>
                <!-- Tên đăng nhập -->
                <tr>
                    <td width="30%" class="col"><label for="userID">Tên Đăng nhập:</label></td>
                    <td><input type="text" size="40" id="userID" name="userID" value=""><span id="eruserID" class="error">*</span></td>
                </tr>
                <!-- Mật khẩu -->
                <tr>
                    <td width="30%" class="col1"><label for="password">Mật khẩu:</label></td>
                    <td><input type="password" size="40" id="password" name="password" value=""><span id="erPass" class="error">*</span></td>
                </tr>
                <!-- Nhập lại mật khẩu -->
                <tr>
                    <td width="30%" class="coll"><label for="repass">Nhập lại mật khẩu:</label></td>
                    <td><input type="password" size="40" id="repass" name="repass" value=""><span id="erRePass" class="error">*</span></td>
                </tr>
                <!-- Email -->
                <tr>
                    <td width="30%" class="coll"><label for="email">Email:</label></td>
                    <td><input type="text" size="40" id="email" name="email" value=""><span id="erEmail" class="error">*</span></td>
                </tr>
                <!-- Giới tính -->
                <tr>
                    <td width="30%" class="coll"><label for="rgender">Giới tính:</label></td>
                    <td>
                        <input type="radio" id="male" name="rgender" value="Nam" checked><label for="male">Nam</label>
                        <input type="radio" id="female" name="rgender" value="Nữ"><label for="female">Nữ</label>
                    </td>
                </tr>
                <!-- Năm sinh -->
                <tr>
                    <td width="30%" class="coll"><label for="birthdate">Năm sinh:</label></td>
                    <td>
                        <label for="day">Ngày</label>
                        <select id="day" name="day">
                            <script>
                                for (var i = 1; i <= 31; i++) {
                                    document.write('<option value="' + i + '">' + i + '</option>');
                                }
                            </script>
                        </select>
                        <label for="month">Tháng</label>
                        <select id="month" name="month">
                            <script>
                                for (var j = 1; j <= 12; j++) {
                                    document.write('<option value="' + j + '">' + j + '</option>');
                                }
                            </script>
                        </select>
                        <label for="year">Năm</label>
                        <select id="year" name="year">
                            <script>
                                var d = new Date();
                                var currentYear = d.getFullYear();
                                for (var k = 1900; k <= currentYear; k++) {
                                    document.write('<option value="' + k + '">' + k + '</option>');
                                }
                            </script>
                        </select>
                    </td>
                </tr>
                <!-- Địa chỉ -->
                <tr>
                    <td width="30%" class="col1"><label for="address">Địa chỉ:</label></td>
                    <td><textarea id="address" name="address"></textarea></td>
                </tr>
                <!-- Nút Submit và Reset -->
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Submit">
                        <input type="reset" name="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
