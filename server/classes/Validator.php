<?php

class Validator {

    public static function clean($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    public static function required($value) {
        return isset($value) && trim($value) !== '';
    }

    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function minLength($value, $min) {
        return strlen(trim($value)) >= $min;
    }

    public static function maxLength($value, $max) {
        return strlen(trim($value)) <= $max;
    }
}
