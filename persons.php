<?php
    require 'config/dbConnect.php';
    require 'includes/header.php';
    require 'includes/nav.php';
?>
<div class="main">
    <h2>User Management</h2>
    
    <div class="form-container">
        <table class="food-table">
            <caption>All Users</caption>
            <tr>
                <th>SN</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Date Registered</th>
                <th>Actions</th>
            </tr>
            <?php
            $query_users = "SELECT * FROM Users 
                          LEFT JOIN Roles USING (role_id) 
                          LEFT JOIN Genders USING (gender_id) 
                          ORDER BY Users.full_name ASC";
            $result = $conn->query($query_users); 
            $sn = 0;
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sn++;
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($row['gender_name'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
                <td>
                    [ <a href="edit_user.php?id=<?php echo $row['user_id']; ?>">Edit</a> ] |
                    [ <a href="proc/processes.php?delete_user=<?php echo $row['user_id']; ?>" 
                        onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($row['full_name']); ?>?');">
                        Delete
                    </a> ]
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='8'>No users found in the system.</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="about-section">
        <h2>About ShareBite</h2>
        <p>ShareBite is a community-driven platform that connects people with surplus food to those who need it. Our mission is to reduce food waste while helping to feed our community.</p>
        <p>By joining ShareBite, you become part of a movement that values sustainability, community support, and responsible consumption. Together, we can make a difference one meal at a time.</p>
    </div>
</div>
<?php
    require 'includes/footer.php';
?>