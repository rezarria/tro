<?php
$msg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/dao/UserDAO.php';
    $db = new UserDAO();
    $motel = $db->getUserByUsername($_POST['username']);
    if ($motel && password_verify($_POST['password'], $motel->Password)) {
        session_start();
        $_SESSION['user'] = $motel;
        header('location:tro/danhsach.php');
        exit();
    } else
        $msg = "sai thông tin đăng nhập";

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
        <h1 style="color:white;">Đăng nhập</h1>
        <?php if (isset($msg)) { ?>
            <h2 style="color:red; text-align: center;">Sai thông tin đăng nhập</h2>
        <?php } ?>
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
                <button type="submit"><span>Đăng nhập</span></button>
            </div>
        </form>
        <div>
</body>

</html>