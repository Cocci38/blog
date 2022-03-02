<h1><?= $params['tag']->name ?></h1>

<?php // On boucle sur nos articles
foreach($params['tag']->getPosts() as $post) : ?>
<div>
    <a href="/site_poo/posts/<?= $post->id ?>"><?= $post->title ?> </a>
</div>

<?php  endforeach ?>