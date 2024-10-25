<?php
// Connect to your database
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

// Fetch color names and RGB values from the database along with member and post counts
$query = "SELECT g.group_id, g.group_name, g.description, g.icon_url, g.icon_color, g.c_theme, 
                 COALESCE(COUNT(m.member_id), 0) AS member_count,
                 COALESCE(COUNT(p.post_id), 0) AS post_count
          FROM group_table g
          LEFT JOIN group_members m ON g.group_id = m.group_id
          LEFT JOIN post p ON g.group_id = p.group_id
          GROUP BY g.group_id";
$result = mysqli_query($conn, $query);
$colors = array();

while ($row = mysqli_fetch_assoc($result)) {
    $colors[] = array(
        'g_id' => $row['group_id'],
        'gname' => $row['group_name'],
        'desc' => $row['description'],
        'icon_img' => $row['icon_url'],
        'icon_color' => $row['icon_color'],
        'rgb' => $row['c_theme'],
        'member_count' => $row['member_count'],
        'post_count' => $row['post_count']
    );
}

// Close database connection
mysqli_close($conn);

// Return colors as JSON
echo json_encode($colors);
?>
