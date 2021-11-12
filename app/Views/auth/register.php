<?php $this->layout(config('view.layout')); ?>

<?php $this->start('page') ?>

<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Registration</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li>
                        <a href="/home"><i class="lni lni-home"></i> Home</a>
                    </li>
                    <li>Registration</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="register-form">
                    <?php if (isset($errors['failed'])) : ?>
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $errors['failed']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>

                    <?php endif; ?>
                    <form class="row g-3 needs-validation" method="POST" action="\register" id="form_register" novalidate>
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>
                                Registration takes less than a minute but gives you full
                                control over your orders.
                            </p>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control <?= isset($errors['username']) ? ' is-invalid' : '' ?>" name="username" value="<?= $params['username'] ?? null ?>" type="username" id="username" placeholder="Your username" />
                            <label for="username">Username</label>
                            <div class="form-message invalid-feedback">
                                <?= $errors['username'] ?? null ?>
                            </div>
                        </div>


                        <div class="form-floating mb-3">
                            <input class="form-control <?= isset($errors['email']) ? ' is-invalid' : '' ?>" type="email" name="email" value="<?= $params['email'] ?? null ?>" id="email" placeholder="name@example" />
                            <label for="email">Email address</label>
                            <div class="form-message invalid-feedback">
                                <?= $errors['email'] ?? null ?>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control <?= isset($errors['password']) ? ' is-invalid' : '' ?>" type="password" name="password" value="<?= $params['password'] ?? null ?>" id="password" placeholder="Password" />
                            <label for="password">Password</label>
                            <div class="form-message invalid-feedback">
                                <?= $errors['password'] ?? null ?>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control <?= isset($errors['confirm_password']) ? ' is-invalid' : '' ?>" type="password" name="confirm_password" value="<?= $params['confirm_password'] ?? null ?>" id="confirm_password" placeholder="Password" />
                            <label for="confirm_password">Confirm Password</label>
                            <div class="form-message invalid-feedback">
                                <?= $errors['confirm_password'] ?? null ?>
                            </div>
                        </div>

                        <div class="form-floating">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" value="" id="terms" require>
                                <label for="terms" class="form-check-lable">
                                    Agree to terms and conditions.
                                </label>
                            </div>
                        </div>

                        <div class="button">
                            <button class="btn" type="submit">Register</button>
                        </div>
                        <p class="outer-link">
                            Already have an account? <a href="/login">Login Now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->stop() ?>

<?php $this->start('js'); ?>
<script src="assets/js/validator.js"></script>
<script src="assets/js/register.js"></script>
<?php $this->stop() ?>