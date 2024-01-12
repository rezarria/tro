<?php

include_once __DIR__ ."/../trait/to_sql.php";

class UserDTO
{
    use MyTrait\ToSql;
    public function __construct(string $username = "",string $password = "",string $email = "",string $name = "",string $phone = "",string $avatar = "", int $role = 0) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->avatar = $avatar;
        $this->email = $email;
        $this->role = $role;
    }

    public string $username;
    public string $password;
    public string $email;
    public string $name;
    public int $role;
    public string $phone;
    public string $avatar;
}

?>