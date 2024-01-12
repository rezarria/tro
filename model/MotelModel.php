<?php
class MotelModel
{
    public static function fromResult(array $result)
    {
        $motel = new MotelModel();
        foreach ($result as $key => $value) {
            $motel->$key = $value;
        }
        return $motel;
    }

    public static function fromForm(array|null $skip)
    {
        $motel = new MotelModel();
        $vars = array_keys(get_object_vars($motel));
        $vars = array_diff($vars, $skip);
        foreach ($vars as $key) {
            if (key_exists($key, $_POST)) {
                $motel->$key = $_POST[$key];
            }
        }
        return $motel;
    }

    public static function mergeFromForm(MotelModel &$motel)
    {
        $vars = array_keys(get_object_vars($motel));
        foreach ($vars as $key) {
            if (array_key_exists($key, $_POST)) {
                $motel->$key = $_POST[$key];
            }
        }
    }


    public int|null $ID = null;
    public string|null $title = "";
    public string|null $description = "";
    public int|null $price = 0;
    public int|null $area = -1;
    public int|null $count_view = 0;
    public string|null $address = "";
    public string|null $latlng = "";
    public string|null $images = "";
    public int|null $user_id = null;
    public int|null $category_id = null;
    public int|null $district_id = null;
    public string|null $utilities = "";
    public string|null $created_at = null;
    public string|null $phone = "";
    public int|null $approve = 0;
}

?>