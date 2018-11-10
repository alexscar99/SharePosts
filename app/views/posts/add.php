<?php require APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php print URLROOT; ?>/posts" class="btn btn-light">
        <i class="fa fa-backward"></i> Go Back
    </a>
    <div class="card card-body bg-light mt-5">
        <h2>Add New Post</h2>
        <p>Create a post to share your thoughts</p>
        <form action="<?php print URLROOT; ?>/users/login" method="POST">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?php print (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php print $data['title']; ?>">
                <span class="invalid-feedback"><?php print $data['title_err'] ?></span>
            </div>

            <div class="form-group">
                <label for="body">Body: <sup>*</sup></label>
                <textarea name="body" class="form-control form-control-lg <?php print (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>">
                    <?php print $data['body']; ?>
                </textarea>
                <span class="invalid-feedback"><?php print $data['body_err'] ?></span>
            </div>

            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>