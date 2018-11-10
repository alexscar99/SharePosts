<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create Account</h2>
                <p>Fill out the following form to register with us</p>
                <form action="<?php print URLROOT; ?>/users/register" method="POST">
                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-lg <?php print (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php print $data['name']; ?>">
                        <span class="invalid-feedback"><?php print $data['name_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php print (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php print $data['email']; ?>">
                        <span class="invalid-feedback"><?php print $data['email_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php print (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php print $data['password']; ?>">
                        <span class="invalid-feedback"><?php print $data['password_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg <?php print (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php print $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php print $data['confirm_password_err']; ?></span>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php print URLROOT;?>/users/login" class="btn btn-light btn-block">
                                Already have an account?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>