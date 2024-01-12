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
    <h1>Thêm bài viết</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea  id="editor" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a type="button" href="danhsach.php" class="btn btn-danger">Quay lại</a>
    </form>


    
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" integrity="sha512-6JR4bbn8rCKvrkdoTJd/VFyXAN4CE9XMtgykPWgKiHjou56YDJxWsi90hAeMTYxNwUnKSQu9JPc3SQUg+aGCHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    tinymce.init({
  selector: '#editor'
});
</script>

</div>


<?php
include_once __DIR__ . '/../components/footer.php';
?>