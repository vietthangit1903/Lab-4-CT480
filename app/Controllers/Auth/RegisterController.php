<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use Exception;

class RegisterController extends BaseController
{

    public function showRegisterForm()
    {
        
        return $this->render('auth/register');
    }

    public function register()
    {

        $params = $_POST;

        $user = new User();
        $user->fill($params);

        if ($user->validate($params)) {
            $user->password = encrypt_password($user->password);

            if ($user->save()) {
                $message['success'] = 'Congratulations, your account has been created successfully.';

                return $this->render('auth/register_success', ['messages' => $message]);
            }

            $user->errors['failed'] = 'Registration failed. Something went wrong, please try again.';
        }
        $data = [
            'errors' => $user->errors,
            'params' => $params,
        ];
        return $this->render('auth/register', $data);
    }
}
