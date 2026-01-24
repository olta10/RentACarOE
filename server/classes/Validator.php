<?php
class Validator {

    public static function clean($data) {
        return htmlspecialchars(trim($data));
    }

    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
