<h1>Les derniers articles</h1>

<?php // On boucle sur nos articles
foreach($params['posts'] as $post): ?>
<div>
    <h2><?= $post->title ?></h2> <!-- On a défini que l'on souhaitait récupérer les articles de cette façon-->
    <small><?= $post->created_at ?></small> <!-- La balise small pour écrire en petit (style commentaire) -->
    <p><?= $post->content ?></p>
    <a href="/site_poo/posts/<?= $post->id ?>">Lire plus</a>
</div>

<?php  endforeach ?>
