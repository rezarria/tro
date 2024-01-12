<?php
class DB
{
    private mysqli $conn;
    private string $table;
    private string $db;

    function __construct(string $db, string $table)
    {
        $this->table = $table;
        $this->db = $db;
        $conn = mysqli_connect("localhost", "root", "", $db);
        if (!$conn)
            throw new Exception("lỗi trong quá trình khởi tạo");
        $this->conn = $conn;
    }

    function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    function create_prepare_insert($struct, int $n)
    {
        $t = substr(str_repeat("?,", $n), 0, -1);
        return $this->conn->prepare("INSERT INTO $this->table ($struct) VALUE ($t)");
    }

    function create_prepare_update($struct)
    {
        $sql = "UPDATE $this->table SET " . join(",", array_map(fn($k) => "$k=?", $struct)) . " WHERE ID=?";
        return $this->conn->prepare($sql);
    }

    function create_prepare_select(string|null $where)
    {
        $sql = "SELECT * FROM $this->table";
        if (isset($where)) {
            $sql = $sql . " " . $where;
        }
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function save($data)
    {
        $data = get_object_vars($data);
        unset($data["ID"]);
        $structs = $this->get_struct($data);
        $types = $this->get_types($data);
        $stmt = $this->create_prepare_insert($structs, sizeof($data));
        if ($stmt)
            return $stmt->execute(array_values($data));
        return false;
    }

    public function load(&$data, int $id)
    {
        $vars = get_object_vars($data);
        $structs = $this->get_struct($vars);
        $sql = "SELECT $structs FROM $this->table WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            if (isset($row)) {
                foreach ($row as $key => $value) {
                    $data->$key = $value;
                }
                return true;
            }
        }
        return false;
    }

    public function load_all()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $data;
    }

    public function update($data)
    {
        $data = get_object_vars($data);
        $id = $data["ID"];
        unset($data["ID"]);
        $stmt = $this->create_prepare_update(array_keys($data));
        if ($stmt)
            return $stmt->execute(array_merge(array_values($data), [$id]));
        return false;
    }

    public function load_where(&$data, array|null $where = null)
    {
        $check = function ($n) {
            switch (gettype($n)) {
                case 'string':
                    return 's';
                case 'integer':
                    return 'i';
                case 'double':
                    return 'd';
            }
        };

        $k = [];
        $v = [];
        $t = [];
        $e = [];

        if ($where) {
            foreach ($where as $key => $value) {
                array_push($k, $key);
                array_push($v, $value['value']);
                array_push($t, $check($value['value']));
                $t = $value['type'];
                if ($t)
                    array_push($e, $t);
                else
                    array_push($e, '=');
            }
        }
        $k = join(',', $k);
        $sql = "SELECT $k FROM $this->table";
        if ($where) {

            $sql = $sql . ' WHERE ' . $where;
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->get_result();
        foreach ($result as $key => $value) {
            $data[$key] = $value;
        }
    }

    public static function get_types($array)
    {
        return join("", array_map(function ($i) {
            switch (gettype($i)) {
                case 'string':
                    return 's';
                case 'integer':
                    return 'i';
                case 'double':
                    return 'd';
            }
        }, $array));
    }

    public static function get_struct($array)
    {
        return join(",", array_keys($array));
    }

}

?>