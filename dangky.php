<?php
$msg = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] === $_POST['password2']) {
        include_once __DIR__ . '/dao/UserDAO.php';
        include_once __DIR__ . '/dto/UserDTO.php';
        $db = new UserDAO();
        $motel = new UserModel();
        $motel->Username = $_POST['username'];
        $motel->Password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $motel->Email = $_POST['email'];
        $motel->Name = $_POST['name'];
        if ($db->save($motel)) {
            if (key_exists('returnUrl', $_GET)) {
                header('location:' . $_GET['returnUrl']);
            } else {
                header('location:dangnhap.php');
            }
            exit(200);
        } else
            $msg = 'có lỗi trong quá trình tạo tài khoản';
    } else
        $msg = 'sai mật khẩu';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/login.css">
</head>

<body>
    <div class="main">
        <?php
        if ($msg) {
            ?>
            <h2 style="color:red;">
                <?php echo $msg; ?>
            </h2>
            <?php
        }
        ?>
        <h1>Đăng ký thành viên mới</h1>
        <form method="POST">
            <div class="group">
                <label for="username">Tài khoản:</label>
                <input type="text" id="username" name="username" />
            </div>
            <div class="group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" />
            </div>
            <div class="group">
                <label for="password2">Nhập lại mật khẩu:</label>
                <input type="password" id="password2" name="password2" />
            </div>
            <div class="group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" />
            </div>
            <div class="group">
                <label for="name">Tên hiện thị:</label>
                <input type="text" id="name" name="name" />
            </div>
            <div class="group">
                <button type="submit"><span>Đăng kí</span></button>
            </div>
        </form>
        <div>
</body>

</html>