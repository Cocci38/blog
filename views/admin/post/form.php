

<h1> Créer un nouvel article</h1>

<form action="<?= '/site_poo/admin/posts/create' ?>" method="POST">
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input type="text" class="form-control" name="title" id="title" value="">
    </div>
    <div class="form-group">
        <label for="content">Contenu de l'article</label>
        <textarea name="content" id="content" rows="8" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags de l'article</label>
        <select multiple class="form-control" id="tags" name="tags[]">
            <option value="">--Please choose an option--</option>
            <option value="PHP">PHP</option>
            <option value="HTML/CSS">HTML/CSS</option>
            <option value="JS">JS</option>
            <option value="PYTHON">PYTHON</option>
            </select>
    </div>
    <button type="submit" class=""><?='Enregistrer mon article' ?></button>
</form>



