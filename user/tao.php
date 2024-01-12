<?php
include_once __DIR__ . '/../components/head.php';
$msg = null;
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        if ($_POST['Password'] == $_POST['Password2']) {
            include_once __DIR__ . '/../model/UserModel.php';
            include_once __DIR__ . '/../dao/UserDAO.php';
            $db = new UserDAO();
            $motel = UserModel::fromForm([]);
            if (isset($_FILES["Avatar_file"])) {
                $images = $_FILES["Avatar_file"];
                $upload_dir = "/www/tro/uploads/";
                $target_file = $upload_dir . basename($images["name"]);
                move_uploaded_file($images["tmp_name"], $target_file);
                $motel->Avatar = $target_file;
            }
            $db->save($motel);
        } else
            $msg = "Mật khẩu không khớp";
        break;
    default:
        break;
}
?>

    <?php
    if ($msg) {
        ?>
        <h2 style="color:red;">
            <?php echo $msg; ?>
        </h2>
        <?php
    }
    ?>

    <div class="container">
        <h1>Thêm người dùng</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Tài khoản</label>
                <input type="text" name="Username" id="username" class="form-control">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="Name" id="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="Email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" name="Password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" name="Password2" id="password2" class="form-control">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="Phone" id="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="text" name="Avatar" id="avatar" class="form-control" hidden>
                <div class="card">
                    <div class="card-body">
                        <img id="avatar_img" style="height: 300px; width: 300px;" />
                        <input id="file" class="form-control" type="file" name="Avatar_file" />
                        <script>
                            document.getElementById("file").onchange = (e) => {
                                const reader = new FileReader();
                                reader.onload = (x) => {
                                    document.getElementById("avatar_img").src = x.target.result;
                                }
                                reader.readAsDataURL(e.target.files[0]);
                            };
                        </script>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php
    include_once __DIR__ . '/../components/footer.php';
    ?>