<?php

require_once 'Database.php';
$db = new Database();

$ids = $db->get('oeuvres', ['id', 'title']);

$id = isset($ids) && count($ids) > 0 ? end($ids)['id'] + 1 : 1;
if (isset($_POST['title']) && !empty($_POST['title']) && !in_array($_POST['title'], array_column($ids, 'title')))
    $title = htmlspecialchars($_POST['title']);
if (isset($_POST['artist']) && !empty($_POST['artist']))
    $artist = htmlspecialchars($_POST['artist']);
if (isset($_POST['description']) && !empty($_POST['description']))
    $description = htmlspecialchars($_POST['description']);
if (isset($_POST['image']) && !empty($_POST['image']))
    $image = htmlspecialchars($_POST['image']);


if (!isset($title) || empty($title) || !isset($artist) || empty($artist) || !isset($description) || empty($description) || !isset($image) || empty($image) || !isset($id) || empty($id) || strlen($description) < 3 || filter_var($image, FILTER_VALIDATE_URL) === false) {
    header('Location: create.php');
    exit;
} else {
    try {
        $db->insert(
            'oeuvres',
            [
                'id' => $id,
                'title' => $title,
                'artist' => $artist,
                'description' => $description,
                'image' => $image
            ]
        );
    } catch (PDOException | Exception $e) {
        echo $e->getMessage();
    }

    header('Location: index.php');
}

?>
