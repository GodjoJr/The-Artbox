<?php require 'header.php'; ?>

<h1 class="center">Ajouter une oeuvre</h1>

<form id="create-oeuvre-form" action="add.php" method="POST">

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
        <input type="url" name="image" required>
    </label>

    <input type="submit" value="Ajouter une oeuvre" name="submit">
    
</form>

<?php require 'footer.php'; ?>