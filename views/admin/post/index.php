
    <h1>Administration des articles</h1>
<a href="posts/create">Créer un nouvel article</a>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Publié le </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($params['posts'] as $post) : ?>
                <tr>
                    <th><?= $post->id ?>
                    <td><?= $post->title ?></td>
                    <td><?= $post->getCreatedAt() ?></td>
                    <td>
                        <a href="#">Modifier</a>
                        <form action="/site_poo/admin/posts/delete/<?= $post->id ?>" method="post">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
