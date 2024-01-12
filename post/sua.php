<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        include_once __DIR__ . "/../dao/MotelDAO.php";
        include_once __DIR__ . "/../model/MotelModel.php";
        $id = $_GET['id'] + 0;
        $db = new MotelDAO();
        $motel = new MotelModel();
        if (!$db->load($motel, $id)) {
            $msg = "không tìm thấy";
            break;
        }
        break;
    case 'POST':
        include_once __DIR__ . "/../dao/MotelDAO.php";
        include_once __DIR__ . "/../model/MotelModel.php";
        $db = new MotelDAO();
        $motel = new MotelModel();
        $id = $_GET['id'] + 0;
        $db->load($motel, $id);
        MotelModel::mergeFromForm($motel);
        if (isset($_FILES["images_file"]) && $_FILES["images_file"]["size"] != 0) {
            $images = $_FILES["images_file"];
            $upload_dir = "/www/tro/uploads/";
            $target_file = $upload_dir . basename($images["name"]);
            move_uploaded_file($images["tmp_name"], $target_file);
            $motel->images = $target_file;
        }
        if ($db->update($motel)) {
            header('location:danhsach.php');
            exit();
        } else {
            $msg = "có lỗi trong quá trình lưu";
        }
        exit();
    default:
        exit();
}

?>


<?php
include_once __DIR__ . '/../components/head.php';
?>

    <div class="container">
        <h1>Cập nhật thông tin trọ</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tên</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $motel->title ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description"
                    name="description"><?php echo $motel->description ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $motel->price ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="<?php echo $motel->address ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $motel->phone ?>">
            </div>
            <div class="mb-3">
                <label for="utilities" class="form-label">Tiện ích</label>
                <textarea class="form-control" id="utilities"
                    name="utilities"><?php echo $motel->utilities ?></textarea>
            </div>
            <?php
            function isCheck(int $id)
            {
                global $motel;
                if ($motel->approve == $id) {
                    echo "selected";
                }
            }
            ?>
            <div class="mb-3">
                <label for="appover">Trạng thái</label>
                <select class="form-select">
                    <option value="0" <?php isCheck(0) ?>>Trống</option>>
                    <option value="1" <?php isCheck(1) ?>>Đã thuê</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Avatar</label>
                <input type="text" name="images" id="images" class="form-control" value="<?php echo $motel->images ?>"
                    hidden>
                <div class="card">
                    <div class="card-body">
                        <img id="images_img" src="<?php echo $motel->images ?>" style="height: 300px; width: 300px;" />
                        <input id="file" class="form-control" type="file" name="images_file" />
                        <script>
                            document.getElementById("file").onchange = (e) => {
                                const reader = new FileReader();
                                reader.onload = (x) => {
                                    document.getElementById("images_img").src = x.target.result;
                                }
                                reader.readAsDataURL(e.target.files[0]);
                            };
                        </script>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a type="button" href="danhsach.php" class="btn btn-danger">Quay lại</a>
        </form>
    </div>


    <?php
    include_once __DIR__ . '/../components/footer.php';
    ?>