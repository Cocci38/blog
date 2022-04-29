<h1>Les derniers articles</h1>

<?php // On boucle sur nos articles
foreach($params['posts'] as $post): ?>
<div class="card border-primary mb-3">
<div class="card-body">
    <h2 class="card-header"><?= $post->title ?></h2> <!-- On a défini que l'on souhaitait récupérer les articles de cette façon-->
        <div>
        <?php foreach($post->getTags() as $tag) :  ?>
            <span class="badge bg-info color-light"><a href="/site_poo/tags/<?= $tag->id ?>"> <?= $tag->name ?> </a></span><!-- On récupère le nom de nos tag qui sont liés à nos posts-->
        <?php endforeach ?>
        </div>
        <small class="text-info">Publié le <?= $post->getCreatedAt() ?></small> <!-- La balise small pour écrire en petit (style commentaire) -->
        <p><?= $post->getExcerpt() ?></p>
        <?PHP // $post->getButton() => Si on utlilse la syntaxe Heredoc (voir sur Post.php)?>
        <a href="/blog/posts/<?= $post->id  ?>" class="btn btn-primary"> Lire l'article</a>
    </div>
</div>

<?php  endforeach ?>
