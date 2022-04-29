
<h1>Administration des articles</h1>

<?php if(isset($_GET['success'])) : ?>
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"><a href="/blog/admin/posts" ></a></button>
    <p> Vous êtes connecté </p>
    </div>
<?php endif ?>

<a href="/blog/admin/posts/create" class="btn btn-primary">Créer un nouvel article</a>
<br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titre</th>
                <th scope="col">Publié le </th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($params['posts'] as $post) : ?>
                <tr class="table-light">
                    <th scope="row"><?= $post->id ?>
                    <td><?= $post->title ?></td>
                    <td><?= $post->getCreatedAt() ?></td>
                    <td class="action">
                        <a href="/blog/admin/posts/edit/<?= $post->id ?>" class="btn btn-warning">Modifier</a>
                        <form action="/blog/admin/posts/delete/<?= $post->id ?>" method="post">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
