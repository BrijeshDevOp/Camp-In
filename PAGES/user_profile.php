<?php
    if(isset($_GET['user_id']))
    {
        $encodedValue = $_GET['user_id'];
        $uid = base64_decode($encodedValue);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/user_profile.css">
</head>
<body>
    
    <div class="parent_container">
        <div class="b profile_box">
            <div class="box">
                <img src="../Assets/images/profile.png" alt="" id="img">
            </div>
        </div>
        <div class="b profile_name" id="user_name">brijesh</div>
        <div class="b posts bc">
            <img src="../ICONS/at.svg" alt="" srcset="">
        </div>
        <div class="b posts_count" id="posts"></div>

        <div class="b groups bc">
            <img src="../ICONS/at.svg" alt="" srcset="">
        </div>
        <div class="b groups_count" id="groups"></div>
    </div>

    <script>
        var uId = '<?php echo $uid?>';
        console.log(uId);
    </script>
    <script>
        userId = uId;
    
    fetch(`../getData/profile_data.php?user_id=${userId}`)
      .then(response => response.json())
      .then(data => {
        console.log(`Username: ${data.username}`);
        const profile_img  = document.getElementById('image');
        profile_img.src =data.profile_url;
        console.log(profile_img);

        const profile_name = document.getElementById('user_name');
        profile_name.textContent = data.username;
        console.log(profile_name);
        const posts = document.getElementById('posts');
        console.log(posts);
        posts.textContent = data.post_count;
        const groups = document.getElementById('groups');
        groups.textContent = data.group_count;
        console.log(likes);
        
        console.log(`Profile URL: ${data.profile_url}`);
        console.log(`Total Posts: ${data.post_count}`);
        console.log(`Total Groups: ${data.group_count}`);
      })
      .catch(error => {
        console.error('Error fetching user data:', error);
      });
    </script>
</body>
</html>