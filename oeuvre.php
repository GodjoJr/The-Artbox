<?php
include("header.php");


function oeuvreFilter($oeuvres, $id)
{
    foreach ($oeuvres as $oeuvre) {
        if ($oeuvre['id'] == $id) {
            return $oeuvre;
        }
    }
    return null;
}

include("oeuvres.php");

$id = $_GET['id'] ?? null;
$oeuvre = oeuvreFilter($oeuvres, $id);


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