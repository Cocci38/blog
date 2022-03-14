<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
    <h1>La liste de nos articles</h1>

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
                    <td><?= $post->created_at ?></td>
                    <td>
                        <a href="#">Modifier</a>
                        <a href="#">Supprimer</a>
                    </td>
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>