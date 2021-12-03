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
            $this->redirect('/home');
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
}
