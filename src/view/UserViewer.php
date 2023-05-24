<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';

class UserViewer
{
    public static function selectWithOptions($selected)
    {
        $roles = UserStore::getRoles();

        $el = "<select name='role'>";
        foreach ($roles as $role => $value) {
            if ($role === $selected) {
                $el .= "<option value='{$role}' selected>{$value}</option>";
            } else {
                $el .= "<option value='{$role}'>{$value}</option>";
            }
        }
        $el .= "</select>";

        return $el;
    }
}