<?php
class UserModel
{
    public static function fromResult(array $result)
    {
        $user = new UserModel();
        $user->ID = $result['ID'];
        $user->Username = $result['Username'];
        $user->Password = $result['Password'];
        $user->Email = $result['Email'];
        $user->Name = $result['Name'];
        $user->Phone = $result['Phone'];
        $user->Avatar = $result['Avatar'];
        $user->Role = $result['Role'];
        return $user;
    }

    public static function fromForm(array|null $skip)
    {
        $user = new UserModel();
        $vars = array_keys(get_object_vars($user));
        $vars = array_diff($vars, $skip);
        foreach ($vars as $key) {
            if (key_exists($key, $_POST)) {
                $user->$key = $_POST[$key];
            }
        }
        return $user;
    }

    public static function mergeFromForm(UserModel &$user)
    {
        $vars = array_keys(get_object_vars($user));
        foreach ($vars as $key) {
            if (array_key_exists($key, $_POST)) {
                $user->$key = $_POST[$key];
            }
        }
    }

    public function __construct(int $id = -1, string $username = "", string $password = "", string $email = "", string $name = "", string $phone = "", string $avatar = "", int $role = 0)
    {
        $this->ID = $id;
        $this->Username = $username;
        $this->Password = $password;
        $this->Email = $email;
        $this->Name = $name;
        $this->Phone = $phone;
        $this->Avatar = $avatar;
        $this->Role = $role;
    }

    public int $ID;
    public string $Username;
    public string $Password;
    public string $Email;
    public string $Name;
    public int $Role;
    public string $Phone;
    public string $Avatar;
}

?>