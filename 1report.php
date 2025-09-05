<?php
require 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $date_lost = $_POST['date_lost'];
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO users (item_name, description, date_reported, date_lost, location, contact_info, image_url, status)
            VALUES (:item_name, :description, NOW(), :date_lost, :location, :contact_info, :image_url, 'pending')";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item_name' => $item_name,
        ':description' => $description,
        ':date_lost' => $date_lost,
        ':location' => $location,
        ':contact_info' => $contact_info,
        ':image_url' => $image_url
    ]);

    echo "Item reported successfully!";
}
?>

