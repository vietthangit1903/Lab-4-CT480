<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Traits\UserAuthenticateTrait;


class LoginController extends BaseController{

    use UserAuthenticateTrait;


    public function showLoginForm(){
        if(check_login() == true){
            redirect("/home");
        }

        $errors = [];
        return $this->render('auth/login');
    }

    public function login(){
        $credentials = $this->getCredentials();
        $user = $this->authenticate($credentials);
        if($user){
            $user->password = null;
            $_SESSION['user'] = serialize($user);

            if(isset($_POST['remember_me'])){

                $str = serialize($credentials);

                $encrypted = encrypt($str, ENCRYPTION_KEY);

                setcookie('credentials', $encrypted, mktime(23,59,59,12,1,2021));
            }

            redirect('/home');

        }


        $errors[] = 'Username or password is invalid!';

        $data = [
            'errors' => $errors,
            'credentials' => $credentials,
        ];

        return $this->render('auth/login', $data);
    }

    public function getCredentials(){
        return [
            'username' => $_POST['username'] ?? null,
            'password' => $_POST['password'] ?? null
        ];
    }

    public function logout(){
        $this->signout();
        redirect('\home');
    }
}