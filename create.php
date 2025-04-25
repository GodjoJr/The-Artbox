<?php require 'header.php'; ?>

<h1 class="center">Ajouter une oeuvre</h1>

<form id="create-oeuvre-form" action="add.php" method="POST" enctype="multipart/form-data">

    <label for="title">Titre de l'oeuvre
        <input type="text" name="title" required>
    </label>

    <label for="artist">Artiste
        <input type="text" name="artist" required>
    </label>

    <label for="description">Description
        <textarea name="description" required></textarea>
    </label>

    <label for="image">URL de l'image
        <input type="url" name="image">
    </label>

    <label for="image">Fichier de l'image (JPG, JPEG, PNG, GIF, WebP)
    <input type="file" name="image_file" accept="image/*">
    </label>

    <input type="submit" value="Ajouter une oeuvre" name="submit">
    
</form>

<?php require 'footer.php'; ?>