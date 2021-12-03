<?php $this->layout(config('view.layout')); ?>

<?php $this->start('css') ?>
<?= $this->insert('profile/css') ?>
<?php $this->stop() ?>

<?php $this->start('page') ?>

<div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Profile Settings</h4>
            </div>
            <form action="" method="post">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px"
                        src="<?= $profile->avatar ?>">
                    <div class="col-md-10">
                        <label class="labels" for="customFile">Add proflie image</label>
                        <input type="file" class="form-control" id="customFile" />
                    </div>    
                    <span class="font-weight-bold"><?= $profile->user->username ?></span>
                    <span class="text-black-50"><?= $profile->user->email ?></span><span> </span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="col-md-10">
                        <label class="labels">Location</label>
                        <input type="text" class="form-control" placeholder="Location" name="location" value="<?= $profile->location ?>">
                    </div>
                    <div class="col-md-10">
                        <label class="labels">Biography</label>
                        <input type="text" class="form-control" placeholder="Biography" name="bio" value="<?= $profile->bio ?>">
                    </div>
                    <div class="col-md-10">
                        <label class="labels">Twitter Username</label>
                        <input type="text" class="form-control" placeholder="Twitter Username" name="twitter_username" value="<?= $profile->twitter_username ?>">
                    </div>
                    <div class="col-md-10">
                        <label class="labels">Github Username</label>
                        <input type="text" class="form-control" placeholder="Github Username" name="github_username" value="<?= $profile->github_username ?>">
                    </div>

                </div>

                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                </div>
            </form>
        </div>
    </div>

<?php $this->stop() ?>