<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
requireLogin();

// Get all available food posts
$query = "SELECT fp.*, u.name as sharer_name 
          FROM food_posts fp
          JOIN users u ON fp.user_id = u.id
          WHERE fp.status = 'available'
          ORDER BY fp.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareBite - Browse Food</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container mt-5">
        <h2 class="mb-4">Available Food</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if ($row['image_path']): ?>
                                <img src="../assets/images/uploads/<?= $row['image_path'] ?>" class="card-img-top" alt="<?= $row['food_name'] ?>">
                            <?php else: ?>
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">No image available</span>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['food_name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><strong>Quantity:</strong> <?= htmlspecialchars($row['quantity']) ?></li>
                                    <li class="list-group-item"><strong>Expiry:</strong> <?= date('M j, Y', strtotime($row['expiry_date'])) ?></li>
                                    <li class="list-group-item"><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></li>
                                    <li class="list-group-item"><strong>Shared by:</strong> <?= htmlspecialchars($row['sharer_name']) ?></li>
                                </ul>
                                <?php if (isSeeker()): ?>
                                    <a href="../actions/request-food.php?food_id=<?= $row['id'] ?>" class="btn btn-primary">Request Food</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">No food available at the moment. Please check back later.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>