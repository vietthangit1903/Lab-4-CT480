<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Http\Response;
use App\Models\User;
use App\Models\Profile;


class ProfileController extends BaseController
{

    public function profile()
    {
        $user = auth();
        if ($user == null) {
            $this->redirect('/login');
        } else {
            $profile = Profile::where(['user_id' => $user->id])->first();
            if ($profile == null) {
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->save();
            }
            return $this->render('profile/profile', ['profile' => $profile]);
        }
    }

    public function uploadProfile()
    {
        $params = $_POST;
        unset($params['avatar_status']);
        $user = auth();
        $profile = Profile::where(['user_id' => $user->id])->first();
        if(($_FILES["avatar"]["name"]) != null)
            $profile->avatar = $profile->uploadImage();
        $profile->fill($params);
        $profile->avatar_status = $_POST['avatar_status'];

        if ($profile->save()) {
            session()->setFlash(\FLASH::SUCCESS, "Congratulations, your profile has been updated successfully.");
            $data = [
                'profile' => $profile
            ];
            return $this->render('profile/profile', $data);
        }
        $data = [
            'errors' => $profile->errors,
            'profile' => $profile
        ];
        return $this->render('profile/profile', $data);
    }
}
