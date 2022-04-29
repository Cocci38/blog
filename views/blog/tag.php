<h1><?= $params['tag']->name ?></h1>

<?php // On boucle sur nos articles
foreach($params['tag']->getPosts() as $post) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <a><a href="/blog/posts/<?= $post->id ?>" class="btn btn-link text-decoration-none"><?= $post->title ?> </a></a>
        </div>
    </div>

<?php  endforeach ?>