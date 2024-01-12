<?php
namespace MyTrait;
trait ToSql {
    public function create_struct() {
        return implode(",", array_keys(get_object_vars($this)));
    }
}
?>