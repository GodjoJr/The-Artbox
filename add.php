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

$image = null;
$upload_dir = 'img/';

if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['image_file']['tmp_name'];
    $extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
    $sanitized_title = preg_replace('/[^a-zA-Z0-9_-]/', '-', strtolower($title));
    $new_filename = $sanitized_title . '_' . time() . '.' . $extension;
    $target_path = $upload_dir . $new_filename;

    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (in_array(mime_content_type($tmp_name), $allowed_types)) {
        if (move_uploaded_file($tmp_name, $target_path)) {
            $image = $target_path;
        }
    }
}

elseif (isset($_POST['image_url']) && !empty($_POST['image_url']) && filter_var($_POST['image_url'], FILTER_VALIDATE_URL)) {
    $image = htmlspecialchars($_POST['image_url']);
}

if (!isset($title) || empty($title) || 
    !isset($artist) || empty($artist) || 
    !isset($description) || empty($description) || 
    !isset($image) || empty($image) || 
    !isset($id) || empty($id) || 
    strlen($description) < 3) {
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
    exit;
}

?>
