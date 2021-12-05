<?php

use App\Models\Contact;

$this->layout(config('view.layout')); ?>

<?php $this->start('page') ?>
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Contact</h2>
                        <p>
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in some
                            form.
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12 d-flex flex-column align-items-center">
                        <?php if (isset($errors['contact'])) : ?>
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $errors['contact']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
    
                        <?php endif; ?>
                        <?php if (isset($errors['failed'])) : ?>
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $errors['failed']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
    
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="contact-info">
                <div class="d-flex flex-column align-items-center row">
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="contact-form-head">
                            <div class="form-main">
                                <form id="contact-form" class="form" method="post" action="/contact">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-4 mb-3">
                                            <select name="city" id="city" class="form-select" aria-label="Default select example">

                                                <option selected>Select your city</option>

                                                <?php foreach ($cities as $city) : ?>
                                                    <?php if ($contact->ward_id != null && $city->id == $contact->ward->district->city->id) : ?>
                                                        <option selected value="<?= $contact->ward->district->city->id ?>"><?= $contact->ward->district->city->id . ' - ' . $contact->ward->district->city->name ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $city->id ?>"><?= $city->id . ' - ' . $city->name ?></option>
                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-4 mb-3">
                                            <select name="district" id="district" class="form-select" aria-label="Default select example">
                                                <?php if ($contact->ward_id) : ?>
                                                    <option selected value="<?= $contact->ward->district->id ?>"><?= $contact->ward->district->id . ' - ' . $contact->ward->district->name ?></option>
                                                <?php else : ?>
                                                    <option selected value="0">Select your district</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-4 mb-3">
                                            <select name="ward_id" id="ward" class="form-select <?= isset($errors['ward_id']) ? ' is-invalid' : '' ?>" aria-label="Default select example">
                                                <?php if ($contact->ward_id) : ?>
                                                    <option selected value="<?= $contact->ward->id ?>"><?= $contact->ward->id . ' - ' . $contact->ward->name ?></option>
                                                <?php else : ?>
                                                    <option selected value="0">Select your ward</option>
                                                <?php endif; ?>
                                            </select>
                                            <div class="form-message invalid-feedback">
                                                <?= $errors['ward_id'] ?? null ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-3">

                                            <input name="address" class="form-control <?= isset($errors['address']) ? ' is-invalid' : '' ?>" id="address" type="text" placeholder="Your Address" required="required" value="<?= $contact->address ?? null ?>" />

                                            <div class="form-message invalid-feedback">
                                                <?= $errors['address'] ?? null ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-3">
                                            <input name="phone" class="form-control <?= isset($errors['phone']) ? ' is-invalid' : '' ?>" id="phone" type="text" placeholder="Your Phone" required="required" value="<?= $contact->phone ?? null ?>" />
                                            <div class="form-message invalid-feedback">
                                                <?= $errors['phone'] ?? null ?>
                                            </div>

                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-3">
                                            <input name="email" class="form-control <?= isset($errors['email']) ? ' is-invalid' : '' ?>" id="email" type="email" placeholder="Your Email" required="required" value="<?= $contact->email ?? null ?>" />
                                            <div class="form-message invalid-feedback">
                                                <?= $errors['email'] ?? null ?>
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <div class="form-group button d-flex flex-column align-items-center">
                                                <button type="submit" class="btn">
                                                    Submit Message
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->stop() ?>

<?php $this->start('js') ?>
<script src="assets/js/contact.js"></script>
<script src="assets/js/validator.js"></script>
<script>
    Validator({
        form: '#contact-form',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#address'),
            Validator.isPhoneNumber('#phone'),
            Validator.isEmail('#email')
        ]
    });
</script>
<?php $this->stop() ?>