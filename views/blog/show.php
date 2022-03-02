
<h1><?= $params['post'] ->title ?></h1>
<div>
        <?php foreach($params['post']->getTags() as $tag) :  ?>
            <span><?= $tag->name ?></span>
        <?php endforeach ?>
    </div>
<p><?= $params['post'] ->content ?><</p>
<a href="/site_poo/posts/">Retour</a>