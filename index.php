<?php include("header.php"); ?>
<?php include("oeuvres.php"); ?>
<?php require_once 'Database.php';
?>

<main>

    <div id="liste-oeuvres">

        <?php foreach ($oeuvres as $oeuvre): ?>

            <article class="oeuvre">
                <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                    <img src="<?php echo $oeuvre['image']; ?>" alt="<?php echo $oeuvre['title']; ?>">
                    <h2><?php echo $oeuvre['title']; ?></h2>
                    <p class="description"><?php echo $oeuvre['artist']; ?></p>
                </a>
            </article>

        <?php endforeach; ?>

    </div>

</main>


<?php include("footer.php"); ?>