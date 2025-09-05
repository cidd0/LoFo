<?php
require 'dbConfig.php';

// Fetch all items from database
$sql = "SELECT * FROM lost_items ORDER BY date_reported DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>Browse Items</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <img src="../assets/images/logo.png" alt="Systems Plus Computer College" class="logo">
        <nav>
            <button class="nav-btn" onclick="window.location.href='../index.html'">Home</button>
            <button class="nav-btn" onclick="window.location.href='../pages/login.html'">Login</button>
        </nav>
    </header>
    <main>
        <h1>LO-FO</h1>
        <h2>Lost Items</h2>
        <input type="text" placeholder="Search items..." class="search-bar">
        <div class="items-grid">
            <?php if (empty($items)): ?>
                <p>No items reported yet.</p>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <div class="item" onclick="viewItemDetails('<?= htmlspecialchars($item['item_name']) ?>', '<?= $item['image_url'] ? '../uploads/' . htmlspecialchars($item['image_url']) : '../assets/images/placeholder.jpg' ?>', '<?= date('M j, Y', strtotime($item['date_reported'])) ?>', '<?= htmlspecialchars($item['location']) ?>', '<?= htmlspecialchars($item['description']) ?>', '<?= ucfirst($item['status']) ?>')">
                        <img src="<?= $item['image_url'] ? '../uploads/' . htmlspecialchars($item['image_url']) : '../assets/images/placeholder.jpg' ?>" alt="<?= htmlspecialchars($item['item_name']) ?>">
                        <h3><?= htmlspecialchars($item['item_name']) ?></h3>
                        <p>Posted <?= date('M j, Y', strtotime($item['date_reported'])) ?></p>
                        <p class="status <?= strtolower($item['status']) ?>"><?= ucfirst($item['status']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <!-- Modal -->
    <div id="itemModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Item Image">
            <h2 id="modalTitle">Item Name</h2>
            <p><strong>Date Reported:</strong> <span id="modalDate"></span></p>
            <p><strong>Location:</strong> <span id="modalLocation"></span></p>
            <p><strong>Description:</strong> <span id="modalDescription"></span></p>
            <p class="status" id="modalStatus"></p>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
</body>
</html>