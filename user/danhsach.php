<?php
include_once __DIR__ . '/../components/head.php';
?>

    <div class="container">
        <div class="row my-3">
            <div class="col">
                <a href="tao.php" class="btn btn-primary">Tạo</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <?php
                    include_once __DIR__ . '/../dao/UserDAO.php';
                    $db = new UserDAO();
                    $data = $db->load_all();
                    ?>
                    <tbody>
                        <?php
                        foreach ($data as $key => $value) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $key ?>
                                </th>
                                <td>
                                    <?php echo $value->Username ?>
                                </td>
                                <td>
                                    <?php echo $value->Name ?>
                                </td>
                                <td>
                                    <?php echo $value->Email ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="sua.php?id=<?php echo $value->ID ?>">Sửa</a>
                                    <a class="btn btn-danger" href="xoa.php?id=<?php echo $value->ID ?>">Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../components/footer.php';
    ?>