<?php

namespace App\Traits;

use App\Models\User;

trait UserAuthenticateTrait
{


    /**
     * Kiem tra thong tin user
     * So khop password == password_hash
     * 
     * @param array $credentials
     * @return \App\Models\User|mixed|null
     */
    public function authenticate($credentials)
    {

        $user = User::where(['username' => $credentials['username']])->first();
        if ($user) {
            if (password_check($credentials['password'], $user->password)) {
                return $user;
            }
            return null;
        }
        return false;
    }

    public function signout()
    {
        unset($_SESSION['user']);

        if (isset($_COOKIE['credentials'])) {
            setcookie('credentials', null, time() - 3600);
        }
    }




    public function auto_login()
    {
        $encryptedCredentials = $_COOKIE['credentials'] ?? null;

        if (!$encryptedCredentials) {
            return;
        }

        $decryptedCredentials = decrypt($encryptedCredentials, ENCRYPTION_KEY);

        $credentials = unserialize($decryptedCredentials);

        $user = $this->authenticate($credentials);

        if ($user) {
            $user->password = null;
            $_SESSION['user'] = serialize($user);
        }
    }
}
