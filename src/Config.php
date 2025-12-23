<?php

class Config {
    private static $settings = [];

    public static function load($path) {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($name, $value) = explode('=', $line, 2);
            self::$settings[trim($name)] = trim($value);
        }
    }

    public static function get($key, $default = null) {
        return self::$settings[$key] ?? $default;
    }
}
