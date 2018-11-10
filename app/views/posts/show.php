<?php require APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php print URLROOT; ?>/posts" class="btn btn-light mb-4">
        <i class="fa fa-backward"></i> Go Back
    </a>
    <br>
    <h1><?php print $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?php print $data['user']->name; ?> on <?php print $data['post']->created_at; ?>
    </div>
    <p><?php print $data['post']->body; ?></p>

    <?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
        <hr>
        <a href="<?php print URLROOT; ?>/posts/edit/<?php print $data['post']->id; ?>" 
        class="btn btn-dark">
            Edit
        </a>
        <form action="<?php print URLROOT; ?>/posts/delete/<?php print $data['post']->id; ?>" 
        method="POST" class="pull-right">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    <?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>