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
        <form action="/profile" method="post" enctype="multipart/form-data">
            <div class="d-flex flex-column align-items-center">
                <img class="rounded-circle mt-5 avatar" width="150px" height="150px" src="<?= $profile->avatar_status ? $profile->avatar : "\assets\images\profile\default-avartar.png"  ?>">
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php
                            foreach ($errors as $err) {
                                echo "<li>$err</li>";
                            }
                            ?>
                        </ul>

                    </div>
                <?php endif; ?>
                <span class="font-weight-bold fs-5"><?= $profile->user->username ?></span>
                <span class="text-black-50 fs-5"><?= $profile->user->email ?></span><span> </span>

                <div class="col-md-10">
                    <label class="labels" for="avatar">Add proflie image</label>
                    <input type="file" name="avatar" class="form-control" id="avatar" />
                </div>
                
                <div class="col-md-10 my-2" >
                    <input type="radio" class="form-check-input" id="show-avatar" name="avatar_status" value="1" <?= $profile->avatar_status ? 'checked': null?>>
                    <label for="show_avata" class="pe-3">Show avatar</label>
                    <input type="radio" class="form-check-input" id="hide-avatar" name="avatar_status" value="0" <?= $profile->avatar_status ? null : 'checked' ?>>
                    <label for="hide_avatar">Hide avartar</label>

                </div>
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