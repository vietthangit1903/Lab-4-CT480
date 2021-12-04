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
                </div>
            </div>
            <div class="contact-info">
                <div class="d-flex flex-column align-items-center row">
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="contact-form-head">
                            <div class="form-main">
                                <form class="form" method="post" action="/contact">
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
                                                <?php if ($contact->ward_id != null) : ?>
                                                    <option selected value="<?= $contact->ward->district->id ?>"><?= $contact->ward->district->id . ' - ' . $contact->ward->district->name ?></option>
                                                <?php else : ?>
                                                    <option selected>Select your district</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-4 mb-3">
                                            <select name="ward_id" id="ward" class="form-select" aria-label="Default select example">
                                                <?php if ($contact->ward_id != null) : ?>
                                                    <option selected value="<?= $contact->ward->id ?>"><?= $contact->ward->id . ' - ' . $contact->ward->name ?></option>
                                                <?php else : ?>
                                                    <option selected>Select your ward</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <input name="address" id="address" type="text" placeholder="Your Address" required="required" value="<?= $contact->address ?? null ?>" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <input name="phone" id="address" type="text" placeholder="Your Phone" required="required" value="<?= $contact->phone ?? null ?>" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <input name="email" id="address" type="email" placeholder="Your Email" required="required" value="<?= $contact->email ?? null ?>" />
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
<?php $this->stop() ?>