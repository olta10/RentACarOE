<?php
class Validator {

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function required($value) {
        return isset($value) && trim($value) !== '';
    }

    public static function minLength($value, $length) {
        return strlen(trim($value)) >= $length;
    }
}
