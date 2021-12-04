<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bigint unsigned $user_id user id
 * @property varchar $name name
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property timestamp $deleted_at deleted at
 * @property User $user belongsTo
   
 */
class Profile extends Model
{
    /**
     * Database table name
     */
    protected $table = 'profiles';

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
        'location',
        'bio',
        'twitter_username',
        'github_username',
        'avatar',
        'avartar_status',
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

    public $errors = [];

    public function uploadImage()
    {
        if (($_FILES["avatar"]["name"]) != null){
            $target_dir = "assets/images/profile";
            $target_file = $target_dir . '/' . basename($_FILES["avatar"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $this->errors['invalidImage'] = "File is not an image.";
                    $uploadOk = 0;
                }
            }
    
            // Check if file already exists
            if (file_exists($target_file)) {
                $this->errors['imageExist']  = "Sorry, file already exists.";
                $uploadOk = 0;
            }
    
            // Check file size
            if ($_FILES["avatar"]["size"] > 5000000) {
                $this->errors['imageLarge'] = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $this->errors['imageType'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an errors
            if ($uploadOk == 0) {
                session()->setFlash(\FLASH::ERROR, "Sorry, your file was not uploaded.");
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    session()->setFlash(\FLASH::SUCCESS, "The file " . htmlspecialchars(basename($_FILES["avatar"]["name"])) . " has been uploaded.");
                } else {
                    session()->setFlash(\FLASH::ERROR, "Sorry, there was an error uploading your file.");
                }
            }
            return $target_file;
        }
        else
            return null;
    }
}
