<?php
require 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $date_lost = $_POST['date_lost'];
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    
    // Handle file upload
    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $filename;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            $image_url = $filename; // Store just filename, not full path
        }
    }

    // FIXED: Use 'lost_items' table instead of 'users'
    $sql = "INSERT INTO lost_items (item_name, description, date_reported, date_lost, location, contact_info, image_url, status)
            VALUES (:item_name, :description, NOW(), :date_lost, :location, :contact_info, :image_url, 'lost')";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item_name' => $item_name,
        ':description' => $description,
        ':date_lost' => $date_lost,
        ':location' => $location,
        ':contact_info' => $contact_info,
        ':image_url' => $image_url
    ]);

    header("Location: browse.php");
    exit();
}
?>