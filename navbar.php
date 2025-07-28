<div class="navbar">
    <a href="/pages/home.php">Home</a>
    <a href="/pages/food/browse.php">Browse Food</a>
    <a href="/pages/food/share.php">Share Food</a>
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="/proc/logout.php" class="right">Logout</a>
    <?php else: ?>
        <a href="/pages/auth/login.php" class="right">Login</a>
        <a href="/pages/auth/register.php" class="right">Register</a>
    <?php endif; ?>
</div>