<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property bigint unsigned $ward_id ward id
 * @property bigint unsigned $user_id user id
 * @property varchar $name name
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property timestamp $deleted_at deleted at
 * @property User $user belongsTo
 * @property Ward $ward belongsTo
   
 */
class Contact extends Model
{
    use SoftDeletes;

    /**
     * Database table name
     */
    protected $table = 'contacts';

    /**
     * Use timestamps 
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'user_id',
        'ward_id',
        'address',
        'phone',
        'email',
    ];

    /**
     * user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public $errors = [];

    public function validate($params = []){
        //Validate ward id
        if($params['ward_id'] == null || $params['ward_id'] == 0){
            $this->errors['ward_id'] = 'You must choose specific ward!';
        }
        
        //Validate address
        if($params['address'] == null){
            $this->errors['address'] = 'You must type specific address!';
        }

        //Validate phone number
        //Phone number bat dau bang 84 hoac 0, theo sau la 9 chu so
        $pattern = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';
        if (!preg_match($pattern, $params['phone'])) {
            $this->errors['phone']= 'Phone number is invalid!';
        }

        //Validate email
        if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        }

        $contact = Contact::where(['user_id' => $params['user_id'], 'ward_id' => $params['ward_id'], 'address' => $params['address']])->first();
        if ($contact)
        $this->errors['contact'] = 'This contact is already exitst. Please choose another one.';
        
        if(!empty($this->errors)){
            return false;
        }

        return true;
    }

    
}
