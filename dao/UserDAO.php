<?php
include_once __DIR__ . "/DB.php";
include_once __DIR__ . "/../dto/UserDTO.php";
include_once __DIR__ . "/../model/UserModel.php";
class UserDAO extends DB
{
    public function __construct()
    {
        parent::__construct("GTPT", "USER");
    }

    public function getUserByUsername(string $username)
    {
        $stmt = $this->create_prepare_select("where username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $resut = $stmt->get_result();
        $row = $resut->fetch_assoc();
        $resut->close();
        if (gettype($row) == "array") {
            return UserModel::fromResult($row);
        }
        return false;
    }

    public function load_all()
    {
        $data = parent::load_all();
        return array_map(fn($i) => UserModel::fromResult($i), $data);
    }
}
?>