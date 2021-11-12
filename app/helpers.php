<?php

use App\Traits\UserAuthenticateTrait;


if (!function_exists('config')) {
    /**
     * Đọc giá trị trong app/config/*
     * 
     * @param string $key
     * @return array|stirng|mix
     */

    function config($key)
    {
        /**
         * @var array|mixed
         */
        $config = $GLOBALS['config'];

        return $config->get($key);
    }
}

if (!function_exists('redirect')) {
    function redirect($location)
    {
        if (ob_get_level()) {
            ob_end_clean();
        }

        header('Location: ' . $location);
        exit();
    }
}

if (!function_exists('check_login')) {
    function check_login()
    {
        return isset($_SESSION['user']) ? true : false;
    }
}

if (!function_exists('encrypt')) {
    function encrypt($pure_string, $encryption_key)
    {
        $ciphering = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($ciphering);
        $option = 0;

        $encryption_iv = '1234567891011121';

        $encryption = openssl_encrypt(
            $pure_string,
            $ciphering,
            $encryption_key,
            $option,
            $encryption_iv
        );

        return $encryption;
    }
}

if (!function_exists('decrypt')) {
    function decrypt($encryption_string, $encryption_key)
    {
        $ciphering = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($ciphering);
        $option = 0;

        $decryption_iv = '1234567891011121';

        $decryption = openssl_decrypt(
            $encryption_string,
            $ciphering,
            $encryption_key,
            $option,
            $decryption_iv
        );

        return $decryption;
    }
}

if (!function_exists('encrypt_password')) {
    function encrypt_password($password)
    {
        $option = [
            'cost' => 12
        ];
        return password_hash($password, PASSWORD_BCRYPT, $option);
    }
}

if (!function_exists('password_check')) {
    function password_check($password, $password_hash)
    {
        return password_verify($password, $password_hash);
    }
}


if (!function_exists('auth')) {
    /**
     * Tra ve User model neu da login
     * 
     * @return \App\Models\User|mixed
     */
    function auth()
    {
        $userSerialized = $_SESSION['user'] ?? null;

        $user = $userSerialized ? unserialize($userSerialized) : null;

        return $user;
    }
}
