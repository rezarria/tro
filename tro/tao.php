<?php
include_once __DIR__ . '/../components/head.php';
$msg = null;
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        include_once __DIR__ . '/../model/MotelModel.php';
        include_once __DIR__ . '/../dao/MotelDAO.php';
        $db = new MotelDAO();
        $motel = MotelModel::fromForm([]);
        if (isset($_FILES["images_file"])) {
            $images = $_FILES["images_file"];
            $upload_dir = "/www/tro/uploads/";
            $target_file = $upload_dir . basename($images["name"]);
            move_uploaded_file($images["tmp_name"], $target_file);
            $motel->images = $target_file;
        }
        $db->save($motel);
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
        <h1>Thêm trọ</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tên</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label for="appover">Trạng thái</label>
                <select class="form-select">
                    <option selected value="0">Trống</option>>
                    <option value="1">Đã thuê</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="utilities" class="form-label">Tiện ích</label>
                <textarea class="form-control" id="utilities" name="utilities"></textarea>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Hình ảnh</label>
                <input type="text" name="images" id="images" class="form-control" hidden>
                <div class="card">
                    <div class="card-body">
                        <img id="images_img" src="#" style="height: 300px; width: 300px;" />
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