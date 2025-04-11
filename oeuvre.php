<?php
include("header.php");

$db = new Database();
$id = $_GET['id'] ?? null;
$oeuvres = $db->get('oeuvres', ['title', 'artist', 'description', 'image'], ['id' => $id]);
$oeuvre = $oeuvres[0] ?? null;
?>

<?php if ($oeuvre): ?>

    <main>
        <article id="detail-oeuvre">
            <div id="img-oeuvre">
                <img src="<?php echo $oeuvre['image']; ?>" alt="<?php echo $oeuvre['title']; ?>">
            </div>
            <div id="contenu-oeuvre">
                <h1><?php echo $oeuvre['title']; ?></h1>
                <p class="description"><?php echo $oeuvre['artist']; ?></p>
                <p class="description-complete"><?php echo $oeuvre['description']; ?></p>
            </div>
        </article>
    </main>


<?php else: ?>
        <p style="text-align: center;margin: 300px auto;">Aucune œuvre ne correspond à l'identifiant fourni.</p>
<?php endif; ?>



<?php include("footer.php"); ?>