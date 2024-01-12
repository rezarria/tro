<?php
include_once __DIR__ . "/DB.php";
include_once __DIR__ . "/../model/MotelModel.php";
class MotelDAO extends DB
{
    public function __construct()
    {
        parent::__construct("GTPT", "Motel");
    }

    public function load_all()
    {
        $data = parent::load_all();
        return array_map(fn($i) => MotelModel::fromResult($i), $data);
    }
}
?>