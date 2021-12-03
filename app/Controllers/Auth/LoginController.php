<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Traits\UserAuthenticateTrait;


class LoginController extends BaseController{

    use UserAuthenticateTrait;


    public function showLoginForm(){
        if(check_login() == true){
            $this->redirect("/home");
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
            //session()->set('user', serialize($user));
            if($this->request->post('remember_me')){

                $str = serialize($credentials);

                $encrypted = encrypt($str, ENCRYPTION_KEY);

                setcookie('credentials', $encrypted, mktime(23,59,59,12,1,2021));
            }
            
            session()->setFlash(\FLASH::SUCCESS, "Login successfully");
            //redirect('/home');
            $this->redirect('/home');

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
            'username' => $this->request->post('username'),
            'password' => $this->request->post('password'),
        ];
    }

    public function logout(){
        $this->signout();

        session()->setFlash(\FLASH::INFO, "Bye!");

        //redirect('\home');
        $this->redirect('/home');
    }
}