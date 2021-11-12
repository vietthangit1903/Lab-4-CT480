<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{

    use SoftDeletes;

    /**
     * Neu khong co thuoc tinh ten bang, Eloquent se lay ten theo
     * ten Model o dang so nhieu
     * @var string
     */

    protected $table = 'users';

    /**
     * Su dung thuoc tinh created_at va updated_at trong bang
     * @var boolean
     */
    public $timestamps = false;

    public $errors = [];

    /**
     * Danh sach thuoc tinh de gan hang loat
     * 
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * Validate
     * 
     * @var array $params
     * @return \App\Models\User|boolean|mixed
     */

    public function validate($params = [])
    {

        //Validate username
        //Username chua ky tu, so, dau '_' tu 6 - 20 ky tu
        $pattern = '/^[a-zA-Z0-9_]{6,20}$/';
        if (!preg_match($pattern, $params['username'])) {
            $this->errors['username']= 'Only letters, numbers, underscore and at least 6 characters and maximum 20 characters';
        }

        //Validate email
        if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        }

        //Validate password
        $pattern = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/';
        if (!preg_match($pattern, $params['password'])) {
            $this->errors['password'] = 'Password must contains at least one capitalize letter, number and special character.';
        }

        //Validate confirm password
        if ($params['password'] !== $params['confirm_password']) {
            $this->errors['confirm_password'] = 'Password does not match.';
        }

        $user = User::where(['username' => $params['username']])->first();
        if ($user)
        $this->errors['username'] = 'This username is already taken. Please choose another one.';
        

        if(!empty($this->errors)){
            return false;
        }

        return true;
    }
}
