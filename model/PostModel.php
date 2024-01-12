<?php
class PostModel
{
    public static function fromResult(array $result)
    {
        $motel = new PostModel();
        foreach ($result as $key => $value) {
            $motel->$key = $value;
        }
        return $motel;
    }

    public static function fromForm(array|null $skip)
    {
        $motel = new PostModel();
        $vars = array_keys(get_object_vars($motel));
        $vars = array_diff($vars, $skip);
        foreach ($vars as $key) {
            if (key_exists($key, $_POST)) {
                $motel->$key = $_POST[$key];
            }
        }
        return $motel;
    }

    public static function mergeFromForm(PostModel &$motel)
    {
        $vars = array_keys(get_object_vars($motel));
        foreach ($vars as $key) {
            if (array_key_exists($key, $_POST)) {
                $motel->$key = $_POST[$key];
            }
        }
    }


    public int|null $ID = null;
    public string $Title = "";
    public string $Content = "";
    public int|null $MotelID = null;

}

?>