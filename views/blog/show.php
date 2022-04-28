<div class="jumbotron">
    <h1><?= $params['post'] ->title ?></h1>
    <?php foreach($params['post']->getTags() as $tag) :  ?>
        <span class="badge bg-info"><?= $tag->name ?></span>
    <?php endforeach ?>
    <hr class="my-4">
    <p class="lead"><?= $params['post'] ->content ?></p>
    <a href="/site_poo/posts/" class="btn btn-primary">Retour</a>        

</div>