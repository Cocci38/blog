<h1>Les derniers articles</h1>

<?php // On boucle sur nos articles
foreach($params['posts'] as $post): ?>
<div>
    <h2><?= $post->title ?></h2> <!-- On a défini que l'on souhaitait récupérer les articles de cette façon-->
    <div>
        <?php foreach($post->getTags() as $tag) :  ?>
            <span><?= $tag->name ?></span> <!-- On récupère le nom de nos tag qui sont liés à nos posts-->
        <?php endforeach ?>
    </div>
    <small>Publié le <?= $post->getCreatedAt() ?></small> <!-- La balise small pour écrire en petit (style commentaire) -->
    <p><?= $post->getExcerpt() ?></p>
    <?PHP // $post->getButton() => Si on utlilse la syntaxe Heredoc (voir sur Post.php)?>
    <a href="/site_poo/posts/<?= $post->id ?>"> Lire l'article</a>
</div>

<?php  endforeach ?>
