<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        include_once __DIR__ . "/../dao/UserDAO.php";
        include_once __DIR__ . "/../model/UserModel.php";
        $id = $_GET['id'] + 0;
        $db = new UserDAO();
        $motel = new UserModel();
        if (!$db->load($motel, $id)) {
            $msg = "không tìm thấy";
            break;
        }
        break;
    case 'POST':
        include_once __DIR__ . "/../dao/UserDAO.php";
        include_once __DIR__ . "/../model/UserModel.php";
        $db = new UserDAO();
        $motel = new UserModel();
        $id = $_GET['id'] + 0;
        $db->load($motel, $id);
        UserModel::mergeFromForm($motel);
        if (isset($_FILES["Avatar_file"]) && $_FILES["Avatar_file"]["size"] != 0) {
            $images = $_FILES["Avatar_file"];
            $upload_dir = "/www/tro/uploads/";
            $target_file = $upload_dir . basename($images["name"]);
            move_uploaded_file($images["tmp_name"], $target_file);
            $motel->Avatar = $target_file;
        }
        if ($db->update($motel)) {
            header('location:danhsach.php');
            exit();
        } else {
            $msg = "có lỗi trong quá trình lưu";
        }
        echo json_encode($motel);
        exit();
    default:
        exit();
}

?>


<?php
include_once __DIR__ . '/../components/head.php';
?>

    <div class="container">
        <?php if (isset($msg)) { ?>
            <h2 style="color:red; text-align: center;">Sai thông tin đăng nhập</h2>
        <?php } ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" id="id" name="ID" class="form-control" readonly value="<?php echo $motel->ID; ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Tài khoản</label>
                <input type="text" name="Username" id="username" class="form-control"
                    value="<?php echo $motel->Username; ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="Name" id="name" class="form-control" value="<?php echo $motel->Name; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="Email" id="email" class="form-control" value="<?php echo $motel->Email; ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="Phone" id="phone" class="form-control" value="<?php echo $motel->Phone; ?>">
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="text" name="Avatar" id="avatar" class="form-control" value="<?php echo $motel->Avatar; ?>"
                    hidden>
                <div class="card">
                    <div class="card-body">
                        <img id="avatar_img" src="<?php echo $motel->Avatar; ?>" style="height: 300px; width: 300px;" />
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