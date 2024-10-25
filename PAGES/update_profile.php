<?php
    session_start();
    $user_id = $_SESSION['u_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../css/update_profile.css">
</head>
<body>
    <div class="parent_container">

        <div class="profile_box">
            <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
            <div class="upload">
                <img src="" id = "image" >
                
                <div class="rightRound" id ="upload">
                    <input type="file" name="fileImg" id = "fileImg" accept=".jpg, .jpeg, .png">
                    <i class = "fa fa-camera"></i>
                </div>
                
                <div class="leftRound" id = "cancel" style = "display: none;">
                    <i class = "fa fa-times"></i>
                </div>
                <div class="rightRound" id = "confirm" style = "display: none;">
                    <input type="submit">
                    <input type="hidden" name="imageData" id="imageData"> <!-- New hidden input field -->
                    <i class = "fa fa-check"></i>
                </div>
            </div>
            </form>
        </div>

        <div class="user_name" id="user_name">Bijju</div>

        <div class="user_info">
            <div class="info_box">
                <div class="b box1">
                    <img src="../ICONS/posts.svg" alt="">
                </div>
                <div class="b box2" id="posts"></div>
                <div class="b box3">
                    <img src="../ICONS/community.svg" alt="" srcset="">
                </div>
                <div class="b box4" id="likes"></div>
            </div>
        </div>

        <!-- <div class="user_post_container" id="user_post_container">

             <div class="user-post-container">

                    <div class="home-camp-name-box">
                        <div class="home-at-icon-box">
                            <img src="../ICONS/at.svg" alt="" srcset="">
                        </div>
                        <div class="home-camp-name">
                            <a class="home-camp-link" href="">brijesh</a>
                        </div>
                    </div>

                    <div class="home-post-img-box">
                        <img src="../POSTS/20230811_033943_64d5915f8d916.jpg" alt="">
                    </div>

                    <div class="home-info-function-box">
                        <div class="home-info-box">
                            <div class="home-profile-box">
                                <img src="../POSTS/20230811_033943_64d5915f8d916.jpg" alt="">
                            </div>
                            <div class="home-name-box">
                                <a href="gd.php" class="user-name">user1</a>
                            </div>
                        </div>
                        <div class="home-function-box">
                            <div class="like-box">
                                        <img src="../ICONS/heart-regular.svg" alt="" srcset="">
                            </div>
                                
                            <div class="like-count-box">100</div>
                        </div>
                    </div>
                    
                    <div class="home-description-box">
                        <div class="home-post-description">
                            quis odit iusto vitae.
                        </div>
                    </div>

             </div> -->
             <!-- -------------------------------------------------HOME POST CONTAINER------------------------------------------------------- -->

        <!-- </div> -->
        <!-- ------------------------------------------------------user_post_container------------------------------------------------------------------- -->
            <div class="logout_box"></div>
    </div>
    <!-- -------------------------------------------------------------PARENT_CONTAINER------------------------------------------------------------------------ -->
    <script>
        var uId = '<?php echo $user_id; ?>';
        console.log(uId);
    </script>
    
    <script src="../js/profileData.js"></script>
</body>
</html>