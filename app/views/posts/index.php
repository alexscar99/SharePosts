<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('post_message'); ?>
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>

        <div class="col-md-6">
            <a href="<?php print URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php print $post->title; ?></h4>
            <div class="bg-light p-2 mb-3">
                Written by <?php print $post->name; ?> on <?php print $post->postCreated; ?>
            </div>
            <p class="card-text"><?php print $post->body; ?></p>
            <a href="<?php print URLROOT; ?>/posts/show/<?php print $post->postId; ?>" class="btn btn-dark">
                More
            </a>
        </div>
    <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>